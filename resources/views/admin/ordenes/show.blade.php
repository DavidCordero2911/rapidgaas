@extends('layouts.adminlte')
@section('page_title', 'Detalle de Orden')
@section('extra_css')
<style>
    :root { --naranja: #FF6600; --azul: #007FFF; }
    .welcome-banner { background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); border-radius:12px; border-left:5px solid var(--naranja); color:white; padding:20px 25px; margin-bottom:25px; }
    .section-title { font-weight:700; color:#2d2d2d; border-left:4px solid var(--naranja); padding-left:10px; margin-bottom:20px; }
    .info-card { border:none; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.08); }
    .badge-estado { padding:5px 12px; border-radius:20px; font-size:0.85rem; font-weight:600; }
    .estado-en_espera { background-color:#6c757d; color:white; }
    .estado-en_diagnostico { background-color:#007FFF; color:white; }
    .estado-en_reparacion { background-color:#FF6600; color:white; }
    .estado-finalizado { background-color:#28a745; color:white; }
    .estado-entregado { background-color:#1a1a2e; color:white; }
    .timeline-item { border-left:3px solid var(--naranja); padding-left:15px; margin-bottom:15px; position:relative; }
    .timeline-item::before { content:''; width:12px; height:12px; background:var(--naranja); border-radius:50%; position:absolute; left:-7px; top:4px; }
</style>
@stop
@section('page_content')
<div class="welcome-banner">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1"><i class="fas fa-clipboard-list me-2" style="color:#FF6600;"></i>Detalle de Orden #{{ $orden->id }}</h5>
            <p class="mb-0" style="opacity:0.75; font-size:0.9rem;">
                Vehículo: <strong>{{ $orden->vehiculo->matricula }}</strong> —
                <span class="badge-estado estado-{{ $orden->estado }}">{{ ucfirst(str_replace('_', ' ', $orden->estado)) }}</span>
            </p>
        </div>
        <a href="{{ route('admin.ordenes.index') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card info-card p-4">
            <h5 class="section-title">Información del vehículo</h5>
            <p><span class="fw-semibold">Matrícula:</span> <span style="color:#FF6600;">{{ $orden->vehiculo->matricula }}</span></p>
            <p><span class="fw-semibold">Marca y modelo:</span> {{ $orden->vehiculo->marca }} {{ $orden->vehiculo->modelo }}</p>
            <p><span class="fw-semibold">Año:</span> {{ $orden->vehiculo->anio ?? '—' }}</p>
            <p><span class="fw-semibold">Color:</span> {{ $orden->vehiculo->color ?? '—' }}</p>
            <p><span class="fw-semibold">Cliente:</span> {{ $orden->vehiculo->cliente->nombre ?? '—' }}</p>
            <p class="mb-0"><span class="fw-semibold">Teléfono:</span> {{ $orden->vehiculo->cliente->telefono ?? '—' }}</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card info-card p-4">
            <h5 class="section-title">Información de la orden</h5>
            <p><span class="fw-semibold">Mecánico:</span> {{ $orden->mecanico->nombre ?? 'Sin asignar' }}</p>
            <p><span class="fw-semibold">Fecha entrada:</span> {{ $orden->fecha_entrada ? \Carbon\Carbon::parse($orden->fecha_entrada)->format('d/m/Y') : '—' }}</p>
            <p><span class="fw-semibold">Fecha estimada:</span> {{ $orden->fecha_estimada ? \Carbon\Carbon::parse($orden->fecha_estimada)->format('d/m/Y') : '—' }}</p>
            <p><span class="fw-semibold">Fecha entrega:</span> {{ $orden->fecha_entrega ? \Carbon\Carbon::parse($orden->fecha_entrega)->format('d/m/Y') : '—' }}</p>
            <p><span class="fw-semibold">Presupuesto:</span> {{ $orden->presupuesto_estimado ? number_format($orden->presupuesto_estimado, 2).' €' : '—' }}</p>
            <p class="mb-0"><span class="fw-semibold">Coste final:</span> {{ $orden->coste_final ? number_format($orden->coste_final, 2).' €' : '—' }}</p>
        </div>
    </div>
    <div class="col-12">
        <div class="card info-card p-4">
            <h5 class="section-title">Diagnóstico y observaciones</h5>
            <p><span class="fw-semibold">Diagnóstico inicial:</span></p>
            <p class="text-muted">{{ $orden->diagnostico_inicial ?? 'Sin diagnóstico registrado.' }}</p>
            <p><span class="fw-semibold">Observaciones:</span></p>
            <p class="text-muted mb-0">{{ $orden->observaciones ?? 'Sin observaciones.' }}</p>
        </div>
    </div>
    <div class="col-12">
        <div class="card info-card p-4">
            <h5 class="section-title">Historial de actualizaciones</h5>
            @forelse($orden->actualizaciones as $actualizacion)
            <div class="timeline-item">
                <p class="mb-1 fw-semibold">
                    {{ ucfirst(str_replace('_', ' ', $actualizacion->estado_nuevo)) }}
                    @if($actualizacion->estado_anterior)
                        <small class="text-muted fw-normal">← {{ ucfirst(str_replace('_', ' ', $actualizacion->estado_anterior)) }}</small>
                    @endif
                </p>
                <p class="text-muted small mb-1">{{ $actualizacion->comentario ?? '—' }}</p>
                <small class="text-muted">{{ $actualizacion->user->nombre ?? '—' }} — {{ $actualizacion->created_at->format('d/m/Y H:i') }}</small>
            </div>
            @empty
            <p class="text-muted">No hay actualizaciones registradas.</p>
            @endforelse
        </div>
    </div>
</div>
@stop
