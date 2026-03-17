<!DOCTYPE html>
<html lang="es" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Control Escolar</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: "#6b2e50", accent: "#ec5b13", bg: "#f8f6f6" },
                    fontFamily: { sans: ["Public Sans"] }
                }
            }
        }
    </script>
    <style>
        .sidebar-link.active { background: #6b2e50; color: white; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 12px 25px rgba(0,0,0,.08); }
    </style>
</head>

<body class="bg-bg font-sans flex min-h-screen">

<!-- SIDEBAR -->
<aside class="w-64 bg-white border-r flex flex-col">

    <div class="p-6 border-b flex items-center gap-3">
        <div class="bg-primary text-white p-2 rounded-lg">
            <span class="material-symbols-outlined">school</span>
        </div>
        <div>
            <p class="font-bold text-sm">Control Escolar</p>
            <p class="text-xs text-gray-400">{{ Auth::user()->role }}</p>
        </div>
    </div>

    <nav class="flex-1 p-4 space-y-1 text-sm">

        <p class="text-xs text-gray-400 uppercase mb-2">Principal</p>

        <a href="/dashboard" class="sidebar-link active flex items-center gap-2 p-2 rounded">
            <span class="material-symbols-outlined">dashboard</span>
            Inicio
        </a>

        <a href="#" class="sidebar-link flex items-center gap-2 p-2 rounded hover:bg-gray-100">
            <span class="material-symbols-outlined">people</span>
            Usuarios
        </a>

        <a href="{{ route('materias.index') }}"" class="sidebar-link flex items-center gap-2 p-2 rounded hover:bg-gray-100">
            <span class="material-symbols-outlined">menu_book</span>
            Materias
        </a>

        <a href="#" class="sidebar-link flex items-center gap-2 p-2 rounded hover:bg-gray-100">
            <span class="material-symbols-outlined">schedule</span>
            Horarios
        </a>

        <a href="{{ route('horarios.index') }}" class="sidebar-link flex items-center gap-2 p-2 rounded hover:bg-gray-100">
            <span class="material-symbols-outlined">groups</span>
            Grupos
        </a>

    </nav>

    <div class="p-4 border-t">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full flex items-center gap-2 p-2 rounded hover:bg-red-50 text-sm text-red-500">
                <span class="material-symbols-outlined">logout</span>
                Salir
            </button>
        </form>
    </div>

</aside>

<!-- CONTENIDO -->
<div class="flex-1 flex flex-col">

    <!-- HEADER -->
    <header class="bg-white border-b p-6 flex justify-between items-center">
        <div>
            <h1 class="font-bold text-lg">Panel</h1>
            <p class="text-xs text-gray-400">Resumen general</p>
        </div>
        <div class="flex items-center gap-4">
            <span class="material-symbols-outlined">notifications</span>
            <div class="bg-primary text-white w-8 h-8 flex items-center justify-center rounded-full text-sm">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>
    </header>

    <!-- MAIN -->
    <main class="p-8 space-y-8">

        <h2 class="text-xl font-bold">
            Bienvenido, {{ Auth::user()->name }} 
        </h2>

        <!-- CARDS -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

            <div class="bg-white p-5 rounded-xl border card-hover transition-all">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-primary">people</span>
                    <p class="text-gray-400 text-sm">Alumnos</p>
                </div>
                <p class="text-2xl font-bold">{{ $alumnos }}</p>
            </div>

            <div class="bg-white p-5 rounded-xl border card-hover transition-all">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-primary">menu_book</span>
                    <p class="text-gray-400 text-sm">Materias</p>
                </div>
                <p class="text-2xl font-bold">{{ $materias }}</p>
            </div>

            <div class="bg-white p-5 rounded-xl border card-hover transition-all">
                <div class="flex items-center gap-2 mb-2">
                    
                    <p class="text-gray-400 text-sm">Docentes</p>
                </div>
                <p class="text-2xl font-bold">{{ $docentes }}</p>
            </div>

            <div class="bg-white p-5 rounded-xl border card-hover transition-all">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-primary">schedule</span>
                    <p class="text-gray-400 text-sm">Horarios</p>
                </div>
                <p class="text-2xl font-bold">{{ $horarios }}</p>
            </div>

            <div class="bg-white p-5 rounded-xl border card-hover transition-all">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-primary">groups</span>
                    <p class="text-gray-400 text-sm">Grupos</p>
                </div>
                <p class="text-2xl font-bold">{{ $grupos }}</p>
            </div>

        </div>

    </main>

</div>

</body>
</html>