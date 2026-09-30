<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Puskesmas Madukara 1</title>
    
    <!-- Google Fonts & Font Awesome (Sama seperti Halaman Utama User) -->
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
            --sidebar-width: 260px;
            --header-height: 70px;
        }

        body {
            background-color: #f1f5f9;
            color: #333;
            display: flex;
            min-height: 100vh;
        }

        /* 1. SIDEBAR (NILAI DAN TEMA VISUAL SAMA DENGAN NAV USER) */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: #ffffff;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
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

        .sidebar-brand img {
            height: 40px;
            width: auto;
        }

        .sidebar-brand-text {
            font-family: 'League Spartan', sans-serif;
            font-weight: 800;
            font-size: 15px;
            line-height: 1.2;
            color: #ffffff;
            text-transform: uppercase;
        }

        .sidebar-menu {
            list-style: none;
            padding: 15px 0;
            overflow-y: auto;
            flex: 1;
        }

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
            font-size: 13.5px;
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

        .sidebar-menu li a i {
            width: 20px;
            text-align: center;
            font-size: 15px;
        }

        /* 2. TOP HEADER ADMIN */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .top-header {
            height: var(--header-height);
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 90;
            box-shadow: 0 2px 5px rgba(0,0,0,0.03);
        }

        .header-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

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

        .admin-info {
            line-height: 1.2;
        }

        .admin-name {
            font-size: 13.5px;
            font-weight: 600;
            color: #334155;
        }

        .admin-role {
            font-size: 11px;
            color: #64748b;
        }

        /* 3. CONTENT CONTAINER */
        .content-body {
            padding: 30px;
            flex: 1;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--primary-color);
        }

        /* TAB NAVIGATION UTAMA UNTUK ADMIN MANAGEMENT */
        .admin-tabs {
            display: flex;
            gap: 8px;
            border-bottom: 2px solid #e2e8f0;
            margin-bottom: 25px;
            overflow-x: auto;
            padding-bottom: 2px;
        }

        .tab-btn {
            padding: 10px 18px;
            background: transparent;
            border: none;
            font-size: 13.5px;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .tab-btn:hover {
            color: var(--primary-color);
        }

        .tab-btn.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        /* FORM CARD DESIGN */
        .form-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            margin-bottom: 30px;
            display: none;
        }

        .form-card.active {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-card-header {
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .form-card-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 13.5px;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(39, 111, 39, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .file-input-wrapper {
            border: 2px dashed #cbd5e1;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            background-color: #f8fafc;
            cursor: pointer;
            transition: all 0.2s;
        }

        .file-input-wrapper:hover {
            border-color: var(--primary-color);
            background-color: rgba(39, 111, 39, 0.03);
        }

        .file-input-wrapper i {
            font-size: 28px;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .file-input-wrapper p {
            font-size: 12px;
            color: #64748b;
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 11px 24px;
            font-size: 13.5px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s;
        }

        .btn-submit:hover {
            background-color: var(--primary-dark);
        }

        /* PREVIEW IMAGE THUMBNAIL */
        .preview-box {
            margin-top: 10px;
            max-width: 180px;
            border-radius: 8px;
            overflow: hidden;
            display: none;
            border: 1px solid #e2e8f0;
        }

        .preview-box img {
            width: 100%;
            height: auto;
        }

        /* 4. FOOTER ADMIN */
        .admin-footer {
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 15px 30px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
        }

        /* RESPONSIF HP & TABLET */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-wrapper {
                margin-left: 0;
                width: 100%;
            }
            .menu-toggle {
                display: block !important;
            }
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 20px;
            color: #334155;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR NAVIGASI ADMIN -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="https://www.freepnglogos.com/uploads/logo-puskesmas-png/logo-puskesmas-lambang-baru-puskesmas-puskesmas-makale-3.png" alt="Logo Puskesmas">
            <div class="sidebar-brand-text">Puskesmas<br>Madukara 1</div>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-category">Menu Utama</li>
            <li class="active"><a href="#dashboard" onclick="showTab('carousel')"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>

            <li class="menu-category">Pengelolaan Konten</li>
            <li><a href="javascript:void(0)" onclick="showTab('carousel')"><i class="fa-solid fa-images"></i> Poster Carousel</a></li>
            <li><a href="javascript:void(0)" onclick="showTab('pimpinan')"><i class="fa-solid fa-user-tie"></i> Sambutan Pimpinan</a></li>
            <li><a href="javascript:void(0)" onclick="showTab('berita')"><i class="fa-solid fa-newspaper"></i> Berita & Kegiatan</a></li>
            <li><a href="javascript:void(0)" onclick="showTab('galeri')"><i class="fa-solid fa-photo-film"></i> Galeri Foto</a></li>

            <li class="menu-category">Profil & Layanan</li>
            <li><a href="javascript:void(0)" onclick="showTab('visimisi')"><i class="fa-solid fa-bullseye"></i> Visi Misi & Motto</a></li>
            <li><a href="javascript:void(0)" onclick="showTab('struktur')"><i class="fa-solid fa-sitemap"></i> Struktur Organisasi</a></li>
            <li><a href="javascript:void(0)" onclick="showTab('standar')"><i class="fa-solid fa-file-contract"></i> Standar Pelayanan</a></li>
            <li><a href="javascript:void(0)" onclick="showTab('jenis')"><i class="fa-solid fa-list-check"></i> Jenis Pelayanan</a></li>
            <li><a href="javascript:void(0)" onclick="showTab('maklumat')"><i class="fa-solid fa-scroll"></i> Maklumat Pelayanan</a></li>
            <li><a href="javascript:void(0)" onclick="showTab('mutu')"><i class="fa-solid fa-award"></i> Mutu Pelayanan</a></li>

            <li class="menu-category">Sistem</li>
            <li><a href="{{ url('/') }}" target="_blank"><i class="fa-solid fa-globe"></i> Lihat Website</a></li>
            <li><a href="#logout" style="color: #f87171;"><i class="fa-solid fa-right-from-bracket"></i> Keluar (Logout)</a></li>
        </ul>
    </aside>

    <!-- WRAPPER UTAMA -->
    <div class="main-wrapper">
        
        <!-- HEADER TOP BAR -->
        <header class="top-header">
            <div style="display: flex; align-items: center; gap: 15px;">
                <button class="menu-toggle" id="menuToggle"><i class="fa-solid fa-bars"></i></button>
                <div class="header-title">Panel Administrasi Konten Website</div>
            </div>

            <div class="admin-profile">
                <div class="admin-avatar">A</div>
                <div class="admin-info">
                    <div class="admin-name">Administrator</div>
                    <div class="admin-role">Puskesmas Madukara 1</div>
                </div>
            </div>
        </header>

        <!-- KONTEN UTAMA DENGAN FORM UPLOAD METODE TAB -->
        <main class="content-body">
            <div class="section-title">
                <i class="fa-solid fa-pen-to-square"></i> Form Manajemen Konten Gambar & Informasi
            </div>

            <!-- TAB PILIHAN MANAJEMEN -->
            <div class="admin-tabs">
                <button class="tab-btn active" onclick="showTab('carousel')">1. Carousel Poster</button>
                <button class="tab-btn" onclick="showTab('pimpinan')">2. Sambutan Pimpinan</button>
                <button class="tab-btn" onclick="showTab('berita')">3. Gambar Berita</button>
                <button class="tab-btn" onclick="showTab('galeri')">4. Galeri Foto</button>
                <button class="tab-btn" onclick="showTab('visimisi')">5. Visi, Misi & Motto</button>
                <button class="tab-btn" onclick="showTab('struktur')">6. Struktur Organisasi</button>
                <button class="tab-btn" onclick="showTab('standar')">7. Standar Pelayanan</button>
                <button class="tab-btn" onclick="showTab('jenis')">8. Jenis Pelayanan</button>
                <button class="tab-btn" onclick="showTab('maklumat')">9. Maklumat Pelayanan</button>
                <button class="tab-btn" onclick="showTab('mutu')">10. Mutu Pelayanan</button>
            </div>

            <!-- 1. FORM CAROUSEL -->
            <div class="form-card active" id="tab-carousel">
                <div class="form-card-header">
                    <h3>Upload Gambar Poster Carousel (Beranda)</h3>
                </div>
                <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Judul Poster / Headline</label>
                            <input type="text" name="title" class="form-control" placeholder="Contoh: Pelayanan Kesehatan Gratis">
                        </div>
                        <div class="form-group">
                            <label>File Gambar Poster</label>
                            <input type="file" name="image" accept="image/*" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Poster Carousel</button>
                </form>
            </div>

            <!-- 2. FORM SAMBUTAN PIMPINAN -->
            <div class="form-card" id="tab-pimpinan">
                <div class="form-card-header">
                    <h3>Upload Foto & Kata Sambutan Pimpinan</h3>
                </div>
                <form action="{{ route('admin.pimpinan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Kepala Puskesmas</label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh: dr. H. Ahmad Furtuna" required>
                        </div>
                        <div class="form-group">
                            <label>Jabatan / Gelar</label>
                            <input type="text" name="jabatan" class="form-control" value="Kepala Puskesmas Madukara 1" required>
                        </div>
                        <div class="form-group full-width">
                            <label>Kutipan Singkat (Quote)</label>
                            <input type="text" name="quote" class="form-control" placeholder="Masukkan kutipan singkat pimpinan...">
                        </div>
                        <div class="form-group full-width">
                            <label>Isi Lengkap Kata Sambutan</label>
                            <textarea name="sambutan" class="form-control" placeholder="Tuliskan kata sambutan pimpinan di sini..."></textarea>
                        </div>
                        <div class="form-group full-width">
                            <label>Foto Pimpinan (Format Portrait)</label>
                            <input type="file" name="foto" accept="image/*" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Sambutan Pimpinan</button>
                </form>
            </div>

            <!-- 3. FORM GAMBAR BERITA -->
            <div class="form-card" id="tab-berita">
                <div class="form-card-header">
                    <h3>Tambah Berita & Gambar Kegiatan</h3>
                </div>
                <form onsubmit="event.preventDefault(); alert('Berita berhasil dipublikasikan!');">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Judul Berita / Kegiatan</label>
                            <input type="text" class="form-control" placeholder="Judul berita terbaru..." required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Publikasi</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="form-group full-width">
                            <label>Upload Gambar Utama Berita</label>
                            <input type="file" accept="image/*" class="form-control" required>
                        </div>
                        <div class="form-group full-width">
                            <label>Isi Berita</label>
                            <textarea class="form-control" rows="5" placeholder="Tulis rincian berita..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-paper-plane"></i> Terbitkan Berita</button>
                </form>
            </div>

            <!-- 4. FORM GALERI GAMBAR -->
            <div class="form-card" id="tab-galeri">
                <div class="form-card-header">
                    <h3>Upload Galeri Gambar Kegiatan</h3>
                </div>
                <form onsubmit="event.preventDefault(); alert('Gambar Galeri berhasil diupload!');">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Judul / Keterangan Gambar</label>
                            <input type="text" class="form-control" placeholder="Keterangan singkat foto..." required>
                        </div>
                        <div class="form-group">
                            <label>Kategori Galeri</label>
                            <select class="form-control">
                                <option>Kegiatan Posyandu</option>
                                <option>Pelayanan Gedung</option>
                                <option>Pemeriksaan Luar Gedung</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label>Pilih Gambar Foto</label>
                            <input type="file" accept="image/*" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-upload"></i> Upload ke Galeri</button>
                </form>
            </div>

            <!-- 5. FORM VISI, MISI, TATA NILAI DAN MOTTO -->
            <div class="form-card" id="tab-visimisi">
                <div class="form-card-header">
                    <h3>Upload Gambar Visi, Misi, Tata Nilai & Motto</h3>
                </div>
                <form onsubmit="event.preventDefault(); alert('Gambar Visi Misi & Motto berhasil disimpan!');">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Gambar Infografis Visi & Misi</label>
                            <input type="file" accept="image/*" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Gambar Infografis Tata Nilai</label>
                            <input type="file" accept="image/*" class="form-control">
                        </div>
                        <div class="form-group full-width">
                            <label>Gambar Banner Motto Pelayanan</label>
                            <input type="file" accept="image/*" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Visi, Misi & Motto</button>
                </form>
            </div>

            <!-- 6. FORM STRUKTUR ORGANISASI -->
            <div class="form-card" id="tab-struktur">
                <div class="form-card-header">
                    <h3>Upload Gambar Bagan Struktur Organisasi</h3>
                </div>
                <form onsubmit="event.preventDefault(); alert('Bagan Struktur Organisasi berhasil diperbarui!');">
                    <div class="form-group">
                        <label>File Gambar Bagan Struktur Organisasi (Resolusi Tinggi)</label>
                        <input type="file" accept="image/*" class="form-control" required>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Perbarui Struktur Organisasi</button>
                </form>
            </div>

            <!-- 7. FORM STANDAR PELAYANAN -->
            <div class="form-card" id="tab-standar">
                <div class="form-card-header">
                    <h3>Upload Gambar Standar Pelayanan</h3>
                </div>
                <form onsubmit="event.preventDefault(); alert('Gambar Standar Pelayanan disimpan!');">
                    <div class="form-group">
                        <label>Judul Dokumen Standar Pelayanan</label>
                        <input type="text" class="form-control" placeholder="Contoh: Standar Pelayanan Pendaftaran & Poli">
                    </div>
                    <div class="form-group">
                        <label>Gambar / Flowchart Standar Pelayanan</label>
                        <input type="file" accept="image/*" class="form-control" required>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Standar Pelayanan</button>
                </form>
            </div>

            <!-- 8. FORM JENIS PELAYANAN -->
            <div class="form-card" id="tab-jenis">
                <div class="form-card-header">
                    <h3>Upload Gambar Jenis Pelayanan</h3>
                </div>
                <form onsubmit="event.preventDefault(); alert('Jenis Pelayanan disimpan!');">
                    <div class="form-group">
                        <label>Nama / Kategori Jenis Layanan</label>
                        <input type="text" class="form-control" placeholder="Contoh: Poli Gigi / UGD 24 Jam">
                    </div>
                    <div class="form-group">
                        <label>Gambar / Ikon Layanan</label>
                        <input type="file" accept="image/*" class="form-control" required>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Jenis Pelayanan</button>
                </form>
            </div>

            <!-- 9. FORM MAKLUMAT PELAYANAN -->
            <div class="form-card" id="tab-maklumat">
                <div class="form-card-header">
                    <h3>Upload Gambar Maklumat Pelayanan</h3>
                </div>
                <form onsubmit="event.preventDefault(); alert('Gambar Maklumat Pelayanan diperbarui!');">
                    <div class="form-group">
                        <label>Gambar Infografis / Poster Maklumat Pelayanan</label>
                        <input type="file" accept="image/*" class="form-control" required>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Maklumat Pelayanan</button>
                </form>
            </div>

            <!-- 10. FORM MUTU PELAYANAN -->
            <div class="form-card" id="tab-mutu">
                <div class="form-card-header">
                    <h3>Upload Gambar Mutu Pelayanan & Sertifikat Akreditasi</h3>
                </div>
                <form onsubmit="event.preventDefault(); alert('Gambar Mutu Pelayanan berhasil diperbarui!');">
                    <div class="form-group">
                        <label>Judul Capaian Mutu / Sertifikat</label>
                        <input type="text" class="form-control" placeholder="Contoh: Sertifikat Akreditasi Paripurna">
                    </div>
                    <div class="form-group">
                        <label>Gambar Sertifikat / Grafik Mutu Pelayanan</label>
                        <input type="file" accept="image/*" class="form-control" required>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Mutu Pelayanan</button>
                </form>
            </div>

        </main>

        <!-- FOOTER ADMIN -->
        <footer class="admin-footer">
            &copy; 2026 Admin System Puskesmas Madukara 1 Kabupaten Banjarnegara. All Rights Reserved.
        </footer>
    </div>

    <!-- SCRIPT JAVASCRIPT UNTUK NAVIGASI TAB & INTERAKSI ADMIN -->
    <script>
        // Switcher Tab Form Admin
        function showTab(tabName) {
            // Sembunyikan semua card
            const cards = document.querySelectorAll('.form-card');
            cards.forEach(card => card.classList.remove('active'));

            // Nonaktifkan semua button tab
            const tabBtns = document.querySelectorAll('.tab-btn');
            tabBtns.forEach(btn => btn.classList.remove('active'));

            // Tampilkan card dan button aktif yang dipilih
            const targetCard = document.getElementById('tab-' + tabName);
            if (targetCard) {
                targetCard.classList.add('active');
            }

            // Highlight tombol tab
            if (event && event.currentTarget) {
                event.currentTarget.classList.add('active');
            }
        }

        // Preview Gambar Sederhana
        function previewImg(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.querySelector('img').src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }

        // Sidebar Responsive Toggle (HP/Tablet)
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');

        if(menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('show');
            });
        }
    </script>
</body>
</html>