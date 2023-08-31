<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Registry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Admin/Companies/CompanyIndex', [
            'filters' => $request->all(['search', 'trashed']),
            'companies' => Company::when($request->input('search'), function ($query, $search) {

                $query->where('name' , 'like', '%' . $search. '%')
                    ->orWhere('city', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            })
                ->when($request->input('trashed'), function ($query, $trashed) {
                    if ($trashed === 'with') {
                        $query->withTrashed();
                    } elseif ($trashed === 'only') {
                        $query->onlyTrashed();
                    }
                })->paginate(5)
                ->withQueryString()
                ->through(fn($company) => [
                    'id' => $company->id,
                    'name' => $company->name,
                    'city' => $company->last_name,
                    'email' => $company->email,
                    'phone' => $company->phone,
                    'deleted_at' => $company->deleted_at
                ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Companies/CompanyCreate',[
            'registries' => Registry::all()->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = new Company();
        $company->name = $request->get('name');
        $company->city = $request->get('city');
        $company->email = $request->get('email');
        $company->phone = $request->get('phone');
        $company->save();

        $registries = Registry::all();
        $companyRegistries = Registry::findMany($request->get('registry_ids'));

        $company->registries()->syncWithPivotValues($registries, ['assigned' => false]);
        $company->registries()->detach($companyRegistries);
        $company->registries()->attach($companyRegistries, ['assigned' => true]);

        return Redirect::route('companies.index')->with('success', 'Company created.');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company): Response
    {
        $registries = $company->registries()->where('assigned', 1)->get();

        $companyRegistries = $registries->map(function ($registry, $key) {
            return $registry->id;
        });

        return Inertia::render('Admin/Companies/CompanyEdit', [
            'company' => $company,
            'registries' => $company->registries()->get(),
            'registry_ids' => $companyRegistries->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->name = $request->get('name');
        $company->city = $request->get('city');
        $company->email = $request->get('email');
        $company->phone = $request->get('phone');
        $company->save();

        $companyRegistries = Registry::findMany($request->get('registry_ids'));

        $registries = Registry::all();
        $company->registries()->syncWithPivotValues($registries, ['assigned' => false]);
        $company->registries()->detach($companyRegistries);
        $company->registries()->attach($companyRegistries, ['assigned' => true]);

        return Redirect::route('companies.index')->with('success', 'Company updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return Redirect::route('companies.index')->with('success', 'Company deleted.');
    }

    public function restore(Company $company): RedirectResponse
    {
        $company->restore();

        return Redirect::route('companies.index')->with('success', 'Company restored.');
    }
}
