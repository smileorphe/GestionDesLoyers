@extends('user.layouts')

@section('title', 'Tableau de bord - Gestion des loyers')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
        <!-- Loyers card -->
        <div class="rounded-lg border bg-white overflow-hidden shadow-sm">
            <div class="p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total des loyers</p>
                        <h3 class="mt-1 text-2xl font-semibold">4 500 Franc CFA</h3>
                        <div class="mt-1 flex items-center">
                            <span class="text-xs font-medium text-green-600">+5.2%</span>
                            <span class="ml-1 text-xs text-gray-500">depuis le mois dernier</span>
                        </div>
                    </div>
                    <div class="bg-blue-100 text-blue-600 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Propriétés card -->
        <div class="rounded-lg border bg-white overflow-hidden shadow-sm">
            <div class="p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Propriétés</p>
                        <h3 class="mt-1 text-2xl font-semibold">5</h3>
                    </div>
                    <div class="bg-purple-100 text-purple-600 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                            <rect x="2" y="2" width="20" height="20" rx="2" ry="2"></rect>
                            <path d="M7 10.5V13.5"></path>
                            <path d="M12 7.5V16.5"></path>
                            <path d="M17 10.5V13.5"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Taux d'occupation card -->
        <div class="rounded-lg border bg-white overflow-hidden shadow-sm">
            <div class="p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Taux d'occupation</p>
                        <h3 class="mt-1 text-2xl font-semibold">80%</h3>
                        <div class="mt-1 flex items-center">
                            <span class="text-xs font-medium text-green-600">+10%</span>
                            <span class="ml-1 text-xs text-gray-500">depuis le mois dernier</span>
                        </div>
                    </div>
                    <div class="bg-green-100 text-green-600 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dépenses card -->
        <div class="rounded-lg border bg-white overflow-hidden shadow-sm">
            <div class="p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Dépenses</p>
                        <h3 class="mt-1 text-2xl font-semibold">1 200 Franc CFA</h3>
                        <div class="mt-1 flex items-center">
                            <span class="text-xs font-medium text-red-600">-2.3%</span>
                            <span class="ml-1 text-xs text-gray-500">depuis le mois dernier</span>
                        </div>
                    </div>
                    <div class="bg-red-100 text-red-600 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Property List -->
    <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-3">
        <!-- Rent Chart -->
        <div class="col-span-full xl:col-span-2 rounded-lg border bg-white overflow-hidden shadow-sm">
            <div class="flex items-center justify-between p-6 pb-2">
                <h3 class="font-semibold text-lg">Évolution des loyers</h3>
            </div>
            <div class="p-6 pt-0">
                <canvas id="rentChart" height="300"></canvas>
            </div>
        </div>

        <!-- Property List -->
        <div class="col-span-full xl:col-span-1 rounded-lg border bg-white overflow-hidden shadow-sm">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-lg">Propriétés</h3>
                        <p class="text-sm text-gray-500">Liste des propriétés</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="mt-6 rounded-lg border bg-white overflow-hidden shadow-sm">
        <div class="p-6 flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-lg">Transactions récentes</h3>
                <p class="text-sm text-gray-500">Les 5 dernières transactions de loyer</p>
            </div>
        </div>
        <div class="px-6 pb-6">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="py-3 pl-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Propriété</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Locataire</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Transaction rows will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('rentChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                datasets: [{
                    label: 'Loyers perçus',
                    data: [4200, 4300, 4500, 4400, 4600, 4500],
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endpush