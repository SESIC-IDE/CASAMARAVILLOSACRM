@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Editar Cliente</h1>

<x-alert />

<form method="POST" action="{{ route('customers.update', $customer->id) }}"
      class="space-y-4 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    @csrf @method('PUT')
    <div>
        <label class="block font-medium">Nombre</label>
        <input type="text" name="name" value="{{ old('name', $customer->name) }}" required
               class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-lg">
    </div>
    <div>
        <label class="block font-medium">Correo</label>
        <input type="email" name="email" value="{{ old('email', $customer->email) }}" required
               class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-lg">
    </div>
    <div>
        <label class="block font-medium">Teléfono</label>
        <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}"
               class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-lg">
    </div>
    <div>
        <label class="block font-medium">Dirección</label>
        <input type="text" name="address" value="{{ old('address', $customer->address) }}"
               class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-lg">
    </div>
    <div>
        <label class="block font-medium">Notas</label>
        <textarea name="notes" rows="3"
                  class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-lg">{{ old('notes', $customer->notes) }}</textarea>
    </div>
    <div class="flex justify-end space-x-3">
        <a href="{{ route('customers.index') }}"
           class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">Cancelar</a>
        <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Actualizar</button>
    </div>
</form>
@endsection
