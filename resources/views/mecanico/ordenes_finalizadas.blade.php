@extends('layouts.adminlte')

@section('page_title', 'Órdenes Finalizadas')

@section('extra_css')
<style>
    :root { --naranja: #FF6600; --azul: #007FFF; }
    .welcome-banner { background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); border-radius:12px; border-left:5px solid var(--naranja); color:white; padding:25px 30px; margin-bottom:25px; }
    .section-title { font-weight:700; color:#2d2d2d; border-left:4px solid var(--naranja); padding-left:10px; margin-bottom:20px; }
    .orden-card { border:none; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.08); margin-bottom:20px; overflow:hidden; }
    .orden-card-header { background:linear-gradient(135deg,#1a1a2e,#0f3460); color:white; padding:15px 20px; }
    .badge-estado { padding:5px 12px; border-radius:20px; font-size:0.78rem; font-weight:600; }
    .estado-finalizado { background-color:#28a745; color:white; }
    .estado-entregado { background-color:#1a1a2e; color:white; }
    .btn-ver { background-color:var(--azul); color:white; border:none; border-radius:20px; padding:6px 16px; font-weight:600; font-size:0.85rem; transition:all 0.3s; text-decoration:none; display:inline-block; }
    .btn-ver:hover { background-color:#0066CC; color:white; }
</style>
@stop

@section('page_content')

<div class="welcome-banner">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4><i class="fas fa-check-circle me-2" style="color:#FF6600;"></i>Órdenes Finalizadas</h4>
            <p>Historial de reparaciones completadas.</p>
        </div>
        <a href="{{ route('mecanico.dashboard') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>
</div>

<h5 class="section-title">Órdenes finalizadas ({{ $ordenes->count() }})</h5>

@forelse($ordenes as $orden)
<div class="card orden-card">
    <div class="orden-card-header d-flex justify-content-between align-items-center">
        <div>
            <span class="fw-bold" style="color:#FF6600;">{{ $orden->vehiculo->matricula }}</span>
            <span class="text-white ms-2">{{ $orden->vehiculo->marca }} {{ $orden->vehiculo->modelo }}</span>
        </div>
        <span class="badge-estado estado-{{ $orden->estado }}">
            {{ ucfirst(str_replace('_', ' ', $orden->estado)) }}
        </span>
    </div>
    <div class="card-body p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <p class="mb-1"><span class="fw-semibold">Cliente:</span> {{ $orden->vehiculo->cliente->nombre ?? '—' }}</p>
                <p class="mb-1"><span class="fw-semibold">Teléfono:</span> {{ $orden->vehiculo->cliente->telefono ?? '—' }}</p>
                <p class="mb-1"><span class="fw-semibold">Fecha entrada:</span>
                    {{ $orden->fecha_entrada ? \Carbon\Carbon::parse($orden->fecha_entrada)->format('d/m/Y') : '—' }}
                </p>
                <p class="mb-1"><span class="fw-semibold">Fecha entrega:</span>
                    {{ $orden->fecha_entrega ? \Carbon\Carbon::parse($orden->fecha_entrega)->format('d/m/Y') : '—' }}
                </p>
                <p class="mb-0"><span class="fw-semibold">Coste final:</span>
                    @if($orden->coste_final)
                        <span class="fw-bold" style="color:#FF6600;">{{ number_format($orden->coste_final, 2) }} €</span>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </p>
            </div>
            <div class="col-md-6">
                <p class="mb-1"><span class="fw-semibold">Diagnóstico inicial:</span></p>
                <p class="text-muted small">{{ $orden->diagnostico_inicial ?? '—' }}</p>
                <p class="mb-1"><span class="fw-semibold">Observaciones:</span></p>
                <p class="text-muted small">{{ $orden->observaciones ?? '—' }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('mecanico.reparacion', $orden->id) }}" class="btn-ver">
                <i class="fas fa-eye me-2"></i>Ver registro de reparación
            </a>
        </div>
    </div>
</div>
@empty
<div class="card p-4 text-center text-muted" style="border-radius:12px;">
    <i class="fas fa-check-circle fa-2x mb-2"></i>
    <p class="mb-0">No tienes órdenes finalizadas todavía.</p>
</div>
@endforelse

@stop
