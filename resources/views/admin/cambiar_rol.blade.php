@extends('layouts.adminlte')

@section('page_title', 'Cambiar Rol')

@section('extra_css')
<style>
    :root {
        --naranja: #FF6600;
        --azul: #007FFF;
    }

    .form-card {
        border: none;
        border-radius: 12px;
        border-top: 5px solid var(--naranja);
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .welcome-banner {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        border-radius: 12px;
        border-left: 5px solid var(--naranja);
        color: white;
        padding: 20px 25px;
        margin-bottom: 25px;
    }

    .btn-guardar {
        background-color: var(--naranja);
        color: white;
        border: none;
        border-radius: 20px;
        padding: 8px 25px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-guardar:hover {
        background-color: #e65c00;
        color: white;
    }

    .rol-option {
        border: 2px solid #dee2e6;
        border-radius: 10px;
        padding: 12px 15px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .rol-option:hover {
        border-color: var(--naranja);
        background-color: rgba(255,102,0,0.05);
    }

    .rol-option input:checked + label {
        color: var(--naranja);
        font-weight: 600;
    }
</style>
@stop

@section('page_content')

<div class="welcome-banner">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1"><i class="fas fa-user-edit me-2" style="color:#FF6600;"></i>Cambiar Rol</h5>
            <p class="mb-0" style="opacity:0.75; font-size:0.9rem;">Modifica el rol asignado a <strong>{{ $usuario->nombre }}</strong></p>
        </div>
        <a href="{{ route('admin.usuarios') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card form-card p-4">
            <div class="card-body">

                <div class="mb-4 text-center">
                    <div style="font-size: 3rem; color: #FF6600;">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h5 class="fw-bold mt-2">{{ $usuario->nombre }}</h5>
                    <small class="text-muted">{{ $usuario->email }}</small>
                </div>

                <form method="POST" action="{{ route('admin.actualizarRol', $usuario->id) }}">
                    @csrf

                    <p class="fw-semibold mb-3">Selecciona el nuevo rol:</p>

                    @foreach($roles as $rol)
                    <div class="rol-option d-flex align-items-center gap-3">
                        <input type="radio"
                               id="rol_{{ $rol->name }}"
                               name="rol"
                               value="{{ $rol->name }}"
                               {{ $usuario->roles->first()?->name === $rol->name ? 'checked' : '' }}>
                        <label for="rol_{{ $rol->name }}" class="mb-0 w-100" style="cursor:pointer;">
                            {{ ucfirst(str_replace('_', ' ', $rol->name)) }}
                        </label>
                    </div>
                    @endforeach

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-guardar">
                            <i class="fas fa-save me-2"></i>Guardar cambios
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@stop
