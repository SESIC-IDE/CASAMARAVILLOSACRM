@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Panel de Control</h1>

<div class="grid md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-center">
        <h2 class="text-3xl font-bold text-indigo-600">{{ $customersCount }}</h2>
        <p class="text-gray-500 dark:text-gray-300">Clientes registrados</p>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-center">
        <h2 class="text-3xl font-bold text-green-500">{{ $interactionsCount }}</h2>
        <p class="text-gray-500 dark:text-gray-300">Interacciones</p>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-center">
        <h2 class="text-3xl font-bold text-amber-500">{{ $remindersPending }}</h2>
        <p class="text-gray-500 dark:text-gray-300">Recordatorios pendientes</p>
    </div>
</div>

{{-- Gráfico --}}
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow" style="height:400px;">
  <h2 class="text-xl font-semibold mb-4">Estado de Recordatorios</h2>
  <canvas id="remindersChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('remindersChart');
new Chart(ctx, {
  type: 'bar', // tipo de gráfico
  data: {
    labels: @json($chartData['labels']),
    datasets: [{
      label: 'Cantidad de recordatorios',
      data: @json($chartData['values']),
      backgroundColor: ['#4F46E5', '#10B981', '#F59E0B'], // azul, verde, dorado
      borderColor: '#1E1B4B',
      borderWidth: 1,
      borderRadius: 6
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        ticks: { color: '#9CA3AF' },
        grid: { color: 'rgba(156,163,175,0.2)' }
      },
      x: {
        ticks: { color: '#9CA3AF' },
        grid: { display: false }
      }
    },
    plugins: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Distribución de Recordatorios',
        color: '#4F46E5',
        font: { size: 16, weight: 'bold' }
      }
    }
  }
});
</script>

@endsection
