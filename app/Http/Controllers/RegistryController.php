<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Registry;
use App\Http\Requests\StoreRegistryRequest;
use App\Http\Requests\UpdateRegistryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RegistryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Admin/Registries/RegistryIndex', [
        'filters' => $request->all(['search', 'trashed']),
        'registries' => Registry::when($request->input('search'), function ($query, $search) {

            $query->where('name', 'like', '%' . $search . '%');

        })
            ->when($request->input('trashed'), function ($query, $trashed) {
                if ($trashed === 'with') {
                    $query->withTrashed();
                } elseif ($trashed === 'only') {
                    $query->onlyTrashed();
                }
            })->paginate(10)
            ->withQueryString()
            ->through(fn($registry) => [
                'id' => $registry->id,
                'name' => $registry->name,
                'description' => $registry->description,
                'valid_for' => $registry->valid_for,
                'deleted_at' => $registry->deleted_at
            ]),
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Registries/RegistryCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegistryRequest $request)
    {
        $registry = new Registry();
        $registry->name = $request->get('name');
        $registry->description = $request->get('description');
        $registry->valid_for = $request->get('valid_for');
        $registry->save();

        $registry->companies()->sync(Company::all());

        return Redirect::route('registries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Registry $registry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registry $registry)
    {
        return Inertia::render('Admin/Registries/RegistryEdit', [
            'registry' => $registry,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegistryRequest $request, Registry $registry)
    {
        $registry->name = $request->get('name');
        $registry->description = $request->get('description');
        $registry->valid_for = $request->get('valid_for');
        $registry->save();

        $registry->companies()->sync(Company::all());

        return Redirect::route('registries.index')->with('success', 'Registry updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registry $registry)
    {
        $registry->delete();

        return Redirect::route('registries.index')->with('success', 'Registry deleted.');
    }

    public function restore(Registry $registry)
    {

        $registry->restore();

        return Redirect::route('registries.index')->with('success', 'Registry restored.');
    }
}
