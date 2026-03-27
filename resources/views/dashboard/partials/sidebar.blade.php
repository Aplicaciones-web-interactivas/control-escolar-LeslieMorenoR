<aside class="w-64 bg-white border-r flex flex-col fixed h-screen z-50">
    <div class="p-6 border-b flex items-center gap-3">
        <div class="bg-primary text-white p-2 rounded-xl">
            <span class="material-symbols-outlined">school</span>
        </div>
        <div>
            <p class="font-headline font-bold text-sm">Control Escolar</p>
            <p class="text-xs text-gray-400 capitalize">{{ Auth::user()->role }}</p>
        </div>
    </div>

    <nav class="flex-1 p-4 space-y-1 text-sm overflow-y-auto">

        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 p-2 rounded-xl bg-primary text-white font-medium">
            <span class="material-symbols-outlined text-lg">dashboard</span> Inicio
        </a>

        @if($role === 'admin')
            <p class="text-xs text-gray-400 uppercase mt-4 mb-1 px-2">Gestión</p>
            <a href="{{ route('materias.index') }}" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 text-gray-600">
                <span class="material-symbols-outlined text-lg">menu_book</span> Materias
            </a>
            <a href="{{ route('horarios.index') }}" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 text-gray-600">
                <span class="material-symbols-outlined text-lg">schedule</span> Horarios
            </a>
            <a href="{{ route('grupos.index') }}" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 text-gray-600">
                <span class="material-symbols-outlined text-lg">groups</span> Grupos
            </a>
            <a href="{{ route('inscripciones.index') }}" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 text-gray-600">
                <span class="material-symbols-outlined text-lg">assignment</span> Inscripciones
            </a>
            <a href="{{ route('calificaciones.index') }}" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 text-gray-600">
                <span class="material-symbols-outlined text-lg">grade</span> Calificaciones
            </a>
            <a href="{{ route('tareas.index') }}" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 text-gray-600">
                <span class="material-symbols-outlined text-lg">task</span> Tareas
            </a>
        @endif

        @if($role === 'teacher')
            <p class="text-xs text-gray-400 uppercase mt-4 mb-1 px-2">Mis módulos</p>
            <a href="{{ route('grupos.index') }}" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 text-gray-600">
                <span class="material-symbols-outlined text-lg">groups</span> Mis Grupos
            </a>
            <a href="{{ route('tareas.index') }}" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 text-gray-600">
                <span class="material-symbols-outlined text-lg">task</span> Tareas
            </a>
            <a href="{{ route('calificaciones.index') }}" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 text-gray-600">
                <span class="material-symbols-outlined text-lg">grade</span> Calificaciones
            </a>
        @endif

        @if($role === 'student')
            <p class="text-xs text-gray-400 uppercase mt-4 mb-1 px-2">Mis módulos</p>
            <a href="{{ route('inscripciones.index') }}" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 text-gray-600">
                <span class="material-symbols-outlined text-lg">assignment</span> Inscripciones
            </a>
            <a href="{{ route('tareas.mias') }}" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 text-gray-600">
                <span class="material-symbols-outlined text-lg">task</span> Mis Tareas
            </a>
            <a href="{{ route('calificaciones.mias') }}" class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 text-gray-600">
                <span class="material-symbols-outlined text-lg">grade</span> Mis Calificaciones
            </a>
        @endif

    </nav>

    <div class="p-4 border-t">
        <div class="flex items-center gap-3 mb-3 px-2">
            <div class="bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-400">{{ Auth::user()->institutional_key }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full flex items-center gap-2 p-2 rounded-xl hover:bg-red-50 text-sm text-red-500 transition">
                <span class="material-symbols-outlined text-lg">logout</span> Salir
            </button>
        </form>
    </div>
</aside>