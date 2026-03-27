<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Entregas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { colors: { primary: "#6b2e50" }, fontFamily: { sans: ["Public Sans"] } } } }</script>
</head>
<body class="bg-gray-50 font-sans p-8">
<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">{{ $tarea->titulo }}</h1>
            <p class="text-sm text-gray-400">
                {{ $tarea->grupo->nombre }} —
                Entrega: {{ \Carbon\Carbon::parse($tarea->fecha_entrega)->format('d/m/Y') }}
            </p>
        </div>
        <a href="{{ route('tareas.index') }}" class="text-sm text-gray-500 hover:underline">← Volver</a>
    </div>

    <div class="bg-white rounded-lg border p-4 mb-6 text-sm text-gray-600">
        <p class="font-medium mb-1">Descripción:</p>
        <p>{{ $tarea->descripcion }}</p>
    </div>

    <div class="bg-white rounded-xl border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-left">
                <tr>
                    <th class="p-4">Alumno</th>
                    <th class="p-4">Clave</th>
                    <th class="p-4">Entregado</th>
                    <th class="p-4">Archivo</th>
                </tr>
            </thead>
            <tbody>
                @forelse($entregas as $entrega)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-4">{{ $entrega->alumno->name }}</td>
                    <td class="p-4 text-gray-400">{{ $entrega->alumno->institutional_key }}</td>
                    <td class="p-4 text-xs text-gray-400">{{ $entrega->created_at->format('d/m/Y h:i A') }}</td>
                    <td class="p-4">
                        <a href="{{ asset('storage/' . $entrega->archivo) }}" target="_blank"
                            class="text-primary text-xs hover:underline flex items-center gap-1">
                            📄 Ver PDF
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="p-8 text-center text-gray-400">Sin entregas aún</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>