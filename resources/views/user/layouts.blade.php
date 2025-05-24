<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion des loyers')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F3F4F6;
        }
        
        .sidebar {
            width: 240px;
            transition: all 0.3s ease;
        }
        
        .sidebar.collapsed {
            width: 80px;
        }
        
        @media (max-width: 1024px) {
            .sidebar {
                width: 0;
                position: fixed;
                z-index: 40;
            }
            
            .sidebar.active {
                width: 240px;
            }
        }
    </style>
    @stack('head-scripts')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex w-full">
        <!-- Sidebar -->
        <aside class="sidebar bg-white border-r border-gray-200 flex flex-col h-screen">
            <div class="flex items-center px-4 py-3 justify-between">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500">
                        <rect x="2" y="2" width="20" height="20" rx="2" ry="2"></rect>
                        <path d="M7 10.5V13.5"></path>
                        <path d="M12 7.5V16.5"></path>
                        <path d="M17 10.5V13.5"></path>
                    </svg>
                    <h1 class="text-xl font-bold">Loyers</h1>
                </div>
                <button id="sidebar-toggle" class="rounded-full p-1 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6"></path>
                    </svg>
                </button>
            </div>
      
      <div class="flex flex-col gap-2 flex-1 overflow-auto px-2 py-4">
        <div class="px-2 py-2">
          <p class="text-xs font-medium text-gray-500 mb-2">Navigation</p>
          <ul class="space-y-1">
            <li>
              <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 p-2 rounded-md hover:bg-gray-100 text-gray-700 {{ request()->routeIs('user.dashboard') ? 'bg-blue-50 text-blue-600 font-medium' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                </svg>
                <span>Tableau de bord</span>
              </a>
            </li>
            <li>
              <a href="{{ route('user.messages') }}" class="flex items-center gap-3 p-2 rounded-md hover:bg-gray-100 text-gray-700 {{ request()->routeIs('user.messages') ? 'bg-gray-100' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                <span>Messages</span>
              </a>
            </li>
            <!-- <li>
              <a href="#" class="flex items-center gap-3 p-2 rounded-md hover:bg-gray-100 text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                  <circle cx="9" cy="7" r="4"></circle>
                  <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span>Locataires</span>
              </a>
            </li> -->
            <li>
              <a href="{{ route('user.factures') }}" class="flex items-center gap-3 p-2 rounded-md hover:bg-gray-100 text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                  <polyline points="14 2 14 8 20 8"></polyline>
                  <line x1="16" y1="13" x2="8" y2="13"></line>
                  <line x1="16" y1="17" x2="8" y2="17"></line>
                  <line x1="10" y1="9" x2="8" y2="9"></line>
                </svg>
                <span>Reçus</span>
              </a>
            </li>
          </ul>
        </div>
        
        <div class="px-2 py-2">
          <p class="text-xs font-medium text-gray-500 mb-2">Analyse</p>
          <ul class="space-y-1">
            <!-- <li>
              <a href="#" class="flex items-center gap-3 p-2 rounded-md hover:bg-gray-100 text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="18" y1="20" x2="18" y2="10"></line>
                  <line x1="12" y1="20" x2="12" y2="4"></line>
                  <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
                <span>Rapports</span>
              </a>
            </li>
            <li> -->
              <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-2 rounded-md hover:bg-gray-100 text-gray-700 {{ request()->routeIs('profile.edit') ? 'bg-gray-100' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                  <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>Mon compte</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      
      <div class="p-2 border-t border-gray-200">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full flex items-center gap-3 p-2 rounded-md hover:bg-gray-100 text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
              <polyline points="16 17 21 12 16 7"></polyline>
              <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            <span>Déconnexion</span>
          </button>
        </form>
      </div>
    </aside>

    <!-- Main content -->
    <div class="flex flex-1 flex-col">
      <!-- Header -->
      <header class="border-b border-gray-200 bg-white px-6 py-3">
        <div class="flex items-center justify-between">
          <div class="relative w-64">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-2 top-2.5 h-4 w-4 text-gray-400">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" placeholder="Rechercher..." class="h-9 w-full rounded-md border border-gray-300 pl-8 pr-4 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" />
          </div>
          
          <div class="flex items-center gap-4">
            <!-- Notifications -->
            <div class="relative">
              <button class="relative p-2 rounded-full hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                  <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                <span class="absolute -right-0.5 -top-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] font-medium text-white">
                  3
                </span>
              </button>
            </div>
            
            <!-- User menu -->
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
              <button @click="open = !open" class="flex items-center gap-2 p-2 rounded-full hover:bg-gray-100">
                <div class="h-8 w-8 rounded-full bg-blue-100 text-blue-800 flex items-center justify-center font-medium">
                  {{ substr(Auth::user()->name, 0, 2) }}
                </div>
                <span class="hidden font-medium sm:inline-block">{{ Auth::user()->name }}</span>
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </button>
              
              <!-- Menu déroulant -->
              <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Mon Profil</a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                  @csrf
                  <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Déconnexion</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </header>

      <!-- Main content -->
      <main class="flex-1 p-6">
        @yield('content')
        
      </main>
    </div>
  </div>
  
  <script>
    // Sidebar toggle
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    
    sidebarToggle.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
      
      // Change icon
      const icon = sidebarToggle.querySelector('svg');
      if (sidebar.classList.contains('collapsed')) {
        icon.innerHTML = '<path d="M9 18l6-6-6-6"></path>';
      } else {
        icon.innerHTML = '<path d="M15 18l-6-6 6-6"></path>';
      }
    });

    // Chart
    window.addEventListener('load', function() {
      const ctx = document.getElementById('rentChart').getContext('2d');
      const rentChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
          datasets: [
            {
              label: 'Loyers encaissés',
              data: [4500, 4500, 4500, 4200, 4500, 4500, 4500, 4500, 4500, 4500, 0, 0],
              backgroundColor: '#3B82F6',
              borderRadius: 4,
            },
            {
              label: 'Loyers prévisionnels',
              data: [4500, 4500, 4500, 4500, 4500, 4500, 4500, 4500, 4500, 4500, 4500, 4500],
              backgroundColor: '#93C5FD',
              borderRadius: 4,
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            tooltip: {
              callbacks: {
                label: function(context) {
                  return context.dataset.label + ': ' + context.raw + 'Franc CFA';
                }
              }
            },
            legend: {
              position: 'bottom',
            }
          },
          scales: {
            x: {
              grid: {
                display: false
              }
            },
            y: {
              beginAtZero: true,
              ticks: {
                callback: function(value) {
                  return value + 'Franc CFA';
                }
              }
            }
          }
        }
      });
    });
  </script>
</body>
</html>