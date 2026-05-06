@extends('layouts.adminlte')

@section('page_title', 'Panel Admin Taller')

@section('extra_css')
<style>
    :root { --naranja: #FF6600; --azul: #007FFF; }

    .stat-card {
        border:none; border-radius:12px;
        border-left:5px solid var(--naranja);
        box-shadow:0 4px 15px rgba(0,0,0,0.08);
        transition:transform 0.3s ease, box-shadow 0.3s ease;
    }
    .stat-card:hover { transform:translateY(-4px); box-shadow:0 8px 25px rgba(0,0,0,0.12); }
    .stat-card.azul { border-left-color:var(--azul); }
    .stat-icon { font-size:2.5rem; opacity:0.85; }
    .stat-number { font-size:2rem; font-weight:700; color:#2d2d2d; }
    .stat-label { font-size:0.85rem; color:#888; text-transform:uppercase; letter-spacing:1px; }
    .section-title { font-weight:700; color:#2d2d2d; border-left:4px solid var(--naranja); padding-left:10px; margin-bottom:20px; }
    .welcome-banner { background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); border-radius:12px; border-left:5px solid var(--naranja); color:white; padding:25px 30px; margin-bottom:25px; }
    .welcome-banner h4 { font-weight:700; font-size:1.4rem; margin-bottom:5px; }
    .welcome-banner p { opacity:0.75; margin-bottom:0; font-size:0.9rem; }
    .badge-naranja { background-color:var(--naranja); color:white; font-size:0.75rem; padding:4px 10px; border-radius:20px; }
</style>
@stop

@section('page_content')

{{-- Banner --}}
<div class="welcome-banner">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4><i class="fas fa-clipboard-list me-2" style="color:#FF6600;"></i>Panel Admin Taller</h4>
            <p>Bienvenido, <strong>{{ auth()->user()->nombre }}</strong>. Gestiona los vehículos y órdenes del taller.</p>
        </div>
        <span class="badge-naranja">
            <i class="fas fa-circle me-1" style="font-size:8px;"></i> Sistema activo
        </span>
    </div>
</div>

{{-- Estadísticas --}}
<h5 class="section-title">Resumen del taller</h5>
<div class="row g-3 mb-4">

    <div class="col-md-3 col-sm-6">
        <div class="card stat-card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number">{{ $totalClientes }}</div>
                    <div class="stat-label">Clientes</div>
                </div>
                <div class="stat-icon" style="color:#FF6600;"><i class="fas fa-users"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card stat-card azul p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number">{{ $totalVehiculos }}</div>
                    <div class="stat-label">Vehículos</div>
                </div>
                <div class="stat-icon" style="color:#007FFF;"><i class="fas fa-motorcycle"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card stat-card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number">{{ $ordenesActivas }}</div>
                    <div class="stat-label">Órdenes activas</div>
                </div>
                <div class="stat-icon" style="color:#FF6600;"><i class="fas fa-wrench"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card stat-card azul p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-number">{{ $ordenesPendientes }}</div>
                    <div class="stat-label">En espera</div>
                </div>
                <div class="stat-icon" style="color:#007FFF;"><i class="fas fa-clock"></i></div>
            </div>
        </div>
    </div>

</div>

{{-- Accesos rápidos --}}
<h5 class="section-title">Accesos rápidos</h5>
<div class="row g-3">

    <div class="col-md-4">
        <a href="{{ route('admin.clientes.index') }}" class="text-decoration-none">
            <div class="card stat-card p-3 text-center">
                <div style="color:#FF6600; font-size:2rem; margin-bottom:8px;">
                    <i class="fas fa-users"></i>
                </div>
                <div class="fw-bold" style="color:#2d2d2d;">Gestión de clientes</div>
                <small class="text-muted">Ver, crear y editar clientes</small>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ route('admin.vehiculos.index') }}" class="text-decoration-none">
            <div class="card stat-card azul p-3 text-center">
                <div style="color:#007FFF; font-size:2rem; margin-bottom:8px;">
                    <i class="fas fa-motorcycle"></i>
                </div>
                <div class="fw-bold" style="color:#2d2d2d;">Gestión de vehículos</div>
                <small class="text-muted">Ver, crear y editar vehículos</small>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ route('admin.ordenes.index') }}" class="text-decoration-none">
            <div class="card stat-card p-3 text-center">
                <div style="color:#FF6600; font-size:2rem; margin-bottom:8px;">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="fw-bold" style="color:#2d2d2d;">Órdenes de trabajo</div>
                <small class="text-muted">Ver y gestionar órdenes</small>
            </div>
        </a>
    </div>

</div>

@stop
