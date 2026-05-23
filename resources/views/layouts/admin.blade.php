<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - ITBSCarRental Panel</title>

    <!-- Google Fonts & FontAwesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary-bg: #f8fafc;
            --secondary-bg: #ffffff;
            --accent-color: #7c3aed;
            --accent-glow: rgba(124, 58, 237, 0.3);
            --text-main: #0f172a;
            --text-muted: #64748b;
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(0, 0, 0, 0.08);
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-main);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: var(--sidebar-width);
            background: var(--secondary-bg);
            border-right: 1px solid var(--glass-border);
            box-shadow: 4px 0 30px rgba(0, 0, 0, 0.01);
            z-index: 1000;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 16px 20px;
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--text-main);
            letter-spacing: 1px;
            border-bottom: 1px solid var(--glass-border);
        }

        .sidebar-brand span {
            color: var(--accent-color);
        }

        .sidebar-menu {
            padding: 16px 12px;
            list-style: none;
            margin: 0;
            flex-grow: 1;
        }

        .sidebar-item {
            margin-bottom: 4px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 10px 14px;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .sidebar-link i {
            width: 24px;
            font-size: 1.1rem;
            margin-right: 12px;
            transition: transform 0.3s ease;
        }

        .sidebar-link:hover {
            color: var(--accent-color);
            background: rgba(124, 58, 237, 0.05);
        }

        .sidebar-link:hover i {
            transform: translateX(3px);
        }

        .sidebar-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, #7c3aed, #a855f7);
            box-shadow: 0 4px 15px var(--accent-glow);
        }

        /* Top Navbar Header */
        .top-header {
            position: sticky;
            top: 0;
            height: 56px;
            margin-left: var(--sidebar-width);
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.01);
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            transition: all 0.2s ease;
        }

        /* Main Content Container */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            min-height: calc(100vh - 56px);
            transition: all 0.2s ease;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                left: calc(-1 * var(--sidebar-width));
            }
            .sidebar.active {
                left: 0;
            }
            .top-header {
                margin-left: 0;
                padding: 0 20px;
            }
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }

        /* Global UI Improvements */
        
        /* Modern Cards */
        .card {
            background: var(--secondary-bg);
            border: 1px solid var(--glass-border);
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.015);
            transition: all 0.2s ease;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--glass-border);
            padding: 12px 18px;
            font-weight: 700;
            color: var(--text-main);
        }

        .card-body {
            padding: 18px;
        }

        /* Tables styling */
        .table {
            color: var(--text-main);
            vertical-align: middle;
            margin-bottom: 0;
        }

        .table th {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.72rem;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            padding: 10px 14px;
            background-color: rgba(0, 0, 0, 0.01);
            border-bottom: 2px solid var(--glass-border);
        }

        .table td {
            padding: 10px 14px;
            border-bottom: 1px solid var(--glass-border);
            font-size: 0.88rem;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(124, 58, 237, 0.02);
        }

        /* Buttons overrides */
        .btn {
            border-radius: 6px;
            padding: 6px 14px;
            font-weight: 600;
            font-size: 0.82rem;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #7c3aed, #a855f7) !important;
            border: none !important;
            color: white !important;
            box-shadow: 0 4px 15px var(--accent-glow) !important;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px var(--accent-glow) !important;
        }

        .btn-outline-primary {
            border: 2px solid var(--accent-color) !important;
            color: var(--accent-color) !important;
            background: transparent !important;
        }

        .btn-outline-primary:hover {
            background: var(--accent-color) !important;
            color: white !important;
            box-shadow: 0 4px 15px var(--accent-glow) !important;
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #34d399) !important;
            border: none !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2) !important;
        }

        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3) !important;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #f87171) !important;
            border: none !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2) !important;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3) !important;
        }

        /* Glass Form Control */
        .form-control, .form-select {
            background: rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 0.875rem;
            color: var(--text-main);
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            background: #ffffff;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.15);
            color: var(--text-main);
        }

        /* Badges */
        .badge {
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .bg-success {
            background-color: rgba(16, 185, 129, 0.1) !important;
            color: #10b981 !important;
        }

        .bg-danger {
            background-color: rgba(239, 68, 68, 0.1) !important;
            color: #ef4444 !important;
        }

        .bg-warning {
            background-color: rgba(245, 158, 11, 0.1) !important;
            color: #f59e0b !important;
        }

        .bg-primary {
            background-color: rgba(124, 58, 237, 0.1) !important;
            color: var(--accent-color) !important;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--primary-bg);
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 5px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-color);
        }

        /* Micro-animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-up {
            animation: fadeUp 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand d-flex align-items-center">
            <img src="{{ asset('logoo.png') }}" alt="ITBSCarRental Logo" height="32" class="me-2 rounded-2" style="border: 1px solid var(--glass-border);">
            <span style="font-weight: 700; font-size: 1.15rem; letter-spacing: 0.5px;">ITBS<span style="color: var(--accent-color);">CarRental</span></span>
        </div>
        <ul class="sidebar-menu">
            <li class="sidebar-item">
                <a class="sidebar-link {{ Route::is('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('admin/car-types*') ? 'active' : '' }}" href="{{ route('admin.car-types.index') }}">
                    <i class="fas fa-tags"></i> Jenis Mobil
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('admin/cars*') ? 'active' : '' }}" href="{{ route('admin.cars.index') }}">
                    <i class="fas fa-car"></i> Data Mobil
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('admin/bookings*') ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}">
                    <i class="fas fa-calendar-alt"></i> Pemesanan
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('admin/payments*') ? 'active' : '' }}" href="{{ route('admin.payments.index') }}">
                    <i class="fas fa-money-bill-wave"></i> Pembayaran
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('admin/customers*') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}">
                    <i class="fas fa-users"></i> Pelanggan
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('admin/contacts*') ? 'active' : '' }} d-flex justify-content-between align-items-center" href="{{ route('admin.contacts.index') }}">
                    <div>
                        <i class="fas fa-envelope"></i> Pesan Masuk
                    </div>
                    @php
                        $unreadContacts = \App\Models\Contact::where('is_read', false)->count();
                    @endphp
                    @if($unreadContacts > 0)
                        <span class="badge bg-danger rounded-pill px-2 py-1" style="font-size: 0.7rem; color: #ffffff !important; background-color: #ef4444 !important;">{{ $unreadContacts }}</span>
                    @endif
                </a>
            </li>
        </ul>
        
        <div class="p-3 border-top" style="border-color: var(--glass-border) !important;">
            <a class="btn btn-outline-danger w-100 rounded-pill py-2" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
        </div>
    </div>

    <!-- Top Header Navigation -->
    <header class="top-header">
        <div class="d-flex align-items-center">
            <button class="btn btn-link text-dark p-0 me-3 d-lg-none" id="sidebarCollapse">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            <h4 class="fw-bold mb-0 text-dark">
                @yield('page-title', 'Overview')
            </h4>
        </div>
        
        <div class="d-flex align-items-center gap-3">
            <div class="dropdown">
                <a class="text-decoration-none d-flex align-items-center text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=7c3aed&color=fff&rounded=true" alt="Avatar" class="rounded-circle me-2 shadow-sm" width="36" height="36">
                    <div class="d-none d-md-block">
                        <div class="fw-bold small">{{ Auth::user()->name }}</div>
                        <div class="text-muted small" style="font-size: 0.75rem;">Administrator</div>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius: 12px; margin-top: 10px;">
                    <li>
                        <a class="dropdown-item text-dark" href="{{ url('/') }}" target="_blank">
                            <i class="fas fa-external-link-alt me-2 text-muted"></i> Kunjungi Situs
                        </a>
                    </li>
                    <li><hr class="dropdown-divider" style="border-color: var(--glass-border);"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="main-content animate-fade-up">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center" role="alert" style="border-radius: 12px; background-color: rgba(16, 185, 129, 0.1); color: #10b981;">
                <i class="fas fa-check-circle me-2 fa-lg"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm mb-4 d-flex align-items-center" role="alert" style="border-radius: 12px; background-color: rgba(239, 68, 68, 0.1); color: #ef4444;">
                <i class="fas fa-exclamation-circle me-2 fa-lg"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Sidebar Toggler Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const collapseBtn = document.getElementById('sidebarCollapse');
            
            if (collapseBtn) {
                collapseBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
