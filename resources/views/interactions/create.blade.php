@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Nueva Interacción</h1>

<form method="POST" action="{{ route('interactions.store') }}"
      class="space-y-4 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    @csrf
    <div>
        <label class="block font-medium">Cliente</label>
        <select name="customer_id" class="w-full rounded-lg dark:bg-gray-900 dark:border-gray-700">
            @foreach($customers as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block font-medium">Tipo</label>
        <select name="type" class="w-full rounded-lg dark:bg-gray-900 dark:border-gray-700">
            <option value="call">Llamada</option>
            <option value="email">Correo</option>
            <option value="meeting">Reunión</option>
            <option value="whatsapp">WhatsApp</option>
        </select>
    </div>
    <div>
        <label class="block font-medium">Fecha</label>
        <input type="datetime-local" name="date" required
               class="w-full rounded-lg dark:bg-gray-900 dark:border-gray-700">
    </div>
    <div>
        <label class="block font-medium">Resumen</label>
        <textarea name="summary" rows="3" required
                  class="w-full rounded-lg dark:bg-gray-900 dark:border-gray-700"></textarea>
    </div>
    <div>
        <label class="block font-medium">Resultado</label>
        <input type="text" name="outcome"
               class="w-full rounded-lg dark:bg-gray-900 dark:border-gray-700">
    </div>
    <div class="flex justify-end space-x-3">
        <a href="{{ route('interactions.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">Cancelar</a>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Guardar</button>
    </div>
</form>
@endsection
