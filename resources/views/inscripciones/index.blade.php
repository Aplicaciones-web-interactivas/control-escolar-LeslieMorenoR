<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inscripciones</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { colors: { primary: "#6b2e50" }, fontFamily: { sans: ["Public Sans"] } } } }</script>
</head>
<body class="bg-gray-50 font-sans p-8">
<div class="max-w-5xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Grupos Disponibles</h1>
            <p class="text-sm text-gray-400">Inscríbete a los grupos que desees</p>
        </div>
        <a href="/dashboard" class="text-sm text-gray-500 hover:underline">← Dashboard</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 text-sm">{{ $errors->first() }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($grupos as $grupo)
        <div class="bg-white rounded-xl border p-5 flex flex-col gap-3">
            <div>
                <p class="font-bold text-base">{{ $grupo->nombre }}</p>
                <p class="text-sm text-gray-500">{{ $grupo->horario->materia->nombre }}</p>
            </div>
            <div class="text-sm text-gray-500 space-y-1">
                <p>👨‍🏫 {{ $grupo->horario->maestro->name }}</p>
                <p>🕐 {{ \Carbon\Carbon::parse($grupo->horario->hora_inicio)->format('h:i A') }} - {{ \Carbon\Carbon::parse($grupo->horario->hora_fin)->format('h:i A') }}</p>
                <p>📅 {{ $grupo->horario->dias }}</p>
            </div>

            @if($misInscripciones->contains($grupo->id))
                <div class="flex items-center justify-between">
                    <span class="text-green-600 text-sm font-medium">✓ Inscrito</span>
                    <form method="POST" action="{{ route('inscripciones.destroy', Illuminate\Support\Facades\Auth::user()->inscripciones->where('grupo_id', $grupo->id)->first()) }}">
                        @csrf @method('DELETE')
                        <button class="text-red-400 text-xs hover:underline">Cancelar inscripción</button>
                    </form>
                </div>
            @else
                <form method="POST" action="{{ route('inscripciones.store') }}">
                    @csrf
                    <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                    <button class="w-full bg-primary text-white py-2 rounded-lg text-sm hover:opacity-90 transition">
                        Inscribirme
                    </button>
                </form>
            @endif
        </div>
        @empty
            <p class="text-gray-400 col-span-2 text-center py-8">No hay grupos disponibles</p>
        @endforelse
    </div>
</div>
</body>
</html>