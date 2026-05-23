<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ITBSCarRental') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --primary-bg: #f8fafc;
            --secondary-bg: #ffffff;
            --accent-color: #7c3aed; /* Royal Violet */
            --accent-glow: rgba(124, 58, 237, 0.4);
            --text-main: #0f172a;
            --text-muted: #64748b;
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(0, 0, 0, 0.08);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Glassmorphism Navbar */
        .navbar-glass {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text-main) !important;
            letter-spacing: 1px;
        }
        
        .navbar-brand span {
            color: var(--accent-color);
        }

        .nav-link {
            color: var(--text-muted) !important;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--accent-color) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--accent-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
            box-shadow: 0 0 8px var(--accent-glow);
        }

        /* Buttons */
        .btn-premium {
            background: linear-gradient(135deg, #7c3aed, #a855f7);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px var(--accent-glow);
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px var(--accent-glow);
            color: white;
        }
        
        .btn-outline-premium {
            background: transparent;
            color: var(--accent-color);
            border: 2px solid var(--accent-color);
            border-radius: 50px;
            padding: 8px 22px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-premium:hover {
            background: var(--accent-color);
            color: white;
            box-shadow: 0 4px 15px var(--accent-glow);
        }

        /* Hero Section */
        .hero-section {
            padding: 100px 0;
            background: radial-gradient(circle at top right, #ffffff, #f5f3ff);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(124,58,237,0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, #0f172a, #334155);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Cards */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            overflow: hidden;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .glass-card:hover {
            transform: translateY(-10px);
            border-color: rgba(124, 58, 237, 0.3);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1), 0 0 15px var(--accent-glow);
        }

        .card-img-wrapper {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .glass-card:hover .card-img-wrapper img {
            transform: scale(1.05);
        }

        .badge-premium {
            background: rgba(124, 58, 237, 0.1);
            color: var(--accent-color);
            border: 1px solid rgba(124, 58, 237, 0.3);
            font-weight: 600;
            padding: 5px 15px;
            border-radius: 20px;
        }

        /* Forms */
        .form-control-glass {
            background: rgba(0,0,0,0.02);
            border: 1px solid rgba(0,0,0,0.1);
            color: var(--text-main);
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control-glass:focus {
            background: #ffffff;
            border-color: var(--accent-color);
            color: var(--text-main);
            box-shadow: 0 0 0 0.25rem rgba(124, 58, 237, 0.25);
        }

        .form-control-glass::placeholder {
            color: #94a3b8;
        }

        /* Footer */
        .footer {
            background: #ffffff;
            border-top: 1px solid var(--glass-border);
            padding: 50px 0 20px;
            margin-top: auto;
        }

        /* Micro animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-up {
            animation: fadeUp 0.8s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
            opacity: 0;
        }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
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
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark navbar-glass">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('logoo.png') }}" alt="ITBSCarRental Logo" height="38" class="me-2 rounded-2" style="border: 1px solid var(--glass-border);">
                <span class="fw-bold" style="letter-spacing: 0.5px; font-size: 1.3rem;">ITBS<span style="color: var(--accent-color);">CarRental</span></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#cars-section">Cars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about-section">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact-section">Contact</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item me-2">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="btn btn-premium" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=7c3aed&color=fff&rounded=true" alt="Avatar" class="rounded-circle me-2" width="30">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" style="background: var(--secondary-bg); border: 1px solid var(--glass-border); box-shadow: 0 10px 20px rgba(0,0,0,0.1);" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->role === 'admin')
                                    <a class="dropdown-item text-dark hover-bg-primary" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i> Admin Dashboard
                                    </a>
                                @else
                                    <a class="dropdown-item text-dark hover-bg-primary" href="{{ route('user.dashboard') }}">
                                        <i class="fas fa-user me-2"></i> My Dashboard
                                    </a>
                                @endif
                                <div class="dropdown-divider border-secondary"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <li class="nav-item d-md-none ms-2 mt-2">
                            <a class="btn btn-sm btn-outline-danger w-100 rounded-pill py-2" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer mt-auto">
        <div class="container">
            <div class="row animate-fade-up">
                <div class="col-md-4 mb-4">
                    <h5 class="text-dark font-bold mb-3 d-flex align-items-center">
                        <img src="{{ asset('logoo.png') }}" alt="ITBSCarRental Logo" height="30" class="me-2 rounded-1" style="border: 1px solid var(--glass-border);">
                        ITBS<span style="color: var(--accent-color)">CarRental</span>
                    </h5>
                    <p class="text-muted">Premium car rental service for your ultimate journey. We provide top-tier vehicles with exceptional service.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-dark mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted text-decoration-none" style="transition: color 0.3s;" onmouseover="this.style.color='#0f172a'" onmouseout="this.style.color='#64748b'">Home</a></li>
                        <li><a href="#cars-section" class="text-muted text-decoration-none" style="transition: color 0.3s;" onmouseover="this.style.color='#0f172a'" onmouseout="this.style.color='#64748b'">Fleet</a></li>
                        <li><a href="#about-section" class="text-muted text-decoration-none" style="transition: color 0.3s;" onmouseover="this.style.color='#0f172a'" onmouseout="this.style.color='#64748b'">About Us</a></li>
                        <li><a href="#contact-section" class="text-muted text-decoration-none" style="transition: color 0.3s;" onmouseover="this.style.color='#0f172a'" onmouseout="this.style.color='#64748b'">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-dark mb-3">Contact Us</h5>
                    <ul class="list-unstyled text-muted">
                        <li><i class="fas fa-map-marker-alt me-2" style="color: var(--accent-color);"></i> Jl. Malaka No.3, RT.7/RW.3, Roa Malaka, Kec. Tambora, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11230</li>
                        <li><i class="fas fa-phone me-2" style="color: var(--accent-color);"></i> +62 812 3456 7890</li>
                        <li><i class="fas fa-envelope me-2" style="color: var(--accent-color);"></i> contact@itbscarrental.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-top pt-3 mt-3 text-center text-muted" style="border-color: rgba(0,0,0,0.1) !important;">
                <p>&copy; {{ date('Y') }} ITBSCarRental. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <style>
        .dropdown-item:hover, .dropdown-item:focus {
            background-color: rgba(124, 58, 237, 0.1);
            color: var(--accent-color) !important;
        }
    </style>
    @stack('scripts')
</body>
</html>
