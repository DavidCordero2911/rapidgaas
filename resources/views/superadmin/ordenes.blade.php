@extends('layouts.adminlte')

@section('page_title', 'Órdenes de Trabajo')

@section('extra_css')
<style>
    :root {
        --naranja: #FF6600;
        --azul: #007FFF;
    }

    .section-title {
        font-weight: 700;
        color: #2d2d2d;
        border-left: 4px solid var(--naranja);
        padding-left: 10px;
        margin-bottom: 20px;
    }

    .table-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .table thead th {
        background: linear-gradient(135deg, #1a1a2e, #0f3460);
        color: white;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
    }

    .table tbody tr:hover {
        background-color: rgba(255, 102, 0, 0.05);
    }

    .welcome-banner {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        border-radius: 12px;
        border-left: 5px solid var(--naranja);
        color: white;
        padding: 20px 25px;
        margin-bottom: 25px;
    }

    .badge-estado {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
    }

    .estado-en_espera { background-color: #6c757d; color: white; }
    .estado-en_diagnostico { background-color: #007FFF; color: white; }
    .estado-en_reparacion { background-color: #FF6600; color: white; }
    .estado-finalizado { background-color: #28a745; color: white; }
    .estado-entregado { background-color: #1a1a2e; color: white; }
</style>
@stop

@section('page_content')

<div class="welcome-banner">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1"><i class="fas fa-clipboard-list me-2" style="color:#FF6600;"></i>Órdenes de Trabajo</h5>
            <p class="mb-0" style="opacity:0.75; font-size:0.9rem;">Listado de todas las órdenes de trabajo del taller.</p>
        </div>
        <a href="{{ route('superadmin.dashboard') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>
</div>

<h5 class="section-title">Órdenes registradas ({{ $ordenes->count() }})</h5>

<div class="card table-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Vehículo</th>
                    <th>Cliente</th>
                    <th>Mecánico</th>
                    <th>Estado</th>
                    <th>Presupuesto</th>
                    <th>Entrada</th>
                    <th>Entrega estimada</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ordenes as $orden)
                <tr>
                    <td class="text-muted small">{{ $orden->id }}</td>
                    <td>
                        <span class="fw-semibold" style="color:#FF6600;">{{ $orden->vehiculo->matricula }}</span>
                        <br>
                        <small class="text-muted">{{ $orden->vehiculo->marca }} {{ $orden->vehiculo->modelo }}</small>
                    </td>
                    <td>
                        @if($orden->vehiculo->cliente)
                            {{ $orden->vehiculo->cliente->nombre }}
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        @if($orden->mecanico)
                            {{ $orden->mecanico->nombre }}
                        @else
                            <span class="text-muted">Sin asignar</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge-estado estado-{{ $orden->estado }}">
                            {{ ucfirst(str_replace('_', ' ', $orden->estado)) }}
                        </span>
                    </td>
                    <td>
                        @if($orden->presupuesto_estimado)
                            <span class="fw-semibold">{{ number_format($orden->presupuesto_estimado, 2) }} €</span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td class="text-muted small">{{ $orden->fecha_entrada ? \Carbon\Carbon::parse($orden->fecha_entrada)->format('d/m/Y') : '—' }}</td>
                    <td class="text-muted small">{{ $orden->fecha_estimada ? \Carbon\Carbon::parse($orden->fecha_estimada)->format('d/m/Y') : '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="fas fa-clipboard fa-2x mb-2 d-block"></i>
                        No hay órdenes de trabajo registradas todavía.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@stop
