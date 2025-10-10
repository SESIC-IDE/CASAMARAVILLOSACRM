@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold text-indigo-600 dark:text-indigo-400">Recordatorios</h1>
        <a href="{{ route('reminders.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
            + Nuevo Recordatorio
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600 dark:text-green-400">{{ session('success') }}</div>
    @endif

    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead>
            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                <th class="px-4 py-2 text-left">Título</th>
                <th class="px-4 py-2 text-left">Cliente</th>
                <th class="px-4 py-2 text-left">Fecha</th>
                <th class="px-4 py-2 text-left">Estado</th>
                <th class="px-4 py-2 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach ($reminders as $reminder)
                <tr>
                    <td class="px-4 py-2">{{ $reminder->title }}</td>
                    <td class="px-4 py-2">{{ $reminder->customer->name ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $reminder->reminder_date->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded-full text-xs 
                            {{ $reminder->status === 'Completado' ? 'bg-green-500 text-white' : 
                               ($reminder->is_expired ? 'bg-red-500 text-white' : 'bg-amber-400 text-black') }}">
                            {{ $reminder->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2 text-right">
                        <a href="{{ route('reminders.edit', $reminder) }}" class="text-indigo-600 hover:underline">Editar</a>
                        <form method="POST" action="{{ route('reminders.destroy', $reminder) }}" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $reminders->links() }}</div>
</div>
@endsection
