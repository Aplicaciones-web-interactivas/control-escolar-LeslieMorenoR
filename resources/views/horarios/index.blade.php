<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: "#6b2e50" } } } }</script>
</head>
<body class="bg-gray-50 p-8">

    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Horarios</h1>
            <div class="flex gap-3">
                <a href="/dashboard" class="text-sm text-gray-500 hover:underline">← Dashboard</a>
                <a href="{{ route('horarios.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm">
                    + Nuevo Horario
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
                        <th class="text-left p-4">Materia</th>
                        <th class="text-left p-4">Maestro</th>
                        <th class="text-left p-4">Horario</th>
                        <th class="text-left p-4">Días</th>
                        <th class="p-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($horarios as $horario)
                    <tr class="border-t">
                        <td class="p-4">{{ $horario->materia->nombre }}</td>
                        <td class="p-4">{{ $horario->maestro->name }}</td>
                        <td class="p-4">{{ $horario->hora_inicio }} - {{ $horario->hora_fin }}</td>
                        <td class="p-4">{{ $horario->dias }}</td>
                        <td class="p-4 text-right">
                            <form method="POST" action="{{ route('horarios.destroy', $horario) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 text-xs hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="p-4 text-center text-gray-400">Sin horarios registrados</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>