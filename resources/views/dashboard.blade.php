<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Control Escolar</title>
</head>
<body>

    <h1>Bienvenido, {{ Auth::user()->name }}</h1>
    <p>Rol: {{ Auth::user()->role }}</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar Sesión</button>
    </form>

</body>
</html>