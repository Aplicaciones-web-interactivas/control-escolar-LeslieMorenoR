<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calificaciones</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { colors: { primary: "#6b2e50" }, fontFamily: { sans: ["Public Sans"] } } } }</script>
</head>
<body class="bg-gray-50 font-sans p-8">
<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Calificaciones</h1>
            <p class="text-sm text-gray-400">Selecciona un grupo para calificar</p>
        </div>
        <a href="/dashboard" class="text-sm text-gray-500 hover:underline">← Dashboard</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($grupos as $grupo)
        <a href="{{ route('calificaciones.show', $grupo) }}"
           class="bg-white rounded-xl border p-5 flex flex-col gap-2 hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <p class="font-bold">{{ $grupo->nombre }}</p>
                <span class="bg-purple-100 text-primary text-xs px-2 py-1 rounded-full">
                    {{ $grupo->horario->dias }}
                </span>
            </div>
            <p class="text-sm text-gray-500">{{ $grupo->horario->materia->nombre }}</p>
            <div class="text-xs text-gray-400 flex gap-4 mt-1">
                <span>🕐 {{ \Carbon\Carbon::parse($grupo->horario->hora_inicio)->format('h:i A') }} - {{ \Carbon\Carbon::parse($grupo->horario->hora_fin)->format('h:i A') }}</span>
            </div>
            <p class="text-xs text-primary font-medium mt-1">Ver alumnos y calificar →</p>
        </a>
        @empty
            <div class="col-span-2 text-center py-12 text-gray-400">
                <p>No tienes grupos asignados</p>
            </div>
        @endforelse
    </div>

</div>
</body>
</html>