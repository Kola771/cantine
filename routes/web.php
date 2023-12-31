<?php

use App\Http\Controllers\AdminEntrepriseController;
use App\Http\Controllers\LicenceHistoriqueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/accueilUser', [RolesController::class, 'accueilUser'])->middleware(['auth', 'verified'])->name('accueilUser');
Route::get('/dashboard', [RolesController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/gestionUserIndex', [LicenceHistoriqueController::class, 'gestionUserIndex'])->middleware(['auth', 'verified'])->name('gestionUserIndex');
Route::get('/', [RolesController::class, 'logIn'])->name('logIn');

Route::get('/adminEnterprise', [AdminEntrepriseController::class, 'index'])->name('adminEnterprise');
Route::post('/createAdminEnt', [AdminEntrepriseController::class, 'createAdminEnt'])->name('createAdminEnt');
Route::post('/updateAdminEnt', [AdminEntrepriseController::class, 'update'])->name('updateAdminEnt');
Route::get('/indexAdmin', [AdminEntrepriseController::class, 'indexAdmin'])->name('indexAdmin');
Route::get('/getInfoAdminEnt', [AdminEntrepriseController::class, 'edit'])->name('getInfoAdminEnt');
Route::get('/showAdminEnt/{id}', [AdminEntrepriseController::class, 'show'])->name('showAdmin');
Route::get('/getInfoAdminEnt', [AdminEntrepriseController::class, 'edit'])->name('getInfoAdminEnt');
Route::delete('/delSupAdminEnt', [AdminEntrepriseController::class, 'destroy'])->name('delSupAdminEnt');
Route::post('/createAdminUser', [AdminEntrepriseController::class, 'createAdminUser'])->name('createAdminUser');
Route::post('/searchInputAdminEnt', [AdminEntrepriseController::class, 'searchInputAdminEnt'])->name('searchInputAdminEnt');

Route::post('/createUser', [LicenceHistoriqueController::class, 'createUser'])->name('createUser');
Route::post('/createUserNew', [LicenceHistoriqueController::class, 'createUserNew'])->name('createUserNew');
Route::post('/updateUserNew', [LicenceHistoriqueController::class, 'updateUserNew'])->name('updateUserNew');
Route::get('/indexUser', [LicenceHistoriqueController::class, 'indexUser'])->name('indexUser');
Route::delete('/deleteUser', [LicenceHistoriqueController::class, 'deleteUser'])->name('deleteUser');
Route::get('/paginationUser', [LicenceHistoriqueController::class, 'paginationUser'])->name('paginationUser');
Route::get('/search', [LicenceHistoriqueController::class, 'search'])->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
