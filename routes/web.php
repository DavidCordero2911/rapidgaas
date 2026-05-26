<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MecanicoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\OrdenTrabajoController;
use App\Http\Controllers\RegistroReparacionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forzar-logout', function() {
    auth()->logout();
    session()->flush();
    return redirect('/login');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== ADMIN ====================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Usuarios
    Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
    Route::get('/usuarios/{id}/cambiar-rol', [AdminController::class, 'cambiarRol'])->name('admin.cambiarRol');
    Route::post('/usuarios/{id}/cambiar-rol', [AdminController::class, 'actualizarRol'])->name('admin.actualizarRol');
    Route::post('/usuarios/{id}/toggle-activo', [AdminController::class, 'toggleActivo'])->name('admin.toggleActivo');

    // CRUD Clientes
    Route::get('/clientes', [ClienteController::class, 'listar'])->name('admin.clientes.index');
    Route::get('/clientes/crear', [ClienteController::class, 'crear'])->name('admin.clientes.create');
    Route::post('/clientes', [ClienteController::class, 'guardar'])->name('admin.clientes.store');
    Route::get('/clientes/{id}/editar', [ClienteController::class, 'editar'])->name('admin.clientes.edit');
    Route::put('/clientes/{id}', [ClienteController::class, 'actualizar'])->name('admin.clientes.update');
    Route::delete('/clientes/{id}', [ClienteController::class, 'eliminar'])->name('admin.clientes.destroy');

    // CRUD Vehículos
    Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('admin.vehiculos.index');
    Route::get('/vehiculos/crear', [VehiculoController::class, 'create'])->name('admin.vehiculos.create');
    Route::post('/vehiculos', [VehiculoController::class, 'store'])->name('admin.vehiculos.store');
    Route::get('/vehiculos/{id}/editar', [VehiculoController::class, 'edit'])->name('admin.vehiculos.edit');
    Route::put('/vehiculos/{id}', [VehiculoController::class, 'update'])->name('admin.vehiculos.update');
    Route::delete('/vehiculos/{id}', [VehiculoController::class, 'destroy'])->name('admin.vehiculos.destroy');

    // CRUD Órdenes
    Route::get('/ordenes', [OrdenTrabajoController::class, 'index'])->name('admin.ordenes.index');
    Route::get('/ordenes/crear', [OrdenTrabajoController::class, 'create'])->name('admin.ordenes.create');
    Route::post('/ordenes', [OrdenTrabajoController::class, 'store'])->name('admin.ordenes.store');
    Route::get('/ordenes/{id}', [OrdenTrabajoController::class, 'show'])->name('admin.ordenes.show');
    Route::get('/ordenes/{id}/editar', [OrdenTrabajoController::class, 'edit'])->name('admin.ordenes.edit');
    Route::put('/ordenes/{id}', [OrdenTrabajoController::class, 'update'])->name('admin.ordenes.update');
    Route::delete('/ordenes/{id}', [OrdenTrabajoController::class, 'destroy'])->name('admin.ordenes.destroy');
});

// ==================== MECÁNICO ====================
Route::middleware(['auth', 'role:mecanico|admin'])->prefix('mecanico')->group(function () {
    Route::get('/dashboard', [MecanicoController::class, 'index'])->name('mecanico.dashboard');
    Route::get('/ordenes/activas', [MecanicoController::class, 'ordenesActivas'])->name('mecanico.ordenesActivas');
    Route::get('/ordenes/finalizadas', [MecanicoController::class, 'ordenesFinalizadas'])->name('mecanico.ordenesFinalizadas');
    Route::post('/ordenes/{id}/estado', [MecanicoController::class, 'actualizarEstado'])->name('mecanico.actualizarEstado');
    Route::get('/ordenes/{id}/reparacion', [RegistroReparacionController::class, 'show'])->name('mecanico.reparacion');
    Route::post('/ordenes/{id}/reparacion', [RegistroReparacionController::class, 'store'])->name('mecanico.guardarReparacion');
});

// ==================== CLIENTE ====================
Route::middleware(['auth', 'verified', 'role:cliente|admin'])->prefix('cliente')->group(function () {
    Route::get('/dashboard', [ClienteController::class, 'index'])->name('cliente.dashboard');
    Route::get('/notificaciones', [ClienteController::class, 'notificaciones'])->name('cliente.notificaciones');
    Route::post('/notificaciones/leer', [ClienteController::class, 'marcarLeidas'])->name('cliente.notificaciones.leer');
});
