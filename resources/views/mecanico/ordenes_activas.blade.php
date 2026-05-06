@extends('layouts.adminlte')

@section('page_title', 'Órdenes Activas')

@section('extra_css')
<style>
    :root { --naranja: #FF6600; --azul: #007FFF; }
    .welcome-banner { background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); border-radius:12px; border-left:5px solid var(--naranja); color:white; padding:25px 30px; margin-bottom:25px; }
    .section-title { font-weight:700; color:#2d2d2d; border-left:4px solid var(--naranja); padding-left:10px; margin-bottom:20px; }
    .orden-card { border:none; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.08); margin-bottom:20px; overflow:hidden; transition:transform 0.3s ease; }
    .orden-card:hover { transform:translateY(-3px); }
    .orden-card-header { background:linear-gradient(135deg,#1a1a2e,#0f3460); color:white; padding:15px 20px; }
    .badge-estado { padding:5px 12px; border-radius:20px; font-size:0.78rem; font-weight:600; }
    .estado-en_espera { background-color:#6c757d; color:white; }
    .estado-en_diagnostico { background-color:#007FFF; color:white; }
    .estado-en_reparacion { background-color:#FF6600; color:white; }
    .btn-reparacion { background-color:var(--azul); color:white; border:none; border-radius:20px; padding:6px 16px; font-weight:600; font-size:0.85rem; transition:all 0.3s; text-decoration:none; display:inline-block; }
    .btn-reparacion:hover { background-color:#0066CC; color:white; }
    .btn-actualizar { background-color:var(--naranja); color:white; border:none; border-radius:20px; padding:6px 16px; font-weight:600; font-size:0.85rem; transition:all 0.3s; }
    .btn-actualizar:hover { background-color:#e65c00; color:white; }
    .form-select:focus, .form-control:focus { border-color:var(--azul); box-shadow:0 0 0 0.25rem rgba(0,127,255,0.15); }
</style>
@stop

@section('page_content')

<div class="welcome-banner">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4><i class="fas fa-wrench me-2" style="color:#FF6600;"></i>Órdenes Activas</h4>
            <p>Listado de tus reparaciones en curso.</p>
        </div>
        <a href="{{ route('mecanico.dashboard') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<h5 class="section-title">Órdenes activas ({{ $ordenes->count() }})</h5>

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
                <p class="mb-0"><span class="fw-semibold">Entrega estimada:</span>
                    {{ $orden->fecha_estimada ? \Carbon\Carbon::parse($orden->fecha_estimada)->format('d/m/Y') : '—' }}
                </p>
            </div>
            <div class="col-md-6">
                <p class="mb-1"><span class="fw-semibold">Diagnóstico inicial:</span></p>
                <p class="text-muted small">{{ $orden->diagnostico_inicial ?? 'Sin diagnóstico registrado.' }}</p>
            </div>
        </div>

        <div class="mb-3">
            <a href="{{ route('mecanico.reparacion', $orden->id) }}" class="btn-reparacion">
                <i class="fas fa-tools me-2"></i>Gestionar reparación
            </a>
        </div>

        <hr>
        <form method="POST" action="{{ route('mecanico.actualizarEstado', $orden->id) }}">
            @csrf
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Actualizar estado</label>
                    <select name="estado" class="form-select form-select-sm">
                        <option value="en_espera"      {{ $orden->estado == 'en_espera'      ? 'selected' : '' }}>En espera</option>
                        <option value="en_diagnostico" {{ $orden->estado == 'en_diagnostico' ? 'selected' : '' }}>En diagnóstico</option>
                        <option value="en_reparacion"  {{ $orden->estado == 'en_reparacion'  ? 'selected' : '' }}>En reparación</option>
                        <option value="finalizado"     {{ $orden->estado == 'finalizado'     ? 'selected' : '' }}>Finalizado</option>
                        <option value="entregado"      {{ $orden->estado == 'entregado'      ? 'selected' : '' }}>Entregado</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Comentario (opcional)</label>
                    <input type="text" name="comentario" class="form-control form-control-sm"
                        placeholder="Añade una observación...">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-actualizar w-100">
                        <i class="fas fa-save me-1"></i>Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@empty
<div class="card p-4 text-center text-muted" style="border-radius:12px;">
    <i class="fas fa-wrench fa-2x mb-2"></i>
    <p class="mb-0">No tienes órdenes activas actualmente.</p>
</div>
@endforelse

@stop
