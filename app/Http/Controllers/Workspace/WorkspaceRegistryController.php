<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Registry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class WorkspaceRegistryController extends Controller
{
    public function index(Request $request, Company $company): Response
    {
        $query = DB::table('registries')
            ->join('company_registry', 'registries.id', '=', 'company_registry.registry_id')
            ->leftJoin('reports', function ($join) {
                $join->on('company_registry.registry_id', '=', 'reports.registry_id')
                    ->on('company_registry.company_id', '=', 'reports.company_id')
                    ->whereRaw('reports.expiry_date = (SELECT MAX(expiry_date) FROM reports WHERE reports.registry_id = company_registry.registry_id)');
            })
            ->where('company_registry.company_id', '=', $company->id)
            ->where('assigned', true)
            ->select('company_registry.registry_id', 'registries.name', DB::raw('MAX(reports.expiry_date) as expiry_date'), 'company_registry.company_id')
            ->groupBy('company_registry.registry_id', 'registries.name', 'company_registry.company_id');




        if ($request->has('search')){
            $query->where('registries.name', 'like', '%' .$request->get('search') . '%');
        }

        if($request->has(['field', 'direction'])){

            $query->orderBy($request->get('field'), $request->get('direction'));
        }

        $companies = Auth::user()->companies()->pluck('company_id');

        $companiesCount = Auth::user()->companies()->count();

        return Inertia::render('Workspace/Registries/RegistryIndex', [
            'registries' => $query->paginate(10)
                ->withQueryString(),
            'filters'=> $request->all(['search', 'field', 'direction']),
            'company' => $company,
            'companies' => $companies,
            'companiesCount' => $companiesCount,
            'countOfUpToDateRegistries' => $query->whereNotNull('expiry_date')->where('expiry_date', '>', Carbon::now() )->get()->count()
        ]);
    }

    public function show(Company $company, Registry $registry)
    {
        $companies = Auth::user()->companies()->pluck('company_id');

        $companiesCount = Auth::user()->companies()->count();

        return Inertia::render('Workspace/Registries/RegistryShow', [
            'company' => $company,
            'registry' => $registry,
            'reports' => $registry->reports()->where('company_id', $company->id)->get()->toArray(),
            'companies' => $companies,
            'companiesCount' => $companiesCount,

        ]);
    }
}
