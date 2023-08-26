<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistryController;
use App\Http\Controllers\RoleController;
use App\Models\Registry;
use Illuminate\Foundation\Application;
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
    return Inertia::render('Test');
});




Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('welcome');

Route::get('/contact', function () {
    return Inertia::render('Contact', [
        'canLogin' => Route::has('login'),
    ]);
})->name('contact');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'admin.authorize'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');

    Route::resource('companies', CompanyController::class);
    Route::put('companies/{company}/restore', [CompanyController::class, 'restore'])->name('companies.restore');
    Route::resource('registries', RegistryController::class);
    Route::put('registries/{registry}/restore', [RegistryController::class, 'restore'])->name('registries.restore');
    Route::resource('permissions', PermissionController::class);
    Route::put('permissions/{permission}/restore', [PermissionController::class, 'restore'])->name('permissions.restore');
    Route::resource('roles', RoleController::class);
    Route::put('permissions/{role}/restore', [RoleController::class, 'restore'])->name('roles.restore');

});









Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
