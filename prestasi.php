<?php
require_once __DIR__ . '/config/database.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi & Pramuka Garuda - Pramuka SKAGARA Gudep 05.127 - 05.128</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="pramuka-logohd-38049.png">
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        :root {
            --color-dark-purple: #4E1F6E;
            --color-navy-purple: #3E3E75;
            --color-teal:        #45A9A9;
            --color-mint-light:  #98E8DE;
            --color-bg-light:    #F5F8F8;
            --color-text-main:   #2B2B2B;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-bg-light);
            color: var(--color-text-main);
        }
        .top-bar {
            background-color: var(--color-dark-purple);
            font-size: 0.85rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
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
        .page-header {
            background: linear-gradient(rgba(78, 31, 110, 0.92), rgba(62, 62, 117, 0.92)),
                        url('https://images.unsplash.com/photo-1510312305653-8ed496efae75?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
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
        .stat-banner {
            background: #FFFFFF;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 8px 24px rgba(62, 62, 117, 0.08);
            border-bottom: 4px solid var(--color-teal);
        }
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
        .card-custom {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(62, 62, 117, 0.08);
            transition: all 0.3s ease;
            background: #FFFFFF;
        }
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(62, 62, 117, 0.14);
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
        }
        .card-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: rgba(78, 31, 110, 0.85);
            color: #FFFFFF;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            z-index: 2;
        }
        .card-badge-gold {
            background-color: var(--color-teal);
            color: #FFFFFF;
        }
        .garuda-card {
            background: #FFFFFF;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 24px rgba(62, 62, 117, 0.08);
            transition: all 0.3s ease;
        }
        .garuda-card:hover {
            transform: translateY(-5px);
        }
        .garuda-img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--color-teal);
        }

        /* Accordion FAQ Styling */
        .accordion-item {
            border: none;
            border-radius: 12px !important;
            margin-bottom: 12px;
            box-shadow: 0 4px 12px rgba(62, 62, 117, 0.05);
            overflow: hidden;
        }
        .accordion-button:not(.collapsed) {
            background-color: var(--color-mint-light);
            color: var(--color-dark-purple);
            font-weight: 700;
            box-shadow: none;
        }
        .accordion-button {
            font-weight: 700;
            color: var(--color-navy-purple);
        }
        .accordion-button:focus {
            box-shadow: none;
        }

        /* Custom Pagination */
        .pagination .page-link {
            color: var(--color-navy-purple);
            border-radius: 8px;
            margin: 0 3px;
            font-weight: 700;
            border: 1px solid #ddd;
        }
        .pagination .page-item.active .page-link {
            background-color: var(--color-dark-purple);
            border-color: var(--color-dark-purple);
            color: #FFFFFF;
        }

        footer {
            background-color: var(--color-dark-purple);
            color: #FFFFFF;
        }
        footer a {
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            transition: all 0.2s ease;
        }
        footer a:hover {
            color: var(--color-mint-light);
        }
        .social-btn {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            margin-right: 8px;
            transition: all 0.3s ease;
        }
        .social-btn:hover {
            background-color: var(--color-teal);
        }
    </style>
</head>

<body>
    <!-- TOP BAR -->
    <div class="top-bar text-white py-2">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center small">
            <div class="mb-2 mb-md-0"><i class="fa-solid fa-phone me-1"></i> 0291 589315 | <i class="fa-solid fa-envelope me-1"></i> smkn3jepara@smkn3jepara.sch.id</div>
            <div>
                <span class="me-3"><i class="fa-solid fa-flag me-1"></i>Pramuka Gudep 05.127 - 05.128</span>
                <a href="pendaftaran.php" class="text-white text-decoration-none fw-semibold"><i class="fa-solid fa-user-plus me-1"></i>Daftar Anggota Baru</a>
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
            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fa-solid fa-bars fs-3"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fa-solid fa-house me-1"></i> Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="tentangDropdown" role="button" data-bs-toggle="dropdown">Tentang Kami</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profil.php"><i class="fa-solid fa-compass me-2"></i>Profil & Sejarah</a></li>

                            <li><a class="dropdown-item active" href="prestasi.php"><i class="fa-solid fa-trophy me-2"></i>Prestasi & Garuda</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="kegiatanDropdown" role="button" data-bs-toggle="dropdown">Kegiatan & Agenda</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="jadwal-latihan.php"><i class="fa-solid fa-clock me-2"></i>Jadwal Latihan</a></li>
                            <li><a class="dropdown-item" href="berita.php"><i class="fa-solid fa-newspaper me-2"></i>Berita</a></li>
                            <li><a class="dropdown-item" href="dokumentasi.php"><i class="fa-solid fa-images me-2"></i>Galeri Foto & Video</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="materi.php">Materi</a></li>
                    <li class="nav-item ms-lg-2 my-2 my-lg-0"><a class="btn btn-accent btn-sm px-3 shadow-none" href="pendaftaran.php"><i class="fa-solid fa-user-plus me-1"></i> Pendaftaran</a></li>
                    <li class="nav-item"><a class="nav-link" href="kontak.php">Kontak</a></li>
                    <li class="nav-item ms-lg-2 my-2 my-lg-0"><a class="btn btn-accent btn-sm px-3 shadow-none" href="pendaftaran.php"><i class="fa-solid fa-user-plus me-1"></i> Pendaftaran</a></li>
                    <li class="nav-item"><a class="nav-link" href="kontak.php">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HEADER PAGE -->
    <header class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="section-tag text-white-75">Prestasi & Penghargaan</span>
                    <h1 class="display-6 fw-extrabold mb-2 mt-2">Prestasi & Pramuka Garuda Ambalan</h1>
                    <p class="lead mb-0 opacity-90 small">Rekam jejak keberhasilan anggota Ambalan Wira Bhumi & Tri Buana Tungga Dewi dalam berbagai kejuaraan kepramukaan.</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- STATISTIK RINGKAS -->
    <section class="container mt-n4 position-relative" style="z-index: 10;">
        <div class="stat-banner">
            <div class="row g-4 text-center">
                <div class="col-md-4"><h2 class="fw-extrabold mb-1" style="color: var(--color-dark-purple);">12</h2><p class="text-muted mb-0 small">Prestasi Tingkat Kab/Kota</p></div>
                <div class="col-md-4"><h2 class="fw-extrabold mb-1" style="color: var(--color-dark-purple);">5</h2><p class="text-muted mb-0 small">Prestasi Tingkat Provinsi</p></div>
                <div class="col-md-4"><h2 class="fw-extrabold mb-1" style="color: var(--color-dark-purple);">8</h2><p class="text-muted mb-0 small">Anggota Pramuka Garuda</p></div>
            </div>
        </div>
    </section>

    <!-- SECTION PRAMUKA GARUDA -->
    <section class="py-5">
        <div class="container">
            <div class="text-center max-w-lg mx-auto mb-4">
                <span class="section-tag">The Highest Award</span>
                <h2 class="section-title">Pramuka Garuda</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="garuda-card d-flex align-items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=400&auto=format&fit=crop" class="garuda-img" alt="Garuda 1">
                        <div>
                            <span class="badge mb-1" style="background-color: var(--color-mint-light); color: var(--color-dark-purple);">Garuda 2026</span>
                            <h6 class="fw-bold mb-1">Ahmad Rizky Pratama</h6>
                            <small class="opacity-75 d-block">Ambalan Wira Bhumi</small>
                            <small class="text-info"><i class="fa-solid fa-certificate me-1"></i>SK Kwarcab Jepara</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="garuda-card d-flex align-items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=400&auto=format&fit=crop" class="garuda-img" alt="Garuda 2">
                        <div>
                            <span class="badge mb-1" style="background-color: var(--color-mint-light); color: var(--color-dark-purple);">Garuda 2026</span>
                            <h6 class="fw-bold mb-1">Siti Nurhaliza</h6>
                            <small class="opacity-75 d-block">Ambalan Tri Buana</small>
                            <small class="text-info"><i class="fa-solid fa-certificate me-1"></i>SK Kwarcab Jepara</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="garuda-card d-flex align-items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400&auto=format&fit=crop" class="garuda-img" alt="Garuda 3">
                        <div>
                            <span class="badge mb-1" style="background-color: var(--color-mint-light); color: var(--color-dark-purple);">Garuda 2025</span>
                            <h6 class="fw-bold mb-1">Bagus Setiawan</h6>
                            <small class="opacity-75 d-block">Ambalan Wira Bhumi</small>
                            <small class="text-info"><i class="fa-solid fa-certificate me-1"></i>SK Kwarcab Jepara</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION DAFTAR PRESTASI & FILTERING -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
                <div>
                    <span class="section-tag">Galeri Juara</span>
                    <h2 class="section-title mb-0">Daftar Kejuaraan Ambalan</h2>
                </div>
                <div class="d-flex flex-wrap gap-2 mt-3 mt-md-0" id="filterButtons">
                    <button class="btn btn-filter active" data-filter="all">Semua</button>
                    <button class="btn btn-filter" data-filter="kwarcab">Kwarcab / Kab.</button>
                    <button class="btn btn-filter" data-filter="kwarda">Kwarda / Prov.</button>
                    <button class="btn btn-filter" data-filter="nasional">Nasional</button>
                    <button class="btn btn-filter" data-filter="lainnya">Lainnya</button>
                </div>
            </div>

            <!-- GRID DATA PRESTASI (12 ITEM DATA) -->
            <div class="row g-4" id="prestasiGrid">
                
                <!-- Item 1 -->
                <div class="col-md-4 prestasi-item" data-category="kwarcab">
                    <div class="card-custom h-100 d-flex flex-column">
                        <div class="card-img-wrapper">
                            <span class="card-badge card-badge-gold"><i class="fa-solid fa-trophy me-1"></i>Juara 1</span>
                            <img src="https://images.unsplash.com/photo-1526772662000-3f88f10405ff?q=80&w=800&auto=format&fit=crop" alt="Lomba Pioneering">
                        </div>
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> September 2026</div>
                            <h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Juara 1 Lomba Pioneering Vokasi</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">Sangga Utama Putra Wira Bhumi berhasil meraih juara 1 dalam kreasi pioneering simpul dan ikatan.</p>
                            <span class="fw-bold small" style="color: var(--color-teal);"><i class="fa-solid fa-medal me-1"></i>Tingkat Kwarcab Jepara</span>
                        </div>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="col-md-4 prestasi-item" data-category="kwarcab">
                    <div class="card-custom h-100 d-flex flex-column">
                        <div class="card-img-wrapper">
                            <span class="card-badge card-badge-gold"><i class="fa-solid fa-trophy me-1"></i>Juara 1</span>
                            <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=800&auto=format&fit=crop" alt="Lomba PBB">
                        </div>
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> Agustus 2026</div>
                            <h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Juara 1 PBB Variasi & Formasi</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">Tim Pasukan Khusus Putri Tri Buana Tungga Dewi meraih nilai tertinggi ketepatan ikrar dan variasi formasi.</p>
                            <span class="fw-bold small" style="color: var(--color-teal);"><i class="fa-solid fa-medal me-1"></i>Tingkat Kwarcab Jepara</span>
                        </div>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="col-md-4 prestasi-item" data-category="kwarda">
                    <div class="card-custom h-100 d-flex flex-column">
                        <div class="card-img-wrapper">
                            <span class="card-badge bg-secondary"><i class="fa-solid fa-trophy me-1"></i>Juara 2</span>
                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=800&auto=format&fit=crop" alt="Lomba Eco Scout">
                        </div>
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> Juni 2026</div>
                            <h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Juara 2 Inovasi Eco-Scout</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">Aksi inovasi lingkungan daur ulang sampah pesisir tingkat Provinsi Jawa Tengah.</p>
                            <span class="fw-bold small" style="color: var(--color-teal);"><i class="fa-solid fa-medal me-1"></i>Tingkat Kwarda Jateng</span>
                        </div>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="col-md-4 prestasi-item" data-category="kwarcab">
                    <div class="card-custom h-100 d-flex flex-column">
                        <div class="card-img-wrapper">
                            <span class="card-badge card-badge-gold"><i class="fa-solid fa-trophy me-1"></i>Juara 1</span>
                            <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?q=80&w=800&auto=format&fit=crop" alt="Lomba Sandi">
                        </div>
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> Mei 2026</div>
                            <h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Juara 1 Lomba Sandi & Komunikasi</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">Kecepatan dan ketepatan menerjemahkan Morse, Semaphore, dan Sandi Kotak.</p>
                            <span class="fw-bold small" style="color: var(--color-teal);"><i class="fa-solid fa-medal me-1"></i>Tingkat Kwarcab Jepara</span>
                        </div>
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="col-md-4 prestasi-item" data-category="kwarda">
                    <div class="card-custom h-100 d-flex flex-column">
                        <div class="card-img-wrapper">
                            <span class="card-badge bg-secondary"><i class="fa-solid fa-trophy me-1"></i>Juara 3</span>
                            <img src="https://images.unsplash.com/photo-1510312305653-8ed496efae75?q=80&w=800&auto=format&fit=crop" alt="Lomba Cerdas Cermat">
                        </div>
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> April 2026</div>
                            <h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Juara 3 Cerdas Cermat Kepramukaan</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">Prestasi tingkat Provinsi Jawa Tengah dalam wawasan AD/ART dan Sejarah Pramuka.</p>
                            <span class="fw-bold small" style="color: var(--color-teal);"><i class="fa-solid fa-medal me-1"></i>Tingkat Kwarda Jateng</span>
                        </div>
                    </div>
                </div>

                <!-- Item 6 -->
                <div class="col-md-4 prestasi-item" data-category="kwarcab">
                    <div class="card-custom h-100 d-flex flex-column">
                        <div class="card-img-wrapper">
                            <span class="card-badge bg-secondary"><i class="fa-solid fa-trophy me-1"></i>Juara 2</span>
                            <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=800&auto=format&fit=crop" alt="Lomba Baris Berbaris">
                        </div>
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> Maret 2026</div>
                            <h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Juara 2 PBB Tongkat Penegak</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">Tim PBB Ambalan Wira Bhumi meraih Juara 2 Kategori Ketangkasan Tongkat.</p>
                            <span class="fw-bold small" style="color: var(--color-teal);"><i class="fa-solid fa-medal me-1"></i>Tingkat Kwarcab Jepara</span>
                        </div>
                    </div>
                </div>

                <!-- Item 7 -->
                <div class="col-md-4 prestasi-item" data-category="nasional">
                    <div class="card-custom h-100 d-flex flex-column">
                        <div class="card-img-wrapper">
                            <span class="card-badge card-badge-gold"><i class="fa-solid fa-trophy me-1"></i>Juara 1</span>
                            <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=800&auto=format&fit=crop" alt="Lomba Nasional">
                        </div>
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> Oktober 2025</div>
                            <h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Juara 1 Karya Tulis Vokasi</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">Inovasi teknologi tepat guna karya Penegak SKAGARA di ajang Kemah Nasional.</p>
                            <span class="fw-bold small" style="color: var(--color-teal);"><i class="fa-solid fa-medal me-1"></i>Tingkat Nasional</span>
                        </div>
                    </div>
                </div>

                <!-- Item 8 -->
                <div class="col-md-4 prestasi-item" data-category="kwarda">
                    <div class="card-custom h-100 d-flex flex-column">
                        <div class="card-img-wrapper">
                            <span class="card-badge card-badge-gold"><i class="fa-solid fa-trophy me-1"></i>Juara 1</span>
                            <img src="https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?q=80&w=800&auto=format&fit=crop" alt="Lomba Pertolongan Pertama">
                        </div>
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> September 2025</div>
                            <h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Juara 1 Pertolongan Pertama (PPPK)</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">Kecepatan evakuasi dan pembalutan luka dalam Gladian Kwarda Jawa Tengah.</p>
                            <span class="fw-bold small" style="color: var(--color-teal);"><i class="fa-solid fa-medal me-1"></i>Tingkat Kwarda Jateng</span>
                        </div>
                    </div>
                </div>

                <!-- Item 9 -->
                <div class="col-md-4 prestasi-item" data-category="kwarcab">
                    <div class="card-custom h-100 d-flex flex-column">
                        <div class="card-img-wrapper">
                            <span class="card-badge bg-secondary"><i class="fa-solid fa-trophy me-1"></i>Juara 2</span>
                            <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=800&auto=format&fit=crop" alt="Lomba Navigasi">
                        </div>
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> Agustus 2025</div>
                            <h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Juara 2 Navigasi Darat & Kompas</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">Lomba orientasi medan penjelajahan hutan pesisir Kabupaten Jepara.</p>
                            <span class="fw-bold small" style="color: var(--color-teal);"><i class="fa-solid fa-medal me-1"></i>Tingkat Kwarcab Jepara</span>
                        </div>
                    </div>
                </div>

                <!-- Item 10 -->
                <div class="col-md-4 prestasi-item" data-category="nasional">
                    <div class="card-custom h-100 d-flex flex-column">
                        <div class="card-img-wrapper">
                            <span class="card-badge bg-secondary"><i class="fa-solid fa-trophy me-1"></i>Juara 3</span>
                            <img src="https://images.unsplash.com/photo-1510312305653-8ed496efae75?q=80&w=800&auto=format&fit=crop" alt="Lomba Fotografi">
                        </div>
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> Mei 2025</div>
                            <h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Juara 3 Jurnalistik & Fotografi</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">Dokumentasi terbaik aksi Pramuka Peduli Lingkungan tingkat Nasional.</p>
                            <span class="fw-bold small" style="color: var(--color-teal);"><i class="fa-solid fa-medal me-1"></i>Tingkat Nasional</span>
                        </div>
                    </div>
                </div>

                <!-- Item 11 -->
                <div class="col-md-4 prestasi-item" data-category="lainnya">
                    <div class="card-custom h-100 d-flex flex-column">
                        <div class="card-img-wrapper">
                            <span class="card-badge bg-secondary"><i class="fa-solid fa-trophy me-1"></i>Harapan 1</span>
                            <img src="https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?q=80&w=800&auto=format&fit=crop" alt="Lomba Kreasi Seni">
                        </div>
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> November 2025</div>
                            <h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Harapan 1 Pentas Seni Budaya</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">Penampilan tari tradisional Jepara pada Temu Budaya Pramuka Penegak.</p>
                            <span class="fw-bold small" style="color: var(--color-teal);"><i class="fa-solid fa-medal me-1"></i>Lainnya / Fest</span>
                        </div>
                    </div>
                </div>

                <!-- Item 12 -->
                <div class="col-md-4 prestasi-item" data-category="lainnya">
                    <div class="card-custom h-100 d-flex flex-column">
                        <div class="card-img-wrapper">
                            <span class="card-badge card-badge-gold"><i class="fa-solid fa-trophy me-1"></i>Juara 1</span>
                            <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?q=80&w=800&auto=format&fit=crop" alt="Lomba Teknologi">
                        </div>
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> Januari 2025</div>
                            <h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Juara 1 Website Gudep Terinovatif</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">Pengembangan portal digital dan sistem pendaftaran anggota online SKAGARA.</p>
                            <span class="fw-bold small" style="color: var(--color-teal);"><i class="fa-solid fa-medal me-1"></i>Lainnya / Antar-Gudep</span>
                        </div>
                    </div>
                </div>

            </div>

            <div id="noResult" class="text-center py-4 d-none">
                <p class="text-muted">Tidak ada data prestasi untuk filter ini.</p>
            </div>

            <!-- PAGINASI HALAMAN -->
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Navigasi Halaman Prestasi">
                    <ul class="pagination" id="pagination">
                        <!-- Render via JS -->
                    </ul>
                </nav>
            </div>
        </div>
    </section>

    <!-- FREQUENTLY ASKED QUESTIONS (FAQ TANYA JAWAB) -->
    <section class="py-5" style="background-color: #FFFFFF;">
        <div class="container">
            <div class="text-center max-w-lg mx-auto mb-5">
                <span class="section-tag">Tanya Jawab</span>
                <h2 class="section-title">Seputar Prestasi & Pramuka Garuda</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        
                        <!-- FAQ 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                    Bagaimana alur untuk menjadi anggota Pramuka Garuda di SKAGARA?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted small">
                                    Calon Pramuka Garuda harus telah dilantik menjadi Penegak Laksana, menyelesaikan sekurang-kurangnya 10 TKK, aktif dalam bakti masyarakat, serta lolos verifikasi berkas dan uji kecakapan oleh Tim Penilai Kwarcab Jepara.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                    Apakah anggota biasa bisa ikut seleksi lomba mewakili Ambalan?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted small">
                                    Bisa. Seluruh anggota Penegak SKAGARA memiliki kesempatan yang sama melalui proses seleksi internal Sangga dan Pemusatan Latihan (TC) yang diselenggarakan oleh Dewan Ambalan.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                    Apa apresiasi bagi anggota yang berhasil meraih juara perlombaan?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted small">
                                    Anggota berprestasi mendapatkan piagam penghargaan sekolah, sertifikat resmi kejuaraan, serta dukungan poin portofolio prestasi untuk beasiswa maupun kelanjutan studi/karier.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

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
                <div class="col-lg-2 col-md-6">
                    <h5>Navigasi</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="profil.php">Profil Ambalan</a></li>
                        <li class="mb-2"><a href="ambalan.php">Dewan Ambalan</a></li>
                        <li class="mb-2"><a href="program-kerja.php">Program Kerja</a></li>
                        <li class="mb-2"><a href="materi.php">Materi SKU/TKU</a></li>
                        <li class="mb-2"><a href="pendaftaran.php">Pendaftaran Online</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Sanggar Bakti</h5>
                    <ul class="list-unstyled small text-white-50">
                        <li class="mb-2"><i class="fa-solid fa-building me-2" style="color: var(--color-mint-light);"></i>SMK Negeri 3 Jepara</li>
                        <li class="mb-2"><i class="fa-solid fa-location-dot me-2" style="color: var(--color-mint-light);"></i>Jl. KS Tubun No. 3, Kabupaten Jepara, Jawa Tengah 59418</li>
                        <li class="mb-2"><i class="fa-solid fa-clock me-2" style="color: var(--color-mint-light);"></i>Senin - Jumat: 07.00 - 16.00 WIB</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>Tautan Resmi</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="https://www.scout.org/" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square me-1"></i> WOSM (scout.org)</a></li>
                        <li class="mb-2"><a href="#" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Kwarnas Gerakan Pramuka</a></li>
                        <li class="mb-2"><a href="#" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Kwarda Jawa Tengah</a></li>
                        <li class="mb-2"><a href="#" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Kwarcab Jepara</a></li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary my-4" style="opacity: 0.2;">
            <div class="row align-items-center small text-white-50">
                <div class="col-md-6 text-center text-md-start">&copy; 2026 Ambalan SKAGARA SMK Negeri 3 Jepara. Hak Cipta Dilindungi.</div>
                <div class="col-md-6 text-center text-md-end mt-2 mt-md-0"><span>Dikembangkan untuk Kepramukaan Vokasi SKAGARA</span></div>
            </div>
        </div>
    </footer>

    <!-- JS BUNDLE & PAGINATION SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const itemsPerPage = 6;
            let currentPage = 1;
            let currentFilter = 'all';

            const items = Array.from(document.querySelectorAll('.prestasi-item'));
            const filterBtns = document.querySelectorAll('#filterButtons .btn-filter');
            const noResult = document.getElementById('noResult');
            const paginationContainer = document.getElementById('pagination');

            function getFilteredItems() {
                return items.filter(item => {
                    return currentFilter === 'all' || item.dataset.category === currentFilter;
                });
            }

            function render() {
                const filteredItems = getFilteredItems();
                const totalItems = filteredItems.length;
                const totalPages = Math.ceil(totalItems / itemsPerPage) || 1;

                if (currentPage > totalPages) currentPage = totalPages;

                // Sembunyikan semua item lebih dulu
                items.forEach(item => item.classList.add('d-none'));

                if (totalItems === 0) {
                    noResult.classList.remove('d-none');
                } else {
                    noResult.classList.add('d-none');
                    const start = (currentPage - 1) * itemsPerPage;
                    const end = start + itemsPerPage;
                    const visibleItems = filteredItems.slice(start, end);

                    visibleItems.forEach(item => item.classList.remove('d-none'));
                }

                // Render tombol paginasi
                paginationContainer.innerHTML = '';
                if (totalPages > 1) {
                    for (let i = 1; i <= totalPages; i++) {
                        const li = document.createElement('li');
                        li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                        li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                        li.addEventListener('click', (e) => {
                            e.preventDefault();
                            currentPage = i;
                            render();
                        });
                        paginationContainer.appendChild(li);
                    }
                }
            }

            // Event listener untuk tombol filter
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentFilter = this.dataset.filter;
                    currentPage = 1;
                    render();
                });
            });

            // Inisialisasi awal
            render();
        });
    </script>
</body>
</html>