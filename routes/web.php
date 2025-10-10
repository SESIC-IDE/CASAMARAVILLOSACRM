<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CustomerController,
    InteractionController,
    ReminderController,
    ReportController
};


Route::get('/', function () {
    return view('welcome'); // o tu vista personalizada, por ejemplo 'inicio'
})->name('home');
/*
|--------------------------------------------------------------------------
| Rutas protegidas por autenticación
|--------------------------------------------------------------------------
*/

// Dashboard principal (redirige al ReportController)
Route::middleware(['auth', 'verified'])
    ->get('/dashboard', [ReportController::class, 'dashboard'])
    ->name('dashboard');

// Grupo de rutas autenticadas
Route::middleware('auth')->group(function () {

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Rutas para roles admin y manager
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,manager')->group(function () {
        Route::resource('customers', CustomerController::class);
        Route::resource('interactions', InteractionController::class);
        Route::resource('reminders', ReminderController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Rutas solo para admin
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::get('/reports/customers', [ReportController::class, 'customersReport'])->name('reports.customers');
        Route::get('/reports/customers/pdf', [ReportController::class, 'exportPdf'])->name('reports.pdf');
        Route::get('/reports/customers/excel', [ReportController::class, 'exportExcel'])->name('reports.excel');
    });
});

/*
|--------------------------------------------------------------------------
| Rutas de autenticación (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
