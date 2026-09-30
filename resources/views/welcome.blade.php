<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puskesmas Madukara 1</title>
    <!-- Google Fonts & Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        :root {
            --primary-color: #276f27;
            --primary-dark: #1b4f1b;
            --accent-color: #ffcc00;
            --bg-light: #f8f9fa;
        }
        body {
            background-color: var(--bg-light);
            color: #333;
            overflow-x: hidden;
        }
        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* HEADER FIXED WRAPPER */
        .header-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* TOP BAR DESKTOP */
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
        .top-left > i {
            color: #008080; 
        }
        .top-left .divider {
            color: #cccccc;
            margin: 0 4px;
            user-select: none;
        }
        .top-left .social-icon {
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
        .top-left .social-icon.wa:hover {
            color: #25D366;
            background-color: rgba(37, 211, 102, 0.1);
            transform: translateY(-2px);
        }
        .top-left .social-icon.ig:hover {
            color: #E4405F;
            background-color: rgba(228, 64, 95, 0.1);
            transform: translateY(-2px);
        }
        .top-left .social-icon.yt:hover {
            color: #FF0000;
            background-color: rgba(255, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        .top-left .social-icon.tt:hover {
            color: #000000;
            background-color: rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }
        .top-left .social-icon.fb:hover {
            color: #1877F2;
            background-color: rgba(24, 119, 242, 0.1);
            transform: translateY(-2px);
        }
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
        .status-dot.open {
            background-color: #2ec4b6; 
            box-shadow: 0 0 6px rgba(46, 196, 182, 0.6);
        }
        .status-dot.closed {
            background-color: #e63946; 
        }

        /* NAVBAR UTAMA DESKTOP */
        .navbar {
            background-color: var(--primary-color);
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
        .mobile-status-bar {
            display: none;
        }
        .mobile-toggle {
            display: none;
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            width: 44px;
            height: 44px;
            border-radius: 8px;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .mobile-toggle:active {
            transform: scale(0.95);
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
            background-color: var(--primary-dark);
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
            transition: background 0.2s;
        }
        .dropdown-menu li a:hover {
            background-color: #f4f6f4;
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
        .search-btn {
            background-color: white;
            color: var(--primary-color);
            border: none;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 12px;
            transition: all 0.2s;
        }
        .search-btn:hover {
            background-color: var(--accent-color);
        }
        .mobile-search {
            display: none;
            padding: 12px 16px;
            border-bottom: 1px solid #eef2f5;
        }
        .mobile-search-box {
            display: flex;
            background: #f1f5f9;
            border-radius: 8px;
            padding: 6px 12px;
            align-items: center;
        }
        .mobile-search-box input {
            border: none;
            background: transparent;
            width: 100%;
            padding: 6px 8px;
            font-size: 14px;
            outline: none;
        }
        .mobile-search-box i {
            color: #888;
        }

        /* Carousel Section */
        .carousel-container {
            position: relative;
            width: 100%;
            height: clamp(250px, 45vw, 520px);
            overflow: hidden;
            background-color: #ddd;
        }
        .carousel-track {
            display: flex;
            width: 100%;
            height: 100%;
            transition: transform 0.5s ease-in-out;
        }
        .carousel-slide {
            min-width: 100%;
            height: 100%;
        }
        .carousel-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.85);
            color: #000;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        .prev-btn { left: 15px; }
        .next-btn { right: 15px; }
        .carousel-dots {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            background-color: rgba(0, 0, 0, 0.3);
            padding: 6px 12px;
            border-radius: 20px;
        }
        .dot {
            width: 8px;
            height: 8px;
            background-color: #fff;
            opacity: 0.6;
            border-radius: 50%;
            cursor: pointer;
        }
        .dot.active {
            opacity: 1;
            background-color: var(--accent-color);
            transform: scale(1.2);
        }

       /* Sambutan Section */
        .welcome-section {
            padding: 35px 5%;
            background-color: #f8fafc;
            overflow: hidden; 
        }
        .welcome-container {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 290px 1fr; 
            gap: 20px; 
            align-items: stretch; 
        }
        .welcome-profile-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 12px; 
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.04);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            
            animation: slideInLeft 1s cubic-bezier(0.25, 1, 0.5, 1) forwards;
        }
        @keyframes slideInLeft {
            0% {
                opacity: 0;
                transform: translateX(-80px); 
            }
            100% {
                opacity: 1;
                transform: translateX(0); 
            }
        }
        .welcome-photo-frame {
            position: relative;
            width: 100%;
            flex: 1;
            min-height: 240px;
            border-radius: 10px;
            overflow: hidden;
        }
        .welcome-photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top;
            transition: transform 0.4s ease;
        }
        .welcome-profile-card:hover .welcome-photo-frame img {
            transform: scale(1.03);
        }
        .welcome-profile-info {
            padding-top: 10px;
            padding-bottom: 2px;
        }
        .welcome-profile-info h3 {
            font-size: 14px;
            font-weight: 800;
            color: #003a3a;
            margin-bottom: 2px;
        }
        .welcome-profile-info p {
            font-size: 11px;
            color: var(--accent-color, #e76f51);
            font-weight: 600;
            margin: 0;
        }
        .welcome-text-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 20px 25px; 
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;

            animation: slideInRight 1s cubic-bezier(0.25, 1, 0.5, 1) forwards;
        }
        @keyframes slideInRight {
            0% {
                opacity: 0;
                transform: translateX(80px); 
            }
            100% {
                opacity: 1;
                transform: translateX(0); 
            }
        }
        .welcome-tag {
            color: var(--primary-color, #008080);
            background: rgba(0, 128, 128, 0.08);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.8px;
            padding: 3px 10px;
            border-radius: 15px;
            display: inline-block;
            margin-bottom: 15px;
        }
        .welcome-header h2 {
            font-family: 'League Spartan', sans-serif;
            font-size: 21px; /* Ukuran font disesuaikan agar lebih padat */
            font-weight: 800;
            color: #003a3a;
            line-height: 1.25;
            margin-bottom: 12px;
        }
        .welcome-quote-box {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background-color: #fff9f5;
            border-left: 3px solid var(--accent-color, #f4a261);
            padding: 10px 14px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 12px;
        }
        .welcome-quote-box i {
            font-size: 14px;
            color: var(--accent-color, #f4a261);
            margin-top: 2px;
        }
        .welcome-quote-box p {
            font-size: 12px;
            font-style: italic;
            font-weight: 600;
            color: #333333;
            margin: 0;
            line-height: 1.45;
        }
        .welcome-body-text p {
            font-size: 12.5px;
            line-height: 1.55;
            color: #555555;
            margin-bottom: 8px;
        }
        .welcome-body-text p:last-child {
            margin-bottom: 0;
        }
        @media (max-width: 992px) {
            .welcome-container {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .welcome-photo-frame {
                height: 280px;
            }

            .welcome-text-card {
                padding: 18px 16px;
            }

            .welcome-header h2 {
                font-size: 19px;
            }
        }

       /* FOOTER SECTION (MODERN & PREMIUM DESIGN) */
        .footer {
            background: linear-gradient(135deg, var(--primary-color, #005f5f) 0%, #003a3a 100%);
            color: #ffffff;
            padding: 40px 5% 18px;
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
            height: 3px;
            background: linear-gradient(90deg, var(--accent-color, #f4a261), #2ec4b6, var(--accent-color, #f4a261));
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
            color: var(--accent-color, #f4a261);
            text-transform: uppercase;
            display: inline-block;
            position: relative;
        }

        .footer-col h3::after {
            content: '';
            display: block;
            width: 25px;
            height: 2px;
            background-color: var(--accent-color, #f4a261);
            margin-top: 4px;
            border-radius: 2px;
        }

        .footer-col h3.sub-heading {
            margin-top: 18px;
        }

        /* Logo & Teks Brand */
        .footer-logo-group {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }

        .footer-logo-group img {
            height: 90px;
            width: auto;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
            transition: transform 0.3s ease;
        }

        .footer-logo-group img:hover {
            transform: scale(1.08);
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
            font-size: 14px;
            margin-top: 8px;
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.45;
        }

        .footer-contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            word-break: break-all;
            transition: transform 0.2s ease;
        }

        .footer-contact-item:hover {
            transform: translateX(4px); 
        }

        .footer-contact-item a, 
        .footer-contact-item span {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: color 0.2s ease;
            font-size: 12.5px;
        }

        .footer-contact-item a:hover {
            color: #ffffff;
        }

        .footer-contact-item i {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            min-width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-color, #f4a261);
            font-size: 12px;
            transition: all 0.3s ease;
        }

        .footer-contact-item:hover i {
            background: var(--accent-color, #f4a261);
            color: #003a3a;
            box-shadow: 0 0 10px rgba(244, 162, 97, 0.5);
        }

        /* Daftar Tautan Layanan (Panah Geser) */
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 6px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            transition: all 0.25s ease;
            font-size: 12.5px;
            display: inline-block;
        }

        .footer-links a:hover {
            color: var(--accent-color, #f4a261);
            transform: translateX(5px); 
        }

        .footer-links a::before {
            content: '›';
            margin-right: 6px;
            color: var(--accent-color, #f4a261);
            font-weight: bold;
            opacity: 0.6;
            transition: opacity 0.2s;
        }

        .footer-links a:hover::before {
            opacity: 1;
        }
        .visitor-stats {
            list-style: none;
            padding: 0;
            margin: 0;
            background: rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 10px;
            padding: 12px 14px;
        }

        .visitor-stats li {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            border-bottom: 1px dashed rgba(255, 255, 255, 0.12);
            padding-bottom: 4px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
        }

        .visitor-stats li:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .visitor-stats .val {
            color: var(--accent-color, #f4a261);
            font-weight: 700;
            font-family: 'Courier New', Courier, monospace;
            letter-spacing: 0.5px;
        }

        /* Copyright Bar Bawah */
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 25px;
            padding-top: 14px;
            text-align: center;
            font-size: 11.5px;
            color: rgba(255, 255, 255, 0.6);
        }

        /* OPTIMASI NAVBAR KHUSUS LAYAR MOBILE (HP) */
        @media (max-width: 992px) {
            .top-bar {
                display: none;
            }

            .navbar {
                height: 62px;
                padding: 0 4%;
            }

            .logo {
                font-size: 14px;
                gap: 8px;
            }

            .logo img {
                height: 38px;
            }

            .mobile-toggle {
                display: flex; 
            }

            .search-btn {
                display: none;
            }

            .mobile-search {
                display: block;
            }
            .nav-menu {
                position: fixed;
                top: 62px;
                left: 0;
                width: 100%;
                height: calc(100vh - 62px);
                background-color: #ffffff;
                flex-direction: column;
                align-items: stretch;
                justify-content: flex-start;
                padding: 0 0 30px 0;
                overflow-y: auto;
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
                
                opacity: 0;
                visibility: hidden;
                transform: translateY(-10px);
                transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .nav-menu.active {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }

            .mobile-status-bar {
                background: #f1f5f9;
                padding: 10px 16px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                font-size: 12px;
                color: #475569;
                border-bottom: 1px solid #e2e8f0;
            }
            .nav-item {
                width: 100%;
                height: auto;
                border-bottom: 1px solid #f1f5f9;
            }

            .nav-item > a {
                color: #1e293b;
                padding: 14px 20px;
                font-size: 14.5px;
                font-weight: 600;
                justify-content: space-between;
                background-color: #ffffff;
            }

            .nav-item > a:hover,
            .nav-item.open > a {
                background-color: #f8fafc;
                color: var(--primary-color);
            }

            .dropdown-menu {
                position: static;
                box-shadow: none;
                background-color: #f8fafc;
                border-top: none;
                border-radius: 0;
                display: none;
                padding: 4px 0;
            }

            .dropdown-menu li a {
                padding: 11px 20px 11px 35px;
                font-size: 13.5px;
                color: #475569;
                border-bottom: 1px dashed #e2e8f0;
            }

            .dropdown-menu li a:hover {
                background-color: #e2e8f0;
                color: var(--primary-color);
            }

            .nav-item.open .nav-icon {
                transform: rotate(180deg);
                color: var(--primary-color);
            }

            .nav-item.open .dropdown-menu {
                display: block;
            }

            .sambutan-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <!-- Header atas navbar -->
    <header class="header-wrapper" id="header-wrapper">
       <div class="top-bar">
            <div class="top-left">
                <i class="fa-solid fa-phone"></i>
                <span>(0286) 5986981</span>
                <span class="divider">|</span>
                <i class="fa-solid fa-envelope"></i>
                <span>puskesmas.madukara1@gmail.com</span>
                <span class="divider">|</span>
                <a href="https://wa.me/6281234567890" target="_blank" title="WhatsApp" class="social-icon wa">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
                <a href="https://instagram.com/puskesmasmadukara1" target="_blank" title="Instagram" class="social-icon ig">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://youtube.com" target="_blank" title="YouTube" class="social-icon yt">
                    <i class="fa-brands fa-youtube"></i>
                </a>
                <a href="https://tiktok.com" target="_blank" title="TikTok" class="social-icon tt">
                    <i class="fa-brands fa-tiktok"></i>
                </a>
                <a href="https://facebook.com" target="_blank" title="Facebook" class="social-icon fb">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
            </div>

            <div class="top-right">
                <span id="status-dot-desktop" class="status-dot"></span> 
                <span id="status-text-desktop">Memeriksa jam kerja...</span>
            </div>
        </div>

            <!-- Navbar -->
        <nav class="navbar">
            <a href="#" class="logo">
                <img src="https://www.freepnglogos.com/uploads/logo-puskesmas-png/logo-puskesmas-lambang-baru-puskesmas-puskesmas-makale-3.png" alt="Logo Puskesmas">
                <div>PUSKESMAS<br>MADUKARA 1</div>
            </a>

            <button class="mobile-toggle" id="mobile-toggle" aria-label="Menu Utama">
                <i class="fa-solid fa-bars"></i>
            </button>
            
            <ul class="nav-menu" id="nav-menu">
                
                <li class="mobile-status-bar">
                    <span><i class="fa-solid fa-clock" style="color:var(--primary-color);"></i> Jam Pelayanan:</span>
                    <div>
                        <span id="status-dot-mobile" class="status-dot"></span>
                        <span id="status-text-mobile" style="font-weight: 600;">-</span>
                    </div>
                </li>

                <li class="mobile-search">
                    <div class="mobile-search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Cari layanan atau berita...">
                    </div>
                </li>

                <li class="nav-item"><a href="#">Beranda</a></li>

                <li class="nav-item dropdown-toggle">
                    <a href="javascript:void(0)">
                        <span>Tentang Kami</span>
                        <i class="fa-solid fa-chevron-down nav-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#visi-misi">Profil</a></li>
                        <li><a href="#visi-misi">Visi Misi dan Motto</a></li>
                        <li><a href="#tata-nilai">Tata Nilai</a></li>
                        <li><a href="#struktur">Struktur Organisasi</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown-toggle">
                    <a href="javascript:void(0)">
                        <span>Layanan</span>
                        <i class="fa-solid fa-chevron-down nav-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#jenis-pelayanan">Jenis Pelayanan</a></li>
                        <li><a href="#maklumat">Maklumat Pelayanan</a></li>
                        <li><a href="#mutu">Mutu Pelayanan</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown-toggle">
                    <a href="javascript:void(0)">
                        <span>Standar Layanan</span>
                        <i class="fa-solid fa-chevron-down nav-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#pendaftaran">Pelayanan Pendaftaran</a></li>
                        <li><a href="#pemeriksaan-umum">Pelayanan Pemeriksaan Umum</a></li>
                        <li><a href="#kia">Pelayanan Tindakan Umum</a></li>
                        <li><a href="#gigi">Pelayanan Kesehatan Ibu dan Anak</a></li>
                        <li><a href="#laboratorium">Pelayanan Imunisasi</a></li>
                        <li><a href="#kefarmasian">Pelayanan Gigi dan Mulut</a></li>
                        <li><a href="#kefarmasian">Pelayanan Laboratorium</a></li>
                        <li><a href="#kefarmasian">Pelayanan Kasir</a></li>
                        <li><a href="#kefarmasian">Pelayanan Obat dan Kefarmasian</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown-toggle">
                    <a href="javascript:void(0)">
                        <span>Informasi</span>
                        <i class="fa-solid fa-chevron-down nav-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#berita">Berita & Kegiatan</a></li>
                        <li><a href="#kontak">Kontak Kami</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown-toggle">
                    <a href="javascript:void(0)">
                        <span>Pengaduan</span>
                        <i class="fa-solid fa-chevron-down nav-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#sp4n">SP4N Lapor</a></li>
                        <li><a href="#wbs">WBS Puseksmas<br>Madukara 1</a></li>
                        <li><a href="#alur-pengaduan">Alur Pengaduan</a></li>
                        <li><a href="#alur-pengaduan">Mekanisme Pengaduan</a></li>
                    </ul>
                </li>

                <li>
                    <button class="search-btn" title="Cari Informasi">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </li>
            </ul>
        </nav>
    </header>

    <!-- CAROUSEL SLIDER -->
    <div class="carousel-container">
        <div class="carousel-track">
            @forelse($carousels as $item)
                <div class="carousel-slide">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title ?? 'Carousel Image' }}">
                </div>
            @empty
                <div class="carousel-slide">
                    <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1200&q=80" alt="Default">
                </div>
            @endforelse
            @foreach(\App\Models\CarouselBanner::all() as $item)
                <div class="carousel-item">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                </div>
            @endforeach
        </div>
    </div>


   <!-- SEKSI SAMBUTAN KEPALA PUSKESMAS -->
    <section class="welcome-section">
    <div class="welcome-container">
        
        <div class="welcome-profile-card">
            <div class="welcome-photo-frame">
                <img src="{{ isset($pimpinan) && $pimpinan->foto ? asset('storage/' . $pimpinan->foto) : 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=800&q=80' }}" alt="Foto Pimpinan">
            </div>
            <div class="welcome-profile-info">
                <h3>{{ $pimpinan->nama ?? 'dr. Nama Kepala Puskesmas' }}</h3>
                <p>{{ $pimpinan->jabatan ?? 'Kepala Puskesmas Madukara 1' }}</p>
            </div>
        </div>

        <div class="welcome-text-card">
            <div class="welcome-header">
                <span class="welcome-tag">SAMBUTAN PIMPINAN</span>
                <h2>Selamat Datang di Website Resmi Puskesmas Madukara 1</h2>
            </div>

            <div class="welcome-quote-box">
                <i class="fa-solid fa-quote-left"></i>
                <p>"{{ $pimpinan->quote ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' }}"</p>
            </div>

            <div class="welcome-body-text">
                @if(isset($pimpinan) && $pimpinan->sambutan)
                    {!! nl2br(e($pimpinan->sambutan)) !!}
                @else
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.
                    </p>
                    <p>
                        Pellentesque in ipsum id orci porta dapibus. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Proin eget tortor risus. Cras ultricies ligula sed magna dictum porta.
                    </p>
                @endif
                @php $pimpinan = \App\Models\ProfilPimpinan::first(); @endphp

                @if($pimpinan)
                    <img src="{{ asset('storage/' . $pimpinan->foto) }}" alt="Foto Pimpinan">
                    <h3>{{ $pimpinan->nama_pimpinan }}</h3>
                    <p>{{ $pimpinan->jabatan }}</p>
                    <p>{{ $pimpinan->kata_sambutan }}</p>
                @endif
            </div>
        </div>
    </div>
    </section>

     <!-- FOOTER SECTION -->
    <footer class="footer" id="kontak">
        <div class="footer-container">

            <div class="footer-col">
                <div class="footer-logo-group">
                    <img src="https://kemkes.go.id/app_asset/image_content/167420049363ca45ad438f30.09191866.png" alt="Logo Kemenkes">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/f9/Lambang_Kabupaten_Banjarnegara.gif" alt="Logo Banjarnegara">
                    <img src="https://www.freepnglogos.com/uploads/logo-puskesmas-png/logo-puskesmas-lambang-baru-puskesmas-puskesmas-makale-3.png" alt="Logo Puskesmas">
                </div>
                
                <p class="footer-title">
                    <strong>PUSKESMAS MADUKARA 1</strong><br>
                    <span class="footer-sub-title">KABUPATEN BANJARNEGARA</span>
                </p>
                
                <p class="footer-address">
                    Jl. Raya Madukara No.KM.5, Bugar Aji, Madukara, Kec. Madukara, Kab. Banjarnegara, Jawa Tengah 53482
                </p>
            </div>

            <div class="footer-col">
                <h3>HUBUNGI KAMI</h3>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-phone"></i>
                    <span>(0286) 5986981</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-envelope"></i>
                    <span>puskesmas.madukara1@gmail.com</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-brands fa-whatsapp"></i>
                    <a href="https://wa.me/6281234567890" target="_blank">+62 812-3456-7890</a>
                </div>

                <h3 class="sub-heading">SOSIAL MEDIA</h3>
                <div class="footer-contact-item">
                    <i class="fa-brands fa-instagram"></i>
                    <a href="https://instagram.com/puskesmasmadukara1" target="_blank">@puskesmasmadukara1</a>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-brands fa-youtube"></i>
                    <a href="https://youtube.com" target="_blank">Puskesmas Madukara 1</a>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-brands fa-tiktok"></i>
                    <a href="https://tiktok.com" target="_blank">@puskesmasmadukara1</a>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-brands fa-facebook-f"></i>
                    <a href="https://facebook.com" target="_blank">Puskesmas Madukara 1</a>
                </div>
            </div>

            <div class="footer-col">
                <h3>STANDAR LAYANAN</h3>
                <ul class="footer-links">
                    <li><a href="#pendaftaran">Pelayanan Pendaftaran</a></li>
                    <li><a href="#pemeriksaan-umum">Pelayanan Pemeriksaan Umum</a></li>
                    <li><a href="#tindakan-umum">Pelayanan Tindakan Umum</a></li>
                    <li><a href="#kia">Pelayanan Kesehatan Ibu dan Anak</a></li>
                    <li><a href="#imunisasi">Pelayanan Imunisasi</a></li>
                    <li><a href="#gigi">Pelayanan Gigi dan Mulut</a></li>
                    <li><a href="#laboratorium">Pelayanan Laboratorium</a></li>
                    <li><a href="#kasir">Pelayanan Kasir</a></li>
                    <li><a href="#farmasi">Pelayanan Obat dan Kefarmasian</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>PENGUNJUNG</h3>
                <ul class="visitor-stats">
                    <li><span>Hari Ini:</span> <span class="val">32</span></li>
                    <li><span>Kemarin:</span> <span class="val">120</span></li>
                    <li><span>Bulan Ini:</span> <span class="val">750</span></li>
                    <li><span>Total:</span> <span class="val">25,240</span></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 Puskesmas Madukara 1 Kabupaten Banjarnegara. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- SCRIPT JAVASCRIPT -->
    <script>
        const mobileToggle = document.getElementById('mobile-toggle');
        const navMenu = document.getElementById('nav-menu');
        const headerWrapper = document.getElementById('header-wrapper');

        // Toggle Buka/Tutup Menu Mobile
        mobileToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            const icon = mobileToggle.querySelector('i');
            
            if (navMenu.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-xmark');
                document.body.style.overflow = 'hidden'; // Mencegah scroll halaman saat menu buka
            } else {
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');
                document.body.style.overflow = 'auto';
            }
        });

        // Dropdown Sub-menu Accordion Khusus Layar HP
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        dropdownToggles.forEach(item => {
            const link = item.querySelector('a');
            link.addEventListener('click', (e) => {
                if (window.innerWidth <= 992) {
                    e.preventDefault();
                    
                    // Tutup dropdown lain yang terbuka (Accordion Mode)
                    dropdownToggles.forEach(other => {
                        if (other !== item) other.classList.remove('open');
                    });

                    item.classList.toggle('open');
                }
            });
        });

        // Menyesuaikan Padding Atas Body Sesuai Tinggi Header Aktual
        function syncHeaderPadding() {
            const headerHeight = headerWrapper.offsetHeight;
            document.body.style.paddingTop = headerHeight + 'px';
        }
        window.addEventListener('load', syncHeaderPadding);
        window.addEventListener('resize', syncHeaderPadding);

        // Jam Pelayanan Otomatis (Desktop & Mobile Sync)
        function updateJamPelayanan() {
            const sekarang = new Date(new Date().toLocaleString("en-US", { timeZone: "Asia/Jakarta" }));
            const hari = sekarang.getDay(); 
            const jam = sekarang.getHours();
            const menit = sekarang.getMinutes();
            const totalMenit = (jam * 60) + menit;

            const jam0730 = (7 * 60) + 30;  
            const jam1030 = (10 * 60) + 30; 
            const jam1100 = (11 * 60) + 0;  
            const jam1200 = (12 * 60) + 0;  

            let buka = false;
            if (hari >= 1 && hari <= 4) {
                if (totalMenit >= jam0730 && totalMenit < jam1200) buka = true;
            } else if (hari === 5) {
                if (totalMenit >= jam0730 && totalMenit < jam1030) buka = true;
            } else if (hari === 6) {
                if (totalMenit >= jam0730 && totalMenit < jam1100) buka = true;
            }

            const color = buka ? '#10b981' : '#ef4444';
            const textStatus = buka ? 'Buka (Jam Kerja)' : 'Tutup (Luar Jam Kerja)';

            // Update UI Desktop
            const dotD = document.getElementById('status-dot-desktop');
            const textD = document.getElementById('status-text-desktop');
            if(dotD && textD) {
                dotD.style.backgroundColor = color;
                textD.innerText = textStatus;
            }

            // Update UI Mobile
            const dotM = document.getElementById('status-dot-mobile');
            const textM = document.getElementById('status-text-mobile');
            if(dotM && textM) {
                dotM.style.backgroundColor = color;
                textM.innerText = textStatus;
                textM.style.color = color;
            }
        }
        updateJamPelayanan();
        setInterval(updateJamPelayanan, 60000);

        // Carousel Slider Simple
        let slideIndex = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.dot');
        const track = document.querySelector('.carousel-track');

        function updateCarousel() {
            if (track) track.style.transform = `translateX(-${slideIndex * 100}%)`;
            dots.forEach((dot, index) => dot.classList.toggle('active', index === slideIndex));
        }

        function moveSlide(step) {
            slideIndex = (slideIndex + step + slides.length) % slides.length;
            updateCarousel();
        }

        function currentSlide(index) {
            slideIndex = index;
            updateCarousel();
        }

        setInterval(() => moveSlide(1), 5000);


    document.addEventListener("DOMContentLoaded", function() {
        const observerOptions = {
            threshold: 0.2 // Animasi terpicu saat 20% elemen terlihat di layar
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        const cardLeft = document.querySelector('.welcome-profile-card');
        const cardRight = document.querySelector('.welcome-text-card');

        if(cardLeft && cardRight) {
            // Hentikan animasi sementara sampai di-scroll
            cardLeft.style.animationPlayState = 'paused';
            cardRight.style.animationPlayState = 'paused';

            observer.observe(cardLeft);
            observer.observe(cardRight);
        }
    });
    </script>

</body>
</html>