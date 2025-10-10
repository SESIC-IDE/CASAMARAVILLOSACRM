@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
    <h1 class="text-2xl font-semibold mb-6 text-indigo-600 dark:text-indigo-400">
        Crear nuevo usuario
    </h1>

    {{-- Mensajes --}}
    @if (session('success'))
        <div class="mb-4 text-green-600 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORMULARIO --}}
    <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
        @csrf

        {{-- Nombre --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre completo</label>
            <input id="name" name="name" type="text" required
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 
                       dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500"
                value="{{ old('name') }}">
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Correo --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo electrónico</label>
            <input id="email" name="email" type="email" required
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 
                       dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500"
                value="{{ old('email') }}">
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Rol --}}
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rol</label>
            <select id="role" name="role" required
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 
                       dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">— Selecciona un rol —</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Vendedor</option>
            </select>
            @error('role') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Contraseña --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña</label>
            <input id="password" name="password" type="password" required
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 
                       dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Confirmar Contraseña --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmar contraseña</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 
                       dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        {{-- Botones --}}
        <div class="flex justify-end space-x-3">
            <a href="{{ route('dashboard') }}"
               class="px-5 py-2 rounded-lg bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-gray-600 transition">
               Cancelar
            </a>
            <button type="submit"
               class="px-5 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white shadow-lg transition">
               Crear usuario
            </button>
        </div>
    </form>
</div>
@endsection
