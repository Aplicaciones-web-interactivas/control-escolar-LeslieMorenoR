<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calificar Grupo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { colors: { primary: "#6b2e50" }, fontFamily: { sans: ["Public Sans"] } } } }</script>
</head>
<body class="bg-gray-50 font-sans p-8">
<div class="max-w-3xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">{{ $grupo->nombre }}</h1>
            <p class="text-sm text-gray-400">{{ $grupo->horario->materia->nombre }} — Asignar calificaciones</p>
        </div>
        <a href="{{ route('calificaciones.index') }}" class="text-sm text-gray-500 hover:underline">← Volver</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-left">
                <tr>
                    <th class="p-4">Alumno</th>
                    <th class="p-4">Clave</th>
                    <th class="p-4">Calificación</th>
                    <th class="p-4"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($inscripciones as $inscripcion)
                <tr class="border-t">
                    <td class="p-4">{{ $inscripcion->alumno->name }}</td>
                    <td class="p-4 text-gray-400">{{ $inscripcion->alumno->institutional_key }}</td>
                    <td class="p-4">
                        <form method="POST" action="{{ route('calificaciones.store') }}" class="flex gap-2 items-center">
                            @csrf
                            <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                            <input type="hidden" name="user_id" value="{{ $inscripcion->alumno->id }}">
                            <input type="number" name="calificacion" step="0.1" min="0" max="10"
                                value="{{ $calificaciones[$inscripcion->alumno->id] ?? '' }}"
                                class="border rounded-lg p-1 w-24 text-sm text-center"
                                placeholder="0 - 10">
                            <button class="bg-primary text-white px-3 py-1 rounded-lg text-xs hover:opacity-90">
                                Guardar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr><td colspan="4" class="p-8 text-center text-gray-400">Sin alumnos inscritos</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>