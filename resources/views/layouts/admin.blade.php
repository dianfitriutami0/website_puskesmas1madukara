<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - Admin {{ config('puskesmas.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #047857;
            --primary-dark: #065f46;
            --primary-darker: #022c22;
            --accent-color: #ffcc00;
            --teal: #0f766e;
            --ink: #0f172a;
            --muted: #64748b;
            --line: #e2e8f0;
            --bg-light: #f8fafc;
            --mint: #ecfdf5;
            --danger: #dc2626;
            --warning: #f59e0b;
            --success: #10b981;
            --radius: 16px;
            --radius-sm: 12px;
            --shadow-sm: 0 2px 10px rgba(15, 23, 42, 0.06);
            --shadow-md: 0 8px 24px rgba(4, 120, 87, 0.12);
            --ease: cubic-bezier(.22, 1, .36, 1);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--bg-light); color: #333; min-height: 100vh; }
        a { text-decoration: none; }
        button { cursor: pointer; font-family: inherit; }

        /* =========================================================
           LAYOUT STRUCTURE
        ========================================================= */
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* =========================================================
           SIDEBAR
        ========================================================= */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--primary-dark) 50%, var(--primary-darker) 100%);
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
        }

        .sidebar-brand {
            padding: 20px 24px;
            background: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .sidebar-brand img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .sidebar-brand-text {
            flex: 1;
        }

        .sidebar-brand-text .name {
            font-family: 'League Spartan', sans-serif;
            font-weight: 800;
            font-size: 14px;
            line-height: 1.2;
            text-transform: uppercase;
            color: #fff;
        }

        .sidebar-brand-text .sub {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .nav-category {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.4);
            padding: 12px 12px 6px;
            margin-top: 8px;
        }

        .nav-category:first-child {
            margin-top: 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 13.5px;
            font-weight: 500;
            border-radius: var(--radius-sm);
            transition: all 0.25s var(--ease);
            border-left: 3px solid transparent;
            margin-bottom: 4px;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 15px;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            transform: translateX(4px);
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.15);
            color: var(--accent-color);
            border-left-color: var(--accent-color);
        }

        .nav-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 12px 12px;
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.15);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 12px;
            background: rgba(220, 38, 38, 0.15);
            color: #fca5a5;
            border: 1px solid rgba(220, 38, 38, 0.3);
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 600;
            transition: all 0.25s var(--ease);
        }

        .logout-btn:hover {
            background: rgba(220, 38, 38, 0.3);
            color: #fff;
            transform: translateY(-2px);
        }

        /* =========================================================
           MAIN CONTENT AREA
        ========================================================= */
        .main-content {
            flex: 1;
            margin-left: 280px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Top Header */
        .top-header {
            background: #fff;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: var(--shadow-sm);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .page-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--ink);
        }

        .page-title span {
            color: var(--primary-color);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--muted);
        }

        .breadcrumb a {
            color: var(--primary-color);
            transition: color 0.2s;
        }

        .breadcrumb a:hover {
            color: var(--primary-dark);
        }

        .breadcrumb i {
            font-size: 8px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .view-website-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: #fff;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.25s var(--ease);
        }

        .view-website-btn:hover {
            background: var(--primary-color);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(4, 120, 87, 0.3);
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: var(--mint);
            border-radius: 999px;
        }

        .admin-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--teal));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
        }

        .admin-details {
            display: flex;
            flex-direction: column;
        }

        .admin-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
        }

        .admin-role {
            font-size: 11px;
            color: var(--muted);
        }

        /* Content Body */
        .content-body {
            flex: 1;
            padding: 32px;
        }

        /* =========================================================
           CARDS & COMPONENTS
        ========================================================= */
        .card {
            background: #fff;
            border-radius: var(--radius);
            padding: 24px;
            border: 1px solid var(--line);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s var(--ease);
        }

        .card:hover {
            box-shadow: var(--shadow-md);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--line);
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            color: var(--primary-color);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.25s var(--ease);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--teal));
            color: #fff;
            box-shadow: 0 4px 12px rgba(4, 120, 87, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(4, 120, 87, 0.4);
        }

        .btn-secondary {
            background: #fff;
            color: var(--primary-color);
            border: 1px solid rgba(4, 120, 87, 0.3);
        }

        .btn-secondary:hover {
            background: var(--primary-color);
            color: #fff;
        }

        .btn-danger {
            background: rgba(220, 38, 38, 0.1);
            color: var(--danger);
            border: 1px solid rgba(220, 38, 38, 0.2);
        }

        .btn-danger:hover {
            background: var(--danger);
            color: #fff;
        }

        .btn-sm {
            padding: 8px 14px;
            font-size: 12px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--line);
            border-radius: var(--radius-sm);
            font-size: 14px;
            font-family: inherit;
            transition: all 0.25s var(--ease);
            background: #fff;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(4, 120, 87, 0.1);
        }

        .form-input::placeholder {
            color: #94a3b8;
        }

        textarea.form-input {
            resize: vertical;
            min-height: 120px;
        }

        .form-hint {
            font-size: 12px;
            color: var(--muted);
            margin-top: 6px;
        }

        /* Alerts */
        .alert {
            padding: 16px 20px;
            border-radius: var(--radius-sm);
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #047857;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .alert-error {
            background: rgba(220, 38, 38, 0.1);
            color: var(--danger);
            border: 1px solid rgba(220, 38, 38, 0.2);
        }

        .alert i {
            font-size: 18px;
        }

        /* Table */
        .table-wrapper {
            overflow-x: auto;
            border-radius: var(--radius-sm);
            border: 1px solid var(--line);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }

        .data-table thead {
            background: var(--bg-light);
        }

        .data-table th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
            color: var(--muted);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--line);
        }

        .data-table td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--line);
            color: var(--ink);
        }

        .data-table tbody tr {
            transition: background 0.2s;
        }

        .data-table tbody tr:hover {
            background: var(--mint);
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Action Links */
        .action-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s var(--ease);
        }

        .action-edit {
            color: var(--primary-color);
            background: var(--mint);
        }

        .action-edit:hover {
            background: var(--primary-color);
            color: #fff;
        }

        .action-delete {
            color: var(--danger);
            background: rgba(220, 38, 38, 0.08);
        }

        .action-delete:hover {
            background: var(--danger);
            color: #fff;
        }

        /* Image Thumbnail */
        .thumb {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid var(--line);
        }

        .thumb-lg {
            width: 120px;
            height: 80px;
        }

        /* Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-primary {
            background: var(--mint);
            color: var(--primary-color);
        }

        .badge-warning {
            background: #fef3c7;
            color: #b45309;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 48px 24px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-state p {
            font-size: 14px;
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 24px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            gap: 4px;
        }

        .pagination a,
        .pagination span {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            background: #fff;
            border: 1px solid var(--line);
            transition: all 0.2s;
        }

        .pagination a:hover {
            background: var(--mint);
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .pagination .active {
            background: var(--primary-color);
            color: #fff;
            border-color: var(--primary-color);
        }

        /* Grid System */
        .grid {
            display: grid;
            gap: 24px;
        }

        .grid-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        .grid-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .grid-4 {
            grid-template-columns: repeat(4, 1fr);
        }

        @media (max-width: 1200px) {
            .grid-4 { grid-template-columns: repeat(3, 1fr); }
        }

        @media (max-width: 992px) {
            .grid-3, .grid-4 { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s var(--ease);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .grid-2, .grid-3, .grid-4 {
                grid-template-columns: 1fr;
            }

            .content-body {
                padding: 20px;
            }

            .top-header {
                padding: 12px 20px;
            }
        }

        /* File Upload Styling */
        .file-upload {
            display: block;
            width: 100%;
            padding: 12px 16px;
            border: 2px dashed var(--line);
            border-radius: var(--radius-sm);
            text-align: center;
            cursor: pointer;
            transition: all 0.25s var(--ease);
            background: var(--bg-light);
        }

        .file-upload:hover {
            border-color: var(--primary-color);
            background: var(--mint);
        }

        .file-upload input[type="file"] {
            display: none;
        }

        .file-upload i {
            font-size: 24px;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .file-upload p {
            font-size: 13px;
            color: var(--muted);
        }

        .file-upload .highlight {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Checkbox & Radio */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary-color);
        }

        /* Footer */
        .admin-footer {
            background: #fff;
            padding: 16px 32px;
            border-top: 1px solid var(--line);
            text-align: center;
            font-size: 12px;
            color: var(--muted);
        }
    </style>
</head>
<body>
@php
    $menus = [
        ['admin.dashboard',        'Dashboard',           'admin.dashboard', 'fa-gauge'],
        ['admin.sliders.index',    'Slider Utama',        'admin.sliders.*', 'fa-images'],
        ['admin.sambutan.edit',   'Sambutan Kepala',     'admin.sambutan.*', 'fa-user-doctor'],
        ['admin.hours.edit',      'Jam Pelayanan',       'admin.hours.*', 'fa-clock'],
        ['admin.news.index',      'Berita & Kegiatan',    'admin.news.*', 'fa-newspaper'],
        ['admin.gallery.index',   'Galeri Foto',         'admin.gallery.*', 'fa-photo-film'],
        ['admin.profiles.edit',   'Profil & Visi Misi', 'admin.profiles.*', 'fa-building'],
        ['admin.organization-structures.index', 'Struktur Organisasi', 'admin.organization-structures.*', 'fa-sitemap'],
        ['admin.service-types.index', 'Jenis Layanan', 'admin.service-types.*', 'fa-stethoscope'],
        ['admin.service-standards.index', 'Standar Layanan', 'admin.service-standards.*', 'fa-list-check'],
        ['admin.service-charters.edit', 'Maklumat Layanan', 'admin.service-charters.*', 'fa-scroll'],
        ['admin.service-qualities.edit', 'Mutu Pelayanan', 'admin.service-qualities.*', 'fa-award'],
    ];
@endphp

<div class="admin-layout">
    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="https://www.freepnglogos.com/uploads/logo-puskesmas-png/logo-puskesmas-lambang-baru-puskesmas-puskesmas-makale-3.png" alt="Logo">
            <div class="sidebar-brand-text">
                <div class="name">Puskesmas<br>Madukara 1</div>
                <div class="sub">Panel Administrator</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-category">Menu Utama</div>
            @foreach ($menus as [$route, $label, $pattern, $icon])
                <a href="{{ route($route) }}"
                   class="nav-item {{ request()->routeIs($pattern) ? 'active' : '' }}">
                    <i class="fa-solid {{ $icon }}"></i>
                    <span>{{ $label }}</span>
                </a>
            @endforeach

            <div class="nav-divider"></div>

            <div class="nav-category">Aksi Cepat</div>
            <a href="{{ route('home') }}" target="_blank" class="nav-item">
                <i class="fa-solid fa-globe"></i>
                <span>Lihat Website</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <header class="top-header">
            <div class="header-left">
                <h1 class="page-title">@yield('heading', 'Dashboard')</h1>
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-home"></i></a>
                    <i class="fa-solid fa-chevron-right"></i>
                    <span>@yield('breadcrumb', 'Dashboard')</span>
                </div>
            </div>
            <div class="header-right">
                <a href="{{ route('home') }}" target="_blank" class="view-website-btn">
                    <i class="fa-solid fa-external-link-alt"></i>
                    <span>Lihat Website</span>
                </a>
                <div class="admin-info">
                    <div class="admin-avatar">A</div>
                    <div class="admin-details">
                        <span class="admin-name">Admin</span>
                        <span class="admin-role">Puskesmas Madukara 1</span>
                    </div>
                </div>
            </div>
        </header>

        <main class="content-body">
            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <div>
                        <strong>Terjadi kesalahan:</strong>
                        <ul style="margin-top: 4px; margin-left: 16px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="admin-footer">
            &copy; {{ date('Y') }} Panel Admin Puskesmas Madukara 1 Kabupaten Banjarnegara. All Rights Reserved.
        </footer>
    </div>
</div>

<script>
    // Mobile sidebar toggle
    document.addEventListener('DOMContentLoaded', function() {
        // Add responsive sidebar toggle for mobile if needed
    });
</script>
</body>
</html>
