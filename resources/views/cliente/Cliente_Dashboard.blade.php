<!DOCTYPE html>
<html>
<head>
    <title>RapidGaas - Cliente</title>
</head>
<body>
    <h1>Panel Cliente</h1>
    <p>Bienvenido, {{ auth()->user()->nombre }}</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
</body>
</html>
