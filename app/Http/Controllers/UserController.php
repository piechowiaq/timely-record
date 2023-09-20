<?php

namespace App\Http\Controllers;


use App\Events\RegisterUser;
use App\Events\UserCreated;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Admin/Users/UserIndex', [
            'filters' => $request->all(['search', 'trashed']),
            'users' => User::when($request->input('search'), function ($query, $search) {

                $query->where('name' , 'like', '%' . $search. '%')
                    ->orWhere('last_name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            })
                ->when($request->input('trashed'), function ($query, $trashed) {
                    if ($trashed === 'with') {
                        $query->withTrashed();
                    } elseif ($trashed === 'only') {
                        $query->onlyTrashed();
                    }
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'deleted_at' => $user->deleted_at
                ]),
        ]);
    }
    /**
     * Display the registration view.
     */
    public function create()
    {
        return Inertia::render('Admin/Users/UserCreate', [
            'roles' => Role::all()->toArray(),
            'companies' => Company::all()->toArray()
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        $user->assignRole($request->get('role_id'));

        $companyIds = $request->get('company_ids');
        $companies  = new Collection();

        if (is_array($companyIds)) {
            $companies = Company::whereIn('id', $companyIds)->get();
        }

        $user->companies()->sync($companies);

        $token = app('auth.password.broker')->createToken($user);


        $url = route('password.reset', ['token' => $token, 'email' => $request->email]);

        $user->notify(new \App\Notifications\RegisterUser($url));

        $user->markEmailAsVerified();

        return Redirect::route('users.index')->with('success', 'User created. Verification e-mail sent.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render('Admin/Users/UserEdit', [
            'user' => $user,
            'roles' => Role::all()->toArray(),
            'role_id' => $user->roles()->pluck('id')->first(),
            'companies' => Company::all()->toArray(),
            'company_ids' => $user->companies()->get()->pluck('id')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->save();

        if (!$request->get('password') === null)
        {
            $user->password = Hash::make($request->get('password'));
            $user->save();
        }

        $user->syncRoles($request->get('role_id'));

        $companyIds = $request->get('company_ids');
        $companies  = new Collection();

        if (is_array($companyIds)) {
            $companies = Company::whereIn('id', $companyIds)->get();
        }

        $user->companies()->sync($companies);

        return Redirect::route('users.index')->with('success', 'User updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return Redirect::route('users.index')->with('success', 'User deleted.');
    }

    public function restore(User $user)
    {
        $user->restore();

        return Redirect::route('users.index')->with('success', 'User restored.');
    }
}
