<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Vehículo — RapidGaas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --naranja: #FF6600;
            --azul: #007FFF;
            --oscuro: #1a1a2e;
        }

        body { background-color:#f8f9fa; }

        .navbar-rapidgaas {
            background:linear-gradient(135deg,#1a1a2e,#0f3460);
            border-bottom:3px solid var(--naranja);
        }

        .navbar-brand span { color:var(--azul); }

        .hero-cliente {
            background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%);
            color:white;
            padding:40px 0;
            border-bottom:4px solid var(--naranja);
        }

        .estado-badge {
            padding:8px 20px;
            border-radius:25px;
            font-weight:700;
            font-size:0.9rem;
            display:inline-block;
        }

        .estado-en_espera { background-color:#6c757d; color:white; }
        .estado-en_diagnostico { background-color:var(--azul); color:white; }
        .estado-en_reparacion { background-color:var(--naranja); color:white; }
        .estado-finalizado { background-color:#28a745; color:white; }
        .estado-entregado { background-color:#1a1a2e; color:white; border:1px solid #444; }

        .info-card {
            border:none;
            border-radius:12px;
            box-shadow:0 4px 15px rgba(0,0,0,0.08);
            border-left:4px solid var(--naranja);
        }

        .info-card.azul { border-left-color:var(--azul); }

        .timeline-item {
            border-left:3px solid var(--naranja);
            padding-left:20px;
            margin-bottom:20px;
            position:relative;
        }

        .timeline-item::before {
            content:'';
            width:12px;
            height:12px;
            background:var(--naranja);
            border-radius:50%;
            position:absolute;
            left:-7px;
            top:4px;
        }

        .progress-estado {
            height:10px;
            border-radius:5px;
        }

        .section-title {
            font-weight:700;
            color:#2d2d2d;
            border-left:4px solid var(--naranja);
            padding-left:10px;
            margin-bottom:20px;
        }

        .no-vehiculo {
            background:linear-gradient(135deg,#1a1a2e,#0f3460);
            border-radius:12px;
            color:white;
            padding:50px;
            text-align:center;
        }

        footer {
            background:linear-gradient(135deg,#1a1a2e,#0f3460);
            border-top:3px solid var(--naranja);
            color:rgba(255,255,255,0.7);
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-rapidgaas">
    <div class="container">
        <a class="navbar-brand text-white fw-800" href="#">
            <i class="bi bi-gear-wide-connected" style="color:var(--naranja);"></i>
            RAPID<span>GAAS</span>
        </a>
        <div class="d-flex align-items-center gap-3">
            <span class="text-white opacity-75 small">
                <i class="bi bi-person-circle me-1"></i>
                {{ auth()->user()->nombre }}
            </span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light rounded-pill px-3">
                    <i class="bi bi-box-arrow-right me-1"></i>Salir
                </button>
            </form>
        </div>
    </div>
</nav>

{{-- HERO --}}
<div class="hero-cliente">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-1">
                    <i class="bi bi-motorcycle me-2" style="color:var(--naranja);"></i>
                    Mi Vehículo
                </h2>
                <p class="opacity-75 mb-0">
                    Consulta el estado de tu moto en tiempo real
                </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                @if($orden)
                    <span class="estado-badge estado-{{ $orden->estado }}">
                        {{ ucfirst(str_replace('_', ' ', $orden->estado)) }}
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container py-4">

@if(!$cliente || !$vehiculo)
    {{-- SIN VEHÍCULO --}}
    <div class="no-vehiculo">
        <i class="bi bi-motorcycle" style="font-size:4rem; color:var(--naranja);"></i>
        <h4 class="fw-bold mt-3">No tienes ningún vehículo registrado</h4>
        <p class="opacity-75">Cuando dejes tu moto en el taller, podrás ver aquí su estado en tiempo real.</p>
        <p class="opacity-75 small">¿Tienes dudas? Contacta con nosotros.</p>
    </div>

@else
    <div class="row g-4">

        {{-- INFO VEHÍCULO --}}
        <div class="col-md-6">
            <div class="card info-card p-4 h-100">
                <h5 class="section-title">Información del vehículo</h5>
                <div class="row g-2">
                    <div class="col-6">
                        <small class="text-muted">Matrícula</small>
                        <p class="fw-bold mb-0" style="color:var(--naranja);">{{ $vehiculo->matricula }}</p>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Marca y modelo</small>
                        <p class="fw-bold mb-0">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</p>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Año</small>
                        <p class="fw-bold mb-0">{{ $vehiculo->anio ?? '—' }}</p>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Color</small>
                        <p class="fw-bold mb-0">{{ $vehiculo->color ?? '—' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- INFO ORDEN --}}
        @if($orden)
        <div class="col-md-6">
            <div class="card info-card azul p-4 h-100">
                <h5 class="section-title" style="border-left-color:var(--azul);">Estado de la reparación</h5>

                {{-- Barra de progreso --}}
                @php
                    $estados = ['en_espera' => 20, 'en_diagnostico' => 40, 'en_reparacion' => 70, 'finalizado' => 90, 'entregado' => 100];
                    $progreso = $estados[$orden->estado] ?? 0;
                @endphp
                <div class="mb-3">
                    <div class="d-flex justify-content-between small text-muted mb-1">
                        <span>Progreso</span>
                        <span>{{ $progreso }}%</span>
                    </div>
                    <div class="progress progress-estado">
                        <div class="progress-bar" role="progressbar"
                            style="width:{{ $progreso }}%; background:linear-gradient(90deg,var(--naranja),var(--azul));">
                        </div>
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col-6">
                        <small class="text-muted">Fecha entrada</small>
                        <p class="fw-bold mb-0">{{ $orden->fecha_entrada ? \Carbon\Carbon::parse($orden->fecha_entrada)->format('d/m/Y') : '—' }}</p>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Entrega estimada</small>
                        <p class="fw-bold mb-0">{{ $orden->fecha_estimada ? \Carbon\Carbon::parse($orden->fecha_estimada)->format('d/m/Y') : '—' }}</p>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Presupuesto</small>
                        <p class="fw-bold mb-0">{{ $orden->presupuesto_estimado ? number_format($orden->presupuesto_estimado, 2).' €' : 'Pendiente' }}</p>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Coste final</small>
                        <p class="fw-bold mb-0">{{ $orden->coste_final ? number_format($orden->coste_final, 2).' €' : 'Pendiente' }}</p>
                    </div>
                </div>

                @if($orden->diagnostico_inicial)
                <div class="mt-3">
                    <small class="text-muted">Diagnóstico inicial</small>
                    <p class="mb-0 small">{{ $orden->diagnostico_inicial }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- HISTORIAL --}}
        <div class="col-12">
            <div class="card info-card p-4">
                <h5 class="section-title">Historial de actualizaciones</h5>
                @forelse($orden->actualizaciones->sortByDesc('created_at') as $actualizacion)
                <div class="timeline-item">
                    <p class="mb-1 fw-semibold">
                        {{ ucfirst(str_replace('_', ' ', $actualizacion->estado_nuevo)) }}
                        @if($actualizacion->estado_anterior)
                            <small class="text-muted fw-normal">← {{ ucfirst(str_replace('_', ' ', $actualizacion->estado_anterior)) }}</small>
                        @endif
                    </p>
                    @if($actualizacion->comentario)
                        <p class="text-muted small mb-1">{{ $actualizacion->comentario }}</p>
                    @endif
                    <small class="text-muted">{{ $actualizacion->created_at->format('d/m/Y H:i') }}</small>
                </div>
                @empty
                <p class="text-muted">No hay actualizaciones registradas todavía.</p>
                @endforelse
            </div>
        </div>
        @endif

    </div>
@endif

</div>

{{-- FOOTER --}}
<footer class="py-4 mt-5">
    <div class="container text-center">
        <p class="mb-1 fw-bold">
            RAPID<span style="color:var(--azul);">GAAS</span>
        </p>
        <small>© {{ date('Y') }} RapidGaas. Todos los derechos reservados.</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
