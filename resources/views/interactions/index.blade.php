@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold">Interacciones</h1>
    <a href="{{ route('interactions.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
        + Nueva Interacción
    </a>
</div>

<x-alert />

<div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
    <table class="min-w-full text-sm text-left">
        <thead class="bg-indigo-600 text-white">
            <tr>
                <th class="px-6 py-3">Cliente</th>
                <th class="px-6 py-3">Tipo</th>
                <th class="px-6 py-3">Fecha</th>
                <th class="px-6 py-3">Resumen</th>
                <th class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-6 py-3">{{ $item->customer->name }}</td>
                <td class="px-6 py-3 capitalize">{{ $item->type }}</td>
                <td class="px-6 py-3">{{ $item->date }}</td>
                <td class="px-6 py-3">{{ Str::limit($item->summary, 40) }}</td>
                <td class="px-6 py-3 flex space-x-2">
                    <a href="{{ route('interactions.edit', $item->id) }}" class="text-blue-500 hover:underline">Editar</a>
                    <form action="{{ route('interactions.destroy', $item->id) }}" method="POST"
                          onsubmit="return confirm('¿Eliminar esta interacción?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
