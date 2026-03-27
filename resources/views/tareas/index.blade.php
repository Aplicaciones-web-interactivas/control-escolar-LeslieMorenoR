<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tareas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { colors: { primary: "#6b2e50" }, fontFamily: { sans: ["Public Sans"] } } } }</script>
</head>
<body class="bg-gray-50 font-sans p-8">
<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Tareas</h1>
            <p class="text-sm text-gray-400">Tareas asignadas a tus grupos</p>
        </div>
        <div class="flex gap-3">
            <a href="/dashboard" class="text-sm text-gray-500 hover:underline">← Dashboard</a>
            <a href="{{ route('tareas.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm">
                + Nueva Tarea
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-left">
                <tr>
                    <th class="p-4">Título</th>
                    <th class="p-4">Grupo</th>
                    <th class="p-4">Materia</th>
                    <th class="p-4">Entrega</th>
                    <th class="p-4">Entregas</th>
                    <th class="p-4"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($tareas as $tarea)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-4 font-medium">{{ $tarea->titulo }}</td>
                    <td class="p-4">{{ $tarea->grupo->nombre }}</td>
                    <td class="p-4 text-gray-400">{{ $tarea->grupo->horario->materia->nombre }}</td>
                    <td class="p-4">
                        <span class="{{ \Carbon\Carbon::parse($tarea->fecha_entrega)->isPast() ? 'text-red-500' : 'text-green-600' }} text-xs">
                            {{ \Carbon\Carbon::parse($tarea->fecha_entrega)->format('d/m/Y') }}
                        </span>
                    </td>
                    <td class="p-4">
                        <a href="{{ route('tareas.show', $tarea) }}" class="text-primary text-xs hover:underline">
                            Ver entregas ({{ $tarea->entregas->count() }})
                        </a>
                    </td>
                    <td class="p-4 text-right">
                        <form method="POST" action="{{ route('tareas.destroy', $tarea) }}" onsubmit="return confirm('¿Eliminar tarea?')">
                            @csrf @method('DELETE')
                            <button class="text-red-400 text-xs hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="p-8 text-center text-gray-400">Sin tareas creadas</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>