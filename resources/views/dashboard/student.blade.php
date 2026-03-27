<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Alumno</title>
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
<body class="bg-gray-50 font-sans min-h-screen">

<!-- Overlay móvil -->
<div id="overlay" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

<!-- SIDEBAR -->
<aside id="sidebar" class="fixed top-0 left-0 h-screen w-64 bg-white border-r flex flex-col z-50 -translate-x-full lg:translate-x-0 transition-transform duration-300">

    <div class="p-6 border-b flex items-center gap-3">
        <div class="bg-primary text-white p-2 rounded-xl">
            <span class="material-symbols-outlined">school</span>
        </div>
        <div>
            <p class="font-headline font-bold text-sm">Control Escolar</p>
            <p class="text-xs text-gray-400">Alumno</p>
        </div>
    </div>

    <nav class="flex-1 p-4 space-y-1 text-sm overflow-y-auto">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 p-2 rounded-xl bg-primary text-white font-medium">
            <span class="material-symbols-outlined text-lg">dashboard</span> Inicio
        </a>

        <p class="text-xs text-gray-400 uppercase mt-4 mb-1 px-2">Mis módulos</p>

        <a href="{{ route('inscripciones.index') }}" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 text-gray-600 transition">
            <span class="material-symbols-outlined text-lg">assignment</span> Inscripciones
        </a>
        <a href="{{ route('tareas.mias') }}" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 text-gray-600 transition">
            <span class="material-symbols-outlined text-lg">task</span> Mis tareas
        </a>
        <a href="{{ route('calificaciones.mias') }}" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 text-gray-600 transition">
            <span class="material-symbols-outlined text-lg">grade</span> Mis calificaciones
        </a>
    </nav>

    <div class="p-4 border-t">
        <div class="flex items-center gap-3 mb-3 px-2">
            <div class="bg-primary text-white w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold shrink-0">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-400">{{ Auth::user()->institutional_key }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full flex items-center gap-2 p-2 rounded-xl hover:bg-red-50 text-sm text-red-500 transition">
                <span class="material-symbols-outlined text-lg">logout</span> Cerrar sesión
            </button>
        </form>
    </div>
</aside>

<!-- CONTENIDO PRINCIPAL -->
<div class="lg:ml-64 flex flex-col min-h-screen">

    <!-- HEADER -->
    <header class="bg-white border-b px-6 py-4 flex justify-between items-center sticky top-0 z-30">
        <button class="lg:hidden p-2 rounded-xl hover:bg-gray-100 transition" onclick="toggleSidebar()">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <div class="hidden lg:block">
            <h1 class="font-headline font-bold text-lg">Panel del Alumno</h1>
            <p class="text-xs text-gray-400">{{ now()->locale('es')->isoFormat('dddd, D [de] MMMM YYYY') }}</p>
        </div>
        <div class="flex items-center gap-3 ml-auto">
            <button class="p-2 hover:bg-gray-100 rounded-full transition">
                <span class="material-symbols-outlined text-gray-600">notifications</span>
            </button>
            <div class="bg-primary text-white w-9 h-9 flex items-center justify-center rounded-full text-sm font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>
    </header>

    <!-- MAIN -->
    <main class="p-6 lg:p-8 space-y-8">

        <div>
            <h2 class="font-headline text-2xl lg:text-3xl font-extrabold">
                Hola, {{ Auth::user()->name }} 👋
            </h2>
            <p class="text-gray-400 text-sm mt-1">Bienvenido a tu panel de alumno</p>
        </div>

        <!-- Tarjetas de resumen -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div class="bg-white p-5 rounded-2xl border shadow-sm hover:-translate-y-1 transition-all">
                <div class="w-10 h-10 bg-purple-100 text-primary rounded-xl flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined">assignment</span>
                </div>
                <p class="text-3xl font-headline font-extrabold">{{ $inscripciones }}</p>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold mt-1">Materias inscritas</p>
            </div>

            <div class="bg-white p-5 rounded-2xl border shadow-sm hover:-translate-y-1 transition-all">
                <div class="w-10 h-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined">grade</span>
                </div>
                <p class="text-3xl font-headline font-extrabold">{{ $calificaciones }}</p>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold mt-1">Calificaciones</p>
            </div>

            <div class="bg-white p-5 rounded-2xl border shadow-sm hover:-translate-y-1 transition-all">
                <div class="w-10 h-10 bg-orange-100 text-accent rounded-xl flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined">task</span>
                </div>
                <p class="text-3xl font-headline font-extrabold">{{ $tareas }}</p>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold mt-1">Tareas asignadas</p>
            </div>
        </div>

        <!-- Acciones rápidas + Módulos -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Banner -->
            <div class="bg-primary text-white p-6 rounded-2xl shadow-sm flex flex-col justify-between min-h-40">
                <div>
                    <p class="text-xs uppercase tracking-widest opacity-70 font-semibold mb-2">Acciones rápidas</p>
                    <h3 class="font-headline text-xl font-bold">¿Qué quieres hacer hoy?</h3>
                </div>
                <div class="flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('inscripciones.index') }}"
                       class="bg-white/20 hover:bg-white/30 text-white text-sm px-4 py-2 rounded-xl transition">
                        Inscribirme a un grupo
                    </a>
                    <a href="{{ route('tareas.mias') }}"
                       class="bg-white/20 hover:bg-white/30 text-white text-sm px-4 py-2 rounded-xl transition">
                        Ver mis tareas
                    </a>
                </div>
            </div>

            <!-- Lista módulos -->
            <div class="bg-white p-6 rounded-2xl border shadow-sm space-y-2">
                <p class="text-xs uppercase tracking-widest text-gray-400 font-semibold mb-3">Ir a módulo</p>

                <a href="{{ route('inscripciones.index') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition group">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">assignment</span>
                        <span class="text-sm font-medium">Mis inscripciones</span>
                    </div>
                    <span class="material-symbols-outlined text-gray-300 text-sm group-hover:text-primary transition">arrow_forward_ios</span>
                </a>

                <a href="{{ route('tareas.mias') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition group">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">task</span>
                        <span class="text-sm font-medium">Mis tareas</span>
                    </div>
                    <span class="material-symbols-outlined text-gray-300 text-sm group-hover:text-primary transition">arrow_forward_ios</span>
                </a>

                <a href="{{ route('calificaciones.mias') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition group">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">grade</span>
                        <span class="text-sm font-medium">Mis calificaciones</span>
                    </div>
                    <span class="material-symbols-outlined text