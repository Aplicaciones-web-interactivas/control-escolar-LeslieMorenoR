<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Materias</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { colors: { primary: "#6b2e50" } } } }</script>
</head>
<body class="bg-gray-50 p-8">

    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Materias</h1>
            <div class="flex gap-3">
                <a href="/dashboard" class="text-sm text-gray-500 hover:underline">← Dashboard</a>
                <a href="{{ route('materias.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm">
                    + Nueva Materia
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-xl border overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500">
                    <tr>
                        <th class="text-left p-4">Nombre</th>
                        <th class="text-left p-4">Clave</th>
                        <th class="p-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($materias as $materia)
                    <tr class="border-t">
                        <td class="p-4">{{ $materia->nombre }}</td>
                        <td class="p-4">{{ $materia->clave }}</td>
                        <td class="p-4 text-right">
                            <form method="POST" action="{{ route('materias.destroy', $materia) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 text-xs hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="p-4 text-center text-gray-400">Sin materias registradas</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>