<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taller Pro - Gestión en Tiempo Real</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Estilos personalizados -->
    <style>
        /* DEFINICIÓN DE PALETA DE COLORES */
        :root {
            /* Naranja Principal (Reemplaza al Primary de Bootstrap) */
            --bs-primary: #FF6600;
            --bs-primary-rgb: 255, 102, 0;

            /* Azul Eléctrico Personalizado */
            --electric-blue: #007FFF;
            --electric-blue-hover: #0066CC;
        }

        /* Override de botones primarios para que sean naranjas */
        .btn-primary {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
            color: #fff;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #e65c00;
            border-color: #e65c00;
        }

        /* Clases para texto Azul Eléctrico */
        .text-electric {
            color: var(--electric-blue) !important;
        }

        .bg-electric {
            background-color: var(--electric-blue) !important;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.85)), url('https://images.unsplash.com/photo-1486006920555-c77dcf18193c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            color: white;
            border-bottom: 4px solid var(--bs-primary);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--electric-blue);
            margin-bottom: 1rem;
            transition: transform 0.3s;
        }

        .card:hover .feature-icon {
            transform: scale(1.1);
            color: var(--bs-primary);
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: 1px;
            font-size: 1.5rem;
        }

        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
            border-bottom: 3px solid var(--electric-blue) !important;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <!-- Icono de tuerca en naranja -->
                <i class="bi bi-gear-wide-connected text-primary"></i>
                RAPID<span class="text-electric">GAAS</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-2">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                @if (auth()->user()->hasRole('admin'))
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm">Ir al
                                        Panel</a>
                                @elseif(auth()->user()->hasRole('mecanico'))
                                    <a href="{{ route('mecanico.dashboard') }}" class="btn btn-outline-light btn-sm">Ir al
                                        Panel</a>
                                @elseif(auth()->user()->hasRole('cliente'))
                                    <a href="{{ route('cliente.dashboard') }}" class="btn btn-outline-light btn-sm">Ir al
                                        Panel</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link text-white">Iniciar Sesión</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}"
                                        class="btn btn-primary btn-sm px-4 rounded-pill">Registrarse</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4">Mecánica experta,<br><span class="text-electric">Control
                            digital</span></h1>
                    <p class="lead mb-5 text-light opacity-75">
                        La potencia de un taller tradicional fusionada con la tecnología en tiempo real.
                        <br>Consulta el estado de tu reparación sin moverte de casa.
                    </p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                        <a href="{{ route('register') }}"
                            class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-lg">
                            Ver mi vehículo <i class="bi bi-arrow-right-short"></i>
                        </a>
                        <a href="#features" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">
                            Saber más
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Características (Features) -->
    <section id="features" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Servicios <span class="text-primary">Premium</span></h2>
                <p class="text-muted">Tecnología aplicada para tu tranquilidad</p>
            </div>
            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center hover-card">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="bi bi-speedometer"></i>
                            </div>
                            <h4 class="card-title fw-bold">Tiempo Real</h4>
                            <p class="card-text text-muted">Monitorización en tiempo real. ¿Tu moto está en el elevador,
                                en pruebas o listo para recoger? Lo sabrás al instante en tu móvil.</p>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center hover-card">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="bi bi-tablet-landscape"></i>
                            </div>
                            <h4 class="card-title fw-bold">Diagnóstico Digital</h4>
                            <p class="card-text text-muted">Informes detallados generados por nuestros mecánicos. Accede
                                a informes detallados de averías, piezas sustituidas y costes antes de aprobar el
                                presupuesto.</p>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center hover-card">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="bi bi-cloud-lightning-rain"></i>
                            </div>
                            <h4 class="card-title fw-bold">Alertas Climáticas</h4>
                            <p class="card-text text-muted">Seguridad ante todo. Te avisamos si hay alertas
                                meteorológicas al momento de recoger tu vehículo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-auto border-top border-primary border-3">
        <div class="container text-center">
            <div class="mb-3">
                <i class="bi bi-gear-wide-connected text-primary fs-4"></i>
            </div>
            <p class="mb-1">&copy; {{ date('Y') }} RapidGaas. Todos los derechos reservados.</p>
            <small class="text-white-50">Desarrollado para el Proyecto de Fin de Grado</small>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
