<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Materia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: "#6b2e50" } } } }</script>
</head>
<body class="bg-gray-50 p-8">

    <div class="max-w-lg mx-auto bg-white p-6 rounded-xl border">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-bold">Nueva Materia</h1>
            <a href="{{ route('materias.index') }}" class="text-sm text-gray-400 hover:underline">← Volver</a>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded mb-4 text-sm">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('materias.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}"
                    class="w-full border rounded-lg p-2 text-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Clave</label>
                <input type="text" name="clave" value="{{ old('clave') }}"
                    class="w-full border rounded-lg p-2 text-sm" required>
            </div>

            <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg text-sm">
                Guardar Materia
            </button>
        </form>
    </div>

</body>
</html>