@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <!-- En-tête du Tableau de Bord -->
            <div class="md:col-span-12 flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Tableau de Bord</h1>
                <div class="text-sm text-gray-600">{{ date('d M Y') }}</div>
            </div>

            <!-- Cartes de Statistiques -->
            <div class="md:col-span-4 bg-white rounded-lg shadow-md p-6 flex items-center">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full mr-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zm-6 4a1 1 0 01-1 1H7a1 1 0 110-2h4a1 1 0 011 1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-gray-500 text-sm">Total Loyers</h3>
                    <p class="text-xl font-bold text-gray-800">{{ number_format($totalLoyers, 2) }} Franc CFA</p>
                </div>
            </div>

            <div class="md:col-span-4 bg-white rounded-lg shadow-md p-6 flex items-center">
                <div class="bg-green-100 text-green-600 p-3 rounded-full mr-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-gray-500 text-sm">Total Charges</h3>
                    <p class="text-xl font-bold text-gray-800">{{ number_format($totalCharges, 2) }} Franc CFA</p>
                </div>
            </div>

            <div class="md:col-span-4 bg-white rounded-lg shadow-md p-6 flex items-center">
                <div class="bg-purple-100 text-purple-600 p-3 rounded-full mr-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-gray-500 text-sm">Transactions</h3>
                    <p class="text-xl font-bold text-gray-800">{{ $transactionsCount }}</p>
                </div>
            </div>

            <!-- Graphique des Dépenses Mensuelles -->
            <div class="md:col-span-6 bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Dépenses Mensuelles</h3>
                <canvas id="monthlyExpensesChart" class="w-full h-64"></canvas>
            </div>

            <!-- Graphique des Charges -->
            <div class="md:col-span-6 bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Répartition des Charges</h3>
                <canvas id="chargesChart" class="w-full h-64"></canvas>
            </div>

            <!-- Graphique des Transactions -->
            <div class="md:col-span-8 bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Historique des Transactions</h3>
                <canvas id="transactionsChart" class="w-full h-64"></canvas>
            </div>

            <!-- Dernières Transactions -->
            <div class="md:col-span-4 bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Dernières Transactions</h3>
                <ul class="divide-y divide-gray-200">
                    @for($i = 0; $i < 5; $i++)
                        <li class="py-3">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Transaction {{ $i + 1 }}</span>
                                <span class="text-sm font-semibold text-gray-800">{{ rand(50, 500) }} Franc CFA</span>
                            </div>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Monthly Expenses Chart
    const ctxExpenses = document.getElementById('monthlyExpensesChart').getContext('2d');
    new Chart(ctxExpenses, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
                label: 'Dépenses',
                data: {{ json_encode($depensesMensuelles) }},
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Charges Chart
    const ctxCharges = document.getElementById('chargesChart').getContext('2d');
    new Chart(ctxCharges, {
        type: 'pie',
        data: {
            labels: ['Eau', 'Électricité', 'Chauffage', 'Entretien', 'Autres'],
            datasets: [{
                label: 'Charges',
                data: {{ json_encode($chargesRepartition) }},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.formattedValue + ' Franc CFA';
                            return label;
                        }
                    }
                }
            }
        }
    });

    // Transactions Chart
    const ctxTransactions = document.getElementById('transactionsChart').getContext('2d');
    new Chart(ctxTransactions, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
                label: 'Transactions',
                data: {{ json_encode($transactionsHistorique) }},
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' Franc CFA';
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.formattedValue + ' Franc CFA';
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection