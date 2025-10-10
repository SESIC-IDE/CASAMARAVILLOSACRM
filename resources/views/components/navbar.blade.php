@extends('layouts.app')

<nav class="bg-white dark:bg-gray-800 shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
            Casa Maravillosa CRM
        </a>
        <div class="flex items-center space-x-4">
            @if(auth()->user()->role !== 'seller')
                <a href="{{ route('customers.index') }}" class="hover:text-indigo-500 dark:hover:text-indigo-300">Clientes</a>
                <a href="{{ route('interactions.index') }}" class="hover:text-indigo-500 dark:hover:text-indigo-300">Interacciones</a>
                <a href="{{ route('reminders.index') }}" class="hover:text-indigo-500 dark:hover:text-indigo-300">Recordatorios</a>
            @endif
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('reports.customers') }}" class="hover:text-indigo-500 dark:hover:text-indigo-300">Reportes</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</nav>
