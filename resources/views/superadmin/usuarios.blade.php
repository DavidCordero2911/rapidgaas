@extends('layouts.adminlte')

@section('page_title', 'Gestión de Usuarios')

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

    .badge-rol {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
    }

    .badge-superadmin { background-color: #1a1a2e; color: white; }
    .badge-admin_taller { background-color: #FF6600; color: white; }
    .badge-mecanico { background-color: #007FFF; color: white; }
    .badge-cliente { background-color: #28a745; color: white; }
    .badge-sin_rol { background-color: #6c757d; color: white; }

    .btn-accion {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s;
    }

    .btn-editar {
        background-color: #007FFF;
        color: white;
    }
    .btn-editar:hover { background-color: #0066CC; color: white; }

    .btn-activar {
        background-color: #28a745;
        color: white;
    }
    .btn-activar:hover { background-color: #218838; color: white; }

    .btn-desactivar {
        background-color: #dc3545;
        color: white;
    }
    .btn-desactivar:hover { background-color: #c82333; color: white; }

    .estado-activo {
        color: #28a745;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .estado-inactivo {
        color: #dc3545;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .welcome-banner {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        border-radius: 12px;
        border-left: 5px solid var(--naranja);
        color: white;
        padding: 20px 25px;
        margin-bottom: 25px;
    }
</style>
@stop

@section('page_content')

{{-- Banner --}}
<div class="welcome-banner">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1"><i class="fas fa-users-cog me-2" style="color:#FF6600;"></i>Gestión de Usuarios</h5>
            <p class="mb-0" style="opacity:0.75; font-size:0.9rem;">Administra los usuarios registrados, sus roles y estados.</p>
        </div>
        <a href="{{ route('superadmin.dashboard') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>
</div>

{{-- Alertas --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Tabla de usuarios --}}
<h5 class="section-title">Usuarios registrados ({{ $usuarios->count() }})</h5>

<div class="card table-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                <tr>
                    <td class="text-muted small">{{ $usuario->id }}</td>
                    <td class="fw-semibold">{{ $usuario->nombre }}</td>
                    <td class="text-muted small">{{ $usuario->email }}</td>
                    <td class="text-muted small">{{ $usuario->telefono ?? '—' }}</td>
                    <td>
                        @if($usuario->roles->isNotEmpty())
                            <span class="badge-rol badge-{{ $usuario->roles->first()->name }}">
                                {{ ucfirst(str_replace('_', ' ', $usuario->roles->first()->name)) }}
                            </span>
                        @else
                            <span class="badge-rol badge-sin_rol">Sin rol</span>
                        @endif
                    </td>
                    <td>
                        @if($usuario->activo)
                            <span class="estado-activo"><i class="fas fa-circle me-1" style="font-size:8px;"></i>Activo</span>
                        @else
                            <span class="estado-inactivo"><i class="fas fa-circle me-1" style="font-size:8px;"></i>Inactivo</span>
                        @endif
                    </td>
                    <td class="text-muted small">{{ $usuario->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('superadmin.cambiarRol', $usuario->id) }}" class="btn btn-accion btn-editar">
                                <i class="fas fa-user-edit me-1"></i>Rol
                            </a>
                            <form method="POST" action="{{ route('superadmin.toggleActivo', $usuario->id) }}">
                                @csrf
                                @if($usuario->activo)
                                    <button type="submit" class="btn btn-accion btn-desactivar">
                                        <i class="fas fa-ban me-1"></i>Desactivar
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-accion btn-activar">
                                        <i class="fas fa-check me-1"></i>Activar
                                    </button>
                                @endif
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="fas fa-users fa-2x mb-2 d-block"></i>
                        No hay usuarios registrados todavía.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@stop
