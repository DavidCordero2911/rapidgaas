@extends('layouts.adminlte')
@section('page_title', 'Órdenes de Trabajo')
@section('extra_css')
<style>
    :root { --naranja: #FF6600; --azul: #007FFF; }
    .welcome-banner { background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); border-radius:12px; border-left:5px solid var(--naranja); color:white; padding:20px 25px; margin-bottom:25px; }
    .section-title { font-weight:700; color:#2d2d2d; border-left:4px solid var(--naranja); padding-left:10px; margin-bottom:20px; }
    .table-card { border:none; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.08); overflow:hidden; }
    .table thead th { background:linear-gradient(135deg,#1a1a2e,#0f3460); color:white; font-weight:600; font-size:0.85rem; text-transform:uppercase; letter-spacing:1px; border:none; }
    .table tbody tr:hover { background-color:rgba(255,102,0,0.05); }
    .btn-naranja { background-color:var(--naranja); color:white; border:none; border-radius:20px; padding:6px 16px; font-weight:600; font-size:0.85rem; }
    .btn-naranja:hover { background-color:#e65c00; color:white; }
    .btn-accion { padding:4px 12px; border-radius:20px; font-size:0.8rem; font-weight:600; border:none; transition:all 0.3s; }
    .btn-ver { background-color:#6c757d; color:white; }
    .btn-ver:hover { background-color:#5a6268; color:white; }
    .btn-editar { background-color:#007FFF; color:white; }
    .btn-editar:hover { background-color:#0066CC; color:white; }
    .btn-eliminar { background-color:#dc3545; color:white; }
    .btn-eliminar:hover { background-color:#c82333; color:white; }
    .badge-estado { padding:5px 12px; border-radius:20px; font-size:0.78rem; font-weight:600; }
    .estado-en_espera { background-color:#6c757d; color:white; }
    .estado-en_diagnostico { background-color:#007FFF; color:white; }
    .estado-en_reparacion { background-color:#FF6600; color:white; }
    .estado-finalizado { background-color:#28a745; color:white; }
    .estado-entregado { background-color:#1a1a2e; color:white; }
</style>
@stop
@section('page_content')
<div class="welcome-banner">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1"><i class="fas fa-clipboard-list me-2" style="color:#FF6600;"></i>  Órdenes de Trabajo</h5>
            <p class="mb-0" style="opacity:0.75; font-size:0.9rem;">Gestiona las órdenes de trabajo del taller.</p>
        </div>
        <a href="{{ route('admin.ordenes.create') }}" class="btn btn-naranja">
            <i class="fas fa-plus me-1"></i> Nueva orden
        </a>
    </div>
</div>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
<h5 class="section-title">Órdenes registradas ({{ $ordenes->count() }})</h5>
<div class="card table-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th><th>Vehículo</th><th>Cliente</th><th>Mecánico</th>
                    <th>Estado</th><th>Presupuesto</th><th>Entrada</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ordenes as $orden)
                <tr>
                    <td class="text-muted small">{{ $orden->id }}</td>
                    <td>
                        <span class="fw-semibold" style="color:#FF6600;">{{ $orden->vehiculo->matricula }}</span>
                        <br><small class="text-muted">{{ $orden->vehiculo->marca }} {{ $orden->vehiculo->modelo }}</small>
                    </td>
                    <td>{{ $orden->vehiculo->cliente->nombre ?? '—' }}</td>
                    <td>{{ $orden->mecanico->nombre ?? 'Sin asignar' }}</td>
                    <td>
                        <span class="badge-estado estado-{{ $orden->estado }}">
                            {{ ucfirst(str_replace('_', ' ', $orden->estado)) }}
                        </span>
                    </td>
                    <td>{{ $orden->presupuesto_estimado ? number_format($orden->presupuesto_estimado, 2).' €' : '—' }}</td>
                    <td class="text-muted small">{{ $orden->fecha_entrada ? \Carbon\Carbon::parse($orden->fecha_entrada)->format('d/m/Y') : '—' }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.ordenes.show', $orden->id) }}" class="btn btn-accion btn-ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.ordenes.edit', $orden->id) }}" class="btn btn-accion btn-editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($orden->estado === 'finalizado')
                            <form method="POST" action="{{ route('admin.ordenes.cerrar', $orden->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-accion"
                                    style="background-color:#28a745; color:white;"
                                    onclick="return confirm('¿Confirmas que el cliente ha recogido el vehículo?')">
                                    <i class="fas fa-check-double"></i>
                                </button>
                            </form>
                            @endif
                            <form method="POST" action="{{ route('admin.ordenes.destroy', $orden->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-accion btn-eliminar"
                                    onclick="return confirm('¿Seguro que quieres eliminar esta orden?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="fas fa-clipboard fa-2x mb-2 d-block"></i>
                        No hay órdenes registradas todavía.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop
