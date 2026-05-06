@extends('layouts.adminlte')

@section('page_title', 'Gestión de Vehículos')

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
</style>
@stop

@section('page_content')

<div class="welcome-banner">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1"><i class="fas fa-motorcycle me-2" style="color:#FF6600;"></i>Gestión de Vehículos</h5>
            <p class="mb-0" style="opacity:0.75; font-size:0.9rem;">Listado de todos los vehículos registrados en el sistema.</p>
        </div>
        <a href="{{ route('superadmin.dashboard') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>
</div>

<h5 class="section-title">Vehículos registrados ({{ $vehiculos->count() }})</h5>

<div class="card table-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Matrícula</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Color</th>
                    <th>Cliente</th>
                    <th>Registro</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vehiculos as $vehiculo)
                <tr>
                    <td class="text-muted small">{{ $vehiculo->id }}</td>
                    <td class="fw-semibold" style="color: #FF6600;">{{ $vehiculo->matricula }}</td>
                    <td>{{ $vehiculo->marca }}</td>
                    <td>{{ $vehiculo->modelo }}</td>
                    <td class="text-muted small">{{ $vehiculo->anio ?? '—' }}</td>
                    <td class="text-muted small">{{ $vehiculo->color ?? '—' }}</td>
                    <td>
                        @if($vehiculo->cliente)
                            <span class="fw-semibold">{{ $vehiculo->cliente->nombre }}</span>
                            <br>
                            <small class="text-muted">{{ $vehiculo->cliente->email }}</small>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td class="text-muted small">{{ $vehiculo->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="fas fa-motorcycle fa-2x mb-2 d-block"></i>
                        No hay vehículos registrados todavía.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@stop
