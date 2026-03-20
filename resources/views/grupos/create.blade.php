<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Grupo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { colors: { primary: "#6b2e50" }, fontFamily: { sans: ["Public Sans"] } } } }</script>
</head>
<body class="bg-gray-50 font-sans p-8">

    <div class="max-w-lg mx-auto bg-white p-6 rounded-xl border">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-xl font-bold">Nuevo Grupo</h1>
                <p class="text-xs text-gray-400">Asigna un horario existente al grupo</p>
            </div>
            <a href="{{ route('grupos.index') }}" class="text-sm text-gray-400 hover:underline">← Volver</a>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('grupos.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Nombre del Grupo</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Ej: Grupo A, 3B..."
                    class="w-full border rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Horario</label>
                <select name="horario_id" class="w-full border rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" required>
                    <option value="">Selecciona un horario</option>
                    @foreach($horarios as $horario)
                        <option value="{{ $horario->id }}" {{ old('horario_id') == $horario->id ? 'selected' : '' }}>
                            {{ $horario->materia->nombre }} —
                            {{ $horario->maestro->name }} |
                            {{ \Carbon\Carbon::parse($horario->hora_inicio)->format('h:i A') }}
                            -
                            {{ \Carbon\Carbon::parse($horario->hora_fin)->format('h:i A') }}
                            ({{ $horario->dias }})
                        </option>
                    @endforeach
                </select>
                @if($horarios->isEmpty())
                    <p class="text-xs text-red-400 mt-1">
                        No hay horarios registrados.
                        <a href="{{ route('horarios.create') }}" class="underline">Crear uno aquí</a>
                    </p>
                @endif
            </div>

            <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg text-sm font-medium hover:opacity-90 transition">
                Guardar Grupo
            </button>
        </form>
    </div>

</body>
</html>