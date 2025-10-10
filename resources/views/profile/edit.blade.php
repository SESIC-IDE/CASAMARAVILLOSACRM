@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
    <h1 class="text-2xl font-semibold mb-6 text-indigo-600 dark:text-indigo-300">
        Perfil del Usuario
    </h1>

    {{-- Mensajes de éxito --}}
    @if (session('status') === 'password-updated')
        <div class="mb-4 text-green-600 dark:text-green-400">
            Contraseña actualizada correctamente ✅
        </div>
    @endif

    {{-- INFORMACIÓN DEL PERFIL (solo lectura) --}}
    <div class="space-y-6 mb-10">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Nombre
            </label>
            <input id="name" type="text" value="{{ $user->name }}" readonly
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-0 cursor-not-allowed">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Correo electrónico
            </label>
            <input id="email" type="email" value="{{ $user->email }}" readonly
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-0 cursor-not-allowed">
        </div>
    </div>

    {{-- CAMBIO DE CONTRASEÑA --}}
    <div>
        <h2 class="text-lg font-semibold text-indigo-600 dark:text-indigo-400 mb-4">
            Cambiar contraseña
        </h2>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Contraseña actual
                </label>
                <input id="current_password" name="current_password" type="password" required
                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
                @error('current_password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Nueva contraseña
                </label>
                <input id="password" name="password" type="password" required
                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Confirmar nueva contraseña
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
                @error('password_confirmation') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit"
                        class="px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Actualizar contraseña
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
