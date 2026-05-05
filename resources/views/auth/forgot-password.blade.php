<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recuperar Contraseña - Taller Pro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        :root {
            --bs-primary: #FF6600;
            --bs-primary-rgb: 255, 102, 0;
            --electric-blue: #007FFF;
            --electric-blue-hover: #0066CC;
        }

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

        .text-electric { color: var(--electric-blue) !important; }
        .text-primary { color: var(--bs-primary) !important; }

        .auth-bg {
            background: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), url('https://images.unsplash.com/photo-1486006920555-c77dcf18193c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            padding-top: 80px;
            padding-bottom: 40px;
        }

        .card-auth {
            border: none;
            border-top: 5px solid var(--bs-primary);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .form-control:focus {
            border-color: var(--electric-blue);
            box-shadow: 0 0 0 0.25rem rgba(0, 127, 255, 0.25);
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: 1px;
            font-size: 1.5rem;
        }

        .link-subtle {
            color: #6c757d;
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.3s;
        }
        .link-subtle:hover {
            color: var(--electric-blue);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-gear-wide-connected text-primary"></i>
                RAPID<span class="text-electric">GAAS</span>
            </a>
            <div class="justify-content-end">
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm rounded-pill px-4">
                    Volver al Login
                </a>
            </div>
        </div>
    </nav>

    <section class="auth-bg d-flex align-items-center justify-content-center flex-grow-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5 col-xl-4">

                    <div class="card card-auth p-4">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h3 class="fw-bold">¿Olvidaste tu clave?</h3>
                                <p class="text-muted small">
                                    {{ __('No hay problema. Introduce tu email y te enviaremos un enlace para restablecerla.') }}
                                </p>
                            </div>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show small" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="mb-4">
                                    <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-primary"></i></span>
                                        <input type="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="ejemplo@correo.com">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                                        Enviar enlace <i class="bi bi-send-fill ms-1"></i>
                                    </button>
                                </div>

                                <div class="text-center mt-3">
                                    <a href="{{ route('login') }}" class="link-subtle">
                                        <i class="bi bi-arrow-left"></i> Volver a inicio de sesión
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-3 border-top border-primary border-3">
        <div class="container text-center">
            <small class="text-white-50">&copy; {{ date('Y') }} RapidGaas. Gestión de talleres online.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
