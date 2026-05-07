@extends('layouts.adminlte')
@section('page_title', 'Editar Orden')
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
            <h5 class="fw-bold mb-1"><i class="fas fa-edit me-2" style="color:#FF6600;"></i>Editar Orden</h5>
            <p class="mb-0" style="opacity:0.75; font-size:0.9rem;">Vehículo: <strong>{{ $orden->vehiculo->matricula }}</strong></p>
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
                <form method="POST" action="{{ route('admin.ordenes.update', $orden->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Mecánico asignado</label>
                            <select name="mecanico_id" class="form-select">
                                <option value="">Sin asignar</option>
                                @foreach($mecanicos as $mecanico)
                                    <option value="{{ $mecanico->id }}" {{ $orden->mecanico_id == $mecanico->id ? 'selected' : '' }}>
                                        {{ $mecanico->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select">
                                <option value="en_espera"      {{ $orden->estado == 'en_espera'      ? 'selected' : '' }}>En espera</option>
                                <option value="en_diagnostico" {{ $orden->estado == 'en_diagnostico' ? 'selected' : '' }}>En diagnóstico</option>
                                <option value="en_reparacion"  {{ $orden->estado == 'en_reparacion'  ? 'selected' : '' }}>En reparación</option>
                                <option value="finalizado"     {{ $orden->estado == 'finalizado'     ? 'selected' : '' }}>Finalizado</option>
                                <option value="entregado"      {{ $orden->estado == 'entregado'      ? 'selected' : '' }}>Entregado</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Presupuesto estimado (€)</label>
                            <input type="number" step="0.01" name="presupuesto_estimado" class="form-control"
                                value="{{ old('presupuesto_estimado', $orden->presupuesto_estimado) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Coste final (€)</label>
                            <input type="number" step="0.01" name="coste_final" class="form-control"
                                value="{{ old('coste_final', $orden->coste_final) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha estimada de entrega</label>
                            <input type="date" name="fecha_estimada" class="form-control"
                                value="{{ old('fecha_estimada', $orden->fecha_estimada ? \Carbon\Carbon::parse($orden->fecha_estimada)->format('Y-m-d') : '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha de entrega real</label>
                            <input type="date" name="fecha_entrega" class="form-control"
                                value="{{ old('fecha_entrega', $orden->fecha_entrega ? \Carbon\Carbon::parse($orden->fecha_entrega)->format('Y-m-d') : '') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Diagnóstico inicial</label>
                            <textarea name="diagnostico_inicial" class="form-control" rows="3">{{ old('diagnostico_inicial', $orden->diagnostico_inicial) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Observaciones</label>
                            <textarea name="observaciones" class="form-control" rows="3">{{ old('observaciones', $orden->observaciones) }}</textarea>
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
