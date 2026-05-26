<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Panel — RapidGaas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --naranja: #FF6600;
            --azul: #007FFF;
            --oscuro: #0a0a0f;
            --oscuro2: #111118;
            --oscuro3: #1a1a25;
            --card-bg: #14141e;
            --border: rgba(255, 255, 255, 0.07);
            --text-primary: #f0f0f0;
            --text-muted: #6b6b7a;
            --text-secondary: #9999aa;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--oscuro);
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            background: rgba(10, 10, 15, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 14px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .topbar-brand {
            font-family: 'Rajdhani', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-primary);
            text-decoration: none;
            letter-spacing: 2px;
        }

        .topbar-brand .accent {
            color: var(--naranja);
        }

        .topbar-brand .accent2 {
            color: var(--azul);
        }

        .topbar-divider {
            width: 1px;
            height: 20px;
            background: var(--border);
        }

        .topbar-user {
            color: var(--text-secondary);
            font-size: 0.82rem;
            letter-spacing: 0.5px;
        }

        .btn-logout {
            background: transparent;
            border: 1px solid rgba(255, 102, 0, 0.3);
            color: var(--naranja);
            border-radius: 3px;
            padding: 6px 18px;
            font-size: 0.8rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: 'Rajdhani', sans-serif;
            font-weight: 600;
            transition: all 0.25s;
            cursor: pointer;
        }

        .btn-logout:hover {
            background: var(--naranja);
            color: white;
            border-color: var(--naranja);
        }

        /* SECTION NAV */
        .section-nav {
            background: var(--oscuro2);
            border-bottom: 1px solid var(--border);
        }

        .nav-tab {
            padding: 16px 30px;
            font-family: 'Rajdhani', sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--text-muted);
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: all 0.25s;
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
            user-select: none;
        }

        .nav-tab:hover {
            color: var(--text-secondary);
        }

        .nav-tab.active {
            color: var(--naranja);
            border-bottom-color: var(--naranja);
        }

        .nav-tab i {
            font-size: 0.85rem;
        }

        /* HERO */
        .section-hero {
            background: var(--oscuro2);
            padding: 40px 0 35px;
            border-bottom: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .section-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(ellipse at 70% 50%, rgba(255, 102, 0, 0.06) 0%, transparent 60%),
                radial-gradient(ellipse at 20% 50%, rgba(0, 127, 255, 0.04) 0%, transparent 50%);
            pointer-events: none;
        }

        .hero-eyebrow {
            font-family: 'Rajdhani', sans-serif;
            font-size: 0.75rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--naranja);
            margin-bottom: 8px;
        }

        .hero-title {
            font-family: 'Rajdhani', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--text-primary);
            line-height: 1.1;
            margin-bottom: 8px;
        }

        .hero-subtitle {
            color: var(--text-muted);
            font-size: 0.88rem;
            letter-spacing: 0.3px;
        }

        .estado-pill {
            font-family: 'Rajdhani', sans-serif;
            font-weight: 700;
            font-size: 0.82rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 8px 22px;
            border-radius: 3px;
            display: inline-block;
        }

        .estado-en_espera {
            background: rgba(108, 117, 125, 0.15);
            color: #aaa;
            border: 1px solid rgba(108, 117, 125, 0.3);
        }

        .estado-en_diagnostico {
            background: rgba(0, 127, 255, 0.12);
            color: var(--azul);
            border: 1px solid rgba(0, 127, 255, 0.3);
        }

        .estado-en_reparacion {
            background: rgba(255, 102, 0, 0.12);
            color: var(--naranja);
            border: 1px solid rgba(255, 102, 0, 0.3);
        }

        .estado-finalizado {
            background: rgba(40, 167, 69, 0.12);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .estado-entregado {
            background: rgba(255, 255, 255, 0.05);
            color: #ddd;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        /* MAIN */
        .main-content {
            padding: 40px 0 80px;
        }

        /* CARDS */
        .data-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 4px;
            overflow: visible;
            height: 100%;
        }

        .data-card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-icon {
            width: 32px;
            height: 32px;
            background: rgba(255, 102, 0, 0.1);
            border: 1px solid rgba(255, 102, 0, 0.2);
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--naranja);
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .card-icon.azul {
            background: rgba(0, 127, 255, 0.1);
            border-color: rgba(0, 127, 255, 0.2);
            color: var(--azul);
        }

        .data-card-header h6 {
            margin: 0;
            font-family: 'Rajdhani', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--text-primary);
        }

        .data-card-body {
            padding: 24px;
        }

        .data-label {
            font-size: 0.72rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .data-value {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        .data-value.naranja {
            color: var(--naranja);
            font-family: 'Rajdhani', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .data-divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 18px 0;
        }

        /* PROGRESS */
        .progress-track {
            height: 3px;
            background: rgba(255, 255, 255, 0.07);
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--naranja), var(--azul));
            border-radius: 2px;
            transition: width 1s ease;
        }

        /* TIMELINE */
        .timeline {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .timeline-item {
            display: flex;
            gap: 16px;
            padding-bottom: 24px;
            position: relative;
        }

        .timeline-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 15px;
            top: 34px;
            bottom: 0;
            width: 1px;
            background: var(--border);
        }

        .timeline-dot {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 102, 0, 0.1);
            border: 1px solid rgba(255, 102, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .timeline-dot i {
            color: var(--naranja);
            font-size: 0.7rem;
        }

        .timeline-title {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .timeline-state {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .timeline-comment {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-bottom: 4px;
            font-style: italic;
        }

        .timeline-date {
            font-size: 0.75rem;
            color: var(--text-muted);
            letter-spacing: 0.3px;
        }

        /* EMPTY STATE */
        .empty-state {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 70px 40px;
            text-align: center;
        }

        .empty-state .empty-icon {
            width: 64px;
            height: 64px;
            background: rgba(255, 102, 0, 0.08);
            border: 1px solid rgba(255, 102, 0, 0.15);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .empty-state .empty-icon i {
            color: var(--naranja);
            font-size: 1.6rem;
        }

        .empty-state h5 {
            font-family: 'Rajdhani', sans-serif;
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 1.1rem;
            color: var(--text-primary);
            margin-bottom: 10px;
        }

        .empty-state p {
            color: var(--text-muted);
            font-size: 0.88rem;
            max-width: 380px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* TAB SECTIONS */
        .tab-section {
            display: none;
        }

        .tab-section.active {
            display: block;
        }

        /* COMING SOON */
        .coming-soon {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 70px 40px;
            text-align: center;
        }

        .coming-soon .cs-icon {
            width: 64px;
            height: 64px;
            background: rgba(0, 127, 255, 0.08);
            border: 1px solid rgba(0, 127, 255, 0.15);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .coming-soon .cs-icon i {
            color: var(--azul);
            font-size: 1.6rem;
        }

        .coming-soon h5 {
            font-family: 'Rajdhani', sans-serif;
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 1.1rem;
            color: var(--text-primary);
            margin-bottom: 10px;
        }

        .coming-soon p {
            color: var(--text-muted);
            font-size: 0.88rem;
            max-width: 380px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* FOOTER */
        .site-footer {
            background: var(--oscuro2);
            border-top: 1px solid var(--border);
            padding: 24px 0;
            text-align: center;
        }

        .site-footer .brand {
            font-family: 'Rajdhani', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--text-primary);
        }

        .site-footer .brand .accent {
            color: var(--naranja);
        }

        .site-footer .brand .accent2 {
            color: var(--azul);
        }

        .site-footer small {
            color: var(--text-muted);
            font-size: 0.75rem;
            display: block;
            margin-top: 4px;
        }

        /* STAT HIGHLIGHT */
        .stat-highlight {
            background: rgba(255, 102, 0, 0.05);
            border: 1px solid rgba(255, 102, 0, 0.1);
            border-radius: 3px;
            padding: 14px 18px;
        }

        .stat-highlight.azul {
            background: rgba(0, 127, 255, 0.05);
            border-color: rgba(0, 127, 255, 0.1);
        }
    </style>
</head>

<body>

    {{-- TOPBAR --}}
    <div class="topbar">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <a class="topbar-brand" href="#">
                    <span class="accent">RAPID</span><span class="accent2">GAAS</span>
                </a>
                <div class="topbar-divider"></div>
                <span
                    style="font-size:0.72rem; letter-spacing:2px; text-transform:uppercase; color:var(--text-muted);">Panel
                    del cliente</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                {{-- NOTIFICACIONES --}}
                <div style="position:relative;">
                    <button id="btn-notificaciones" onclick="toggleNotificaciones()"
                        style="background:transparent; border:1px solid var(--border); color:var(--text-secondary); border-radius:3px; width:36px; height:36px; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all 0.25s; position:relative;"
                        onmouseover="this.style.borderColor='var(--naranja)'; this.style.color='var(--naranja)'"
                        onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--text-secondary)'">
                        <i class="fas fa-bell" style="font-size:0.85rem;"></i>
                        <span id="badge-notif"
                            style="display:none; position:absolute; top:-5px; right:-5px; background:var(--naranja); color:white; font-size:0.6rem; font-weight:700; border-radius:50%; width:16px; height:16px; align-items:center; justify-content:center; font-family:'Rajdhani',sans-serif;">0</span>
                    </button>
                    {{-- PANEL --}}
                    <div id="panel-notificaciones"
                        style="display:none; position:absolute; top:46px; right:0; width:320px; background:var(--card-bg); border:1px solid var(--border); border-radius:4px; box-shadow:0 8px 30px rgba(0,0,0,0.4); z-index:9999;">
                        <div
                            style="padding:14px 18px; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center;">
                            <span
                                style="font-family:'Rajdhani',sans-serif; font-weight:700; font-size:0.85rem; letter-spacing:1.5px; text-transform:uppercase; color:var(--text-primary);">Notificaciones</span>
                            <button onclick="marcarTodasLeidas()"
                                style="background:transparent; border:none; color:var(--naranja); font-size:0.75rem; cursor:pointer; font-family:'Rajdhani',sans-serif; font-weight:600; letter-spacing:0.5px;">Marcar
                                todas leídas</button>
                        </div>
                        <div id="lista-notificaciones" style="max-height:320px; overflow-y:auto;">
                            <div style="padding:20px; text-align:center; color:var(--text-muted); font-size:0.85rem;">
                                <i class="fas fa-spinner fa-spin me-2"></i>Cargando...
                            </div>
                        </div>
                    </div>
                </div>

                <span class="topbar-user">
                    <i class="fas fa-user-circle me-1"></i>
                    {{ auth()->user()->nombre }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt me-1"></i>Salir
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- SECTION NAV --}}
    <div class="section-nav">
        <div class="container d-flex">
            <div class="nav-tab active" onclick="cambiarSeccion('vehiculo', this)">
                <i class="fas fa-motorcycle"></i>Mi Vehículo
            </div>
            <div class="nav-tab" onclick="cambiarSeccion('ruta', this)">
                <i class="fas fa-map-marker-alt"></i>Calcular Ruta
            </div>
            <div class="nav-tab" onclick="cambiarSeccion('ayuda', this)">
                <i class="fas fa-headset"></i>Ayuda
            </div>
        </div>
    </div>

    {{-- HERO --}}
    <div class="section-hero">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div class="hero-eyebrow" id="hero-eyebrow">RapidGaas — Seguimiento en tiempo real</div>
                <h1 class="hero-title" id="hero-title">Mi Vehículo</h1>
                <p class="hero-subtitle" id="hero-subtitle">Consulta el estado de tu moto en tiempo real</p>
            </div>
            <div id="hero-estado-wrap">
                @if ($orden)
                    <span class="estado-pill estado-{{ $orden->estado }}" id="hero-estado">
                        {{ ucfirst(str_replace('_', ' ', $orden->estado)) }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- MAIN --}}
    <div class="main-content">
        <div class="container">

            {{-- SECCIÓN MI VEHÍCULO --}}
            <div class="tab-section active" id="section-vehiculo">

                @if (!$cliente || !$vehiculo)
                    <div class="empty-state">
                        <div class="empty-icon"><i class="fas fa-motorcycle"></i></div>
                        <h5>Sin vehículo registrado</h5>
                        <p>Cuando dejes tu moto en el taller, podrás consultar aquí su estado en tiempo real.</p>
                    </div>
                @else
                    <div class="row g-4">

                        {{-- INFO VEHÍCULO --}}
                        <div class="col-lg-6">
                            <div class="data-card">
                                <div class="data-card-header">
                                    <div class="card-icon"><i class="fas fa-motorcycle"></i></div>
                                    <h6>Información del vehículo</h6>
                                </div>
                                <div class="data-card-body">
                                    <div class="row g-4">
                                        <div class="col-6">
                                            <div class="data-label">Matrícula</div>
                                            <div class="data-value naranja">{{ $vehiculo->matricula }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="data-label">Marca y modelo</div>
                                            <div class="data-value">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="data-label">Año</div>
                                            <div class="data-value">{{ $vehiculo->anio ?? '—' }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="data-label">Color</div>
                                            <div class="data-value">{{ $vehiculo->color ?? '—' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ESTADO REPARACIÓN --}}
                        @if ($orden)
                            <div class="col-lg-6">
                                <div class="data-card">
                                    <div class="data-card-header">
                                        <div class="card-icon azul"><i class="fas fa-wrench"></i></div>
                                        <h6>Estado de la reparación</h6>
                                    </div>
                                    <div class="data-card-body">
                                        @php
                                            $estados = [
                                                'en_espera' => 20,
                                                'en_diagnostico' => 40,
                                                'en_reparacion' => 70,
                                                'finalizado' => 90,
                                                'entregado' => 100,
                                            ];
                                            $progreso = $estados[$orden->estado] ?? 0;
                                        @endphp
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span
                                                    style="font-size:0.75rem; color:var(--text-muted); letter-spacing:0.5px;">Progreso
                                                    de la reparación</span>
                                                <span
                                                    style="font-family:'Rajdhani',sans-serif; font-weight:700; color:var(--naranja); font-size:0.95rem;">{{ $progreso }}%</span>
                                            </div>
                                            <div class="progress-track">
                                                <div class="progress-fill" style="width:{{ $progreso }}%;"></div>
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <div class="stat-highlight">
                                                    <div class="data-label">Fecha entrada</div>
                                                    <div class="data-value">
                                                        {{ $orden->fecha_entrada ? \Carbon\Carbon::parse($orden->fecha_entrada)->format('d/m/Y') : '—' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="stat-highlight azul">
                                                    <div class="data-label">Entrega estimada</div>
                                                    <div class="data-value">
                                                        {{ $orden->fecha_estimada ? \Carbon\Carbon::parse($orden->fecha_estimada)->format('d/m/Y') : '—' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="stat-highlight">
                                                    <div class="data-label">Presupuesto</div>
                                                    <div class="data-value">
                                                        {{ $orden->presupuesto_estimado ? number_format($orden->presupuesto_estimado, 2) . ' €' : 'Pendiente' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="stat-highlight azul">
                                                    <div class="data-label">Coste final</div>
                                                    <div class="data-value">
                                                        {{ $orden->coste_final ? number_format($orden->coste_final, 2) . ' €' : 'Pendiente' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($orden->diagnostico_inicial)
                                            <hr class="data-divider">
                                            <div class="data-label">Diagnóstico inicial</div>
                                            <div
                                                style="font-size:0.88rem; color:var(--text-secondary); line-height:1.6; margin-top:6px;">
                                                {{ $orden->diagnostico_inicial }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- HISTORIAL --}}
                            <div class="col-12">
                                <div class="data-card">
                                    <div class="data-card-header">
                                        <div class="card-icon"><i class="fas fa-history"></i></div>
                                        <h6>Historial de actualizaciones</h6>
                                    </div>
                                    <div class="data-card-body">
                                        <ul class="timeline">
                                            @forelse($orden->actualizaciones->sortByDesc('created_at') as $actualizacion)
                                                <li class="timeline-item">
                                                    <div class="timeline-dot">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <div>
                                                        <div class="timeline-title">
                                                            {{ ucfirst(str_replace('_', ' ', $actualizacion->estado_nuevo)) }}
                                                        </div>
                                                        @if ($actualizacion->estado_anterior)
                                                            <div class="timeline-state">
                                                                Desde:
                                                                {{ ucfirst(str_replace('_', ' ', $actualizacion->estado_anterior)) }}
                                                            </div>
                                                        @endif
                                                        @if ($actualizacion->comentario)
                                                            <div class="timeline-comment">
                                                                "{{ $actualizacion->comentario }}"</div>
                                                        @endif
                                                        <div class="timeline-date">
                                                            {{ $actualizacion->created_at->format('d/m/Y — H:i') }}
                                                        </div>
                                                    </div>
                                                </li>
                                            @empty
                                                <li style="color:var(--text-muted); font-size:0.88rem;">Sin
                                                    actualizaciones registradas todavía.</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                @endif
            </div>

            {{-- SECCIÓN CALCULAR RUTA --}}
            <div class="tab-section" id="section-ruta">
                <div class="row g-4">

                    {{-- MAPA --}}
                    <div class="col-lg-8">
                        <div class="data-card">
                            <div class="data-card-header">
                                <div class="card-icon azul"><i class="fas fa-map-marked-alt"></i></div>
                                <h6>Ruta al taller</h6>
                                <span
                                    style="margin-left:auto; font-size:0.72rem; color:var(--text-muted); letter-spacing:0.5px;">
                                    <i class="fas fa-mouse-pointer me-1"></i>Haz clic en el mapa para seleccionar tu
                                    ubicación
                                </span>
                            </div>
                            <div class="data-card-body" style="padding:0;">
                                <div id="map" style="height:420px; width:100%; border-radius:0 0 4px 4px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PANEL DERECHO --}}
                    <div class="col-lg-4 d-flex flex-column gap-4">

                        {{-- TIEMPO --}}
                        <div class="data-card">
                            <div class="data-card-header">
                                <div class="card-icon"><i class="fas fa-cloud-sun"></i></div>
                                <h6>Tiempo hoy</h6>
                            </div>
                            <div class="data-card-body" id="weather-container">
                                <div class="d-flex align-items-center gap-2"
                                    style="color:var(--text-muted); font-size:0.85rem;">
                                    <i class="fas fa-spinner fa-spin"></i> Cargando previsión...
                                </div>
                            </div>
                        </div>

                        {{-- CALCULAR RUTA --}}
                        <div class="data-card">
                            <div class="data-card-header">
                                <div class="card-icon"><i class="fas fa-route"></i></div>
                                <h6>Calcular ruta</h6>
                            </div>
                            <div class="data-card-body">
                                <div class="mb-3">
                                    <div class="data-label mb-2">Tu dirección</div>
                                    <input type="text" id="origen-input" placeholder="Escribe tu dirección..."
                                        style="width:100%; background:rgba(255,255,255,0.05); border:1px solid var(--border); border-radius:3px; padding:10px 14px; color:var(--text-primary); font-size:0.88rem; outline:none; transition:border-color 0.25s; font-family:'Inter',sans-serif;"
                                        onfocus="this.style.borderColor='var(--naranja)'"
                                        onblur="this.style.borderColor='var(--border)'">
                                </div>
                                <div
                                    style="text-align:center; color:var(--text-muted); font-size:0.75rem; letter-spacing:0.5px; margin:10px 0;">
                                    — o —</div>
                                <button onclick="usarUbicacionGPS()"
                                    style="width:100%; background:transparent; color:var(--azul); border:1px solid rgba(0,127,255,0.3); border-radius:3px; padding:10px; font-family:'Rajdhani',sans-serif; font-weight:700; font-size:0.82rem; letter-spacing:1.5px; text-transform:uppercase; cursor:pointer; transition:all 0.25s; margin-bottom:12px;"
                                    onmouseover="this.style.background='rgba(0,127,255,0.08)'"
                                    onmouseout="this.style.background='transparent'">
                                    <i class="fas fa-crosshairs me-2"></i>Usar mi ubicación GPS
                                </button>
                                <button onclick="calcularRuta()"
                                    style="width:100%; background:var(--naranja); color:white; border:none; border-radius:3px; padding:12px; font-family:'Rajdhani',sans-serif; font-weight:700; font-size:0.85rem; letter-spacing:1.5px; text-transform:uppercase; cursor:pointer; transition:all 0.25s;"
                                    onmouseover="this.style.background='#e65c00'"
                                    onmouseout="this.style.background='var(--naranja)'">
                                    <i class="fas fa-route me-2"></i>Calcular ruta
                                </button>
                                <div id="ruta-info" style="display:none; margin-top:16px;">
                                    <div class="row g-2 text-center">
                                        <div class="col-6"
                                            style="background:rgba(255,102,0,0.05); border:1px solid rgba(255,102,0,0.1); border-radius:3px; padding:14px 8px;">
                                            <div class="data-label">Distancia</div>
                                            <div id="ruta-distancia"
                                                style="font-family:'Rajdhani',sans-serif; font-weight:700; font-size:1.2rem; color:var(--naranja);">
                                                —</div>
                                        </div>
                                        <div class="col-6"
                                            style="background:rgba(0,127,255,0.05); border:1px solid rgba(0,127,255,0.1); border-radius:3px; padding:14px 8px;">
                                            <div class="data-label">Tiempo estimado</div>
                                            <div id="ruta-tiempo"
                                                style="font-family:'Rajdhani',sans-serif; font-weight:700; font-size:1.2rem; color:var(--azul);">
                                                —</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- INFO TALLER --}}
                        <div class="data-card">
                            <div class="data-card-header">
                                <div class="card-icon"><i class="fas fa-map-pin"></i></div>
                                <h6>Ubicación del taller</h6>
                            </div>
                            <div class="data-card-body">
                                <div class="mb-3">
                                    <div class="data-label">Dirección</div>
                                    <div class="data-value" style="font-size:0.88rem; line-height:1.5;">
                                        C. Orilla, 20<br>11500 El Puerto de Santa María, Cádiz
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="data-label">Teléfono</div>
                                    <div class="data-value" style="font-size:0.88rem;">+34 655 64 53 02</div>
                                </div>
                                <div>
                                    <div class="data-label">Horario</div>
                                    <div class="data-value" style="font-size:0.88rem; line-height:1.5;">
                                        Lun — Vie: 08:00 — 19:00<br>
                                        Sáb: 09:00 — 14:00
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- SECCIÓN AYUDA --}}
            <div class="tab-section" id="section-ayuda">
                <div class="coming-soon">
                    <div class="cs-icon"><i class="fas fa-headset"></i></div>
                    <h5>Atención al cliente</h5>
                    <p>Próximamente podrás contactar con nuestro equipo directamente desde aquí.</p>
                </div>
            </div>

        </div>
    </div>

    {{-- FOOTER --}}
    <footer class="site-footer">
        <div class="brand"><span class="accent">RAPID</span><span class="accent2">GAAS</span></div>
        <small>© {{ date('Y') }} RapidGaas. Todos los derechos reservados.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const heroData = {
            vehiculo: {
                eyebrow: 'RapidGaas — Seguimiento en tiempo real',
                title: 'Mi Vehículo',
                subtitle: 'Consulta el estado de tu moto en tiempo real'
            },
            ruta: {
                eyebrow: 'RapidGaas — Navegación',
                title: 'Calcular Ruta',
                subtitle: 'Obtén la ruta más cercana al taller y la previsión del tiempo'
            },
            ayuda: {
                eyebrow: 'RapidGaas — Soporte',
                title: 'Ayuda',
                subtitle: 'Contacta con nuestro equipo de atención al cliente'
            },
        };

        function cambiarSeccion(seccion, tab) {
            document.querySelectorAll('.tab-section').forEach(s => s.classList.remove('active'));
            document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
            document.getElementById('section-' + seccion).classList.add('active');
            tab.classList.add('active');
            document.getElementById('hero-eyebrow').textContent = heroData[seccion].eyebrow;
            document.getElementById('hero-title').textContent = heroData[seccion].title;
            document.getElementById('hero-subtitle').textContent = heroData[seccion].subtitle;
            const estadoWrap = document.getElementById('hero-estado-wrap');
            if (estadoWrap) estadoWrap.style.opacity = seccion === 'vehiculo' ? '1' : '0';
        }
    </script>
    {{-- GOOGLE MAPS --}}
    <script>
        const TALLER_LAT = 36.6081502;
        const TALLER_LNG = -6.2081371;
        const TALLER_NAME = 'RapidGaas — Taller de Motos';
        const MAPS_KEY = '{{ env('GOOGLE_MAPS_API_KEY') }}';
        const OW_KEY = '{{ env('OPENWEATHER_API_KEY') }}';

        let map, directionsService, directionsRenderer, userMarker;

        function initMap() {
            const tallerPos = {
                lat: TALLER_LAT,
                lng: TALLER_LNG
            };

            map = new google.maps.Map(document.getElementById('map'), {
                center: tallerPos,
                zoom: 14,
                styles: [{
                        elementType: 'geometry',
                        stylers: [{
                            color: '#0a0a0f'
                        }]
                    },
                    {
                        elementType: 'labels.text.fill',
                        stylers: [{
                            color: '#6b6b7a'
                        }]
                    },
                    {
                        elementType: 'labels.text.stroke',
                        stylers: [{
                            color: '#0a0a0f'
                        }]
                    },
                    {
                        featureType: 'road',
                        elementType: 'geometry',
                        stylers: [{
                            color: '#1a1a25'
                        }]
                    },
                    {
                        featureType: 'road',
                        elementType: 'geometry.stroke',
                        stylers: [{
                            color: '#111118'
                        }]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'geometry',
                        stylers: [{
                            color: '#1a1a25'
                        }]
                    },
                    {
                        featureType: 'water',
                        elementType: 'geometry',
                        stylers: [{
                            color: '#07111a'
                        }]
                    },
                    {
                        featureType: 'poi',
                        stylers: [{
                            visibility: 'off'
                        }]
                    },
                    {
                        featureType: 'transit',
                        stylers: [{
                            visibility: 'off'
                        }]
                    },
                ],
            });

            new google.maps.Marker({
                position: tallerPos,
                map: map,
                title: TALLER_NAME,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 10,
                    fillColor: '#FF6600',
                    fillOpacity: 1,
                    strokeColor: '#ffffff',
                    strokeWeight: 2,
                }
            });

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer({
                polylineOptions: {
                    strokeColor: '#FF6600',
                    strokeWeight: 4
                },
                suppressMarkers: false,
            });
            directionsRenderer.setMap(map);

            // Clic en el mapa para seleccionar origen automáticamente
            let origenMarker = null;
            map.addListener('click', (e) => {
                const clickPos = e.latLng;
                if (origenMarker) origenMarker.setMap(null);
                origenMarker = new google.maps.Marker({
                    position: clickPos,
                    map: map,
                    title: 'Tu ubicación',
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 8,
                        fillColor: '#007FFF',
                        fillOpacity: 1,
                        strokeColor: '#ffffff',
                        strokeWeight: 2,
                    }
                });
                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    location: clickPos
                }, (results, status) => {
                    if (status === 'OK' && results[0]) {
                        document.getElementById('origen-input').value = results[0].formatted_address;
                    }
                });
                calcularRutaDesde(clickPos);
            });
        }

        function usarUbicacionGPS() {
            if (!navigator.geolocation) {
                alert('Tu navegador no soporta geolocalización.');
                return;
            }
            navigator.geolocation.getCurrentPosition(pos => {
                const latLng = {
                    lat: pos.coords.latitude,
                    lng: pos.coords.longitude
                };
                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    location: latLng
                }, (results, status) => {
                    if (status === 'OK' && results[0]) {
                        document.getElementById('origen-input').value = results[0].formatted_address;
                    }
                });
                calcularRutaDesde(latLng);
            }, () => {
                alert('No se pudo obtener tu ubicación. Revisa los permisos del navegador.');
            });
        }

        function calcularRuta() {
            const direccion = document.getElementById('origen-input').value.trim();
            if (!direccion) {
                alert('Escribe tu dirección o usa el GPS.');
                return;
            }
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                address: direccion
            }, (results, status) => {
                if (status === 'OK') {
                    calcularRutaDesde(results[0].geometry.location);
                } else {
                    alert('No se encontró la dirección. Inténtalo de nuevo.');
                }
            });
        }

        function calcularRutaDesde(origen) {
            // Guardar dirección en localStorage
            const inputVal = document.getElementById('origen-input').value;
            if (inputVal) localStorage.setItem('rapidgaas_origen', inputVal);

            directionsService.route({
                origin: origen,
                destination: {
                    lat: TALLER_LAT,
                    lng: TALLER_LNG
                },
                travelMode: google.maps.TravelMode.DRIVING,
            }, (result, status) => {
                if (status === 'OK') {
                    directionsRenderer.setDirections(result);
                    const leg = result.routes[0].legs[0];
                    document.getElementById('ruta-distancia').textContent = leg.distance.text;
                    document.getElementById('ruta-tiempo').textContent = leg.duration.text;
                    document.getElementById('ruta-info').style.display = 'block';
                } else {
                    alert('No se pudo calcular la ruta. Inténtalo de nuevo.');
                }
            });
        }

        // OPENWEATHER
        async function cargarTiempo() {
            try {
                const res = await fetch(
                    `https://api.openweathermap.org/data/2.5/weather?q=El+Puerto+de+Santa+Maria,ES&appid=${OW_KEY}&units=metric&lang=es`
                );
                const data = await res.json();

                const temp = Math.round(data.main.temp);
                const desc = data.weather[0].description;
                const icono = data.weather[0].icon;
                const humedad = data.main.humidity;
                const viento = Math.round(data.wind.speed * 3.6);
                const sensacion = Math.round(data.main.feels_like);

                document.getElementById('weather-container').innerHTML = `
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="https://openweathermap.org/img/wn/${icono}@2x.png"
                         style="width:56px; height:56px; filter:drop-shadow(0 0 8px rgba(255,102,0,0.3));">
                    <div>
                        <div style="font-family:'Rajdhani',sans-serif; font-size:2rem; font-weight:700; color:var(--text-primary); line-height:1;">${temp}°C</div>
                        <div style="font-size:0.8rem; color:var(--text-muted); text-transform:capitalize; margin-top:2px;">${desc}</div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-4 text-center" style="background:rgba(255,255,255,0.03); border:1px solid var(--border); border-radius:3px; padding:10px 6px;">
                        <div style="font-size:0.68rem; color:var(--text-muted); letter-spacing:0.5px; text-transform:uppercase; margin-bottom:4px;">Sensación</div>
                        <div style="font-family:'Rajdhani',sans-serif; font-weight:700; font-size:1rem; color:var(--text-primary);">${sensacion}°</div>
                    </div>
                    <div class="col-4 text-center" style="background:rgba(255,255,255,0.03); border:1px solid var(--border); border-radius:3px; padding:10px 6px;">
                        <div style="font-size:0.68rem; color:var(--text-muted); letter-spacing:0.5px; text-transform:uppercase; margin-bottom:4px;">Humedad</div>
                        <div style="font-family:'Rajdhani',sans-serif; font-weight:700; font-size:1rem; color:var(--text-primary);">${humedad}%</div>
                    </div>
                    <div class="col-4 text-center" style="background:rgba(255,255,255,0.03); border:1px solid var(--border); border-radius:3px; padding:10px 6px;">
                        <div style="font-size:0.68rem; color:var(--text-muted); letter-spacing:0.5px; text-transform:uppercase; margin-bottom:4px;">Viento</div>
                        <div style="font-family:'Rajdhani',sans-serif; font-weight:700; font-size:1rem; color:var(--text-primary);">${viento}km/h</div>
                    </div>
                </div>
            `;
            } catch (e) {
                document.getElementById('weather-container').innerHTML =
                    '<span style="color:var(--text-muted); font-size:0.85rem;">No se pudo cargar la previsión.</span>';
            }
        }

        // Cargar tiempo al entrar en la sección
        const originalCambiar = window.cambiarSeccion;
        window.cambiarSeccion = function(seccion, tab) {
            originalCambiar(seccion, tab);
            if (seccion === 'ruta') {
                cargarTiempo();
                setTimeout(() => {
                    if (typeof google !== 'undefined' && map) {
                        google.maps.event.trigger(map, 'resize');
                        map.setCenter({
                            lat: TALLER_LAT,
                            lng: TALLER_LNG
                        });
                    }
                }, 100);
            }
        };

        // Cargar tiempo si empezamos en ruta
        document.addEventListener('DOMContentLoaded', cargarTiempo);
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
    <script>
        let panelAbierto = false;

        async function cargarNotificaciones() {
            try {
                const res = await fetch('{{ route('cliente.notificaciones') }}');
                const data = await res.json();
                const badge = document.getElementById('badge-notif');
                const lista = document.getElementById('lista-notificaciones');

                if (data.length > 0) {
                    badge.style.display = 'flex';
                    badge.textContent = data.length > 9 ? '9+' : data.length;
                    lista.innerHTML = data.map(n => `
                        <div style="padding:14px 18px; border-bottom:1px solid var(--border); transition:background 0.2s;"
                             onmouseover="this.style.background='rgba(255,255,255,0.03)'"
                             onmouseout="this.style.background='transparent'">
                            <div style="display:flex; align-items:flex-start; gap:12px;">
                                <div style="width:8px; height:8px; background:var(--naranja); border-radius:50%; margin-top:5px; flex-shrink:0;"></div>
                                <div style="flex:1;">
                                    <div style="font-size:0.85rem; color:var(--text-primary); margin-bottom:4px;">${n.data.mensaje}</div>
                                    <div style="font-size:0.72rem; color:var(--text-muted);">${new Date(n.created_at).toLocaleDateString('es-ES', { day:'2-digit', month:'2-digit', year:'numeric', hour:'2-digit', minute:'2-digit' })}</div>
                                </div>
                            </div>
                        </div>
                    `).join('');
                } else {
                    badge.style.display = 'none';
                    lista.innerHTML =
                        '<div style="padding:24px; text-align:center; color:var(--text-muted); font-size:0.85rem;"><i class="fas fa-check-circle me-2" style="color:#28a745;"></i>Sin notificaciones nuevas</div>';
                }
            } catch (e) {
                console.error('Error cargando notificaciones', e);
            }
        }

        function toggleNotificaciones() {
            const panel = document.getElementById('panel-notificaciones');
            panelAbierto = !panelAbierto;
            panel.style.display = panelAbierto ? 'block' : 'none';
            if (panelAbierto) cargarNotificaciones();
        }

        async function marcarTodasLeidas() {
            await fetch('{{ route('cliente.notificaciones.leer') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            });
            document.getElementById('badge-notif').style.display = 'none';
            cargarNotificaciones();
        }

        document.addEventListener('click', (e) => {
            const btn = document.getElementById('btn-notificaciones');
            const panel = document.getElementById('panel-notificaciones');
            if (!btn.contains(e.target) && !panel.contains(e.target)) {
                panel.style.display = 'none';
                panelAbierto = false;
            }
        });

        document.addEventListener('DOMContentLoaded', cargarNotificaciones);

        // Recuperar dirección guardada
        const origenGuardado = localStorage.getItem('rapidgaas_origen');
        if (origenGuardado) {
            document.getElementById('origen-input').value = origenGuardado;
        }
    </script>
</body>

</html>
