<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Horario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: "#6b2e50" } } } }</script>
</head>
<body class="bg-gray-50 p-8">

    <div class="max-w-lg mx-auto bg-white p-6 rounded-xl border">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-bold">Nuevo Horario</h1>
            <a href="{{ route('horarios.index') }}" class="text-sm text-gray-400 hover:underline">← Volver</a>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded mb-4 text-sm">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('horarios.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Materia</label>
                <select name="materia_id" class="w-full border rounded-lg p-2 text-sm" required>
                    <option value="">Selecciona una materia</option>
                    @foreach($materias as $materia)
                        <option value="{{ $materia->id }}">{{ $materia->nombre }} ({{ $materia->clave }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Maestro</label>
                <select name="user_id" class="w-full border rounded-lg p-2 text-sm" required>
                    <option value="">Selecciona un maestro</option>
                    @foreach($maestros as $maestro)
                        <option value="{{ $maestro->id }}">{{ $maestro->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Hora inicio</label>
                    <input type="time" name="hora_inicio" class="w-full border rounded-lg p-2 text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Hora fin</label>
                    <input type="time" name="hora_fin" class="w-full border rounded-lg p-2 text-sm" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Días</label>
                <div class="flex gap-3 flex-wrap">
                    @foreach(['L' => 'Lunes', 'M' => 'Martes', 'Mi' => 'Miércoles', 'J' => 'Jueves', 'V' => 'Viernes'] as $valor => $dia)
                    <label class="flex items-center gap-1 text-sm">
                        <input type="checkbox" name="dias[]" value="{{ $valor }}"> {{ $dia }}
                    </label>
                    @endforeach
                </div>
            </div>
            @if($errors->has('colision'))
    <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm flex items-center gap-2">
        <span class="material-symbols-outlined text-base">warning</span>
        {{ $errors->first('colision') }}
    </div>
@endif
            <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg text-sm">
                Guardar Horario
            </button>
        </form>
    </div>

</body>
</html>