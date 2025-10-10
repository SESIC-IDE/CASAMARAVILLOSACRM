@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Reporte de Clientes</h1>

<div class="flex justify-end mb-4 space-x-3">
    <a href="{{ route('reports.pdf') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Exportar PDF</a>
    <a href="{{ route('reports.excel') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Exportar Excel</a>
</div>

<div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
    <table class="min-w-full text-sm text-left">
        <thead class="bg-indigo-600 text-white">
            <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Nombre</th>
                <th class="px-6 py-3">Correo</th>
                <th class="px-6 py-3">Teléfono</th>
                <th class="px-6 py-3">Dirección</th>
                <th class="px-6 py-3">Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $c)
            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-6 py-3">{{ $c->id }}</td>
                <td class="px-6 py-3">{{ $c->name }}</td>
                <td class="px-6 py-3">{{ $c->email }}</td>
                <td class="px-6 py-3">{{ $c->phone ?? '—' }}</td>
                <td class="px-6 py-3">{{ $c->address ?? '—' }}</td>
                <td class="px-6 py-3">{{ $c->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
