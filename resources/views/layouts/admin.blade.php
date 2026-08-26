<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Pengaduan Sarana SMK BPPI Baleendah</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /* =========================================
           TEMA GLOBAL
        ========================================= */
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f4f7f6;
        }

        /* =========================================
           SIDEBAR
        ========================================= */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #0f3057 0%, #00587a 50%, #008891 100%);
            color: #e2e8f0;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar .brand {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar .brand img {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            object-fit: cover;
            background: white;
            padding: 2px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .sidebar .brand-text {
            color: #ffffff;
            font-size: 1rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .sidebar .brand-text small {
            display: block;
            font-size: 0.7rem;
            font-weight: 400;
            color: #90cdf4;
            margin-top: 2px;
        }

        .sidebar .nav-section {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #90cdf4;
            padding: 1.2rem 1.5rem 0.5rem;
            font-weight: 600;
        }

        .sidebar .nav-link {
            color: #cbd5e0;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.1);
            border-left: 3px solid #00b4d8;
        }

        .sidebar .nav-link i {
            font-size: 1.1rem;
        }

        /* =========================================
           FOOTER SIDEBAR (USER & LOGOUT)
        ========================================= */
        .sidebar-bottom {
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-bottom .user-info {
            color: #ffffff;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .sidebar-bottom .user-role {
            color: #90cdf4;
            font-size: 0.75rem;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        /* =========================================
           TOPBAR & KONTEN
        ========================================= */
        .main-content {
            margin-left: 260px;
            padding: 2rem;
        }

        .topbar {
            background: #ffffff;
            border-bottom: 2px solid #e2e8f0;
            padding: 1rem 2rem;
            margin-left: 260px;
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar h6 {
            font-weight: 700;
            color: #1a202c;
            font-size: 1.2rem;
            margin-bottom: 0;
        }

        .topbar small {
            color: #718096;
            font-weight: 500;
            font-size: 0.85rem;
        }

        /* =========================================
           ALERT
        ========================================= */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 15px 20px;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .alert-success {
            background: #f0fff4;
            color: #2f855a;
            border-left: 5px solid #38a169;
        }

        .alert-danger {
            background: #fff5f5;
            color: #c53030;
            border-left: 5px solid #e53e3e;
        }

        /* =========================================
           CARD, TABEL, INPUT, TOMBOL, BADGE
        ========================================= */
        .card {
            border: none !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05) !important;
        }

        .card-header {
            border-bottom: 2px solid #e2e8f0 !important;
            background-color: #ffffff !important;
            border-radius: 12px 12px 0 0 !important;
            padding: 20px 25px !important;
        }

        .table thead th {
            background-color: #f7fafc !important;
            color: #4a5568 !important;
            font-size: 12px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            border-bottom: 2px solid #e2e8f0 !important;
            padding: 15px !important;
        }

        .table tbody td {
            color: #1a202c !important;
            font-size: 14px !important;
            padding: 15px !important;
            border-bottom: 1px solid #edf2f7 !important;
            vertical-align: middle !important;
        }

        .table tbody tr:hover {
            background-color: #f7fafc !important;
        }

        .form-control,
        .form-select {
            border: 2px solid #e2e8f0 !important;
            border-radius: 10px !important;
            padding: 10px 15px !important;
            font-size: 14px !important;
            color: #1a202c !important;
            background-color: #f7fafc !important;
            transition: all 0.3s ease !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #008891 !important;
            background-color: #ffffff !important;
            box-shadow: 0 0 0 4px rgba(0, 136, 145, 0.1) !important;
        }

        .btn {
            border-radius: 10px !important;
            font-weight: 700 !important;
            font-size: 14px !important;
            transition: all 0.3s ease !important;
        }

        .btn-primary {
            background: linear-gradient(90deg, #00587a, #008891) !important;
            border: none !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(0, 136, 145, 0.3) !important;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #004a66, #006e75) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(0, 136, 145, 0.4) !important;
        }

        .btn-outline-primary {
            border: 2px solid #008891 !important;
            color: #008891 !important;
            background-color: transparent !important;
        }

        .btn-outline-primary:hover {
            background-color: #008891 !important;
            color: white !important;
        }

        .btn-outline-secondary {
            border: 2px solid #e2e8f0 !important;
            color: #4a5568 !important;
            background-color: white !important;
        }

        .btn-outline-secondary:hover {
            background-color: #f7fafc !important;
            border-color: #cbd5e0 !important;
            color: #1a202c !important;
        }

        .badge {
            padding: 8px 12px !important;
            border-radius: 50px !important;
            font-weight: 600 !important;
            font-size: 12px !important;
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="brand">
            <img src="{{ asset('logo-smk.jpg') }}" alt="Logo SMK">
            <div class="brand-text">
                Pengaduan Sarana
                <small>Admin Panel</small>
            </div>
        </div>
        
        <nav class="flex-grow-1 pt-2">
            <div class="nav-section">Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i> Dashboard
            </a>
            
            <div class="nav-section">Manajemen</div>
            <a href="{{ route('admin.aspirasi.index') }}" class="nav-link {{ request()->routeIs('admin.aspirasi.*') ? 'active' : '' }}">
                <i class="bi bi-inbox"></i> Aspirasi
            </a>
            <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Kategori
            </a>
        </nav>

        <div class="sidebar-bottom">
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                     style="width:38px;height:38px;font-size:.9rem;font-weight:700;color:#0f3057;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="user-info">{{ auth()->user()->name }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-logout w-100">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- TOPBAR -->
    <div class="topbar">
        <h6>@yield('page-title', 'Dashboard')</h6>
        <small><i class="bi bi-calendar3 me-1"></i>{{ now()->isoFormat('dddd, D MMMM YYYY') }}</small>
    </div>

    <!-- KONTEN UTAMA -->
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>