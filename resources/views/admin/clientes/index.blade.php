@extends('layouts.adminlte')
@section('page_title', 'Gestión de Clientes')
@section('extra_css')
<style>
    :root { --naranja: #FF6600; --azul: #007FFF; }
    .welcome-banner { background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); border-radius:12px; border-left:5px solid var(--naranja); color:white; padding:20px 25px; margin-bottom:25px; }
    .section-title { font-weight:700; color:#2d2d2d; border-left:4px solid var(--naranja); padding-left:10px; margin-bottom:20px; }
    .table-card { border:none; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.08); overflow:hidden; }
    .table thead th { background:linear-gradient(135deg,#1a1a2e,#0f3460); color:white; font-weight:600; font-size:0.85rem; text-transform:uppercase; letter-spacing:1px; border:none; }
    .table tbody tr:hover { background-color:rgba(255,102,0,0.05); }
    .btn-naranja { background-color:var(--naranja); color:white; border:none; border-radius:20px; padding:6px 16px; font-weight:600; font-size:0.85rem; transition:all 0.3s; }
    .btn-naranja:hover { background-color:#e65c00; color:white; }
    .btn-accion { padding:4px 12px; border-radius:20px; font-size:0.8rem; font-weight:600; border:none; transition:all 0.3s; }
    .btn-editar { background-color:#007FFF; color:white; }
    .btn-editar:hover { background-color:#0066CC; color:white; }
    .btn-eliminar { background-color:#dc3545; color:white; }
    .btn-eliminar:hover { background-color:#c82333; color:white; }
</style>
@stop
@section('page_content')
<div class="welcome-banner">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1"><i class="fas fa-users me-2" style="color:#FF6600;"></i> Gestión de Clientes</h5>
            <p class="mb-0" style="opacity:0.75; font-size:0.9rem;">Administra los clientes del taller.</p>
        </div>
        <a href="{{ route('admin.clientes.create') }}" class="btn btn-naranja">
            <i class="fas fa-plus me-1"></i> Nuevo cliente
        </a>
    </div>
</div>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
<h5 class="section-title">Clientes registrados ({{ $clientes->count() }})</h5>
<div class="card table-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Usuario web</th>
                    <th>Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clientes as $cliente)
                <tr>
                    <td class="text-muted small">{{ $cliente->id }}</td>
                    <td class="fw-semibold">{{ $cliente->nombre }}</td>
                    <td class="text-muted small">{{ $cliente->email }}</td>
                    <td class="text-muted small">{{ $cliente->telefono ?? '—' }}</td>
                    <td class="text-muted small">{{ $cliente->direccion ?? '—' }}</td>
                    <td>
                        @if($cliente->user)
                            <span class="fw-semibold" style="color:#007FFF;">{{ $cliente->user->nombre }}</span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td class="text-muted small">{{ $cliente->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.clientes.edit', $cliente->id) }}" class="btn btn-accion btn-editar">
                                <i class="fas fa-edit me-1"></i> Editar
                            </a>
                            <form method="POST" action="{{ route('admin.clientes.destroy', $cliente->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-accion btn-eliminar"
                                    onclick="return confirm('¿Seguro que quieres eliminar este cliente?')">
                                    <i class="fas fa-trash me-1"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="fas fa-users fa-2x mb-2 d-block"></i>
                        No hay clientes registrados todavía.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop
