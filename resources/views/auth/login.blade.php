<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- 🌟 FAVICON PERSONALIZADO --}}
    <link rel="icon" type="image/png" href="{{ asset('image/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/favicon.png') }}">
    <title>Casa Maravillosa CRM - Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Animación simple --}}
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="min-h-screen w-full flex items-center justify-center relative bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">

    {{-- FONDO COMPLETO --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('image/FONDO1.jpg') }}" 
             alt="Fondo Casa Maravillosa CRM"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/70 via-black/60 to-indigo-950/80 backdrop-blur-sm"></div>
    </div>

    {{-- FORMULARIO CON ESTILO PERSONALIZADO --}}
    <div class="relative z-10 w-full max-w-md px-8 py-10 
                bg-white/90 dark:bg-gray-900/85 
                border border-indigo-500/20 dark:border-indigo-400/30 
                rounded-2xl shadow-2xl backdrop-blur-md animate-[fadeInUp_0.8s_ease-out]">

        {{-- LOGO --}}
        <div class="mb-6 text-center">
            <img src="{{ asset('image/LOGO.jpg') }}" 
                 alt="Logo Casa Maravillosa CRM" 
                 class="mx-auto w-28 h-28 object-contain mb-3 drop-shadow-[0_0_12px_rgba(79,70,229,0.4)]">
            <h1 class="text-2xl font-extrabold text-indigo-600 dark:text-indigo-400">
                Casa Maravillosa CRM
            </h1>
            <p class="text-gray-600 dark:text-gray-300 text-sm mt-1">
                Bienvenido, inicia sesión en tu cuenta
            </p>
        </div>

        {{-- MENSAJE DE SESIÓN --}}
        <x-auth-session-status class="mb-4 text-center text-green-600 dark:text-green-400" :status="session('status')" />

        {{-- FORMULARIO DE LOGIN --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- CORREO --}}
            <div>
                <x-input-label for="email" :value="__('Correo electrónico')" />
                <x-text-input id="email" class="block mt-1 w-full
                    border-gray-300 dark:border-gray-700 rounded-lg
                    focus:border-indigo-500 focus:ring focus:ring-indigo-400/30 dark:focus:ring-indigo-500/40
                    dark:bg-gray-800 dark:text-gray-100 transition" 
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- CONTRASEÑA --}}
            <div>
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password" class="block mt-1 w-full
                    border-gray-300 dark:border-gray-700 rounded-lg
                    focus:border-indigo-500 focus:ring focus:ring-indigo-400/30 dark:focus:ring-indigo-500/40
                    dark:bg-gray-800 dark:text-gray-100 transition"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- RECORDAR Y OLVIDAR --}}
            <div class="flex items-center justify-between text-sm">
                <label for="remember_me" class="inline-flex items-center text-gray-600 dark:text-gray-300">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                           name="remember">
                    <span class="ml-2">Recordarme</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 hover:underline">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            {{-- BOTÓN LOGIN --}}
            <div class="pt-4">
                <button type="submit"
                        class="w-full justify-center py-3 text-lg font-semibold rounded-lg 
                               bg-indigo-600 hover:bg-indigo-700 text-white
                               shadow-lg hover:shadow-[0_0_15px_rgba(79,70,229,0.5)]
                               transition duration-300 ease-in-out">
                    INICIAR SESIÓN
                </button>
            </div>
        </form>

        {{-- ENLACE VOLVER --}}
            <div class="text-center mt-6">
                <a href="{{ url('/') }}"
                   class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                   ← Volver a la Pantalla Principal
                </a>
            </div>
    </div>
</body>
</html>
