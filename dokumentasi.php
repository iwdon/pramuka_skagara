<?php
require_once __DIR__ . '/config/database.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Dokumentasi - Gudep 05-127 & 05-128 SMK Negeri 3 Jepara</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://placehold.co/60x60/4E1F6E/FFF?text=SKG">
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Custom Palette CSS Variables -->
    <style>
        :root {
            /* Palet Warna Utama */
            --color-dark-purple: #4E1F6E;   /* Deep Dark Purple */
            --color-navy-purple: #3E3E75;   /* Navy Purple */
            --color-teal:        #45A9A9;   /* Teal / Toska Medium */
            --color-mint-light:  #98E8DE;   /* Light Mint Green */
            
            --color-bg-light:    #F5F8F8;   /* Soft Light Gray-Mint */
            --color-text-main:   #2B2B2B;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-bg-light);
            color: var(--color-text-main);
        }

        /* Top Bar */
        .top-bar {
            background-color: var(--color-dark-purple);
            font-size: 0.85rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Navbar Styling */
        .navbar-custom {
            background-color: var(--color-navy-purple);
            box-shadow: 0 4px 20px rgba(62, 62, 117, 0.3);
            transition: all 0.3s ease;
        }

        .navbar-custom .navbar-brand {
            font-weight: 800;
            color: #FFFFFF !important;
            letter-spacing: 0.5px;
        }

        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.92) !important;
            font-weight: 500;
            padding: 0.6rem 1rem !important;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: var(--color-dark-purple) !important;
            background-color: var(--color-mint-light);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(78, 31, 110, 0.15);
            border-radius: 12px;
            padding: 8px;
            background-color: #FFFFFF;
        }

        .dropdown-item {
            font-weight: 500;
            border-radius: 8px;
            padding: 9px 16px;
            transition: all 0.2s ease;
            color: var(--color-dark-purple);
        }

        .dropdown-item:hover {
            background-color: rgba(152, 232, 222, 0.2);
            color: var(--color-navy-purple);
        }

        /* PAGE HEADER */
        .page-header {
            background: linear-gradient(rgba(78, 31, 110, 0.9), rgba(62, 62, 117, 0.92)),
                        url('https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
            color: white;
            padding: 65px 0;
            border-bottom: 4px solid var(--color-teal);
        }

        .section-tag {
            color: var(--color-teal);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.85rem;
        }

        .section-title {
            font-weight: 800;
            color: var(--color-dark-purple);
        }

        /* Filter Buttons */
        .btn-filter {
            border: 2px solid var(--color-navy-purple);
            color: var(--color-navy-purple);
            font-weight: 700;
            border-radius: 50px;
            padding: 8px 20px;
            transition: all 0.3s ease;
            background: transparent;
        }

        .btn-filter:hover, .btn-filter.active {
            background-color: var(--color-navy-purple);
            color: #FFFFFF;
        }

        /* Gallery Item Box */
        .gallery-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(62, 62, 117, 0.08);
            background: #000000;
            cursor: pointer;
            height: 260px;
        }

        .gallery-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease, opacity 0.5s ease;
            opacity: 0.9;
        }

        .gallery-card:hover img {
            transform: scale(1.1);
            opacity: 0.6;
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            padding: 20px;
            display: flex;
            flex-column: column;
            justify-content: flex-end;
            background: linear-gradient(to top, rgba(78, 31, 110, 0.95), rgba(0, 0, 0, 0) 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-card:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-icon-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
            background: var(--color-teal);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        /* Buttons */
        .btn-accent {
            background-color: var(--color-teal);
            color: #FFFFFF;
            font-weight: 800;
            padding: 10px 24px;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-accent:hover {
            background-color: #358d8d;
            color: #FFFFFF;
        }

        /* Footer Styling */
        footer {
            background-color: var(--color-dark-purple);
            color: rgba(255, 255, 255, 0.85);
        }

        footer h5 {
            color: #FFFFFF;
            font-weight: 700;
            margin-bottom: 1.2rem;
        }

        footer a {
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        footer a:hover {
            color: var(--color-mint-light);
        }

        .social-btn {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            background: var(--color-teal);
            color: #FFFFFF;
            transform: translateY(-3px);
        }
    </style>
</head>

<body>
<!-- Halaman dikonversi dari HTML ke PHP; desain asli dipertahankan. -->

    <!-- TOP BAR -->
    <div class="top-bar py-2 text-white d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <span><i class="fa-solid fa-location-dot me-2" style="color: var(--color-mint-light);"></i>SMK Negeri 3
                    Jepara, Jl. KS Tubun No. 3</span>
                <span><i class="fa-solid fa-envelope me-2"
                        style="color: var(--color-mint-light);"></i>pramuka@skagara.com</span>
            </div>
            <div class="d-flex gap-3">
                <a href="#" class="text-white text-decoration-none"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="text-white text-decoration-none"><i class="fa-brands fa-youtube"></i></a>
                <a href="#" class="text-white text-decoration-none"><i class="fa-brands fa-tiktok"></i></a>
            </div>
        </div>
    </div>
   
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
                <div class="d-flex flex-column">
                    <span class="fs-5 lh-1">PRASKA 3 JEPARA</span>
                    <small style="font-size: 0.68rem; opacity: 0.9; font-weight: 500;">GUDEP 05.127 - 05.128</small>
                </div>
            </a>

            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <i class="fa-solid fa-bars fs-3"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fa-solid fa-house me-1"></i> Beranda</a>
                    </li>

                    <!-- Dropdown 1: Tentang Kami -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="tentangDropdown" role="button"
                            data-bs-toggle="dropdown">
                            Tentang Kami
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profil.php"><i class="fa-solid fa-compass me-2"></i>Profil & Sejarah</a></li>
                            <li><a class="dropdown-item" href="prestasi.php"><i class="fa-solid fa-trophy me-2"></i>Prestasi & Garuda</a></li>
                        </ul>
                    </li>

                    <!-- Dropdown 2: Kegiatan & Agenda -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="kegiatanDropdown" role="button"
                            data-bs-toggle="dropdown">
                            Kegiatan & Agenda
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="jadwal-latihan.php"><i class="fa-solid fa-clock me-2"></i>Jadwal Latihan</a></li>
                            <li><a class="dropdown-item active" href="dokumentasi.php"><i class="fa-solid fa-images me-2"></i>Galeri Foto & Video</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="berita.php">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="materi.php">Materi</a>
                    </li>
                    <li class="nav-item ms-lg-2 my-2 my-lg-0">
                        <a class="btn btn-accent btn-sm px-3 shadow-none" href="pendaftaran.php"><i
                                class="fa-solid fa-user-plus me-1"></i> Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <header class="page-header text-center">
        <div class="container">
            <span class="badge bg-white text-dark fw-bold mb-3 px-3 py-2 rounded-pill"><i class="fa-solid fa-camera me-2"></i>REKAM JEJAK VISUAL</span>
            <h1 class="display-5 fw-extrabold text-white mb-2">Galeri Dokumentasi Kegiatan</h1>
            <p class="lead opacity-90 mx-auto" style="max-width: 680px; font-size: 1.05rem;">
                Abadikan momen kebersamaan, perjuangan, dan aksi nyata Ambalan dalam bentuk foto & video.
            </p>
        </div>
    </header>

    <!-- FILTER KATEGORI GALERI -->
    <section class="py-4 bg-white border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-filter active">Semua Album</button>
                <button class="btn btn-filter">Perkemahan & PTA</button>
                <button class="btn btn-filter">Pelantikan Penegak</button>
                <button class="btn btn-filter">Lomba & Prestasi</button>
                <button class="btn btn-filter">Bakti Pesisir</button>
            </div>
        </div>
    </section>

    <!-- GALERI FOTO GRID -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <span class="section-tag">Album Foto</span>
                    <h2 class="section-title mb-0">Dokumentasi Terbaru</h2>
                </div>
                <span class="text-muted small">Klik foto untuk memperbesar</span>
            </div>

            <div class="row g-4">
                <!-- Foto 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#imageModal" 
                         onclick="openModal('https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=1200&auto=format&fit=crop', 'Pelantikan Penegak Bantara 2026')">
                        <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=800&auto=format&fit=crop" alt="Foto 1">
                        <div class="gallery-icon-btn"><i class="fa-solid fa-expand"></i></div>
                        <div class="gallery-overlay">
                            <span class="badge mb-2 w-auto me-auto" style="background-color: var(--color-mint-light); color: var(--color-dark-purple);">Pelantikan</span>
                            <h6 class="text-white fw-bold mb-1">Pelantikan Penegak Bantara</h6>
                            <small class="text-white-50"><i class="fa-regular fa-calendar me-1"></i> Oktober 2026</small>
                        </div>
                    </div>
                </div>

                <!-- Foto 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#imageModal"
                         onclick="openModal('https://images.unsplash.com/photo-1526772662000-3f88f10405ff?q=80&w=1200&auto=format&fit=crop', 'Kompetisi Pioneering Sangga')">
                        <img src="https://images.unsplash.com/photo-1526772662000-3f88f10405ff?q=80&w=800&auto=format&fit=crop" alt="Foto 2">
                        <div class="gallery-icon-btn"><i class="fa-solid fa-expand"></i></div>
                        <div class="gallery-overlay">
                            <span class="badge mb-2 w-auto me-auto" style="background-color: var(--color-mint-light); color: var(--color-dark-purple);">Lomba</span>
                            <h6 class="text-white fw-bold mb-1">Kompetisi Pioneering Sangga Utama</h6>
                            <small class="text-white-50"><i class="fa-regular fa-calendar me-1"></i> September 2026</small>
                        </div>
                    </div>
                </div>

                <!-- Foto 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#imageModal"
                         onclick="openModal('https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=1200&auto=format&fit=crop', 'Aksi Reboisasi Mangrove Pesisir Jepara')">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=800&auto=format&fit=crop" alt="Foto 3">
                        <div class="gallery-icon-btn"><i class="fa-solid fa-expand"></i></div>
                        <div class="gallery-overlay">
                            <span class="badge mb-2 w-auto me-auto" style="background-color: var(--color-mint-light); color: var(--color-dark-purple);">Bakti Pesisir</span>
                            <h6 class="text-white fw-bold mb-1">Aksi Reboisasi Mangrove Pesisir</h6>
                            <small class="text-white-50"><i class="fa-regular fa-calendar me-1"></i> Agustus 2026</small>
                        </div>
                    </div>
                </div>

                <!-- Foto 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#imageModal"
                         onclick="openModal('https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=1200&auto=format&fit=crop', 'Upacara Pembukaan PTA 2026')">
                        <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=800&auto=format&fit=crop" alt="Foto 4">
                        <div class="gallery-icon-btn"><i class="fa-solid fa-expand"></i></div>
                        <div class="gallery-overlay">
                            <span class="badge mb-2 w-auto me-auto" style="background-color: var(--color-mint-light); color: var(--color-dark-purple);">Perkemahan</span>
                            <h6 class="text-white fw-bold mb-1">Upacara Pembukaan PTA 2026</h6>
                            <small class="text-white-50"><i class="fa-regular fa-calendar me-1"></i> Juli 2026</small>
                        </div>
                    </div>
                </div>

                <!-- Foto 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#imageModal"
                         onclick="openModal('https://images.unsplash.com/photo-1510312305653-8ed496efae75?q=80&w=1200&auto=format&fit=crop', 'Malam Api Unggun PTA 2026')">
                        <img src="https://images.unsplash.com/photo-1510312305653-8ed496efae75?q=80&w=800&auto=format&fit=crop" alt="Foto 5">
                        <div class="gallery-icon-btn"><i class="fa-solid fa-expand"></i></div>
                        <div class="gallery-overlay">
                            <span class="badge mb-2 w-auto me-auto" style="background-color: var(--color-mint-light); color: var(--color-dark-purple);">Perkemahan</span>
                            <h6 class="text-white fw-bold mb-1">Malam Api Unggun & Pentas Seni</h6>
                            <small class="text-white-50"><i class="fa-regular fa-calendar me-1"></i> Juli 2026</small>
                        </div>
                    </div>
                </div>

                <!-- Foto 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="gallery-card" data-bs-toggle="modal" data-bs-target="#imageModal"
                         onclick="openModal('https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?q=80&w=1200&auto=format&fit=crop', 'Latihan Rutin Navigasi Kompas')">
                        <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?q=80&w=800&auto=format&fit=crop" alt="Foto 6">
                        <div class="gallery-icon-btn"><i class="fa-solid fa-expand"></i></div>
                        <div class="gallery-overlay">
                            <span class="badge mb-2 w-auto me-auto" style="background-color: var(--color-mint-light); color: var(--color-dark-purple);">Latihan</span>
                            <h6 class="text-white fw-bold mb-1">Latihan Rutin Navigasi & Kompas</h6>
                            <small class="text-white-50"><i class="fa-regular fa-calendar me-1"></i> Mei 2026</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GALERI VIDEO DOKUMENTASI -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center max-w-lg mx-auto mb-5">
                <span class="section-tag">DOKUMENTASI VIDEO</span>
                <h2 class="section-title">Video Kegiatan</h2>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-lg-6">
                    <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-lg">
                        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Video Kegiatan Pramuka SKAGARA" allowfullscreen></iframe>
                    </div>
                    <h5 class="fw-bold mt-3 mb-1" style="color: var(--color-dark-purple);">Afterevent Perkemahan PTA & Pelantikan Bantara 2026</h5>
                    <p class="text-muted small">Rangkuman momen keseruan dan dinamika perkemahan penerimaan tamu ambalan pangkalan SMK Negeri 3 Jepara.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- MODAL POPUP PREVIEW FOTO -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 text-center position-relative">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 shadow-none" data-bs-dismiss="modal" aria-label="Close" style="z-index: 1055;"></button>
                    <img id="modalImg" src="" class="img-fluid rounded-4 shadow-lg mb-2" alt="Preview Foto">
                    <h6 id="modalTitle" class="text-white fw-bold"></h6>
                </div>
            </div>
        </div>
    </div>

<!-- FOOTER -->
    <footer class="pt-5 pb-3">
        <div class="container">
            <div class="row g-4 mb-4">
                <!-- Col 1: Identitas -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <h5 class="mb-0 text-white">PRASKA 3 JEPARA</h5>
                    </div>
                    <p class="small text-white-50">Gudep 05.127 - 05.128 Ambalan Wira Bhumi & Tri Buana Tungga Dewi
                        Pangkalan SMK Negeri 3 Jepara.</p>
                    <div class="mt-3">
                        <a href="#" class="social-btn"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="social-btn"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#" class="social-btn"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="#" class="social-btn"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Col 2: Navigasi Cepat -->
                <div class="col-lg-2 col-md-6">
                    <h5>Navigasi</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="profil.php">Profil Ambalan</a></li>
                        <li class="mb-2"><a href="materi.php">Materi SKU/TKU</a></li>
                        <li class="mb-2"><a href="pendaftaran.php">Pendaftaran Online</a></li>
                    </ul>
                </div>

                <!-- Col 3: Sekretariat -->
                <div class="col-lg-3 col-md-6">
                    <h5>Sanggar Bakti</h5>
                    <ul class="list-unstyled small text-white-50">
                        <li class="mb-2"><i class="fa-solid fa-building me-2"
                                style="color: var(--color-mint-light);"></i>SMK Negeri 3 Jepara</li>
                        <li class="mb-2"><i class="fa-solid fa-location-dot me-2"
                                style="color: var(--color-mint-light);"></i>Jl. KS Tubun No. 3, Kabupaten Jepara, Jawa
                            Tengah 59418</li>
                        <li class="mb-2"><i class="fa-solid fa-clock me-2" style="color: var(--color-mint-light);"></i>Senin
                            - Jumat: 07.00 - 16.00 WIB</li>
                    </ul>
                </div>

                <!-- Col 4: Tautan Luar -->
                <div class="col-lg-3 col-md-6">
                    <h5>Tautan Resmi</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="https://www.scout.org/" target="_blank"><i
                                    class="fa-solid fa-arrow-up-right-from-square me-1"></i> WOSM (scout.org)</a></li>
                        <li class="mb-2"><a href="#" target="_blank"><i
                                    class="fa-solid fa-arrow-up-right-from-square me-1"></i> Kwarnas Gerakan Pramuka</a>
                        </li>
                        <li class="mb-2"><a href="#" target="_blank"><i
                                    class="fa-solid fa-arrow-up-right-from-square me-1"></i> Kwarda Jawa Tengah</a></li>
                        <li class="mb-2"><a href="#" target="_blank"><i
                                    class="fa-solid fa-arrow-up-right-from-square me-1"></i> Kwarcab Jepara</a></li>
                    </ul>
                </div>
            </div>

            <hr class="border-secondary my-4" style="opacity: 0.2;">

            <div class="row align-items-center small text-white-50">
                <div class="col-md-6 text-center text-md-start">
                    &copy; 2026 Ambalan SKAGARA SMK Negeri 3 Jepara. Hak Cipta Dilindungi.
                </div>
                <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                    <span>Dikembangkan untuk Kepramukaan Vokasi SKAGARA</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Script Modal Image -->
    <script>
        function openModal(imgSrc, title) {
            document.getElementById('modalImg').src = imgSrc;
            document.getElementById('modalTitle').innerText = title;
        }
    </script>
</body>

</html>