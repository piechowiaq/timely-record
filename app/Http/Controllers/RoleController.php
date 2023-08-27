<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Admin/Roles/RoleIndex', [
            'filters' => $request->all(['search', 'trashed']),
            'roles' => Role::when($request->input('search'), function ($query, $search) {

                $query->where('name' , 'like', '%' . $search. '%');

            })
                ->when($request->input('trashed'), function ($query, $trashed) {
                    if ($trashed === 'with') {
                        $query->withTrashed();
                    } elseif ($trashed === 'only') {
                        $query->onlyTrashed();
                    }
                })->paginate(10)
                ->withQueryString()
                ->through(fn($role) => [
                    'id' => $role->id,
                    'name' => $role->name,
                    'deleted_at' => $role->deleted_at
                ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Roles/RoleCreate', [
            'permissions' => Permission::all()->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $role = Role::create(['name' => $request->get('name')]);

        $role->syncPermissions($request->get('permission_ids'));

        return Redirect::route('roles.edit', ['role' => $role])->with('success', 'Role created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all()->toArray();

        $rolePermissionIds = $role->permissions->pluck('name')->toArray();

        return Inertia::render('Admin/Roles/RoleEdit', [
            'role' => $role,
            'permissions' => $permissions,
            'permission_ids' => $rolePermissionIds
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->name = $request->get('name');
        $role->save();

        $role->syncPermissions($request->get('permission_ids'));

        return Redirect::route('roles.index')->with('success', 'Role updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return Redirect::route('roles.index')->with('success', 'Role deleted.');
    }

    public function restore(Role $role)
    {
        $role->restore();

        return Redirect::route('roles.index')->with('success', 'Role restored.');
    }
}
