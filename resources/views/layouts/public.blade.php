<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('puskesmas.name'))</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #047857;
            --primary-dark: #065f46;
            --accent-color: #ffcc00;
            --teal: #0f766e;
            --sky: #0ea5e9;
            --ink: #0f172a;
            --muted: #64748b;
            --line: #e2e8f0;
            --bg-light: #f8fafc;
            --mint: #ecfdf5;
            --radius: 20px;
            --radius-sm: 12px;
            --shadow-sm: 0 2px 10px rgba(15, 23, 42, 0.06);
            --shadow-md: 0 12px 30px rgba(4, 120, 87, 0.12);
            --shadow-lg: 0 22px 50px rgba(4, 120, 87, 0.2);
            --ease: cubic-bezier(.22, 1, .36, 1);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        html { scroll-behavior: smooth; }
        body { background-color: var(--bg-light); color: #333; overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }
        img { max-width: 100%; height: auto; display: block; }

        /* =========================================================
           BREADCRUMB
        ========================================================= */
        .breadcrumb-nav {
            padding: 20px 5%;
            background: #fff;
            border-bottom: 1px solid var(--line);
        }
        .breadcrumb {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
        }
        .breadcrumb a {
            color: var(--primary-color);
            font-weight: 500;
            transition: color 0.2s;
        }
        .breadcrumb a:hover {
            color: var(--primary-dark);
        }
        .breadcrumb span {
            color: var(--muted);
        }
        .breadcrumb i {
            font-size: 10px;
            color: var(--muted);
        }
        .breadcrumb .current {
            color: var(--ink);
            font-weight: 500;
        }

        /* =========================================================
           HEADER
        ========================================================= */
        .header-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        .top-bar {
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 5%;
            height: 40px;
            font-size: 13px;
            color: #444444;
            border-bottom: 1px solid #e0e0e0;
        }
        .top-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .top-left > i { color: var(--teal); }
        .top-left .divider { color: #cccccc; margin: 0 4px; user-select: none; }
        .social-icon {
            color: #555555;
            font-size: 14px;
            text-decoration: none;
            margin: 0 2px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            transition: all 0.25s ease;
        }
        .social-icon:hover {
            transform: translateY(-2px);
        }
        .social-icon.wa:hover { color: #25D366; }
        .social-icon.ig:hover { color: #E4405F; }
        .social-icon.yt:hover { color: #FF0000; }
        .social-icon.tt:hover { color: #000000; }
        .social-icon.fb:hover { color: #1877F2; }
        .top-right {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #cccccc;
            display: inline-block;
        }

        .navbar {
            background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 5%;
            height: 75px;
            position: relative;
        }
        .logo {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            font-family: 'League Spartan', sans-serif;
            font-weight: 800;
            font-size: 18px;
            line-height: 1.1;
            text-transform: uppercase;
            gap: 12px;
        }
        .logo img {
            height: 48px;
            width: auto;
        }
        .nav-menu {
            display: flex;
            list-style: none;
            align-items: center;
            height: 100%;
        }
        .nav-item {
            position: relative;
            height: 100%;
        }
        .nav-item > a {
            color: white;
            text-decoration: none;
            padding: 0 16px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            height: 100%;
            align-items: center;
            transition: all 0.2s;
        }
        .nav-item:hover > a {
            background-color: rgba(0, 0, 0, 0.18);
            color: var(--accent-color);
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            min-width: 230px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            list-style: none;
            border-top: var(--accent-color) 4px solid;
            border-radius: 0 0 8px 8px;
            overflow: hidden;
        }
        .dropdown-menu li a {
            color: #333;
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            font-size: 13.5px;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.2s;
        }
        .dropdown-menu li a:hover {
            background-color: var(--mint);
            color: var(--primary-color);
            padding-left: 24px;
        }
        .nav-item:hover .dropdown-menu {
            display: block;
        }
        .nav-icon {
            font-size: 11px;
            margin-left: 6px;
            transition: transform 0.2s;
        }
        .nav-item:hover .nav-icon {
            transform: rotate(180deg);
        }

        /* =========================================================
           MAIN CONTENT
        ========================================================= */
        main {
            padding-top: 115px; /* Header height */
        }

        @yield('page-content')

        /* =========================================================
           FOOTER
        ========================================================= */
        .footer {
            background: linear-gradient(135deg, #047857 0%, #064e3b 60%, #022c22 100%);
            color: #ffffff;
            padding: 48px 5% 18px;
            font-size: 13px;
            position: relative;
            overflow: hidden;
        }
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-color), var(--sky), var(--accent-color));
        }
        .footer-container {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            max-width: 1400px;
            margin: 0 auto;
            flex-wrap: wrap;
        }
        .footer-col {
            flex: 1 1 210px;
        }
        .footer-col h3 {
            font-family: 'League Spartan', sans-serif;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 0.8px;
            margin-bottom: 12px;
            color: var(--accent-color);
            text-transform: uppercase;
            display: inline-block;
        }
        .footer-logo-group {
            display: flex;
            align-items: center;
            gap: 22px;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }
        .footer-logo-group img {
            height: 72px;
            width: auto;
            filter: brightness(0) invert(1);
        }
        .footer-title {
            font-size: 20px;
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 8px;
            color: #ffffff;
        }
        .footer-sub-title {
            font-size: 14px;
            letter-spacing: 1px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.8);
        }
        .footer-address {
            font-size: 13.5px;
            margin-top: 8px;
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.6;
        }
        .footer-contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            word-break: break-all;
        }
        .footer-contact-item i {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.18);
            min-width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-color);
            font-size: 12px;
        }
        .footer-links {
            list-style: none;
        }
        .footer-links li {
            margin-bottom: 6px;
        }
        .footer-links a {
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            transition: color 0.25s;
            display: inline-block;
        }
        .footer-links a:hover {
            color: var(--accent-color);
        }
        .footer-links a::before {
            content: '›';
            margin-right: 6px;
            color: var(--accent-color);
        }
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 28px;
            padding-top: 14px;
            text-align: center;
            font-size: 11.5px;
            color: rgba(255, 255, 255, 0.6);
        }
        .footer-bottom a {
            color: rgba(255, 255, 255, 0.45);
            text-decoration: none;
            margin-left: 10px;
        }
        .footer-bottom a:hover {
            color: #fff;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */
        @media (max-width: 992px) {
            .top-bar { display: none; }
            .navbar { height: 62px; padding: 0 4%; }
            .logo { font-size: 14px; gap: 8px; }
            .logo img { height: 38px; }
        }
    </style>

    @stack('styles')
</head>
<body>
    {{-- HEADER --}}
    <header class="header-wrapper" id="header-wrapper">
        <div class="top-bar">
            <div class="top-left">
                <i class="fa-solid fa-phone"></i>
                <span>(0286) 5986981</span>
                <span class="divider">|</span>
                <i class="fa-solid fa-envelope"></i>
                <span>puskesmastpkesehatan@gmail.com</span>
                <span class="divider">|</span>
                <a href="https://wa.me/6281234567890" target="_blank" class="social-icon wa" title="WhatsApp">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
                <a href="https://instagram.com/puskesmasmadukara1" target="_blank" class="social-icon ig" title="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://youtube.com" target="_blank" class="social-icon yt" title="YouTube">
                    <i class="fa-brands fa-youtube"></i>
                </a>
                <a href="https://tiktok.com" target="_blank" class="social-icon tt" title="TikTok">
                    <i class="fa-brands fa-tiktok"></i>
                </a>
                <a href="https://facebook.com" target="_blank" class="social-icon fb" title="Facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
            </div>
            <div class="top-right">
                <span id="status-dot-desktop" class="status-dot"></span>
                <span id="status-text-desktop">Memeriksa jam kerja...</span>
            </div>
        </div>

        <nav class="navbar">
            <a href="{{ route('home') }}" class="logo">
                <img src="https://www.freepnglogos.com/uploads/logo-puskesmas-png/logo-puskesmas-lambang-baru-puskesmas-puskesmas-makale-3.png" alt="Logo">
                <div>PUSKESMAS<br>MADUKARA 1</div>
            </a>

            <ul class="nav-menu">
                <li class="nav-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="nav-item dropdown-toggle">
                    <a href="javascript:void(0)">
                        <span>Tentang Kami</span>
                        <i class="fa-solid fa-chevron-down nav-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('home') }}#sambutan">Sambutan Kepala Puskesmas</a></li>
                        <li><a href="{{ route('profile') }}">Profil</a></li>
                        <li><a href="{{ route('vision-mission') }}">Visi Misi dan Tata Nilai</a></li>
                        <li><a href="{{ route('organization-structure') }}">Struktur Organisasi</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown-toggle">
                    <a href="javascript:void(0)">
                        <span>Layanan</span>
                        <i class="fa-solid fa-chevron-down nav-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('home') }}#jam-pelayanan">Jam Pelayanan</a></li>
                        <li><a href="{{ route('service-types.index') }}">Jenis Pelayanan</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown-toggle">
                    <a href="javascript:void(0)">
                        <span>Standar Layanan</span>
                        <i class="fa-solid fa-chevron-down nav-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Pelayanan Pendaftaran</a></li>
                        <li><a href="#">Pelayanan Pemeriksaan Umum</a></li>
                        <li><a href="#">Pelayanan KIA</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown-toggle">
                    <a href="javascript:void(0)">
                        <span>Standar Layanan</span>
                        <i class="fa-solid fa-chevron-down nav-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('service-standards.index') }}">Semua Standar Layanan</a></li>
                        <li><a href="{{ route('service-charter') }}">Maklumat Layanan</a></li>
                        <li><a href="{{ route('service-quality') }}">Mutu Pelayanan</a></li>
                        <li><a href="{{ route('home') }}#jam-pelayanan">Jam Pelayanan</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown-toggle">
                    <a href="javascript:void(0)">
                        <span>Informasi</span>
                        <i class="fa-solid fa-chevron-down nav-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('news.index') }}">Berita &amp; Kegiatan</a></li>
                        <li><a href="{{ route('home') }}#galeri">Galeri Foto</a></li>
                        <li><a href="{{ route('home') }}#lokasi">Lokasi</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown-toggle">
                    <a href="javascript:void(0)">
                        <span>Pengaduan</span>
                        <i class="fa-solid fa-chevron-down nav-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">SP4N Lapor</a></li>
                        <li><a href="#">WBS Puskesmas</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col">
                <div class="footer-logo-group">
                    <img src="https://kemkes.go.id/app_asset/image_content/167420049363ca45ad438f30.09191866.png" alt="Logo Kemenkes">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/f9/Lambang_Kabupaten_Banjarnegara.gif" alt="Logo Banjarnegara">
                    <img src="https://www.freepnglogos.com/uploads/logo-puskesmas-png/logo-puskesmas-lambang-baru-puskesmas-puskesmas-makale-3.png" alt="Logo">
                </div>
                <p class="footer-title"><strong>PUSKESMAS MADUKARA 1</strong></p>
                <p class="footer-sub-title">KABUPATEN BANJARNEGARA</p>
                <p class="footer-address">Jl. Raya Madukara No.KM.5, Bugar Aji, Madukara, Kec. Madukara, Kab. Banjarnegara, Jawa Tengah 53482</p>
            </div>

            <div class="footer-col">
                <h3>HUBUNGI KAMI</h3>
                <div class="footer-contact-item"><i class="fa-solid fa-phone"></i><span>(0286) 5986981</span></div>
                <div class="footer-contact-item"><i class="fa-solid fa-envelope"></i><span>puskesmastpkesehatan@gmail.com</span></div>
                <div class="footer-contact-item"><i class="fa-brands fa-whatsapp"></i><span>+62 812-3456-7890</span></div>
            </div>

            <div class="footer-col">
                <h3>STANDAR LAYANAN</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('service-standards.index') }}">Semua Standar Layanan</a></li>
                    <li><a href="{{ route('service-standards.show', 'pelayanan-pendaftaran') }}">Pelayanan Pendaftaran</a></li>
                    <li><a href="{{ route('service-standards.show', 'pelayanan-pemeriksaan-umum') }}">Pelayanan Pemeriksaan Umum</a></li>
                    <li><a href="{{ route('service-standards.show', 'pelayanan-kia') }}">Pelayanan KIA</a></li>
                    <li><a href="{{ route('service-standards.show', 'pelayanan-gigi') }}">Pelayanan Gigi</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Puskesmas Madukara 1 Kabupaten Banjarnegara. All Rights Reserved.
                <a href="{{ route('login') }}">Admin</a></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Status jam kerja
        function updateJamPelayanan() {
            const sekarang = new Date(new Date().toLocaleString('en-US', { timeZone: 'Asia/Jakarta' }));
            const hari = sekarang.getDay();
            const totalMenit = sekarang.getHours() * 60 + sekarang.getMinutes();
            const jam0730 = 7 * 60 + 30, jam1030 = 10 * 60 + 30, jam1100 = 11 * 60, jam1200 = 12 * 60;

            let buka = false;
            if (hari >= 1 && hari <= 4) buka = totalMenit >= jam0730 && totalMenit < jam1200;
            else if (hari === 5) buka = totalMenit >= jam0730 && totalMenit < jam1030;
            else if (hari === 6) buka = totalMenit >= jam0730 && totalMenit < jam1100;

            const color = buka ? '#10b981' : '#ef4444';
            const textStatus = buka ? 'Buka (Jam Kerja)' : 'Tutup (Luar Jam Kerja)';

            document.getElementById('status-dot-desktop').style.backgroundColor = color;
            document.getElementById('status-text-desktop').innerText = textStatus;
        }
        updateJamPelayanan();
        setInterval(updateJamPelayanan, 60000);
    </script>
    @stack('scripts')
</body>
</html>
