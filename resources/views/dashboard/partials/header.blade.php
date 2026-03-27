<header class="bg-white border-b px-8 py-4 flex justify-between items-center sticky top-0 z-40">
    <div>
        <h1 class="font-headline font-bold text-lg">Panel</h1>
        <p class="text-xs text-gray-400">{{ now()->isoFormat('dddd, D [de] MMMM YYYY') }}</p>
    </div>
    <div class="flex items-center gap-3">
        <button class="p-2 hover:bg-gray-100 rounded-full transition relative">
            <span class="material-symbols-outlined text-gray-600">notifications</span>
        </button>
        <div class="bg-primary text-white w-9 h-9 flex items-center justify-center rounded-full text-sm font-bold">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    </div>
</header>