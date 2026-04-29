<!DOCTYPE html>
<html>
<head>
    <title>RapidGaas - Administrador</title>
</head>
<body>
    <h1>Panel Administrador</h1>
    <p>Bienvenido, {{ auth()->user()->nombre }}</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
</body>
</html>
