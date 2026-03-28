<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: { primary: "#6b2e50", accent: "#ec5b13" },
                fontFamily: { sans: ["Inter"], headline: ["Manrope"] }
            }}
        }
    </script>
</head>
<body class="bg-gray-50 font-sans flex min-h-screen">

@include('dashboard.partials.sidebar', ['role' => 'admin'])

<div class="flex-1 flex flex-col ml-64">
    @include('dashboard.partials.header')

    <main class="p-8 space-y-8">
        <div>
            <h2 class="font-headline text-3xl font-extrabold">Bienvenido, {{ Auth::user()->name }} 👋</h2>
            <p class="text-gray-400 text-sm mt-1">Panel de administración — Control Escolar</p>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-5">
            <div class="bg-white p-5 rounded-2xl border hover:-translate-y-1 transition-all shadow-sm">
                <div class="w-10 h-10 bg-purple-100 text-primary rounded-xl flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-lg">people</span>
                </div>
                <p class="text-3xl font-headline font-extrabold">{{ $alumnos }}</p>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold mt-1">Alumnos</p>
            </div>
            <div class="bg-white p-5 rounded-2xl border hover:-translate-y-1 transition-all shadow-sm">
                <div class="w-10 h-10 bg-orange-100 text-accent rounded-xl flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-lg">menu_book</span>
                </div>
                <p class="text-3xl font-headline font-extrabold">{{ $materias }}</p>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold mt-1">Materias</p>
            </div>
            <div class="bg-white p-5 rounded-2xl border hover:-translate-y-1 transition-all shadow-sm">
                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-lg">person</span>
                </div>
                <p class="text-3xl font-headline font-extrabold">{{ $docentes }}</p>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold mt-1">Docentes</p>
            </div>
            <div class="bg-white p-5 rounded-2xl border hover:-translate-y-1 transition-all shadow-sm">
                <div class="w-10 h-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-lg">schedule</span>
                </div>
                <p class="text-3xl font-headline font-extrabold">{{ $horarios }}</p>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold mt-1">Horarios</p>
            </div>
            <div class="bg-white p-5 rounded-2xl border hover:-translate-y-1 transition-all shadow-sm">
                <div class="w-10 h-10 bg-pink-100 text-pink-600 rounded-xl flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-lg">groups</span>
                </div>
                <p class="text-3xl font-headline font-extrabold">{{ $grupos }}</p>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold mt-1">Grupos</p>
            </div>
        </div>

        <!-- Acciones rápidas -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-primary text-white p-6 rounded-2xl shadow-sm lg:col-span-2 flex flex-col justify-between min-h-40">
                <div>
                    <p class="text-xs uppercase tracking-widest opacity-70 font-semibold mb-2">Acciones rápidas</p>
                    <h3 class="font-headline text-xl font-bold">Gestiona tu sistema</h3>
                </div>
                <div class="flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('materias.create') }}" class="bg-white/20 hover:bg-white/30 text-white text-sm px-4 py-2 rounded-xl transition">+ Materia</a>
                    <a href="{{ route('horarios.create') }}" class="bg-white/20 hover:bg-white/30 text-white text-sm px-4 py-2 rounded-xl transition">+ Horario</a>
                    <a href="{{ route('grupos.index') }}" class="bg-white/20 hover:bg-white/30 text-white text-sm px-4 py-2 rounded-xl transition">Ver Grupos</a>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl border shadow-sm space-y-3">
                <p class="text-xs uppercase tracking-widest text-gray-400 font-semibold">Links rápidos</p>
                <a href="{{ route('inscripciones.index') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition group">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">assignment</span>
                        <span class="text-sm font-medium">Inscripciones</span>
                    </div>
                    <span class="material-symbols-outlined text-gray-300 text-sm group-hover:text-primary transition">arrow_forward_ios</span>
                </a>
                <a href="{{ route('calificaciones.index') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition group">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">grade</span>
                        <span class="text-sm font-medium">Calificaciones</span>
                    </div>
                    <span class="material-symbols-outlined text-gray-300 text-sm group-hover:text-primary transition">arrow_forward_ios</span>
                </a>
                <a href="{{ route('tareas.index') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition group">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">task</span>
                        <span class="text-sm font-medium">Tareas</span>
                    </div>
                    <span class="material-symbols-outlined text-gray-300 text-sm group-hover:text-primary transition">arrow_forward_ios</span>
                </a>
            </div>
        </div>
    </main>
</div>
</body>
</html>