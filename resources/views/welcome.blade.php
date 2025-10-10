<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Casa Maravillosa CRM</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 antialiased flex flex-col min-h-screen">

    {{-- IMAGEN DE FONDO --}}
    <div class="absolute inset-0 -z-10">
        <img src="{{ asset('image/FONDO.jpg') }}" 
             alt="Fondo Casa Maravillosa CRM"
             class="w-full h-full object-cover opacity-20 dark:opacity-30">
    </div>

    {{-- NAVBAR SUPERIOR --}}
    <nav class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-wide text-indigo-600 dark:text-indigo-400">
                Casa Maravillosa CRM
            </h1>
            <div class="flex items-center space-x-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition">
                        Ir al Panel
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition">
                            Cerrar sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition">
                        Iniciar sesión
                    </a>
                    
                @endauth

                {{-- Botón modo oscuro --}}
                <button id="theme-toggle" onclick="toggleTheme()" class="p-2 rounded-lg bg-gray-200 dark:bg-gray-700">
                    <span id="theme-icon">🌙</span>
                </button>
            </div>
        </div>
    </nav>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="flex-1 flex flex-col items-center justify-center text-center px-6 py-16">

        {{-- Logo / Icono --}}
<div class="mb-6 flex justify-center">
    <img src="{{ asset('image/LOGO.jpg') }}"
         alt="Logo Casa Maravillosa CRM"
         class="w-24 h-24 md:w-32 md:h-32 object-contain rounded-lg shadow-lg dark:shadow-indigo-500/30 transition-transform duration-300 hover:scale-105">
</div>

<h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold mb-4 text-indigo-700 dark:text-indigo-300 text-center">
    Bienvenido a <span class="text-indigo-600 dark:text-indigo-400">Casa Maravillosa CRM</span>
</h2>

<p class="max-w-5xl mx-auto text-base sm:text-lg md:text-xl lg:text-2xl font-medium text-gray-800 dark:text-gray-100 mb-10 leading-relaxed text-center">
    Gestiona de manera eficiente tus clientes, interacciones y recordatorios 
    <br>en un entorno moderno, intuitivo y seguro.
    <br> Diseñado para optimizar tus procesos comerciales y mejorar la experiencia de tus usuarios.
</p>

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

    {{-- FOOTER --}}
    <footer class="bg-white dark:bg-gray-800 shadow-inner py-4 text-center text-sm text-gray-500 dark:text-gray-400">
        © {{ date('Y') }} Casa Maravillosa CRM — Todos los derechos reservados.
    </footer>

    {{-- SCRIPT MODO OSCURO --}}
    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const icon = document.getElementById('theme-icon');
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.theme = 'light';
                icon.textContent = '🌙';
            } else {
                html.classList.add('dark');
                localStorage.theme = 'dark';
                icon.textContent = '☀️';
            }
        }
        if (localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            document.getElementById('theme-icon').textContent = '☀️';
        }
    </script>

</body>
</html>
