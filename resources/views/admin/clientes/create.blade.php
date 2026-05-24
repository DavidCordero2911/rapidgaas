@extends('layouts.adminlte')
@section('page_title', 'Nuevo Cliente')
@section('extra_css')
<style>
    :root { --naranja: #FF6600; --azul: #007FFF; }
    .form-card { border:none; border-radius:12px; border-top:5px solid var(--naranja); box-shadow:0 4px 15px rgba(0,0,0,0.08); }
    .welcome-banner { background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); border-radius:12px; border-left:5px solid var(--naranja); color:white; padding:20px 25px; margin-bottom:25px; }
    .btn-naranja { background-color:var(--naranja); color:white; border:none; border-radius:20px; padding:8px 25px; font-weight:600; transition:all 0.3s; }
    .btn-naranja:hover { background-color:#e65c00; color:white; }
    .form-control:focus, .form-select:focus { border-color:var(--azul); box-shadow:0 0 0 0.25rem rgba(0,127,255,0.15); }
    .form-label { font-weight:600; font-size:0.9rem; }
</style>
@stop
@section('page_content')
<div class="welcome-banner">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1"><i class="fas fa-user-plus me-2" style="color:#FF6600;"></i>  Nuevo Cliente</h5>
            <p class="mb-0" style="opacity:0.75; font-size:0.9rem;">Registra un nuevo cliente en el sistema.</p>
        </div>
        <a href="{{ route('admin.clientes.index') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card form-card p-4">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.clientes.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Usuario web vinculado</label>
                            <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                <option value="">Selecciona un usuario</option>
                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}" {{ old('user_id') == $usuario->id ? 'selected' : '' }}>
                                        {{ $usuario->nombre }} ({{ $usuario->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                                value="{{ old('nombre') }}" placeholder="Nombre del cliente">
                            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="email@ejemplo.com">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control"
                                value="{{ old('telefono') }}" placeholder="600000000">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="direccion" class="form-control"
                                value="{{ old('direccion') }}" placeholder="Calle, número, ciudad">
                        </div>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-naranja">
                            <i class="fas fa-save me-2"></i>  Guardar cliente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
