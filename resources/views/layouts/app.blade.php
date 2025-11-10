<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dashboard') - E-Voting BEM</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: "#eff6ff",
                            500: "#3b82f6",
                            600: "#2563eb",
                            700: "#1d4ed8",
                        },
                    },
                },
            },
        };

        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("sidebar-overlay");
            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("hidden");
        }
    </script>
</head>

<body class="bg-gray-50">

    <!-- Overlay -->
    <div id="sidebar-overlay"
        class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"
        onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
        <div class="flex items-center justify-between h-14 px-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="ml-2 text-base font-bold text-gray-900">
                    {{ Auth::user()->role === 'admin' ? 'Admin Panel' : 'Dashboard' }}
                </span>
            </div>
            <button onclick="toggleSidebar()" class="lg:hidden text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="mt-4 px-3 flex-1 overflow-y-auto">
            <div class="space-y-1">

                @if (Auth::user()->role === 'admin')
                    <!-- Menu Admin -->
                    <a href="{{ route('admin.dashboard') }}"
                        class="block px-3 py-2.5 text-sm font-medium rounded-lg 
                        {{ request()->routeIs('admin.dashboard') ? 'bg-primary-100 text-primary-700 border-l-4 border-primary-500' : 'text-gray-600 hover:bg-gray-50' }}">
                        🏠 Overview
                    </a>

                    <a href="{{ route('data-admin.index') }}"
                        class="block px-3 py-2.5 text-sm font-medium rounded-lg 
                        {{ request()->routeIs('data-admin.*') ? 'bg-primary-100 text-primary-700 border-l-4 border-primary-500' : 'text-gray-600 hover:bg-gray-50' }}">
                        👤 Data Admin
                    </a>

                    <a href="{{ route('candidates.index') }}"
                        class="block px-3 py-2.5 text-sm font-medium rounded-lg 
                        {{ request()->routeIs('candidates.*') ? 'bg-primary-100 text-primary-700 border-l-4 border-primary-500' : 'text-gray-600 hover:bg-gray-50' }}">
                        🧑‍💼 Kelola Kandidat
                    </a>

                    <a href="{{ route('data-pemilih.index') }}"
                        class="block px-3 py-2.5 text-sm font-medium rounded-lg 
                        {{ request()->routeIs('data-pemilih.*') ? 'bg-primary-100 text-primary-700 border-l-4 border-primary-500' : 'text-gray-600 hover:bg-gray-50' }}">
                        👥 Data Pemilih
                    </a>

                    <a href="#"
                        class="block px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                        📊 Hasil Pemilihan
                    </a>

                    <a href="#"
                        class="block px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                        📅 Pengaturan Periode
                    </a>

                @else
                    <!-- Menu Mahasiswa -->
                    <a href="{{ route('dashboard') }}"
                        class="block px-3 py-2.5 text-sm font-medium rounded-lg 
                        {{ request()->routeIs('dashboard') ? 'bg-primary-100 text-primary-700 border-l-4 border-primary-500' : 'text-gray-600 hover:bg-gray-50' }}">
                        🏠 Beranda
                    </a>

                    <a href="{{ route('vote.index') }}"
                        class="block px-3 py-2.5 text-sm font-medium rounded-lg 
                        {{ request()->routeIs('vote.index') ? 'bg-primary-100 text-primary-700 border-l-4 border-primary-500' : 'text-gray-600 hover:bg-gray-50' }}">
                        🗳️ Voting Sekarang
                    </a>

                    <a href="#"
                        class="block px-3 py-2.5 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                        📈 Hasil Voting
                    </a>
                @endif

            </div>

            <div class="mt-6 pt-4 border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center px-3 py-2.5 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Top Bar -->
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-14">
                    <div class="flex items-center min-w-0">
                        <button onclick="toggleSidebar()"
                            class="lg:hidden text-gray-500 hover:text-gray-700 mr-3 flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <h1 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 truncate">
                            @yield('header', 'Dashboard')
                        </h1>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span
                            class="hidden sm:inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                        <div class="text-xs text-gray-500">
                            {{ date('d M Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="p-4 sm:p-6 lg:p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
