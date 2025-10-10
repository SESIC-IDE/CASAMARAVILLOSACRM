<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Casa Maravillosa CRM') }}</title>

    {{-- 🌟 FAVICON PERSONALIZADO --}}
    <link rel="icon" type="image/png" href="{{ asset('image/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/favicon.png') }}">

    {{-- 🌗 Aplicar modo oscuro antes del CSS --}}
    <script>
      (function () {
        const t = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (t === 'dark' || (!t && prefersDark)) {
          document.documentElement.classList.add('dark');
        } else {
          document.documentElement.classList.remove('dark');
        }
      })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine.js para dropdowns y efectos --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased min-h-screen flex flex-col">

    {{-- 🔹 NAVBAR GLOBAL --}}
    <nav class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-700 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

            {{-- LOGO / TÍTULO --}}
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-lg font-bold text-indigo-600 dark:text-indigo-400">
                <img src="{{ asset('image/LOGO.jpg') }}" 
                    alt="Logo Casa Maravillosa CRM" 
                    class="w-8 h-8 object-contain rounded-md shadow-sm">
                <span>Casa Maravillosa CRM</span>
            </a>

            {{-- MENÚ DE NAVEGACIÓN --}}
            <div class="flex items-center space-x-5">
                @auth
                    {{-- LINKS PRINCIPALES --}}
                    <a href="{{ route('dashboard') }}" class="hover:text-indigo-500 dark:hover:text-indigo-300">Dashboard</a>
                    <a href="{{ route('customers.index') }}" class="hover:text-indigo-500 dark:hover:text-indigo-300">Clientes</a>
                    <a href="{{ route('interactions.index') }}" class="hover:text-indigo-500 dark:hover:text-indigo-300">Interacciones</a>
                    <a href="{{ route('reminders.index') }}" class="hover:text-indigo-500 dark:hover:text-indigo-300">Recordatorios</a>

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('reports.customers') }}" class="hover:text-indigo-500 dark:hover:text-indigo-300">Reportes</a>
                    @endif

                    {{-- 🌗 BOTÓN MODO CLARO / OSCURO --}}
                    <button id="theme-toggle" type="button"
                            class="flex items-center gap-2 px-3 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-medium text-sm hover:scale-105 hover:shadow transition-all duration-300"
                            aria-label="Cambiar tema">
                        <span id="theme-icon" class="text-lg">🌙</span>
                        <span id="theme-label" class="hidden sm:inline">Oscuro</span>
                    </button>

                    {{-- PERFIL DE USUARIO CON DROPDOWN --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-2 focus:outline-none px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                {{ auth()->user()->name }}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- MENÚ DESPLEGABLE --}}
                        <div x-show="open" @click.outside="open = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-50">
                            <div class="py-2">
                                {{-- PERFIL --}}
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Perfil
                                </a>

                                {{-- SOLO ADMIN --}}
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('users.index') }}"
                                        class="block px-4 py-2 text-sm text-indigo-600 dark:text-indigo-400 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium">
                                        Usuarios
                                    </a>
                                @endif

                                {{-- SEPARADOR --}}
                                <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>

                                {{-- CERRAR SESIÓN --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- NO AUTENTICADO --}}
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Iniciar sesión
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition">
                            Registrarse
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    {{-- 📄 CONTENIDO PRINCIPAL --}}
    <main class="flex-1 container mx-auto px-4 py-6">
        @yield('content')
    </main>

    {{-- ⚙️ FOOTER --}}
    <footer class="bg-white dark:bg-gray-800 shadow-inner mt-auto">
        <div class="max-w-7xl mx-auto py-4 text-center text-gray-500 dark:text-gray-400">
            © {{ date('Y') }} Casa Maravillosa CRM — Todos los derechos reservados.
        </div>
    </footer>

    {{-- 🌗 SCRIPT GLOBAL DE TEMA --}}
    <script>
      (function () {
        const btn = document.getElementById('theme-toggle');
        const icon = document.getElementById('theme-icon');
        const label = document.getElementById('theme-label');

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
