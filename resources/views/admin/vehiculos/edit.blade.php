@extends('layouts.adminlte')
@section('page_title', 'Editar Vehículo')
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
            <h5 class="fw-bold mb-1"><i class="fas fa-edit me-2" style="color:#FF6600;"></i>Editar Vehículo</h5>
            <p class="mb-0" style="opacity:0.75; font-size:0.9rem;">Modifica los datos de <strong>{{ $vehiculo->matricula }}</strong></p>
        </div>
        <a href="{{ route('admin.vehiculos.index') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
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
                <form method="POST" action="{{ route('admin.vehiculos.update', $vehiculo->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Cliente</label>
                            <select name="cliente_id" class="form-select">
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ $vehiculo->cliente_id == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Matrícula</label>
                            <input type="text" name="matricula" class="form-control @error('matricula') is-invalid @enderror"
                                value="{{ old('matricula', $vehiculo->matricula) }}">
                            @error('matricula')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Marca</label>
                            <input type="text" name="marca" class="form-control @error('marca') is-invalid @enderror"
                                value="{{ old('marca', $vehiculo->marca) }}">
                            @error('marca')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Modelo</label>
                            <input type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror"
                                value="{{ old('modelo', $vehiculo->modelo) }}">
                            @error('modelo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Año</label>
                            <input type="number" name="anio" class="form-control"
                                value="{{ old('anio', $vehiculo->anio) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Color</label>
                            <input type="text" name="color" class="form-control"
                                value="{{ old('color', $vehiculo->color) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Número de bastidor</label>
                            <input type="text" name="numero_bastidor" class="form-control"
                                value="{{ old('numero_bastidor', $vehiculo->numero_bastidor) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Descripción inicial</label>
                            <textarea name="descripcion_inicial" class="form-control" rows="3">{{ old('descripcion_inicial', $vehiculo->descripcion_inicial) }}</textarea>
                        </div>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-naranja">
                            <i class="fas fa-save me-2"></i>Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
