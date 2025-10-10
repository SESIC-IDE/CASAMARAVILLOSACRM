@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold">Clientes</h1>
    <a href="{{ route('customers.create') }}"
       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
       + Nuevo Cliente
    </a>
</div>

<x-alert />

<div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
    <table class="min-w-full text-sm text-left">
        <thead class="bg-indigo-600 text-white">
            <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Nombre</th>
                <th class="px-6 py-3">Correo</th>
                <th class="px-6 py-3">Teléfono</th>
                <th class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $customer)
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-6 py-3">{{ $customer->id }}</td>
                <td class="px-6 py-3">{{ $customer->name }}</td>
                <td class="px-6 py-3">{{ $customer->email }}</td>
                <td class="px-6 py-3">{{ $customer->phone ?? '—' }}</td>
                <td class="px-6 py-3 flex space-x-2">
                    <a href="{{ route('customers.edit', $customer->id) }}" class="text-blue-500 hover:underline">Editar</a>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                          onsubmit="return confirm('¿Deseas eliminar este cliente?')">
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
