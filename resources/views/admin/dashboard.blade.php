<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Puskesmas Madukara 1</title>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        :root {
            --primary-color: #276f27;
            --primary-dark: #1b4f1b;
            --accent-color: #ffcc00;
            --sidebar-width: 260px;
            --header-height: 70px;
        }
        body { background-color: #f1f5f9; color: #333; display: flex; min-height: 100vh; }
        
        /* SIDEBAR STYLES */
        .sidebar { 
            width: var(--sidebar-width); 
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--primary-dark) 100%); 
            color: #fff; 
            position: fixed; 
            top: 0; 
            bottom: 0; 
            left: 0; 
            z-index: 100; 
            display: flex; 
            flex-direction: column; 
            box-shadow: 4px 0 10px rgba(0,0,0,0.1); 
        }
        .sidebar-brand { 
            height: var(--header-height); 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            padding: 0 20px; 
            background-color: rgba(0, 0, 0, 0.15); 
            border-bottom: 1px solid rgba(255, 255, 255, 0.1); 
        }
        .sidebar-brand img { height: 40px; }
        .sidebar-brand-text { 
            font-family: 'League Spartan', sans-serif; 
            font-weight: 800; 
            font-size: 15px; 
            line-height: 1.2; 
            text-transform: uppercase; 
            color: #fff; 
        }
        .sidebar-menu { list-style: none; padding: 15px 0; overflow-y: auto; flex: 1; }
        .menu-category { 
            font-size: 11px; 
            text-transform: uppercase; 
            font-weight: 700; 
            color: rgba(255, 255, 255, 0.5); 
            padding: 12px 20px 6px; 
            letter-spacing: 0.8px; 
        }
        .sidebar-menu li a { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            padding: 12px 20px; 
            color: rgba(255, 255, 255, 0.85); 
            text-decoration: none; 
            font-size: 13px; 
            font-weight: 500; 
            transition: all 0.2s ease; 
            border-left: 4px solid transparent; 
        }
        .sidebar-menu li a:hover, 
        .sidebar-menu li.active a { 
            background-color: rgba(255, 255, 255, 0.12); 
            color: var(--accent-color); 
            border-left-color: var(--accent-color); 
        }
        .sidebar-menu li a i { width: 20px; text-align: center; }

        /* MAIN CONTENT STYLES */
        .main-wrapper { 
            margin-left: var(--sidebar-width); 
            width: calc(100% - var(--sidebar-width)); 
            display: flex; 
            flex-direction: column; 
            min-height: 100vh; 
        }
        .top-header { 
            height: var(--header-height); 
            background-color: #fff; 
            border-bottom: 1px solid #e2e8f0; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            padding: 0 30px; 
            position: sticky; 
            top: 0; 
            z-index: 90; 
        }
        .header-title { font-size: 18px; font-weight: 700; color: #1e293b; }
        .admin-profile { display: flex; align-items: center; gap: 12px; }
        .admin-avatar { 
            width: 38px; 
            height: 38px; 
            border-radius: 50%; 
            background-color: var(--primary-color); 
            color: white; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-weight: 700; 
        }
        
        .content-body { padding: 30px; flex: 1; }

        /* STATS SUMMARY CARDS */
        .stats-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); 
            gap: 20px; 
            margin-bottom: 30px; 
        }
        .stat-card { 
            background: #fff; 
            border-radius: 12px; 
            padding: 24px; 
            border: 1px solid #e2e8f0; 
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04); 
            text-decoration: none; 
            color: inherit; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            transition: all 0.2s ease; 
        }
        .stat-card:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08); 
            border-color: #cbd5e1; 
        }
        .stat-label { 
            font-size: 13px; 
            font-weight: 500; 
            color: #64748b; 
            margin-bottom: 6px; 
        }
        .stat-value { 
            font-size: 32px; 
            font-weight: 700; 
            color: var(--primary-color); 
            line-height: 1; 
        }
        .stat-max { 
            font-size: 16px; 
            font-weight: 400; 
            color: #94a3b8; 
        }
        .stat-icon { 
            width: 52px; 
            height: 52px; 
            border-radius: 10px; 
            background: #eaf4ea; 
            color: var(--primary-color); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 22px; 
        }

        /* WELCOME BANNER CARD */
        .welcome-card {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 25px;
        }
        .welcome-card h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 6px;
        }
        .welcome-card p {
            font-size: 13.5px;
            color: #64748b;
        }

        .admin-footer { 
            background-color: #fff; 
            border-top: 1px solid #e2e8f0; 
            padding: 15px 30px; 
            text-align: center; 
            font-size: 12px; 
            color: #64748b; 
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <img src="https://www.freepnglogos.com/uploads/logo-puskesmas-png/logo-puskesmas-lambang-baru-puskesmas-puskesmas-makale-3.png" alt="Logo Puskesmas">
            <div class="sidebar-brand-text">Puskesmas<br>Madukara 1</div>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-category">Menu Utama</li>
            <li class="active"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>

            <li class="menu-category">Pengelolaan Konten</li>
            <li><a href="{{ route('admin.sliders.index') }}"><i class="fa-solid fa-images"></i> 1. Slide Aktif</a></li>
            <li><a href="{{ route('admin.news.index') }}"><i class="fa-solid fa-newspaper"></i> 2. Berita & Kegiatan</a></li>
            <li><a href="{{ route('admin.gallery.index') }}"><i class="fa-solid fa-photo-film"></i> 3. Galeri Foto</a></li>

            <li class="menu-category">Tautan</li>
            <li><a href="{{ url('/') }}" target="_blank"><i class="fa-solid fa-globe"></i> Lihat Website</a></li>
        </ul>
    </aside>

    <!-- WRAPPER UTAMA -->
    <div class="main-wrapper">
        <header class="top-header">
            <div class="header-title">Dashboard Utama</div>
            <div class="admin-profile">
                <div class="admin-avatar">A</div>
                <div><strong>Admin</strong> Puskesmas Madukara 1</div>
            </div>
        </header>

        <main class="content-body">
            <!-- WELCOME BANNER -->
            <div class="welcome-card">
                <h3>Selamat Datang di Panel Pengelolaan</h3>
                <p>Pantau metrik data terkini dan kelola seluruh konten publikasi Puskesmas Madukara 1 secara terpadu.</p>
            </div>

            <!-- STATISTIK KONTEN DARI DATABASE -->
            <div class="stats-grid">
                <!-- 1. SLIDER -->
                <a href="{{ route('admin.sliders.index') }}" class="stat-card">
                    <div>
                        <div class="stat-label">Slide Aktif</div>
                        <div class="stat-value">
                            {{ $sliderCount }}<span class="stat-max"> / 4</span>
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-images"></i>
                    </div>
                </a>

                <!-- 2. TOTAL BERITA -->
                <a href="{{ route('admin.news.index') }}" class="stat-card">
                    <div>
                        <div class="stat-label">Total Berita</div>
                        <div class="stat-value">{{ $newsCount }}</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                </a>

                <!-- 3. FOTO GALERI -->
                <a href="{{ route('admin.gallery.index') }}" class="stat-card">
                    <div>
                        <div class="stat-label">Foto Galeri</div>
                        <div class="stat-value">{{ $galleryCount }}</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-photo-film"></i>
                    </div>
                </a>
            </div>
        </main>

        <footer class="admin-footer">
            &copy; {{ date('Y') }} Panel Admin Puskesmas Madukara 1 Kabupaten Banjarnegara. All Rights Reserved.
        </footer>
    </div>

</body>
</html>