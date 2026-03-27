<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Tareas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { colors: { primary: "#6b2e50" }, fontFamily: { sans: ["Public Sans"] } } } }</script>
</head>
<body class="bg-gray-50 font-sans p-8">
<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Mis Tareas</h1>
            <p class="text-sm text-gray-400">Tareas pendientes y entregadas</p>
        </div>
        <a href="/dashboard" class="text-sm text-gray-500 hover:underline">← Dashboard</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 text-sm">{{ $errors->first() }}</div>
    @endif

    <div class="space-y-4">
        @forelse($tareas as $tarea)
        <div class="bg-white rounded-xl border p-5">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <p class="font-bold">{{ $tarea->titulo }}</p>
                    <p class="text-xs text-gray-400">{{ $tarea->grupo->horario->materia->nombre }} — {{ $tarea->grupo->nombre }}</p>
                </div>
                <span class="text-xs px-2 py-1 rounded-full {{ \Carbon\Carbon::parse($tarea->fecha_entrega)->isPast() ? 'bg-red-100 text-red-500' : 'bg-green-100 text-green-600' }}">
                    📅 {{ \Carbon\Carbon::parse($tarea->fecha_entrega)->format('d/m/Y') }}
                </span>
            </div>

            <p class="text-sm text-gray-600 mb-4">{{ $tarea->descripcion }}</p>

            @if($misEntregas->contains($tarea->id))
                <div class="bg-green-50 text-green-700 text-sm p-3 rounded-lg">
                    ✓ Tarea entregada
                </div>
            @elseif(\Carbon\Carbon::parse($tarea->fecha_entrega)->isPast())
                <div class="bg-red-50 text-red-500 text-sm p-3 rounded-lg">
                    ✗ Fecha de entrega vencida
                </div>
            @else
                <form method="POST" action="{{ route('entregas.store') }}" enctype="multipart/form-data" class="flex gap-3 items-center">
                    @csrf
                    <input type="hidden" name="tarea_id" value="{{ $tarea->id }}">
                    <input type="file" name="archivo" accept=".pdf"
                        class="text-sm border rounded-lg p-1 flex-1">
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg text-sm hover:opacity-90">
                        Entregar PDF
                    </button>
                </form>
            @endif
        </div>
        @empty
            <div class="text-center py-12 text-gray-400">Sin tareas asignadas</div>
        @endforelse
    </div>
</div>
</body>
</html>