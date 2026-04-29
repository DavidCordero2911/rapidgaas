<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminTallerController;
use App\Http\Controllers\MecanicoController;
use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/forzar-logout', function() {
    auth()->logout();
    session()->flush();
    return redirect('/login');
});
require __DIR__.'/auth.php';

//Rutas protegidas por login, cada una con su middleware de rol para que solo puedan acceder los usuarios con ese rol
Route::middleware(['auth'])->group(function () {

    //Superadmin
    Route::middleware(['role:superadmin'])->prefix('superadmin')->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    });

    //Admin del taller
    Route::middleware(['role:admin_taller'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminTallerController::class, 'index'])->name('admin.dashboard');
    });

    //Mecánico
    Route::middleware(['role:mecanico'])->prefix('mecanico')->group(function () {
        Route::get('/dashboard', [MecanicoController::class, 'index'])->name('mecanico.dashboard');
    });

    //Cliente
    Route::middleware(['role:cliente'])->prefix('cliente')->group(function () {
        Route::get('/dashboard', [ClienteController::class, 'index'])->name('cliente.dashboard');
    });

});
