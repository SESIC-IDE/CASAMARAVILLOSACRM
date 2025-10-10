@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-indigo-600 dark:text-indigo-400">
            Gestión de Usuarios
        </h1>

        <a href="{{ route('users.create') }}"
           class="px-5 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white shadow transition">
           + Nuevo Usuario
        </a>
    </div>

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="mb-4 text-green-600 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    {{-- Buscador --}}
    <div x-data="{
        search: '{{ request('search') }}',
        results: '',
        timeout: null,
        fetchUsers() {
            clearTimeout(this.timeout);
            this.timeout = setTimeout(() => {
                fetch('{{ route('users.index') }}?search=' + this.search)
                    .then(res => res.text())
                    .then(html => {
                        // Extrae solo el cuerpo de la tabla
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const tbody = doc.querySelector('tbody');
                        document.querySelector('tbody').innerHTML = tbody.innerHTML;
                    });
            }, 300); // Espera 300ms entre cada tecla
        }
    }"
    class="mb-6 flex justify-end items-center space-x-2"
>
    <input type="text"
           x-model="search"
           @input="fetchUsers"
           placeholder="Buscar usuario..."
           class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100
                  focus:ring-indigo-500 focus:border-indigo-500 w-64 px-3 py-2"
    >
    <button type="button"
            @click="search = ''; fetchUsers()"
            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
        Limpiar
    </button>
</div>

    {{-- Tabla de usuarios --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">#</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Correo</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Rol</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Estado</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-300">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $user->id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($user->role === 'admin') bg-red-100 text-red-600 dark:bg-red-800 dark:text-red-300
                                @elseif($user->role === 'manager') bg-yellow-100 text-yellow-600 dark:bg-yellow-800 dark:text-yellow-300
                                @else bg-green-100 text-green-600 dark:bg-green-800 dark:text-green-300 @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        {{-- ESTADO (SWITCH DESLIZANTE) --}}
                        <td class="px-6 py-4 text-center text-sm">
                            <div x-data="{ active: {{ $user->status ? 'true' : 'false' }} }" class="relative inline-flex items-center">
                                <button
                                    @click="
                                        active = !active;
                                        fetch('{{ route('users.toggle-status', $user->id) }}', {
                                            method: 'PUT',
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Accept': 'application/json',
                                                'Content-Type': 'application/json',
                                            },
                                            body: JSON.stringify({ status: active }),
                                        }).then(res => res.json()).then(data => {
                                            if (data.success) {
                                                $dispatch('notify', { text: data.message });
                                            }
                                        });
                                    "
                                    type="button"
                                    class="w-14 h-7 flex items-center rounded-full transition-colors duration-300"
                                    :class="active ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'"
                                >
                                    <span
                                        class="h-6 w-6 bg-white rounded-full shadow transform transition-transform duration-300"
                                        :class="active ? 'translate-x-7' : 'translate-x-1'"
                                    ></span>
                                </button>
                            </div>
                        </td>

                        {{-- ACCIONES --}}
                        <td class="px-6 py-4 text-center text-sm">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-xs">
                                   Editar
                                </a>
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md text-xs">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500 dark:text-gray-400">
                            No se encontraron usuarios.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>

{{-- TOAST DE NOTIFICACIÓN --}}
<div
    x-data="{ show: false, text: '' }"
    @notify.window="
        text = $event.detail.text;
        show = true;
        setTimeout(() => show = false, 2500);
    "
    x-show="show"
    x-transition
    class="fixed bottom-6 right-6 bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-lg text-sm"
>
    <span x-text="text"></span>
</div>
@endsection
