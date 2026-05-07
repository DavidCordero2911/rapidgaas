@extends('layouts.adminlte')
@section('page_title', 'Nueva Orden de Trabajo')
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
            <h5 class="fw-bold mb-1"><i class="fas fa-plus me-2" style="color:#FF6600;"></i>Nueva Orden de Trabajo</h5>
            <p class="mb-0" style="opacity:0.75; font-size:0.9rem;">Crea una nueva orden de trabajo para un vehículo.</p>
        </div>
        <a href="{{ route('admin.ordenes.index') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
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
                <form method="POST" action="{{ route('admin.ordenes.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Vehículo</label>
                            <select name="vehiculo_id" class="form-select @error('vehiculo_id') is-invalid @enderror">
                                <option value="">Selecciona un vehículo</option>
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}" {{ old('vehiculo_id') == $vehiculo->id ? 'selected' : '' }}>
                                        {{ $vehiculo->matricula }} — {{ $vehiculo->marca }} {{ $vehiculo->modelo }}
                                        ({{ $vehiculo->cliente->nombre ?? 'Sin cliente' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('vehiculo_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mecánico asignado</label>
                            <select name="mecanico_id" class="form-select">
                                <option value="">Sin asignar</option>
                                @foreach($mecanicos as $mecanico)
                                    <option value="{{ $mecanico->id }}" {{ old('mecanico_id') == $mecanico->id ? 'selected' : '' }}>
                                        {{ $mecanico->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Presupuesto estimado (€)</label>
                            <input type="number" step="0.01" name="presupuesto_estimado" class="form-control"
                                value="{{ old('presupuesto_estimado') }}" placeholder="0.00">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha estimada de entrega</label>
                            <input type="date" name="fecha_estimada" class="form-control"
                                value="{{ old('fecha_estimada') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Diagnóstico inicial</label>
                            <textarea name="diagnostico_inicial" class="form-control" rows="3"
                                placeholder="Describe el diagnóstico inicial del vehículo...">{{ old('diagnostico_inicial') }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Observaciones</label>
                            <textarea name="observaciones" class="form-control" rows="3"
                                placeholder="Observaciones adicionales...">{{ old('observaciones') }}</textarea>
                        </div>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-naranja">
                            <i class="fas fa-save me-2"></i>Crear orden de trabajo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
