@php
    $namaPuskesmas = config('puskesmas.name', 'Puskesmas Madukara 1');
    $alamat = 'Jl. Raya Madukara No.KM.5, Bugar Aji, Madukara, Kec. Madukara, Kab. Banjarnegara, Jawa Tengah 53482';

    // Placeholder SVG (dipakai jika gambar belum diisi admin / file tidak ditemukan)
    $placeholder = 'data:image/svg+xml;utf8,' . rawurlencode(
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600">'
        . '<defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#d1fae5"/><stop offset="1" stop-color="#bae6fd"/></linearGradient></defs>'
        . '<rect width="800" height="600" fill="url(#g)"/>'
        . '<g fill="none" stroke="#0f766e" stroke-width="14" stroke-linecap="round" opacity=".55"><path d="M400 235v130M335 300h130"/><circle cx="400" cy="300" r="120"/></g>'
        . '</svg>'
    );
    $img = fn ($path) => $path ? asset('storage/' . $path) : $placeholder;

    $serviceIcons = ['fa-stethoscope', 'fa-tooth', 'fa-baby', 'fa-truck-medical'];

    // Sambutan: pisahkan per paragraf. Baris diawali ">" akan tampil di kotak kutipan.
    $paras = $sambutan
        ? array_values(array_filter(array_map('trim', preg_split('/\R+/', (string) $sambutan->sambutan))))
        : ['Sambutan Kepala Puskesmas belum diisi oleh admin.'];
    $quote = null;
    $bodyParas = [];
    foreach ($paras as $p) {
        if ($quote === null && str_starts_with($p, '>')) {
            $quote = trim(ltrim($p, '>'));
        } else {
            $bodyParas[] = $p;
        }
    }

    $mapsLink = 'https://www.google.com/maps/search/?api=1&query=' . urlencode('Puskesmas Madukara 1 ' . $alamat);
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $namaPuskesmas }} - Beranda</title>

    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <noscript><style>.reveal{opacity:1!important;transform:none!important}</style></noscript>

    <style>
        /* =========================================================
           DESIGN TOKENS
        ========================================================= */
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
            --shadow-sm: 0 2px 10px rgba(15, 23, 42, 0.06);
            --shadow-md: 0 12px 30px rgba(4, 120, 87, 0.12);
            --shadow-lg: 0 22px 50px rgba(4, 120, 87, 0.2);
            --ease: cubic-bezier(.22, 1, .36, 1);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        html { scroll-behavior: smooth; }
        body { background-color: var(--bg-light); color: #333; overflow-x: hidden; }
        img { max-width: 100%; height: auto; display: block; }
        section[id], footer[id] { scroll-margin-top: 110px; }

        /* =========================================================
           HEADER (TOP BAR + NAVBAR)
        ========================================================= */
        .header-wrapper {
            position: fixed; top: 0; left: 0; width: 100%; z-index: 1000;
            background-color: #ffffff; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        .top-bar {
            background-color: #ffffff; display: flex; justify-content: space-between; align-items: center;
            padding: 0 5%; height: 40px; font-size: 13px; color: #444444; border-bottom: 1px solid #e0e0e0;
        }
        .top-left { display: flex; align-items: center; gap: 8px; }
        .top-left > i { color: var(--teal); }
        .top-left .divider { color: #cccccc; margin: 0 4px; user-select: none; }
        .top-left .social-icon {
            color: #555555; font-size: 14px; text-decoration: none; margin: 0 2px;
            display: inline-flex; align-items: center; justify-content: center;
            width: 24px; height: 24px; border-radius: 50%; transition: all 0.25s ease;
        }
        .top-left .social-icon.wa:hover { color: #25D366; background-color: rgba(37, 211, 102, 0.1); transform: translateY(-2px); }
        .top-left .social-icon.ig:hover { color: #E4405F; background-color: rgba(228, 64, 95, 0.1); transform: translateY(-2px); }
        .top-left .social-icon.yt:hover { color: #FF0000; background-color: rgba(255, 0, 0, 0.1); transform: translateY(-2px); }
        .top-left .social-icon.tt:hover { color: #000000; background-color: rgba(0, 0, 0, 0.08); transform: translateY(-2px); }
        .top-left .social-icon.fb:hover { color: #1877F2; background-color: rgba(24, 119, 242, 0.1); transform: translateY(-2px); }
        .top-right { display: flex; align-items: center; gap: 8px; font-weight: 500; }
        .status-dot { width: 8px; height: 8px; border-radius: 50%; background-color: #cccccc; display: inline-block; }

        .navbar {
            background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
            display: flex; justify-content: space-between; align-items: center;
            padding: 0 5%; height: 75px; position: relative;
        }
        .logo {
            display: flex; align-items: center; color: white; text-decoration: none;
            font-family: 'League Spartan', sans-serif; font-weight: 800; font-size: 18px;
            line-height: 1.1; text-transform: uppercase; gap: 12px;
        }
        .logo img { height: 48px; width: auto; }
        .mobile-status-bar, .mobile-search { display: none; }
        .mobile-toggle {
            display: none; background: rgba(255, 255, 255, 0.15); border: none; color: white; font-size: 20px;
            cursor: pointer; width: 44px; height: 44px; border-radius: 8px;
            align-items: center; justify-content: center; transition: all 0.2s;
        }
        .mobile-toggle:active { transform: scale(0.95); }
        .nav-menu { display: flex; list-style: none; align-items: center; height: 100%; }
        .nav-item { position: relative; height: 100%; }
        .nav-item > a {
            color: white; text-decoration: none; padding: 0 16px; font-size: 14px; font-weight: 500;
            display: flex; height: 100%; align-items: center; transition: all 0.2s;
        }
        .nav-item:hover > a { background-color: rgba(0, 0, 0, 0.18); color: var(--accent-color); }
        .dropdown-menu {
            display: none; position: absolute; top: 100%; left: 0; background-color: white; min-width: 230px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); list-style: none;
            border-top: var(--accent-color) 4px solid; border-radius: 0 0 8px 8px; overflow: hidden;
        }
        .nav-item.dd-right .dropdown-menu { left: auto; right: 0; }
        .dropdown-menu li a {
            color: #333; padding: 12px 20px; text-decoration: none; display: block; font-size: 13.5px;
            border-bottom: 1px solid #f0f0f0; transition: background 0.2s, padding 0.2s;
        }
        .dropdown-menu li a:hover { background-color: var(--mint); color: var(--primary-color); padding-left: 24px; }
        .nav-item:hover .dropdown-menu { display: block; }
        .nav-icon { font-size: 11px; margin-left: 6px; transition: transform 0.2s; }
        .nav-item:hover .nav-icon { transform: rotate(180deg); }
        .search-btn {
            background-color: white; color: var(--primary-color); border: none; width: 38px; height: 38px;
            border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center;
            margin-left: 12px; transition: all 0.2s;
        }
        .search-btn:hover { background-color: var(--accent-color); }
        .mobile-search { padding: 12px 16px; border-bottom: 1px solid #eef2f5; }
        .mobile-search-box { display: flex; background: #f1f5f9; border-radius: 8px; padding: 6px 12px; align-items: center; }
        .mobile-search-box input { border: none; background: transparent; width: 100%; padding: 6px 8px; font-size: 14px; outline: none; }
        .mobile-search-box i { color: #888; }

        /* =========================================================
           REUSABLE: REVEAL, SECTION HEAD, BUTTONS
        ========================================================= */
        .reveal { opacity: 0; transform: translateY(26px); transition: opacity .8s var(--ease), transform .8s var(--ease); transition-delay: var(--d, 0ms); }
        .reveal-left { transform: translateX(-70px); }
        .reveal-right { transform: translateX(70px); }
        .reveal.in { opacity: 1; transform: none; }

        .section { padding: 76px 5%; }
        .container { max-width: 1200px; margin: 0 auto; }
        .sec-head { text-align: center; margin-bottom: 44px; }
        .eyebrow {
            display: inline-flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 700;
            letter-spacing: .12em; text-transform: uppercase; color: var(--primary-color);
            background: rgba(4, 120, 87, .09); padding: 6px 14px; border-radius: 999px; margin-bottom: 14px;
        }
        .sec-head h2 {
            font-family: 'League Spartan', sans-serif; font-size: clamp(26px, 3.4vw, 38px);
            font-weight: 800; color: var(--ink); line-height: 1.15;
        }
        .sec-head h2::after {
            content: ''; display: block; width: 56px; height: 4px; border-radius: 4px; margin: 14px auto 0;
            background: linear-gradient(90deg, var(--primary-color), var(--sky));
        }
        .sec-head p { max-width: 620px; margin: 14px auto 0; color: var(--muted); font-size: 14.5px; line-height: 1.7; }
        .sec-head.is-left { text-align: left; margin-bottom: 0; }
        .sec-head.is-left h2::after { margin-left: 0; }

        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px; padding: 11px 22px; border-radius: 999px;
            background: linear-gradient(135deg, var(--primary-color), var(--teal)); color: #fff;
            font-weight: 600; font-size: 13.5px; text-decoration: none; border: 0; cursor: pointer;
            box-shadow: 0 8px 20px rgba(4, 120, 87, .28); transition: transform .3s var(--ease), box-shadow .3s;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 26px rgba(4, 120, 87, .36); }
        .btn-primary i { transition: transform .3s var(--ease); }
        .btn-primary:hover i { transform: translateX(3px); }
        .btn-ghost {
            display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; border-radius: 999px;
            background: #fff; color: var(--primary-color); font-weight: 600; font-size: 13px; text-decoration: none;
            border: 1px solid rgba(4, 120, 87, .25); transition: all .3s var(--ease);
        }
        .btn-ghost:hover { background: var(--primary-color); color: #fff; transform: translateY(-2px); }
        .nav-circle {
            width: 44px; height: 44px; border-radius: 50%; border: 1px solid var(--line); background: #fff;
            color: var(--primary-color); cursor: pointer; display: grid; place-items: center; font-size: 14px;
            box-shadow: var(--shadow-sm); transition: all .3s var(--ease);
        }
        .nav-circle:hover { background: var(--primary-color); color: #fff; transform: translateY(-2px); box-shadow: var(--shadow-md); }
        .nav-circle.swiper-button-disabled { opacity: .35; pointer-events: none; }

        /* =========================================================
           SECTION 1: HERO CAROUSEL
        ========================================================= */
        .hero-swiper {
            width: 100%; height: clamp(260px, 46vw, 540px); background: #cfe9df;
            --swiper-navigation-color: #fff; --swiper-navigation-size: 16px;
            --swiper-pagination-color: var(--accent-color);
        }
        .hero-slide { position: relative; overflow: hidden; }
        .hero-slide img { width: 100%; height: 100%; object-fit: cover; transform: scale(1.08); transition: transform 6.5s ease-out; }
        .hero-slide.swiper-slide-active img { transform: scale(1); }
        .hero-caption {
            position: absolute; left: 0; right: 0; bottom: 0; padding: 80px 5% 60px;
            background: linear-gradient(to top, rgba(2, 44, 34, .8), rgba(2, 44, 34, 0));
        }
        .hero-caption h2 {
            max-width: 1200px; margin: 0 auto; color: #fff; font-family: 'League Spartan', sans-serif;
            font-size: clamp(20px, 3.2vw, 38px); font-weight: 800; line-height: 1.2;
            padding-left: 16px; border-left: 5px solid var(--accent-color);
            opacity: 0; transform: translateY(16px); transition: opacity .7s var(--ease) .3s, transform .7s var(--ease) .3s;
        }
        .hero-slide.swiper-slide-active .hero-caption h2 { opacity: 1; transform: none; }
        .hero-swiper .swiper-button-prev, .hero-swiper .swiper-button-next {
            width: 46px; height: 46px; border-radius: 50%; background: rgba(255, 255, 255, .18);
            backdrop-filter: blur(6px); border: 1px solid rgba(255, 255, 255, .35); transition: background .3s;
        }
        .hero-swiper .swiper-button-prev:hover, .hero-swiper .swiper-button-next:hover { background: rgba(255, 255, 255, .35); }
        .hero-swiper .swiper-button-prev::after, .hero-swiper .swiper-button-next::after { font-weight: 800; }
        .hero-swiper .swiper-pagination-bullet { background: #fff; opacity: .6; transition: all .3s; }
        .hero-swiper .swiper-pagination-bullet-active { opacity: 1; width: 26px; border-radius: 6px; background: var(--accent-color); }
        .hero-fallback {
            height: clamp(260px, 40vw, 420px); display: flex; align-items: center; justify-content: center;
            text-align: center; color: #fff; padding: 0 5%;
            background: radial-gradient(circle at 80% 20%, rgba(14, 165, 233, .45), transparent 55%),
                        linear-gradient(135deg, #047857, #0f766e 60%, #0369a1);
        }
        .hero-fallback h1 { font-family: 'League Spartan', sans-serif; font-size: clamp(28px, 5vw, 52px); font-weight: 800; }
        .hero-fallback p { margin-top: 10px; opacity: .85; font-size: 14.5px; }

        /* =========================================================
           SECTION 2: SAMBUTAN (struktur asli dipertahankan)
        ========================================================= */
        .welcome-section { padding: 56px 5%; background-color: #f8fafc; overflow: hidden; }
        .welcome-container {
            max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: 290px 1fr;
            gap: 22px; align-items: stretch;
        }
        .welcome-profile-card {
            background: #ffffff; border-radius: 16px; padding: 12px; box-shadow: var(--shadow-md);
            border: 1px solid rgba(4, 120, 87, 0.08); text-align: center; display: flex;
            flex-direction: column; justify-content: space-between; height: 100%;
        }
        .welcome-photo-frame { position: relative; width: 100%; flex: 1; min-height: 260px; border-radius: 12px; overflow: hidden; background: var(--mint); }
        .welcome-photo-frame img { width: 100%; height: 100%; object-fit: cover; object-position: top; transition: transform 0.5s var(--ease); }
        .welcome-profile-card:hover .welcome-photo-frame img { transform: scale(1.04); }
        .welcome-profile-info { padding: 12px 4px 4px; }
        .welcome-profile-info h3 { font-size: 14.5px; font-weight: 800; color: var(--ink); margin-bottom: 3px; line-height: 1.35; }
        .welcome-profile-info p { font-size: 11.5px; color: var(--primary-color); font-weight: 600; margin: 0; letter-spacing: .02em; }
        .welcome-text-card {
            background: #ffffff; border-radius: 16px; padding: 28px 32px; box-shadow: var(--shadow-md);
            border: 1px solid rgba(4, 120, 87, 0.08); display: flex; flex-direction: column; justify-content: center; height: 100%;
        }
        .welcome-tag {
            align-self: flex-start; color: var(--primary-color); background: rgba(4, 120, 87, 0.09); font-size: 11.5px;
            font-weight: 800; letter-spacing: 0.1em; padding: 5px 12px; border-radius: 999px; margin-bottom: 14px;
        }
        .welcome-header h2 {
            font-family: 'League Spartan', sans-serif; font-size: clamp(21px, 2.4vw, 27px);
            font-weight: 800; color: var(--ink); line-height: 1.25; margin-bottom: 14px;
        }
        .welcome-quote-box {
            display: flex; align-items: flex-start; gap: 12px; background: linear-gradient(90deg, #fffbeb, #fff);
            border-left: 4px solid var(--accent-color); padding: 12px 16px; border-radius: 0 10px 10px 0; margin-bottom: 14px;
        }
        .welcome-quote-box i { font-size: 15px; color: #d4a700; margin-top: 3px; }
        .welcome-quote-box p { font-size: 13px; font-style: italic; font-weight: 600; color: #334155; margin: 0; line-height: 1.6; }
        .welcome-body-text p { font-size: 13.5px; line-height: 1.75; color: #475569; margin-bottom: 10px; text-align: justify; }
        .welcome-body-text p:last-child { margin-bottom: 0; }

        /* =========================================================
           SECTION 3: JAM PELAYANAN
        ========================================================= */
        .hours-section { background: linear-gradient(180deg, #ecfdf5 0%, #f0f9ff 100%); }
        .hours-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 22px; }
        .hour-card {
            position: relative; background: #fff; border-radius: var(--radius); padding: 28px 24px 24px;
            border: 1px solid rgba(4, 120, 87, .1); box-shadow: var(--shadow-sm); overflow: hidden;
            transition: transform .4s var(--ease), box-shadow .4s var(--ease), border-color .4s;
        }
        .hour-card::before {
            content: ''; position: absolute; left: 0; top: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--sky));
            transform: scaleX(0); transform-origin: left; transition: transform .5s var(--ease);
        }
        .hour-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); border-color: rgba(4, 120, 87, .25); }
        .hour-card:hover::before { transform: scaleX(1); }
        .hour-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }
        .hour-icon {
            width: 54px; height: 54px; border-radius: 16px; display: grid; place-items: center; font-size: 22px;
            color: var(--primary-color); background: var(--mint); transition: all .4s var(--ease);
        }
        .hour-card:hover .hour-icon { background: linear-gradient(135deg, var(--primary-color), var(--teal)); color: #fff; transform: rotate(-6deg) scale(1.06); }
        .hour-badge { font-size: 10.5px; font-weight: 700; letter-spacing: .06em; color: #0369a1; background: #e0f2fe; padding: 4px 10px; border-radius: 999px; }
        .hour-card h3 { font-size: 17px; font-weight: 700; color: var(--ink); margin-bottom: 4px; }
        .hour-row { display: flex; align-items: flex-start; gap: 12px; margin-top: 14px; }
        .hour-row > i { width: 30px; height: 30px; border-radius: 10px; display: grid; place-items: center; font-size: 12px; color: var(--teal); background: #f0fdfa; flex-shrink: 0; }
        .hour-row small { display: block; font-size: 11px; color: var(--muted); text-transform: uppercase; letter-spacing: .08em; }
        .hour-row strong { font-size: 14px; font-weight: 600; color: #1e293b; line-height: 1.4; }
        .hour-note { margin-top: 16px; padding-top: 14px; border-top: 1px dashed var(--line); font-size: 12px; color: var(--muted); line-height: 1.6; }

        /* =========================================================
           SECTION 4: BERITA
        ========================================================= */
        .news-section { background: #ffffff; }
        .news-head { display: flex; flex-wrap: wrap; gap: 18px; align-items: flex-end; justify-content: space-between; margin-bottom: 34px; }
        .news-actions { display: flex; align-items: center; gap: 10px; }
        .news-swiper { padding: 8px 6px 54px; margin: -8px -6px 0; }
        .news-swiper .swiper-slide { height: auto; display: flex; }
        .news-swiper .swiper-pagination { bottom: 12px; }
        .news-swiper .swiper-pagination-bullet { background: #94a3b8; opacity: .5; transition: all .3s; }
        .news-swiper .swiper-pagination-bullet-active { background: var(--primary-color); opacity: 1; width: 24px; border-radius: 6px; }
        .news-card {
            display: flex; flex-direction: column; width: 100%; background: #fff; border-radius: var(--radius);
            overflow: hidden; text-decoration: none; border: 1px solid rgba(4, 120, 87, .1); box-shadow: var(--shadow-sm);
            transition: transform .4s var(--ease), box-shadow .4s var(--ease);
        }
        .news-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
        .news-thumb { position: relative; height: 210px; overflow: hidden; background: var(--mint); }
        .news-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform .7s var(--ease); }
        .news-card:hover .news-thumb img { transform: scale(1.07); }
        .news-thumb::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to top, rgba(2, 44, 34, .35), transparent 55%); pointer-events: none; }
        .badge-date, .badge-cat { position: absolute; z-index: 2; font-size: 11.5px; font-weight: 600; border-radius: 999px; padding: 6px 12px; }
        .badge-date { left: 14px; bottom: 14px; color: #fff; background: rgba(4, 120, 87, .92); backdrop-filter: blur(4px); display: inline-flex; align-items: center; gap: 6px; }
        .badge-cat { right: 14px; top: 14px; color: #0369a1; background: rgba(255, 255, 255, .95); }
        .news-body { display: flex; flex-direction: column; flex: 1; padding: 20px 22px 22px; }
        .news-body h3 {
            font-size: 16.5px; font-weight: 700; color: var(--ink); line-height: 1.4; margin-bottom: 10px; transition: color .3s;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }
        .news-card:hover .news-body h3 { color: var(--primary-color); }
        .news-body p {
            font-size: 13.5px; color: var(--muted); line-height: 1.7;
            display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
        }
        .news-more { margin-top: auto; padding-top: 16px; font-size: 13px; font-weight: 600; color: var(--primary-color); display: inline-flex; align-items: center; gap: 8px; }
        .news-more i { transition: transform .3s var(--ease); }
        .news-card:hover .news-more i { transform: translateX(5px); }
        .empty-state { text-align: center; color: var(--muted); padding: 40px 20px; background: var(--mint); border-radius: var(--radius); border: 1px dashed rgba(4, 120, 87, .3); }

        /* =========================================================
           SECTION 5: GALERI
        ========================================================= */
        .gallery-section { background: linear-gradient(180deg, #f0f9ff 0%, #ecfdf5 100%); }
        .gallery-grid { display: grid; grid-template-columns: repeat(4, 1fr); grid-auto-rows: 190px; grid-auto-flow: dense; gap: 14px; }
        .g-item {
            position: relative; display: block; width: 100%; height: 100%; padding: 0; border: 0; cursor: zoom-in;
            border-radius: 16px; overflow: hidden; background: var(--mint); box-shadow: var(--shadow-sm);
            transition: box-shadow .4s var(--ease), transform .4s var(--ease);
        }
        .g-item:nth-child(7n+1) { grid-row: span 2; }
        .g-item:nth-child(7n+4) { grid-column: span 2; }
        .g-item img { width: 100%; height: 100%; object-fit: cover; transition: transform .8s var(--ease); }
        .g-item:hover { box-shadow: var(--shadow-lg); transform: translateY(-3px); }
        .g-item:hover img { transform: scale(1.1); }
        .g-overlay {
            position: absolute; inset: 0; display: flex; flex-direction: column; justify-content: flex-end; text-align: left;
            padding: 16px; background: linear-gradient(to top, rgba(2, 44, 34, .8), rgba(2, 44, 34, 0) 60%);
            opacity: 0; transition: opacity .4s var(--ease);
        }
        .g-item:hover .g-overlay, .g-item:focus-visible .g-overlay { opacity: 1; }
        .g-overlay span { color: #fff; font-size: 13px; font-weight: 600; line-height: 1.4; transform: translateY(10px); transition: transform .4s var(--ease); }
        .g-item:hover .g-overlay span { transform: none; }
        .g-source { position: absolute; top: 12px; left: 12px; z-index: 2; font-size: 10.5px; font-weight: 700; letter-spacing: .05em; color: #fff; background: rgba(4, 120, 87, .9); padding: 4px 10px; border-radius: 999px; }
        .g-zoom {
            position: absolute; top: 12px; right: 12px; z-index: 2; width: 36px; height: 36px; border-radius: 50%;
            display: grid; place-items: center; font-size: 14px; color: var(--primary-color); background: rgba(255, 255, 255, .95);
            opacity: 0; transform: scale(.7); transition: all .4s var(--ease);
        }
        .g-item:hover .g-zoom { opacity: 1; transform: scale(1); }

        /* Lightbox */
        .lightbox {
            position: fixed; inset: 0; z-index: 2000; display: flex; align-items: center; justify-content: center;
            background: rgba(2, 20, 16, .92); backdrop-filter: blur(6px); opacity: 0; visibility: hidden; transition: opacity .3s, visibility .3s;
        }
        .lightbox.open { opacity: 1; visibility: visible; }
        .lb-figure { max-width: min(92vw, 1100px); text-align: center; }
        .lb-figure img { max-width: 100%; max-height: 78vh; margin: 0 auto; border-radius: 14px; box-shadow: 0 30px 80px rgba(0, 0, 0, .5); object-fit: contain; }
        .lb-caption { margin-top: 14px; color: #e2e8f0; font-size: 14px; font-weight: 500; }
        .lb-count { margin-top: 4px; color: #94a3b8; font-size: 12px; }
        .lb-btn {
            position: absolute; width: 48px; height: 48px; border-radius: 50%; border: 1px solid rgba(255, 255, 255, .25);
            background: rgba(255, 255, 255, .12); color: #fff; font-size: 16px; cursor: pointer; display: grid; place-items: center; transition: background .3s;
        }
        .lb-btn:hover { background: rgba(255, 255, 255, .28); }
        .lb-close { top: 20px; right: 20px; }
        .lb-prev { left: 20px; top: 50%; transform: translateY(-50%); }
        .lb-next { right: 20px; top: 50%; transform: translateY(-50%); }

        /* =========================================================
           SECTION 6: PETA
        ========================================================= */
        .map-section { background: #ffffff; }
        .map-card { border-radius: 24px; overflow: hidden; background: #fff; border: 1px solid rgba(4, 120, 87, .15); box-shadow: var(--shadow-md); padding: 8px; background: linear-gradient(135deg, #ecfdf5, #e0f2fe); }
        .map-inner { background: #fff; border-radius: 18px; overflow: hidden; }
        .map-top { display: flex; flex-wrap: wrap; gap: 14px; align-items: center; justify-content: space-between; padding: 18px 22px; border-bottom: 1px solid var(--line); }
        .map-place { display: flex; align-items: center; gap: 14px; }
        .map-pin { width: 46px; height: 46px; border-radius: 14px; display: grid; place-items: center; font-size: 19px; color: #fff; background: linear-gradient(135deg, var(--primary-color), var(--teal)); flex-shrink: 0; }
        .map-place strong { display: block; font-size: 15px; color: var(--ink); }
        .map-place span { display: block; font-size: 12.5px; color: var(--muted); line-height: 1.5; max-width: 560px; }
        .map-frame iframe { display: block; width: 100%; height: clamp(300px, 45vw, 460px); border: 0; }

        /* =========================================================
           FOOTER
        ========================================================= */
        .footer {
            background: linear-gradient(135deg, #047857 0%, #064e3b 60%, #022c22 100%);
            color: #ffffff; padding: 48px 5% 18px; font-size: 13px; position: relative; overflow: hidden;
        }
        .footer::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: linear-gradient(90deg, var(--accent-color), var(--sky), var(--accent-color)); }
        .footer-container { display: flex; justify-content: space-between; gap: 30px; max-width: 1400px; margin: 0 auto; flex-wrap: wrap; }
        .footer-col { flex: 1 1 210px; }
        .footer-col h3 { font-family: 'League Spartan', sans-serif; font-size: 15px; font-weight: 800; letter-spacing: 0.8px; margin-bottom: 12px; color: var(--accent-color); text-transform: uppercase; display: inline-block; }
        .footer-col h3::after { content: ''; display: block; width: 25px; height: 2px; background-color: var(--accent-color); margin-top: 4px; border-radius: 2px; }
        .footer-col h3.sub-heading { margin-top: 18px; }
        .footer-logo-group { display: flex; align-items: center; gap: 22px; margin-bottom: 14px; flex-wrap: wrap; }
        .footer-logo-group img { height: 72px; width: auto; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2)); transition: transform 0.3s ease; }
        .footer-logo-group img:hover { transform: scale(1.08); }
        .footer-title { font-size: 20px; font-weight: 800; line-height: 1.25; margin-bottom: 8px; color: #ffffff; }
        .footer-sub-title { font-size: 14px; letter-spacing: 1px; font-weight: 600; color: rgba(255, 255, 255, 0.8); }
        .footer-address { font-size: 13.5px; margin-top: 8px; color: rgba(255, 255, 255, 0.75); line-height: 1.6; }
        .footer-contact-item { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; word-break: break-all; transition: transform 0.2s ease; }
        .footer-contact-item:hover { transform: translateX(4px); }
        .footer-contact-item a, .footer-contact-item span { color: rgba(255, 255, 255, 0.85); text-decoration: none; transition: color 0.2s ease; font-size: 12.5px; }
        .footer-contact-item a:hover { color: #ffffff; }
        .footer-contact-item i {
            background: rgba(255, 255, 255, 0.12); border: 1px solid rgba(255, 255, 255, 0.18); min-width: 28px; height: 28px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; color: var(--accent-color); font-size: 12px; transition: all 0.3s ease;
        }
        .footer-contact-item:hover i { background: var(--accent-color); color: #022c22; box-shadow: 0 0 10px rgba(255, 204, 0, 0.5); }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 6px; }
        .footer-links a { color: rgba(255, 255, 255, 0.75); text-decoration: none; transition: all 0.25s ease; font-size: 12.5px; display: inline-block; }
        .footer-links a:hover { color: var(--accent-color); transform: translateX(5px); }
        .footer-links a::before { content: '›'; margin-right: 6px; color: var(--accent-color); font-weight: bold; opacity: 0.6; transition: opacity 0.2s; }
        .footer-links a:hover::before { opacity: 1; }
        .visitor-stats { list-style: none; background: rgba(0, 0, 0, 0.18); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 12px; padding: 12px 14px; }
        .visitor-stats li { display: flex; justify-content: space-between; margin-bottom: 6px; border-bottom: 1px dashed rgba(255, 255, 255, 0.12); padding-bottom: 4px; font-size: 12px; color: rgba(255, 255, 255, 0.8); }
        .visitor-stats li:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .visitor-stats .val { color: var(--accent-color); font-weight: 700; font-family: 'Courier New', Courier, monospace; letter-spacing: 0.5px; }
        .footer-bottom { border-top: 1px solid rgba(255, 255, 255, 0.1); margin-top: 28px; padding-top: 14px; text-align: center; font-size: 11.5px; color: rgba(255, 255, 255, 0.6); }
        .footer-bottom a { color: rgba(255, 255, 255, 0.45); text-decoration: none; margin-left: 10px; }
        .footer-bottom a:hover { color: #fff; }

        /* =========================================================
           RESPONSIVE
        ========================================================= */
        @media (max-width: 1100px) {
            .hours-grid { grid-template-columns: repeat(2, 1fr); }
            .gallery-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 992px) {
            .top-bar { display: none; }
            .navbar { height: 62px; padding: 0 4%; }
            .logo { font-size: 14px; gap: 8px; }
            .logo img { height: 38px; }
            .mobile-toggle { display: flex; }
            .search-btn { display: none; }
            .mobile-search { display: block; }
            .nav-menu {
                position: fixed; top: 62px; left: 0; width: 100%; height: calc(100vh - 62px); background-color: #ffffff;
                flex-direction: column; align-items: stretch; justify-content: flex-start; padding: 0 0 30px 0; overflow-y: auto;
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2); opacity: 0; visibility: hidden; transform: translateY(-10px);
                transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            }
            .nav-menu.active { opacity: 1; visibility: visible; transform: translateY(0); }
            .mobile-status-bar {
                background: #f1f5f9; padding: 10px 16px; display: flex; align-items: center; justify-content: space-between;
                font-size: 12px; color: #475569; border-bottom: 1px solid #e2e8f0;
            }
            .nav-item { width: 100%; height: auto; border-bottom: 1px solid #f1f5f9; }
            .nav-item > a { color: #1e293b; padding: 14px 20px; font-size: 14.5px; font-weight: 600; justify-content: space-between; background-color: #ffffff; }
            .nav-item > a:hover, .nav-item.open > a { background-color: #f8fafc; color: var(--primary-color); }
            .nav-item:hover > a { color: #1e293b; }
            .dropdown-menu { position: static; box-shadow: none; background-color: #f8fafc; border-top: none; border-radius: 0; display: none; padding: 4px 0; }
            .nav-item:hover .dropdown-menu { display: none; }
            .dropdown-menu li a { padding: 11px 20px 11px 35px; font-size: 13.5px; color: #475569; border-bottom: 1px dashed #e2e8f0; }
            .dropdown-menu li a:hover { background-color: #e2e8f0; color: var(--primary-color); }
            .nav-item.open .nav-icon { transform: rotate(180deg); color: var(--primary-color); }
            .nav-item.open .dropdown-menu { display: block; }

            .welcome-container { grid-template-columns: 1fr; gap: 16px; }
            .welcome-photo-frame { height: 300px; flex: none; }
            .welcome-text-card { padding: 22px 18px; }
            .reveal-left, .reveal-right { transform: translateY(30px); }
        }
        @media (max-width: 640px) {
            .section { padding: 56px 5%; }
            .hours-grid { grid-template-columns: 1fr; }
            .gallery-grid { grid-template-columns: repeat(2, 1fr); grid-auto-rows: 150px; gap: 10px; }
            .g-item:nth-child(7n+4) { grid-column: span 1; }
            .news-head { align-items: flex-start; }
            .lb-prev { left: 8px; } .lb-next { right: 8px; } .lb-close { top: 12px; right: 12px; }
            .lb-btn { width: 42px; height: 42px; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; transition-duration: .01ms !important; }
            .reveal { opacity: 1; transform: none; }
        }
    </style>
</head>
<body>

    {{-- ===================== HEADER ===================== --}}
    <header class="header-wrapper" id="header-wrapper">
        <div class="top-bar">
            <div class="top-left">
                <i class="fa-solid fa-phone"></i>
                <span>(0286) 5986981</span>
                <span class="divider">|</span>
                <i class="fa-solid fa-envelope"></i>
                <span>puskesmas.madukara1@gmail.com</span>
                <span class="divider">|</span>
                <a href="https://wa.me/6281234567890" target="_blank" rel="noopener" title="WhatsApp" class="social-icon wa"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="https://instagram.com/puskesmasmadukara1" target="_blank" rel="noopener" title="Instagram" class="social-icon ig"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://youtube.com" target="_blank" rel="noopener" title="YouTube" class="social-icon yt"><i class="fa-brands fa-youtube"></i></a>
                <a href="https://tiktok.com" target="_blank" rel="noopener" title="TikTok" class="social-icon tt"><i class="fa-brands fa-tiktok"></i></a>
                <a href="https://facebook.com" target="_blank" rel="noopener" title="Facebook" class="social-icon fb"><i class="fa-brands fa-facebook-f"></i></a>
            </div>
            <div class="top-right">
                <span id="status-dot-desktop" class="status-dot"></span>
                <span id="status-text-desktop">Memeriksa jam kerja...</span>
            </div>
        </div>

        <nav class="navbar">
            <a href="{{ route('home') }}" class="logo">
                <img src="https://www.freepnglogos.com/uploads/logo-puskesmas-png/logo-puskesmas-lambang-baru-puskesmas-puskesmas-makale-3.png" alt="Logo Puskesmas">
                <div>PUSKESMAS<br>MADUKARA 1</div>
            </a>

            <button class="mobile-toggle" id="mobile-toggle" aria-label="Menu Utama"><i class="fa-solid fa-bars"></i></button>

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

                <li class="nav-item"><a href="{{ route('home') }}">Beranda</a></li>

                <li class="nav-item dropdown-toggle">
                    <a href="javascript:void(0)"><span>Tentang Kami</span><i class="fa-solid fa-chevron-down nav-icon"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('home') }}#sambutan">Sambutan Kepala Puskesmas</a></li>
                        <li><a href="#visi-misi">Profil</a></li>
                        <li><a href="#visi-misi">Visi Misi dan Motto</a></li>
                        <li><a href="#tata-nilai">Tata Nilai</a></li>
                        <li><a href="#struktur">Struktur Organisasi</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown-toggle">
                    <a href="javascript:void(0)"><span>Layanan</span><i class="fa-solid fa-chevron-down nav-icon"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('home') }}#jam-pelayanan">Jam Pelayanan</a></li>
                        <li><a href="#jenis-pelayanan">Jenis Pelayanan</a></li>
                        <li><a href="#maklumat">Maklumat Pelayanan</a></li>
                        <li><a href="#mutu">Mutu Pelayanan</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown-toggle">
                    <a href="javascript:void(0)"><span>Standar Layanan</span><i class="fa-solid fa-chevron-down nav-icon"></i></a>
                    <ul class="dropdown-menu">
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
                </li>

                <li class="nav-item dropdown-toggle dd-right">
                    <a href="javascript:void(0)"><span>Informasi</span><i class="fa-solid fa-chevron-down nav-icon"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('news.index') }}">Berita &amp; Kegiatan</a></li>
                        <li><a href="{{ route('home') }}#galeri">Galeri Foto</a></li>
                        <li><a href="{{ route('home') }}#lokasi">Lokasi Puskesmas</a></li>
                        <li><a href="#kontak">Kontak Kami</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown-toggle dd-right">
                    <a href="javascript:void(0)"><span>Pengaduan</span><i class="fa-solid fa-chevron-down nav-icon"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#sp4n">SP4N Lapor</a></li>
                        <li><a href="#wbs">WBS Puskesmas Madukara 1</a></li>
                        <li><a href="#alur-pengaduan">Alur Pengaduan</a></li>
                        <li><a href="#mekanisme-pengaduan">Mekanisme Pengaduan</a></li>
                    </ul>
                </li>

                <li>
                    <button class="search-btn" title="Cari Informasi"><i class="fa-solid fa-magnifying-glass"></i></button>
                </li>
            </ul>
        </nav>
    </header>

    <main>

        {{-- ================= SECTION 1: HERO CAROUSEL ================= --}}
        <section id="beranda" aria-label="Slider utama">
            @if ($sliders->isNotEmpty())
                <div class="swiper hero-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($sliders as $slide)
                            <div class="swiper-slide hero-slide">
                                <img src="{{ $img($slide->image) }}"
                                     alt="{{ $slide->title ?: 'Slide ' . $slide->position }}"
                                     onerror="this.onerror=null;this.src='{{ $placeholder }}'">
                                @if ($slide->title)
                                    <div class="hero-caption"><h2>{{ $slide->title }}</h2></div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            @else
                <div class="hero-fallback">
                    <div>
                        <h1>{{ $namaPuskesmas }}</h1>
                        <p>{{ $alamat }}</p>
                    </div>
                </div>
            @endif
        </section>

        {{-- ================= SECTION 2: SAMBUTAN KEPALA PUSKESMAS ================= --}}
        <section id="sambutan" class="welcome-section">
            <div class="welcome-container">

                <div class="welcome-profile-card reveal reveal-left">
                    <div class="welcome-photo-frame">
                        <img src="{{ $img($sambutan->foto ?? null) }}"
                             alt="{{ $sambutan->nama_lengkap ?? 'Kepala Puskesmas' }}"
                             onerror="this.onerror=null;this.src='{{ $placeholder }}'">
                    </div>
                    <div class="welcome-profile-info">
                        <h3>{{ $sambutan ? $sambutan->nama_lengkap . ($sambutan->gelar ? ', ' . $sambutan->gelar : '') : 'Nama Kepala Puskesmas' }}</h3>
                        <p>{{ $sambutan->jabatan ?? 'Kepala Puskesmas' }}</p>
                    </div>
                </div>

                <div class="welcome-text-card reveal reveal-right">
                    <span class="welcome-tag">SAMBUTAN KEPALA PUSKESMAS</span>
                    <div class="welcome-header">
                        <h2>Selamat Datang di {{ $namaPuskesmas }}</h2>
                    </div>

                    @if ($quote)
                        <div class="welcome-quote-box">
                            <i class="fa-solid fa-quote-left"></i>
                            <p>{{ $quote }}</p>
                        </div>
                    @endif

                    <div class="welcome-body-text">
                        @foreach ($bodyParas as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>

            </div>
        </section>

        {{-- ================= SECTION 3: JAM PELAYANAN ================= --}}
        <section id="jam-pelayanan" class="section hours-section">
            <div class="container">
                <div class="sec-head reveal">
                    <span class="eyebrow"><i class="fa-regular fa-clock"></i> Layanan Kami</span>
                    <h2>Jam Pelayanan</h2>
                    <p>Informasi hari dan jam buka setiap unit pelayanan agar kunjungan Anda lebih nyaman.</p>
                </div>

                <div class="hours-grid">
                    @foreach ($services as $i => $service)
                        <article class="hour-card reveal" style="--d: {{ $i * 90 }}ms">
                            <div class="hour-top">
                                <div class="hour-icon"><i class="fa-solid {{ $serviceIcons[$i] ?? 'fa-notes-medical' }}"></i></div>
                                @if (stripos($service['jam'] ?? '', '24') !== false)
                                    <span class="hour-badge">24 JAM</span>
                                @endif
                            </div>
                            <h3>{{ $service['nama'] }}</h3>

                            <div class="hour-row">
                                <i class="fa-regular fa-calendar-days"></i>
                                <div><small>Hari</small><strong>{{ $service['hari'] }}</strong></div>
                            </div>
                            <div class="hour-row">
                                <i class="fa-regular fa-clock"></i>
                                <div><small>Jam</small><strong>{{ $service['jam'] }}</strong></div>
                            </div>

                            @if (! empty($service['keterangan']))
                                <p class="hour-note">{{ $service['keterangan'] }}</p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ================= SECTION 4: BERITA PUSKESMAS ================= --}}
        <section id="berita" class="section news-section">
            <div class="container">
                <div class="news-head reveal">
                    <div class="sec-head is-left">
                        <span class="eyebrow"><i class="fa-regular fa-newspaper"></i> Informasi Terkini</span>
                        <h2>Berita Puskesmas</h2>
                    </div>
                    <div class="news-actions">
                        @if ($latestNews->isNotEmpty())
                            <button type="button" class="nav-circle news-prev" aria-label="Berita sebelumnya"><i class="fa-solid fa-chevron-left"></i></button>
                            <button type="button" class="nav-circle news-next" aria-label="Berita berikutnya"><i class="fa-solid fa-chevron-right"></i></button>
                        @endif
                        <a href="{{ route('news.index') }}" class="btn-primary">Lihat Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                @if ($latestNews->isNotEmpty())
                    <div class="swiper news-swiper reveal">
                        <div class="swiper-wrapper">
                            @foreach ($latestNews as $item)
                                <div class="swiper-slide">
                                    <a href="{{ route('news.show', $item->slug) }}" class="news-card">
                                        <div class="news-thumb">
                                            <img src="{{ $img($item->image) }}" alt="{{ $item->title }}" loading="lazy"
                                                 onerror="this.onerror=null;this.src='{{ $placeholder }}'">
                                            <span class="badge-cat">Berita</span>
                                            <span class="badge-date"><i class="fa-regular fa-calendar"></i> {{ $item->created_at->translatedFormat('d M Y') }}</span>
                                        </div>
                                        <div class="news-body">
                                            <h3>{{ $item->title }}</h3>
                                            <p>{{ $item->excerpt }}</p>
                                            <span class="news-more">Baca selengkapnya <i class="fa-solid fa-arrow-right"></i></span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                @else
                    <div class="empty-state reveal"><i class="fa-regular fa-newspaper" style="font-size:28px;margin-bottom:10px;"></i><br>Belum ada berita yang dipublikasikan.</div>
                @endif
            </div>
        </section>

        {{-- ================= SECTION 5: GALERI FOTO ================= --}}
        <section id="galeri" class="section gallery-section">
            <div class="container">
                <div class="sec-head reveal">
                    <span class="eyebrow"><i class="fa-regular fa-images"></i> Dokumentasi</span>
                    <h2>Galeri Foto</h2>
                    <p>Momen kegiatan dan pelayanan di {{ $namaPuskesmas }}. Klik foto untuk memperbesar.</p>
                </div>

                @if ($photos->isNotEmpty())
                    <div class="gallery-grid" id="gallery-grid">
                        @foreach ($photos as $photo)
                            <button type="button" class="g-item reveal" style="--d: {{ ($loop->index % 8) * 60 }}ms"
                                    data-src="{{ $img($photo->image) }}"
                                    data-title="{{ $photo->title ?: 'Dokumentasi Puskesmas' }}"
                                    aria-label="Perbesar foto: {{ $photo->title ?: 'Dokumentasi Puskesmas' }}">
                                <img src="{{ $img($photo->image) }}" alt="{{ $photo->title ?: 'Dokumentasi Puskesmas' }}" loading="lazy"
                                     onerror="this.onerror=null;this.src='{{ $placeholder }}'">
                                <span class="g-source">{{ $photo->source }}</span>
                                <span class="g-zoom"><i class="fa-solid fa-expand"></i></span>
                                <span class="g-overlay"><span>{{ $photo->title ?: 'Dokumentasi Puskesmas' }}</span></span>
                            </button>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state reveal"><i class="fa-regular fa-images" style="font-size:28px;margin-bottom:10px;"></i><br>Belum ada foto dokumentasi.</div>
                @endif
            </div>
        </section>

        {{-- ================= SECTION 6: PETA LOKASI ================= --}}
        <section id="lokasi" class="section map-section">
            <div class="container">
                <div class="sec-head reveal">
                    <span class="eyebrow"><i class="fa-solid fa-location-dot"></i> Temukan Kami</span>
                    <h2>Lokasi Puskesmas</h2>
                    <p>Kunjungi kami dan dapatkan pelayanan kesehatan terbaik.</p>
                </div>

                <div class="map-card reveal">
                    <div class="map-inner">
                        <div class="map-top">
                            <div class="map-place">
                                <div class="map-pin"><i class="fa-solid fa-hospital"></i></div>
                                <div>
                                    <strong>{{ $namaPuskesmas }}</strong>
                                    <span>{{ $alamat }}</span>
                                </div>
                            </div>
                            <a href="{{ $mapsLink }}" target="_blank" rel="noopener" class="btn-ghost"><i class="fa-solid fa-diamond-turn-right"></i> Petunjuk Arah</a>
                        </div>
                        <div class="map-frame">
                            <iframe src="{{ config('puskesmas.maps_embed_url') }}"
                                    allowfullscreen loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    title="Peta lokasi {{ $namaPuskesmas }}"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    {{-- ===================== FOOTER ===================== --}}
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
                <p class="footer-address">{{ $alamat }}</p>
            </div>

            <div class="footer-col">
                <h3>HUBUNGI KAMI</h3>
                <div class="footer-contact-item"><i class="fa-solid fa-phone"></i><span>(0286) 5986981</span></div>
                <div class="footer-contact-item"><i class="fa-solid fa-envelope"></i><span>puskesmas.madukara1@gmail.com</span></div>
                <div class="footer-contact-item"><i class="fa-brands fa-whatsapp"></i><a href="https://wa.me/6281234567890" target="_blank" rel="noopener">+62 812-3456-7890</a></div>

                <h3 class="sub-heading">SOSIAL MEDIA</h3>
                <div class="footer-contact-item"><i class="fa-brands fa-instagram"></i><a href="https://instagram.com/puskesmasmadukara1" target="_blank" rel="noopener">&#64;puskesmasmadukara1</a></div>
                <div class="footer-contact-item"><i class="fa-brands fa-youtube"></i><a href="https://youtube.com" target="_blank" rel="noopener">Puskesmas Madukara 1</a></div>
                <div class="footer-contact-item"><i class="fa-brands fa-tiktok"></i><a href="https://tiktok.com" target="_blank" rel="noopener">&#64;puskesmasmadukara1</a></div>
                <div class="footer-contact-item"><i class="fa-brands fa-facebook-f"></i><a href="https://facebook.com" target="_blank" rel="noopener">Puskesmas Madukara 1</a></div>
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
            <p>&copy; {{ date('Y') }} Puskesmas Madukara 1 Kabupaten Banjarnegara. All Rights Reserved.
                <a href="{{ route('login') }}">Admin</a></p>
        </div>
    </footer>

    {{-- ===================== LIGHTBOX ===================== --}}
    <div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Pratinjau foto" aria-hidden="true">
        <button type="button" class="lb-btn lb-close" id="lb-close" aria-label="Tutup"><i class="fa-solid fa-xmark"></i></button>
        <button type="button" class="lb-btn lb-prev" id="lb-prev" aria-label="Foto sebelumnya"><i class="fa-solid fa-chevron-left"></i></button>
        <button type="button" class="lb-btn lb-next" id="lb-next" aria-label="Foto berikutnya"><i class="fa-solid fa-chevron-right"></i></button>
        <figure class="lb-figure">
            <img id="lb-img" src="" alt="">
            <figcaption class="lb-caption" id="lb-caption"></figcaption>
            <div class="lb-count" id="lb-count"></div>
        </figure>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // ---------- Menu mobile ----------
        const mobileToggle = document.getElementById('mobile-toggle');
        const navMenu = document.getElementById('nav-menu');
        const headerWrapper = document.getElementById('header-wrapper');

        function closeMobileMenu() {
            navMenu.classList.remove('active');
            const icon = mobileToggle.querySelector('i');
            icon.classList.remove('fa-xmark');
            icon.classList.add('fa-bars');
            document.body.style.overflow = '';
        }

        mobileToggle.addEventListener('click', () => {
            const opening = !navMenu.classList.contains('active');
            if (opening) {
                navMenu.classList.add('active');
                const icon = mobileToggle.querySelector('i');
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-xmark');
                document.body.style.overflow = 'hidden';
            } else {
                closeMobileMenu();
            }
        });

        // Dropdown accordion (mobile)
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        dropdownToggles.forEach(item => {
            item.querySelector(':scope > a').addEventListener('click', (e) => {
                if (window.innerWidth <= 992) {
                    e.preventDefault();
                    dropdownToggles.forEach(other => { if (other !== item) other.classList.remove('open'); });
                    item.classList.toggle('open');
                }
            });
        });

        // Tutup menu mobile saat link tujuan dipilih
        document.querySelectorAll('.nav-menu a[href]').forEach(a => {
            a.addEventListener('click', () => {
                if (window.innerWidth <= 992 && !a.closest('.dropdown-toggle > a') && a.getAttribute('href') !== 'javascript:void(0)') {
                    closeMobileMenu();
                }
            });
        });

        // Padding body mengikuti tinggi header
        function syncHeaderPadding() {
            document.body.style.paddingTop = headerWrapper.offsetHeight + 'px';
        }
        window.addEventListener('load', syncHeaderPadding);
        window.addEventListener('resize', syncHeaderPadding);
        syncHeaderPadding();

        // ---------- Status jam pelayanan (Desktop & Mobile) ----------
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

            const dotD = document.getElementById('status-dot-desktop');
            const textD = document.getElementById('status-text-desktop');
            if (dotD && textD) { dotD.style.backgroundColor = color; textD.innerText = textStatus; }

            const dotM = document.getElementById('status-dot-mobile');
            const textM = document.getElementById('status-text-mobile');
            if (dotM && textM) { dotM.style.backgroundColor = color; textM.innerText = textStatus; textM.style.color = color; }
        }
        updateJamPelayanan();
        setInterval(updateJamPelayanan, 60000);

        // ---------- Swiper ----------
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Swiper === 'undefined') return;

            // Hero carousel
            const hero = document.querySelector('.hero-swiper');
            if (hero) {
                const total = hero.querySelectorAll('.swiper-slide').length;
                new Swiper(hero, {
                    loop: total > 1,
                    effect: 'fade',
                    fadeEffect: { crossFade: true },
                    speed: 900,
                    autoplay: total > 1 ? { delay: 5500, disableOnInteraction: false, pauseOnMouseEnter: true } : false,
                    pagination: { el: hero.querySelector('.swiper-pagination'), clickable: true },
                    navigation: {
                        nextEl: hero.querySelector('.swiper-button-next'),
                        prevEl: hero.querySelector('.swiper-button-prev'),
                    },
                });
            }

            // Slider berita: 1 (mobile) / 2 (tablet) / 3 (desktop)
            const news = document.querySelector('.news-swiper');
            if (news) {
                new Swiper(news, {
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    spaceBetween: 20,
                    grabCursor: true,
                    watchOverflow: true,
                    speed: 600,
                    breakpoints: {
                        640: { slidesPerView: 2, slidesPerGroup: 2, spaceBetween: 20 },
                        1024: { slidesPerView: 3, slidesPerGroup: 3, spaceBetween: 24 },
                    },
                    navigation: { nextEl: '.news-next', prevEl: '.news-prev' },
                    pagination: { el: news.querySelector('.swiper-pagination'), clickable: true },
                });
            }
        });

        // ---------- Reveal on scroll ----------
        (function () {
            const els = document.querySelectorAll('.reveal');
            if (!('IntersectionObserver' in window)) {
                els.forEach(el => el.classList.add('in'));
                return;
            }
            const io = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('in');
                        io.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
            els.forEach(el => io.observe(el));
        })();

        // ---------- Lightbox galeri ----------
        (function () {
            const items = Array.from(document.querySelectorAll('.g-item'));
            if (!items.length) return;

            const lb = document.getElementById('lightbox');
            const lbImg = document.getElementById('lb-img');
            const lbCap = document.getElementById('lb-caption');
            const lbCount = document.getElementById('lb-count');
            let current = 0;

            function show(i) {
                current = (i + items.length) % items.length;
                const it = items[current];
                lbImg.src = it.dataset.src;
                lbImg.alt = it.dataset.title || '';
                lbCap.textContent = it.dataset.title || '';
                lbCount.textContent = (current + 1) + ' / ' + items.length;
            }
            function open(i) {
                show(i);
                lb.classList.add('open');
                lb.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }
            function close() {
                lb.classList.remove('open');
                lb.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }

            items.forEach((it, i) => it.addEventListener('click', () => open(i)));
            document.getElementById('lb-close').addEventListener('click', close);
            document.getElementById('lb-prev').addEventListener('click', () => show(current - 1));
            document.getElementById('lb-next').addEventListener('click', () => show(current + 1));
            lb.addEventListener('click', (e) => { if (e.target === lb) close(); });

            document.addEventListener('keydown', (e) => {
                if (!lb.classList.contains('open')) return;
                if (e.key === 'Escape') close();
                if (e.key === 'ArrowLeft') show(current - 1);
                if (e.key === 'ArrowRight') show(current + 1);
            });

            // Swipe di layar sentuh
            let startX = 0;
            lb.addEventListener('touchstart', (e) => { startX = e.changedTouches[0].clientX; }, { passive: true });
            lb.addEventListener('touchend', (e) => {
                const dx = e.changedTouches[0].clientX - startX;
                if (Math.abs(dx) > 50) show(dx < 0 ? current + 1 : current - 1);
            }, { passive: true });
        })();
    </script>
</body>
</html>