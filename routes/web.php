<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Project\ProjectDashboardController;
use App\Http\Controllers\Workspace\WorkspaceDashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyUserController;
use App\Http\Controllers\Workspace\WorkspaceDashboardSelectorController;
use App\Http\Controllers\Workspace\WorkspaceRegistryController;
use App\Http\Controllers\Workspace\WorkspaceRegistryReportController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test', function () {
    return Inertia::render('Workspace/WorkspaceSelector');
})->name('test');




Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('welcome');


Route::middleware('guest')->group(function(){

    Route::get('/contact', function () {
        return Inertia::render('Contact', [
            'canLogin' => Route::has('login'),
        ]);
    })->name('contact');

    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard',ProjectDashboardController::class)->name('project.dashboard');
    Route::resource('workspaces', WorkspaceController::class);




});


//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//
//


Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');

    Route::resource('companies', CompanyController::class);
    Route::resource('projects', ProjectController::class);
    Route::put('companies/{company}/restore', [CompanyController::class, 'restore'])->name('companies.restore');
    Route::resource('registries', RegistryController::class);
    Route::put('registries/{registry}/restore', [RegistryController::class, 'restore'])->name('registries.restore');
    Route::resource('permissions', PermissionController::class);
    Route::put('permissions/{permission}/restore', [PermissionController::class, 'restore'])->name('permissions.restore');
    Route::resource('roles', RoleController::class);
    Route::put('roles/{role}/restore', [RoleController::class, 'restore'])->name('roles.restore');
    Route::resource('users', UserController::class);
    Route::put('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified', 'project.access', ])->group(function () {
    Route::get('/{company}/dashboard',WorkspaceDashboardController::class)->name('workspace.dashboard');
    Route::get('/selector', WorkspaceDashboardSelectorController::class)->name('workspace.selector');
    Route::get('/{company}/registries', [WorkspaceRegistryController::class, 'index'])->name('workspace.registries.index');
    Route::get('/{company}/registries/{registry}', [WorkspaceRegistryController::class, 'show'])->name('workspace.registries.show');
    Route::get('/{company}/registries/{registry}/reports/create', [WorkspaceRegistryReportController::class, 'create'])->name('workspace.registry.reports.create');
    Route::get('/{company}/registries/{registry}/reports/{report}/edit', [WorkspaceRegistryReportController::class, 'edit'])->name('workspace.registry.reports.edit');
    Route::put('/{company}/registries/{registry}/reports/{report}/restore', [WorkspaceRegistryReportController::class, 'restore'])->name('workspace.registry.reports.restore');
    Route::put('/{company}/registries/{registry}/reports/{report}', [WorkspaceRegistryReportController::class, 'update'])->name('workspace.registry.reports.update');
    Route::delete('/{company}/registries/{registry}/reports/{report}', [WorkspaceRegistryReportController::class, 'destroy'])->name('workspace.registry.reports.destroy');
    Route::post('/{company}/registries/{registry}/reports', [WorkspaceRegistryReportController::class, 'store'])->name('workspace.registry.reports.store');
});

require __DIR__.'/auth.php';
