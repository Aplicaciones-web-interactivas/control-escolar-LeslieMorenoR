<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Tarea</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { colors: { primary: "#6b2e50" }, fontFamily: { sans: ["Public Sans"] } } } }</script>
</head>
<body class="bg-gray-50 font-sans p-8">
<div class="max-w-lg mx-auto bg-white p-6 rounded-xl border">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Nueva Tarea</h1>
        <a href="{{ route('tareas.index') }}" class="text-sm text-gray-400 hover:underline">← Volver</a>
    </div>

    @if($errors->any())
        <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('tareas.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Título</label>
            <input type="text" name="titulo" value="{{ old('titulo') }}"
                class="w-full border rounded-lg p-2 text-sm" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Descripción</label>
            <textarea name="descripcion" rows="4"
                class="w-full border rounded-lg p-2 text-sm" required>{{ old('descripcion') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Grupo</label>
            <select name="grupo_id" class="w-full border rounded-lg p-2 text-sm" required>
                <option value="">Selecciona un grupo</option>
                @foreach($grupos as $grupo)
                    <option value="{{ $grupo->id }}" {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                        {{ $grupo->nombre }} — {{ $grupo->horario->materia->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Fecha de entrega</label>
            <input type="date" name="fecha_entrega" value="{{ old('fecha_entrega') }}"
                class="w-full border rounded-lg p-2 text-sm" required>
        </div>

        <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg text-sm font-medium hover:opacity-90">
            Crear Tarea
        </button>
    </form>
</div>
</body>
</html>