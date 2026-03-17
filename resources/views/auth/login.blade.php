<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - Control Escolar</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#6b2e50",
                        "primary-hover": "#4b2038",
                        "accent": "#ec5b13",
                        "background-light": "#f8f6f6",
                        "background-dark": "#221610",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: "Public Sans", sans-serif;
        }
        .bg-pattern {
            background-color: #f8f6f6;
            background-image: radial-gradient(#6b2e50 0.5px, transparent 0.5px), radial-gradient(#6b2e50 0.5px, #f8f6f6 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            opacity: 0.05;
        }
    </style>
</head>
<body class="bg-background-light font-display min-h-screen flex flex-col">

    <div class="fixed inset-0 bg-pattern pointer-events-none"></div>

    <div class="relative flex min-h-screen w-full flex-col items-center justify-center p-4">
        <div class="w-full max-w-[480px] flex flex-col gap-8">

            {{-- Logo y título --}}
            <div class="flex flex-col items-center gap-4 text-center">
                <div class="flex items-center justify-center size-16 rounded-xl bg-primary text-white shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined" style="font-size: 2.5rem;">school</span>
                </div>
                <div>
                    <h1 class="text-slate-900 text-3xl font-bold tracking-tight">Control Escolar</h1>
                    <p class="text-slate-600 mt-2">Gestiona tu trayectoria académica con facilidad</p>
                </div>
            </div>

            {{-- Tarjeta del formulario --}}
            <div class="bg-white border border-slate-200 rounded-xl shadow-xl p-8 flex flex-col gap-6">

                <div class="flex flex-col gap-2">
                    <h2 class="text-xl font-semibold text-slate-900">Bienvenido</h2>
                    <p class="text-sm text-slate-500">Ingresa tus credenciales para acceder a tu cuenta</p>
                </div>

                {{-- Mensaje de error --}}
                @if ($errors->any())
                    <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg px-4 py-3">
                        <span class="material-symbols-outlined text-red-500 mt-0.5" style="font-size: 1.1rem;">error</span>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="POST" action="/login" class="flex flex-col gap-5">
                    @csrf

                    {{-- Clave Institucional --}}
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-medium text-slate-700" for="user_key">Clave Institucional</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" style="font-size: 1.25rem;"></span>
                            <input
                                id="user_key"
                                class="w-full pl-11 pr-4 h-12 rounded-lg border border-slate-200 bg-slate-50 text-slate-900 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                                type="text"
                                name="user_key"
                                value="{{ old('user_key') }}"
                                placeholder="Ingresa tu clave institucional"
                                required
                                autocomplete="username"
                            />
                        </div>
                    </div>

                    {{-- Contraseña --}}
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between items-center">
                            <label class="text-sm font-medium text-slate-700" for="pass">Contraseña</label>
                            <a class="text-xs font-semibold text-primary hover:text-primary-hover" href="#">¿Olvidaste tu contraseña?</a>
                        </div>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" style="font-size: 1.25rem;"></span>
                            <input
                                id="pass"
                                class="w-full pl-11 pr-11 h-12 rounded-lg border border-slate-200 bg-slate-50 text-slate-900 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                                type="password"
                                name="pass"
                                placeholder="Ingresa tu contraseña"
                                required
                                autocomplete="current-password"
                            />
                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600"
                            >
                                <span id="toggle-icon" class="material-symbols-outlined" style="font-size: 1.25rem;"></span>
                            </button>
                        </div>
                    </div>

                    {{-- Recordarme --}}
                    <div class="flex items-center gap-2">
                        <input
                            class="w-4 h-4 rounded border-slate-300 text-primary focus:ring-primary"
                            id="remember"
                            type="checkbox"
                            name="remember"
                        />
                        <label class="text-sm text-slate-600" for="remember">Recordarme por 30 días</label>
                    </div>

                    {{-- Botón de envío --}}
                    <button
                        type="submit"
                        class="w-full bg-primary hover:bg-primary-hover text-white font-bold h-12 rounded-lg transition-colors flex items-center justify-center gap-2 shadow-lg shadow-primary/20"
                    >
                        <span>Entrar</span>
                        <span class="material-symbols-outlined" style="font-size: 1.1rem;">login</span>
                    </button>

                </form>

                {{-- Divisor --}}
                <div class="relative flex items-center py-2">
                    <div class="flex-grow border-t border-slate-200"></div>
                    <span class="flex-shrink mx-4 text-slate-400 text-xs uppercase tracking-widest font-medium">O continúa con</span>
                    <div class="flex-grow border-t border-slate-200"></div>
                </div>

                {{-- SSO Botones --}}
                <div class="grid grid-cols-2 gap-4">
                    <button class="flex items-center justify-center gap-2 h-11 px-4 rounded-lg border border-slate-200 hover:bg-slate-50 text-slate-700 text-sm font-semibold transition-colors">
                        <img class="size-5" src="https://lh3.googleusercontent.com/aida-public/AB6AXuABd3uPmvxc1rnkVGtjt8ev09TpB5X5EOmcUE7kIvvrHgvg6cpiMFZJn4-3NRi_8GEnN6dlpUrHO3x_sW8_2xNTZU3u4x4nM46bDAoUGBygB7a5G16Pw8-w_plXmszpe-8oxRZ2pvIeN6KnwpGatUflrkxbeVOkiVXy_S2v-67qsPaL062tgBQU23vzUQB3PN7ojcZHCvqsIfvGrIvGSBafFpF_956sRgrFIkxFfayMClXyhwFnWsrOTIhPgmvnr3HXOKmDiNYEra8" alt="Google"/>
                        Google
                    </button>
                    <button class="flex items-center justify-center gap-2 h-11 px-4 rounded-lg border border-slate-200 hover:bg-slate-50 text-slate-700 text-sm font-semibold transition-colors">
                        <span class="material-symbols-outlined" style="font-size: 1.25rem; color: #0078d4;">smb_share</span>
                        Microsoft
                    </button>
                </div>

            </div>

            {{-- Footer --}}
            <footer class="flex flex-col items-center gap-4">
                <p class="text-slate-500 text-sm">
                    ¿Eres nuevo? <a class="text-primary font-semibold hover:underline" href="#">Contacta a administración</a>
                </p>
                <div class="flex gap-6 text-xs text-slate-400">
                    <a class="hover:text-slate-600 transition-colors" href="#">Aviso de Privacidad</a>
                    <a class="hover:text-slate-600 transition-colors" href="#">Términos de Uso</a>
                    <a class="hover:text-slate-600 transition-colors" href="#">Centro de Ayuda</a>
                </div>
            </footer>

        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('pass');
            const icon = document.getElementById('toggle-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }
    </script>

</body>
</html>