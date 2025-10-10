<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- 🌟 FAVICON PERSONALIZADO --}}
    <link rel="icon" type="image/png" href="{{ asset('image/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/favicon.png') }}">
    <title>Casa Maravillosa CRM</title>

    {{-- Cargar estilos --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 antialiased flex flex-col min-h-screen">

    {{-- 🖼️ IMAGEN DE FONDO --}}
    <div class="absolute inset-0 -z-10">
        <img src="{{ asset('image/FONDO.jpg') }}" 
             alt="Fondo Casa Maravillosa CRM"
             class="w-full h-full object-cover opacity-20 dark:opacity-30">
    </div>

    {{-- 🔹 NAVBAR SUPERIOR --}}
    <nav class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-wide text-indigo-600 dark:text-indigo-400 flex items-center gap-2">
                <img src="{{ asset('image/LOGO.jpg') }}" alt="Logo" class="w-8 h-8 rounded-md shadow-sm">
                Casa Maravillosa CRM
            </h1>

            <div class="flex items-center space-x-3">
                @auth
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition">
                       Ir al Panel
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition">
                            Cerrar sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" 
                       class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition">
                       Iniciar sesión
                    </a>
                @endauth

                {{-- 🌗 BOTÓN MODO CLARO / OSCURO --}}
                <button id="theme-toggle" type="button"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 
                               text-gray-800 dark:text-gray-200 font-medium text-sm 
                               hover:scale-105 hover:shadow transition-all duration-300"
                        aria-label="Cambiar tema">
                    <span id="theme-icon" class="text-lg">🌙</span>
                    <span id="theme-label" class="hidden sm:inline">Modo Oscuro</span>
                </button>
            </div>
        </div>
    </nav>

    {{-- 🌟 CONTENIDO PRINCIPAL --}}
    <main class="flex-1 flex flex-col items-center justify-center text-center px-6 py-16">

        {{-- Sección de Bienvenida --}}
        <section class="text-center my-10">
            {{-- LOGO con halo animado pulsante --}}
            <div class="relative flex justify-center mb-8">
                <div class="absolute inset-0 w-32 h-32 md:w-40 md:h-40 rounded-full 
                            bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500
                            blur-2xl opacity-40 animate-pulse"></div>

                <img src="{{ asset('image/LOGO.jpg') }}"
                    alt="Logo Casa Maravillosa CRM"
                    class="relative w-28 h-28 md:w-36 md:h-36 object-contain rounded-2xl border-4 border-white/20 dark:border-gray-700 
                        shadow-2xl dark:shadow-indigo-500/40 transition-transform duration-500 hover:scale-110 hover:rotate-2">
            </div>

            {{-- TÍTULO PRINCIPAL --}}
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold mb-4 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 
                    bg-clip-text text-transparent drop-shadow-sm tracking-tight">
                Bienvenido a <span class="text-indigo-700 dark:text-indigo-400">Casa Maravillosa CRM</span>
            </h2>

            {{-- SUBTEXTO --}}
            <p class="max-w-4xl mx-auto text-base sm:text-lg md:text-xl text-gray-700 dark:text-gray-200 mb-10 leading-relaxed">
                <span class="block mb-1">💼 Gestiona tus clientes, interacciones y recordatorios</span>
                <span class="block">en un entorno <strong class="text-indigo-600 dark:text-indigo-400">moderno</strong>, <strong>intuitivo</strong> y <strong>seguro</strong>.</span>
                <span class="block mt-2 text-sm md:text-base text-gray-500 dark:text-gray-400 italic">
                    “Optimiza tus procesos comerciales y mejora la experiencia de tus usuarios.”
                </span>
            </p>

            {{-- Línea decorativa --}}
            <div class="flex justify-center">
                <div class="h-1 w-32 md:w-48 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-full animate-pulse"></div>
            </div>
        </section>

        {{-- Botones principales --}}
        <div class="flex flex-wrap justify-center gap-4">
            @auth
                <a href="{{ route('dashboard') }}"
                   class="px-6 py-3 bg-indigo-600 text-white rounded-xl shadow hover:shadow-lg hover:bg-indigo-700 transition transform hover:-translate-y-1">
                   Ir al Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="px-6 py-3 bg-indigo-600 text-white rounded-xl shadow hover:shadow-lg hover:bg-indigo-700 transition transform hover:-translate-y-1">
                   Iniciar sesión
                </a>
            @endauth
        </div>
    </main>

    {{-- ⚙️ FOOTER --}}
    <footer class="bg-white dark:bg-gray-800 shadow-inner py-4 text-center text-sm text-gray-500 dark:text-gray-400">
        © {{ date('Y') }} Casa Maravillosa CRM — Todos los derechos reservados.
    </footer>

    {{-- 🌗 SCRIPT MODO CLARO / OSCURO (PERSISTENTE) --}}
<script>
    (function () {
        const btn = document.getElementById('theme-toggle');
        const icon = document.getElementById('theme-icon');
        const label = document.getElementById('theme-label');

        // 🔹 Aplicar el tema guardado (sin cambiar automáticamente)
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        function syncTheme() {
            const isDark = document.documentElement.classList.contains('dark');
            icon.textContent = isDark ? '☀️' : '🌙';
            label.textContent = isDark ? 'Claro' : 'Oscuro';
        }

        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            syncTheme();
        }

        syncTheme();
        btn?.addEventListener('click', toggleTheme);
    })();
</script>

</body>
</html>
