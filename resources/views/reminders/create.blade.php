@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
    <h1 class="text-2xl font-semibold mb-6 text-indigo-600 dark:text-indigo-400">
        Nuevo Recordatorio
    </h1>

    {{-- Mensajes de éxito o error --}}
    @if (session('success'))
        <div class="mb-4 text-green-600 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('reminders.store') }}" class="space-y-6">
        @csrf

        {{-- Título --}}
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Título
            </label>
            <input id="title" name="title" type="text" required
                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 
                       dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500"
                value="{{ old('title') }}">
            @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Descripción --}}
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Descripción
            </label>
            <textarea id="description" name="description" rows="3"
                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 
                       dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
        </div>

        {{-- Fecha y hora --}}
        <div>
            <label for="reminder_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Fecha y hora del recordatorio
            </label>
            <input id="reminder_date" name="reminder_date" type="datetime-local" required
                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 
                       dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500"
                value="{{ old('reminder_date') }}">
            @error('reminder_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Cliente --}}
        <div>
            <label for="customer_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Cliente asociado
            </label>
            <select id="customer_id" name="customer_id"
                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 
                       dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">— Selecciona un cliente —</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
            @error('customer_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Botones --}}
        <div class="flex justify-end space-x-3">
            <a href="{{ route('reminders.index') }}"
               class="px-5 py-2 rounded-lg bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-gray-600 transition">
               Cancelar
            </a>
            <button type="submit"
               class="px-5 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white shadow-lg transition">
               Guardar Recordatorio
            </button>
        </div>
    </form>
</div>
@endsection
