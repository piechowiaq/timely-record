<?php

namespace App\Http\Controllers;

use App\Models\Registry;
use App\Http\Requests\StoreRegistryRequest;
use App\Http\Requests\UpdateRegistryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Admin/Permissions/PermissionIndex', [
            'filters' => $request->all(['search', 'trashed']),
            'permissions' => Permission::when($request->input('search'), function ($query, $search) {

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
                ->through(fn($permission) => [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'deleted_at' => $permission->deleted_at
                ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Permissions/PermissionCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permission = Permission::create(['name' => $request->get('name')]);

        return Redirect::route('permissions.edit',  ['permission' => $permission])->with('success', 'Permission created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return Inertia::render('Admin/Permissions/PermissionEdit', [
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $permission->name = $request->get('name');
        $permission->save();

        return Redirect::route('permissions.index')->with('success', 'Permission updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return Redirect::route('permissions.index')->with('success', 'Permission deleted.');
    }

    public function restore(Permission $permission)
    {
        $permission->restore();

        return Redirect::route('permissions.index')->with('success', 'Permission restored.');
    }
}
