@extends('layouts.adminlte')

@section('page_title', 'Registro de Reparación')

@section('extra_css')
<style>
    :root { --naranja: #FF6600; --azul: #007FFF; }

    .welcome-banner { background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); border-radius:12px; border-left:5px solid var(--naranja); color:white; padding:25px 30px; margin-bottom:25px; }
    .welcome-banner h4 { font-weight:700; font-size:1.4rem; margin-bottom:5px; }
    .welcome-banner p { opacity:0.75; margin-bottom:0; font-size:0.9rem; }

    .section-title { font-weight:700; color:#2d2d2d; border-left:4px solid var(--naranja); padding-left:10px; margin-bottom:20px; }

    .form-card { border:none; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.08); }

    .check-item {
        display:flex;
        align-items:center;
        gap:12px;
        padding:14px 18px;
        border-radius:10px;
        border:2px solid #e9ecef;
        margin-bottom:10px;
        cursor:pointer;
        transition:all 0.3s;
    }
    .check-item:hover { border-color:var(--naranja); background-color:rgba(255,102,0,0.04); }
    .check-item input[type="checkbox"] { width:20px; height:20px; accent-color:var(--naranja); cursor:pointer; }
    .check-item.checked { border-color:var(--naranja); background-color:rgba(255,102,0,0.06); }
    .check-item label { margin:0; cursor:pointer; font-weight:500; font-size:0.95rem; }
    .check-icon { font-size:1.2rem; color:var(--naranja); width:24px; text-align:center; }

    .info-vehiculo { background:#f8f9fa; border-radius:10px; padding:16px 20px; margin-bottom:20px; border-left:4px solid var(--azul); }
    .info-vehiculo p { margin-bottom:4px; font-size:0.9rem; }

    .btn-guardar { background-color:var(--naranja); color:white; border:none; border-radius:20px; padding:10px 30px; font-weight:600; transition:all 0.3s; font-size:1rem; }
    .btn-guardar:hover { background-color:#e65c00; color:white; }

    .form-control:focus, .form-select:focus { border-color:var(--azul); box-shadow:0 0 0 0.25rem rgba(0,127,255,0.15); }

    .progress-bar-custom { height:8px; border-radius:4px; background:#e9ecef; margin-bottom:20px; overflow:hidden; }
    .progress-fill { height:100%; background:linear-gradient(90deg, var(--naranja), var(--azul)); border-radius:4px; transition:width 0.4s ease; }
    .progress-label { font-size:0.85rem; color:#888; margin-bottom:5px; }
</style>
@stop

@section('page_content')

{{-- Banner --}}
<div class="welcome-banner">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4><i class="fas fa-tools me-2" style="color:#FF6600;"></i> Registro de Reparación</h4>
            <p>Vehículo: <strong>{{ $orden->vehiculo->marca }} {{ $orden->vehiculo->modelo }}</strong> — Matrícula: <strong>{{ $orden->vehiculo->matricula }}</strong></p>
        </div>
        <a href="{{ route('mecanico.dashboard') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Info del vehículo --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 rounded-3 p-3 text-center" style="box-shadow:0 4px 15px rgba(0,0,0,0.08); border-top:3px solid var(--naranja) !important;">
            <div style="font-size:1.5rem; color:var(--naranja); margin-bottom:8px;">
                <i class="fas fa-user"></i>
            </div>
            <div class="text-muted small">Cliente</div>
            <div class="fw-bold">{{ $orden->vehiculo->cliente->nombre ?? '—' }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 rounded-3 p-3 text-center" style="box-shadow:0 4px 15px rgba(0,0,0,0.08); border-top:3px solid var(--azul) !important;">
            <div style="font-size:1.5rem; color:var(--azul); margin-bottom:8px;">
                <i class="fas fa-phone"></i>
            </div>
            <div class="text-muted small">Teléfono</div>
            <div class="fw-bold">{{ $orden->vehiculo->cliente->telefono ?? '—' }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 rounded-3 p-3 text-center" style="box-shadow:0 4px 15px rgba(0,0,0,0.08); border-top:3px solid var(--naranja) !important;">
            <div style="font-size:1.5rem; color:var(--naranja); margin-bottom:8px;">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="text-muted small">Año</div>
            <div class="fw-bold">{{ $orden->vehiculo->anio ?? '—' }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 rounded-3 p-3 text-center" style="box-shadow:0 4px 15px rgba(0,0,0,0.08); border-top:3px solid var(--azul) !important;">
            <div style="font-size:1.5rem; color:var(--azul); margin-bottom:8px;">
                <i class="fas fa-palette"></i>
            </div>
            <div class="text-muted small">Color</div>
            <div class="fw-bold">{{ $orden->vehiculo->color ?? '—' }}</div>
        </div>
    </div>
    <div class="col-12">
        <div class="card border-0 rounded-3 p-3" style="box-shadow:0 4px 15px rgba(0,0,0,0.08); border-left:4px solid var(--naranja) !important;">
            <div class="d-flex align-items-start gap-3" style="padding:5px 0;">
                <div style="font-size:1.3rem; color:var(--naranja); margin-top:2px; margin-right:8px;">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <div>
                    <div class="text-muted small mb-1">Diagnóstico inicial</div>
                    <div class="fw-semibold">{{ $orden->diagnostico_inicial ?? 'Sin diagnóstico registrado.' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('mecanico.guardarReparacion', $orden->id) }}" id="formReparacion">
    @csrf

    <div class="row g-4">

        {{-- Checklist --}}
        <div class="col-md-6">
            <div class="card form-card p-4">
                <h5 class="section-title">Checklist de revisión</h5>

                <div class="progress-label">Progreso: <span id="progreso-texto">0/10</span></div>
                <div class="progress-bar-custom">
                    <div class="progress-fill" id="progress-fill" style="width:0%"></div>
                </div>

                <div class="check-item {{ $registro?->diagnostico_inicial ? 'checked' : '' }}" onclick="toggleCheck(this)">
                    <input type="checkbox" name="diagnostico_inicial" id="diagnostico_inicial" {{ $registro?->diagnostico_inicial ? 'checked' : '' }}>
                    <span class="check-icon"><i class="fas fa-stethoscope"></i></span>
                    <label for="diagnostico_inicial">Diagnóstico inicial completado</label>
                </div>

                <div class="check-item {{ $registro?->revision_neumaticos ? 'checked' : '' }}" onclick="toggleCheck(this)">
                    <input type="checkbox" name="revision_neumaticos" id="revision_neumaticos" {{ $registro?->revision_neumaticos ? 'checked' : '' }}>
                    <span class="check-icon"><i class="fas fa-circle"></i></span>
                    <label for="revision_neumaticos">Revisión de neumáticos</label>
                </div>

                <div class="check-item {{ $registro?->revision_motor ? 'checked' : '' }}" onclick="toggleCheck(this)">
                    <input type="checkbox" name="revision_motor" id="revision_motor" {{ $registro?->revision_motor ? 'checked' : '' }}>
                    <span class="check-icon"><i class="fas fa-cog"></i></span>
                    <label for="revision_motor">Revisión de motor</label>
                </div>

                <div class="check-item {{ $registro?->revision_frenos ? 'checked' : '' }}" onclick="toggleCheck(this)">
                    <input type="checkbox" name="revision_frenos" id="revision_frenos" {{ $registro?->revision_frenos ? 'checked' : '' }}>
                    <span class="check-icon"><i class="fas fa-stop-circle"></i></span>
                    <label for="revision_frenos">Revisión de frenos</label>
                </div>

                <div class="check-item {{ $registro?->revision_presion ? 'checked' : '' }}" onclick="toggleCheck(this)">
                    <input type="checkbox" name="revision_presion" id="revision_presion" {{ $registro?->revision_presion ? 'checked' : '' }}>
                    <span class="check-icon"><i class="fas fa-tachometer-alt"></i></span>
                    <label for="revision_presion">Revisión de presión</label>
                </div>

                <div class="check-item {{ $registro?->revision_aceite ? 'checked' : '' }}" onclick="toggleCheck(this)">
                    <input type="checkbox" name="revision_aceite" id="revision_aceite" {{ $registro?->revision_aceite ? 'checked' : '' }}>
                    <span class="check-icon"><i class="fas fa-oil-can"></i></span>
                    <label for="revision_aceite">Cambio de aceite</label>
                </div>

                <div class="check-item {{ $registro?->revision_cadena ? 'checked' : '' }}" onclick="toggleCheck(this)">
                    <input type="checkbox" name="revision_cadena" id="revision_cadena" {{ $registro?->revision_cadena ? 'checked' : '' }}>
                    <span class="check-icon"><i class="fas fa-link"></i></span>
                    <label for="revision_cadena">Revisión de cadena</label>
                </div>

                <div class="check-item {{ $registro?->revision_electrica ? 'checked' : '' }}" onclick="toggleCheck(this)">
                    <input type="checkbox" name="revision_electrica" id="revision_electrica" {{ $registro?->revision_electrica ? 'checked' : '' }}>
                    <span class="check-icon"><i class="fas fa-bolt"></i></span>
                    <label for="revision_electrica">Revisión eléctrica</label>
                </div>

                <div class="check-item {{ $registro?->revision_suspension ? 'checked' : '' }}" onclick="toggleCheck(this)">
                    <input type="checkbox" name="revision_suspension" id="revision_suspension" {{ $registro?->revision_suspension ? 'checked' : '' }}>
                    <span class="check-icon"><i class="fas fa-arrows-alt-v"></i></span>
                    <label for="revision_suspension">Revisión de suspensión</label>
                </div>

                <div class="check-item {{ $registro?->revision_filtros ? 'checked' : '' }}" onclick="toggleCheck(this)">
                    <input type="checkbox" name="revision_filtros" id="revision_filtros" {{ $registro?->revision_filtros ? 'checked' : '' }}>
                    <span class="check-icon"><i class="fas fa-filter"></i></span>
                    <label for="revision_filtros">Revisión de filtros</label>
                </div>
            </div>
        </div>

        {{-- Observaciones --}}
        <div class="col-md-6">
            <div class="card form-card p-4 h-100">
                <h5 class="section-title">Notas de la reparación</h5>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Observaciones de la reparación</label>
                    <textarea name="observaciones_reparacion" class="form-control" rows="6"
                        placeholder="Describe el trabajo realizado, problemas encontrados...">{{ old('observaciones_reparacion', $registro?->observaciones_reparacion) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Piezas sustituidas</label>
                    <textarea name="piezas_sustituidas" class="form-control" rows="6"
                        placeholder="Lista las piezas que has cambiado o sustituido...">{{ old('piezas_sustituidas', $registro?->piezas_sustituidas) }}</textarea>
                </div>

                <div class="d-grid mt-auto">
                    <button type="submit" class="btn btn-guardar">
                        <i class="fas fa-save me-2"></i>Guardar registro de reparación
                    </button>
                </div>
            </div>
        </div>

    </div>
</form>

@stop

@section('extra_js')
<script>
    function toggleCheck(item) {
        const checkbox = item.querySelector('input[type="checkbox"]');
        if (event.target !== checkbox) {
            checkbox.checked = !checkbox.checked;
        }
        item.classList.toggle('checked', checkbox.checked);
        actualizarProgreso();
    }

    function actualizarProgreso() {
        const total      = document.querySelectorAll('.check-item input[type="checkbox"]').length;
        const marcados   = document.querySelectorAll('.check-item input[type="checkbox"]:checked').length;
        const porcentaje = (marcados / total) * 100;

        document.getElementById('progress-fill').style.width   = porcentaje + '%';
        document.getElementById('progreso-texto').textContent  = marcados + '/' + total;
    }

    // Inicializar progreso al cargar
    document.addEventListener('DOMContentLoaded', actualizarProgreso);
</script>
@stop
