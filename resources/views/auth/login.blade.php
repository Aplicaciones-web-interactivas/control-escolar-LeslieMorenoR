<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Control Escolar</title>
</head>
<body>

    <h2>Iniciar Sesión</h2>

    @if ($errors->any())
        <div style="color:red">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <label>Clave Institucional</label>
        <input type="text" name="user_key" value="{{ old('user_key') }}" required>

        <label>Contraseña</label>
        <input type="password" name="pass" required>

        <label>
            <input type="checkbox" name="remember"> Recordarme
        </label>

        <button type="submit">Entrar</button>
    </form>

</body>
</html>