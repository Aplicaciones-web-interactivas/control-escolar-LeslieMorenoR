<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Calificaciones</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { colors: { primary: "#6b2e50" }, fontFamily: { sans: ["Public Sans"] } } } }</script>
</head>
<body class="bg-gray-50 font-sans p-8">
<div class="max-w-3xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Mis Calificaciones</h1>
            <p class="text-sm text-gray-400">{{ Auth::user()->name }}</p>
        </div>
        <a href="/dashboard" class="text-sm text-gray-500 hover:underline">← Dashboard</a>
    </div>

    <div class="bg-white rounded-xl border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-left">
                <tr>
                    <th class="p-4">Materia</th>
                    <th class="p-4">Grupo</th>
                    <th class="p-4 text-center">Calificación</th>
                </tr>
            </thead>
            <tbody>
                @forelse($calificaciones as $cal)
                <tr class="border-t">
                    <td class="p-4">{{ $cal->grupo->horario->materia->nombre }}</td>
                    <td class="p-4 text-gray-400">{{ $cal->grupo->nombre }}</td>
                    <td class="p-4 text-center">
                        <span class="px-3 py-1 rounded-full text-sm font-bold
                            {{ $cal->calificacion >= 6 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                            {{ number_format($cal->calificacion, 1) }}
                        </span>
                    </td>
                </tr>
                @empty
                    <tr><td colspan="3" class="p-8 text-center text-gray-400">Sin calificaciones registradas</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>