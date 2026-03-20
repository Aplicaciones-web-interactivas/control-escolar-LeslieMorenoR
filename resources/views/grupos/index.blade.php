<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Grupos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { colors: { primary: "#6b2e50" }, fontFamily: { sans: ["Public Sans"] } } } }</script>
</head>
<body class="bg-gray-50 font-sans p-8">

    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold">Grupos</h1>
                <p class="text-sm text-gray-400">Listado de grupos registrados</p>
            </div>
            <div class="flex gap-3">
                <a href="/dashboard" class="text-sm text-gray-500 hover:underline flex items-center gap-1">
                    ← Dashboard
                </a>
                <a href="{{ route('grupos.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm flex items-center gap-1">
                    + Nuevo Grupo
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl border overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-left">
                    <tr>
                        <th class="p-4">Grupo</th>
                        <th class="p-4">Materia</th>
                        <th class="p-4">Maestro</th>
                        <th class="p-4">Horario</th>
                        <th class="p-4">Días</th>
                        <th class="p-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($grupos as $grupo)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-4 font-medium">{{ $grupo->nombre }}</td>
                        <td class="p-4">{{ $grupo->horario->materia->nombre }}</td>
                        <td class="p-4">{{ $grupo->horario->maestro->name }}</td>
                        <td class="p-4">
                            {{ \Carbon\Carbon::parse($grupo->horario->hora_inicio)->format('h:i A') }}
                            -
                            {{ \Carbon\Carbon::parse($grupo->horario->hora_fin)->format('h:i A') }}
                        </td>
                        <td class="p-4">
                            <span class="bg-purple-100 text-primary text-xs px-2 py-1 rounded-full">
                                {{ $grupo->horario->dias }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <form method="POST" action="{{ route('grupos.destroy', $grupo) }}" onsubmit="return confirm('¿Eliminar este grupo?')">
                                @csrf @method('DELETE')
                                <button class="text-red-400 text-xs hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-400">
                            Sin grupos registrados
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>