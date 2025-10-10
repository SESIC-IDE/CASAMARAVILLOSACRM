@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Editar Interacción</h1>

<x-alert />

<form method="POST" action="{{ route('interactions.update', $interaction->id) }}"
      class="space-y-4 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    @csrf
    @method('PUT')

    <div>
        <label class="block font-medium">Cliente</label>
        <select name="customer_id" class="w-full rounded-lg dark:bg-gray-900 dark:border-gray-700">
            @foreach($customers as $c)
                <option value="{{ $c->id }}" {{ $interaction->customer_id == $c->id ? 'selected' : '' }}>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block font-medium">Tipo</label>
        <select name="type" class="w-full rounded-lg dark:bg-gray-900 dark:border-gray-700">
            <option value="call" {{ $interaction->type == 'call' ? 'selected' : '' }}>Llamada</option>
            <option value="email" {{ $interaction->type == 'email' ? 'selected' : '' }}>Correo</option>
            <option value="meeting" {{ $interaction->type == 'meeting' ? 'selected' : '' }}>Reunión</option>
            <option value="whatsapp" {{ $interaction->type == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
        </select>
    </div>

    <div>
        <label class="block font-medium">Fecha</label>
        <input type="datetime-local" name="date"
               value="{{ old('date', \Carbon\Carbon::parse($interaction->date)->format('Y-m-d\TH:i')) }}"
               required class="w-full rounded-lg dark:bg-gray-900 dark:border-gray-700">
    </div>

    <div>
        <label class="block font-medium">Resumen</label>
        <textarea name="summary" rows="3" required
                  class="w-full rounded-lg dark:bg-gray-900 dark:border-gray-700">{{ old('summary', $interaction->summary) }}</textarea>
    </div>

    <div>
        <label class="block font-medium">Resultado</label>
        <input type="text" name="outcome" value="{{ old('outcome', $interaction->outcome) }}"
               class="w-full rounded-lg dark:bg-gray-900 dark:border-gray-700">
    </div>

    <div class="flex justify-end space-x-3">
        <a href="{{ route('interactions.index') }}"
           class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">Cancelar</a>
        <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Actualizar</button>
    </div>
</form>
@endsection
