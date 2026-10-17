<?php
require_once __DIR__ . '/config/database.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Kepramukaan - Gudep 05.127 & 05.128 SMK Negeri 3 Jepara</title>
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

    <!-- Custom Palette CSS Variables -->
    <style>
        :root {
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
                        url('https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
            color: white;
            padding: 65px 0 75px;
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

        /* Search Box */
        .search-box {
            background: #FFFFFF;
            padding: 8px 12px;
            border-radius: 50px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .search-box input {
            border: none;
            outline: none;
            box-shadow: none;
        }

        /* Category Pill */
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

        /* Materi Cards */
        .card-materi {
            background: #FFFFFF;
            border-radius: 16px;
            border: none;
            box-shadow: 0 6px 20px rgba(62, 62, 117, 0.06);
            transition: all 0.3s ease;
            height: 100%;
            overflow: hidden;
        }

        .card-materi:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 28px rgba(62, 62, 117, 0.14);
        }

        .materi-icon-bg {
            width: 60px;
            height: 60px;
            background: rgba(152, 232, 222, 0.3);
            color: var(--color-dark-purple);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
        }

        .badge-category {
            background-color: var(--color-mint-light);
            color: var(--color-dark-purple);
            font-weight: 700;
            font-size: 0.75rem;
            padding: 5px 12px;
            border-radius: 50px;
        }

        /* Accordion FAQ */
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

        /* Pagination Custom */
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

    <!-- TOP BAR -->
    <div class="top-bar py-2 text-white d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <span><i class="fa-solid fa-location-dot me-2" style="color: var(--color-mint-light);"></i>SMK Negeri 3 Jepara, Jl. KS Tubun No. 3</span>
                <span><i class="fa-solid fa-envelope me-2" style="color: var(--color-mint-light);"></i>pramuka@skagara.com</span>
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

            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fa-solid fa-bars fs-3"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fa-solid fa-house me-1"></i> Beranda</a>
                    </li>

                    <!-- Dropdown 1: Tentang Kami -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="tentangDropdown" role="button" data-bs-toggle="dropdown">
                            Tentang Kami
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profil.php"><i class="fa-solid fa-compass me-2"></i>Profil & Sejarah</a></li>

                            <li><a class="dropdown-item" href="prestasi.php"><i class="fa-solid fa-trophy me-2"></i>Prestasi & Garuda</a></li>
                        </ul>
                    </li>

                    <!-- Dropdown 2: Kegiatan & Agenda -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="kegiatanDropdown" role="button" data-bs-toggle="dropdown">
                            Kegiatan & Agenda
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="jadwal-latihan.php"><i class="fa-solid fa-clock me-2"></i>Jadwal Latihan</a></li>
                            <li><a class="dropdown-item" href="berita.php"><i class="fa-solid fa-newspaper me-2"></i>Berita</a></li>
                            <li><a class="dropdown-item" href="dokumentasi.php"><i class="fa-solid fa-images me-2"></i>Galeri Foto & Video</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="berita.php">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="materi.php">Materi</a>
                    </li>
                    <li class="nav-item ms-lg-2 my-2 my-lg-0">
                        <a class="btn btn-accent btn-sm px-3 shadow-none" href="pendaftaran.php"><i class="fa-solid fa-user-plus me-1"></i> Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- PAGE HEADER & SEARCH BAR -->
    <header class="page-header text-center">
        <div class="container">
            <span class="badge bg-white text-dark fw-bold mb-3 px-3 py-2 rounded-pill"><i class="fa-solid fa-book-open me-2"></i>PUSAT MATERI & SKILL PENEGAK</span>
            <h1 class="display-5 fw-extrabold text-white mb-2">Panduan & Modul Materi Pramuka</h1>
            <p class="lead opacity-90 mx-auto mb-4" style="max-width: 680px; font-size: 1.05rem;">
                Akses materi kecakapan kepramukaan, panduan SKU Bantara & Laksana, serta keterampilan khusus vokasi.
            </p>

            <!-- Search Bar Form -->
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="search-box d-flex align-items-center">
                        <i class="fa-solid fa-magnifying-glass ms-3 text-muted"></i>
                        <input type="text" id="searchInput" class="form-control border-0 ps-3" placeholder="Cari materi (contoh: Sandi, Pioneering, SKU Bantara)...">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- FILTER KATEGORI -->
    <section class="py-4 bg-white border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap gap-2 justify-content-center" id="filterButtons">
                <button class="btn btn-filter active" data-category="all">Semua Materi</button>
                <button class="btn btn-filter" data-category="sku">SKU & TKU Penegak</button>
                <button class="btn btn-filter" data-category="skill">Scout Skill & Pioneering</button>
                <button class="btn btn-filter" data-category="navigasi">Navigasi & Survival</button>
                <button class="btn btn-filter" data-category="komunikasi">Komunikasi & Sandi</button>
                <button class="btn btn-filter" data-category="vokasi">Pramuka Peduli & Vokasi</button>
            </div>
        </div>
    </section>

    <!-- DAFTAR MATERI MODUL -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <span class="section-tag">Kumpulan Modul</span>
                    <h2 class="section-title mb-0">Materi Pilihan Penegak</h2>
                </div>
                <span class="text-muted small" id="materiCounter">Menampilkan 6 dari 12 Modul</span>
            </div>

            <div class="row g-4" id="materiContainer">
                <!-- Modul 1 -->
                <div class="col-md-6 col-lg-4 materi-item" data-category="sku">
                    <div class="card-materi p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="materi-icon-bg"><i class="fa-solid fa-award"></i></div>
                            <span class="badge-category">SKU & TKU Penegak</span>
                        </div>
                        <h5 class="fw-bold mb-2 materi-title" style="color: var(--color-dark-purple);">Panduan Pengisian SKU Penegak Bantara</h5>
                        <p class="text-muted small mb-4 flex-grow-1">Panduan lengkap langkah dan poin-poin ujian Syarat Kecakapan Umum (SKU) Bantara Pangkalan SMK Negeri 3 Jepara.</p>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                            <span class="text-muted small"><i class="fa-regular fa-file-pdf me-1" style="color: var(--color-teal);"></i> PDF (2.4 MB)</span>
                            <a href="#" class="btn btn-sm btn-accent fw-bold px-3"><i class="fa-solid fa-download me-1"></i> Unduh</a>
                        </div>
                    </div>
                </div>

                <!-- Modul 2 -->
                <div class="col-md-6 col-lg-4 materi-item" data-category="skill">
                    <div class="card-materi p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="materi-icon-bg"><i class="fa-solid fa-route"></i></div>
                            <span class="badge-category">Scout Skill & Pioneering</span>
                        </div>
                        <h5 class="fw-bold mb-2 materi-title" style="color: var(--color-dark-purple);">Pioneering & Ikatan Tali Temali</h5>
                        <p class="text-muted small mb-4 flex-grow-1">Teknik pembuatan tiang bendera, jembatan darurat, serta macam-macam simpul dan ikatan dasar kepramukaan.</p>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                            <span class="text-muted small"><i class="fa-regular fa-file-pdf me-1" style="color: var(--color-teal);"></i> PDF (3.8 MB)</span>
                            <a href="#" class="btn btn-sm btn-accent fw-bold px-3"><i class="fa-solid fa-download me-1"></i> Unduh</a>
                        </div>
                    </div>
                </div>

                <!-- Modul 3 -->
                <div class="col-md-6 col-lg-4 materi-item" data-category="navigasi">
                    <div class="card-materi p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="materi-icon-bg"><i class="fa-solid fa-compass"></i></div>
                            <span class="badge-category">Navigasi & Survival</span>
                        </div>
                        <h5 class="fw-bold mb-2 materi-title" style="color: var(--color-dark-purple);">Navigasi Darat & Kompas Bidik</h5>
                        <p class="text-muted small mb-4 flex-grow-1">Materi pembacaan peta topografi, penggunaan kompas bidik, serta orientasi medan penjelajahan.</p>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                            <span class="text-muted small"><i class="fa-regular fa-file-pdf me-1" style="color: var(--color-teal);"></i> PDF (1.9 MB)</span>
                            <a href="#" class="btn btn-sm btn-accent fw-bold px-3"><i class="fa-solid fa-download me-1"></i> Unduh</a>
                        </div>
                    </div>
                </div>

                <!-- Modul 4 -->
                <div class="col-md-6 col-lg-4 materi-item" data-category="komunikasi">
                    <div class="card-materi p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="materi-icon-bg"><i class="fa-solid fa-envelope-open-text"></i></div>
                            <span class="badge-category">Komunikasi & Sandi</span>
                        </div>
                        <h5 class="fw-bold mb-2 materi-title" style="color: var(--color-dark-purple);">Sandi, Semaphore, & Morse</h5>
                        <p class="text-muted small mb-4 flex-grow-1">Kumpulan sandi kepramukaan (Sandi Kotak, Rumput, Morse, Semaphore) untuk komunikasi lapangan.</p>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                            <span class="text-muted small"><i class="fa-regular fa-file-pdf me-1" style="color: var(--color-teal);"></i> PDF (1.5 MB)</span>
                            <a href="#" class="btn btn-sm btn-accent fw-bold px-3"><i class="fa-solid fa-download me-1"></i> Unduh</a>
                        </div>
                    </div>
                </div>

                <!-- Modul 5 -->
                <div class="col-md-6 col-lg-4 materi-item" data-category="vokasi">
                    <div class="card-materi p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="materi-icon-bg"><i class="fa-solid fa-tree"></i></div>
                            <span class="badge-category">Pramuka Peduli & Vokasi</span>
                        </div>
                        <h5 class="fw-bold mb-2 materi-title" style="color: var(--color-dark-purple);">Konservasi Pesisir & Reboisasi Mangrove</h5>
                        <p class="text-muted small mb-4 flex-grow-1">Modul panduan aksi bakti lingkungan, kelola sampah vokasi, dan pembibitan tanaman pesisir.</p>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                            <span class="text-muted small"><i class="fa-regular fa-file-pdf me-1" style="color: var(--color-teal);"></i> PDF (4.2 MB)</span>
                            <a href="#" class="btn btn-sm btn-accent fw-bold px-3"><i class="fa-solid fa-download me-1"></i> Unduh</a>
                        </div>
                    </div>
                </div>

                <!-- Modul 6 -->
                <div class="col-md-6 col-lg-4 materi-item" data-category="skill">
                    <div class="card-materi p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="materi-icon-bg"><i class="fa-solid fa-kit-medical"></i></div>
                            <span class="badge-category">Scout Skill & Pioneering</span>
                        </div>
                        <h5 class="fw-bold mb-2 materi-title" style="color: var(--color-dark-purple);">Pertolongan Pertama Pada Kecelakaan (PPPK)</h5>
                        <p class="text-muted small mb-4 flex-grow-1">Penanganan gawat darurat lapangan, pembalutan luka, pembuatan tandu darurat, dan evakuasi.</p>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                            <span class="text-muted small"><i class="fa-regular fa-file-pdf me-1" style="color: var(--color-teal);"></i> PDF (2.1 MB)</span>
                            <a href="#" class="btn btn-sm btn-accent fw-bold px-3"><i class="fa-solid fa-download me-1"></i> Unduh</a>
                        </div>
                    </div>
                </div>

                <!-- Modul 7 -->
                <div class="col-md-6 col-lg-4 materi-item" data-category="sku">
                    <div class="card-materi p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="materi-icon-bg"><i class="fa-solid fa-medal"></i></div>
                            <span class="badge-category">SKU & TKU Penegak</span>
                        </div>
                        <h5 class="fw-bold mb-2 materi-title" style="color: var(--color-dark-purple);">Panduan Pengisian SKU Penegak Laksana</h5>
                        <p class="text-muted small mb-4 flex-grow-1">Persyaratan dan pengujian poin SKU Penegak Laksana serta persiapan menuju Penegak Garuda.</p>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                            <span class="text-muted small"><i class="fa-regular fa-file-pdf me-1" style="color: var(--color-teal);"></i> PDF (2.8 MB)</span>
                            <a href="#" class="btn btn-sm btn-accent fw-bold px-3"><i class="fa-solid fa-download me-1"></i> Unduh</a>
                        </div>
                    </div>
                </div>

                <!-- Modul 8 -->
                <div class="col-md-6 col-lg-4 materi-item" data-category="navigasi">
                    <div class="card-materi p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="materi-icon-bg"><i class="fa-solid fa-campground"></i></div>
                            <span class="badge-category">Navigasi & Survival</span>
                        </div>
                        <h5 class="fw-bold mb-2 materi-title" style="color: var(--color-dark-purple);">Teknik Survival & Bivak Alam</h5>
                        <p class="text-muted small mb-4 flex-grow-1">Cara pembuatan tempat berlindung darurat (bivak), pencarian air bersih, dan pemanfaatan tumbuhan hutan.</p>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                            <span class="text-muted small"><i class="fa-regular fa-file-pdf me-1" style="color: var(--color-teal);"></i> PDF (3.1 MB)</span>
                            <a href="#" class="btn btn-sm btn-accent fw-bold px-3"><i class="fa-solid fa-download me-1"></i> Unduh</a>
                        </div>
                    </div>
                </div>

                <!-- Modul 9 -->
                <div class="col-md-6 col-lg-4 materi-item" data-category="komunikasi">
                    <div class="card-materi p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="materi-icon-bg"><i class="fa-solid fa-walkie-talkie"></i></div>
                            <span class="badge-category">Komunikasi & Sandi</span>
                        </div>
                        <h5 class="fw-bold mb-2 materi-title" style="color: var(--color-dark-purple);">Komunikasi Radio & Kode Etik Lapangan</h5>
                        <p class="text-muted small mb-4 flex-grow-1">Penggunaan Perangkat Radio Komunikasi (Handy Talkie/HT), alfabet fonetik, dan standar komunikasi darurat.</p>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                            <span class="text-muted small"><i class="fa-regular fa-file-pdf me-1" style="color: var(--color-teal);"></i> PDF (1.7 MB)</span>
                            <a href="#" class="btn btn-sm btn-accent fw-bold px-3"><i class="fa-solid fa-download me-1"></i> Unduh</a>
                        </div>
                    </div>
                </div>

                <!-- Modul 10 -->
                <div class="col-md-6 col-lg-4 materi-item" data-category="vokasi">
                    <div class="card-materi p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="materi-icon-bg"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                            <span class="badge-category">Pramuka Peduli & Vokasi</span>
                        </div>
                        <h5 class="fw-bold mb-2 materi-title" style="color: var(--color-dark-purple);">Keterampilan Vokasi Terapan Penegak</h5>
                        <p class="text-muted small mb-4 flex-grow-1">Pemanfaatan keahlian teknik, kriya, dan teknologi informasi siswa vokasi dalam aksi kemanusiaan Pramuka.</p>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                            <span class="text-muted small"><i class="fa-regular fa-file-pdf me-1" style="color: var(--color-teal);"></i> PDF (2.6 MB)</span>
                            <a href="#" class="btn btn-sm btn-accent fw-bold px-3"><i class="fa-solid fa-download me-1"></i> Unduh</a>
                        </div>
                    </div>
                </div>

                <!-- Modul 11 -->
                <div class="col-md-6 col-lg-4 materi-item" data-category="skill">
                    <div class="card-materi p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="materi-icon-bg"><i class="fa-solid fa-person-military-pointing"></i></div>
                            <span class="badge-category">Scout Skill & Pioneering</span>
                        </div>
                        <h5 class="fw-bold mb-2 materi-title" style="color: var(--color-dark-purple);">Tata Upacara & Peraturan Baris Berbaris (PBB)</h5>
                        <p class="text-muted small mb-4 flex-grow-1">Panduan resmi tata upacara Ambalan Penegak, PBB dasar, PBB tongkat, dan kepemimpinan Sangga.</p>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                            <span class="text-muted small"><i class="fa-regular fa-file-pdf me-1" style="color: var(--color-teal);"></i> PDF (2.0 MB)</span>
                            <a href="#" class="btn btn-sm btn-accent fw-bold px-3"><i class="fa-solid fa-download me-1"></i> Unduh</a>
                        </div>
                    </div>
                </div>

                <!-- Modul 12 -->
                <div class="col-md-6 col-lg-4 materi-item" data-category="sku">
                    <div class="card-materi p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="materi-icon-bg"><i class="fa-solid fa-crown"></i></div>
                            <span class="badge-category">SKU & TKU Penegak</span>
                        </div>
                        <h5 class="fw-bold mb-2 materi-title" style="color: var(--color-dark-purple);">Syarat & Portofolio Pramuka Garuda Penegak</h5>
                        <p class="text-muted small mb-4 flex-grow-1">Petunjuk teknis pencapaian Pramuka Garuda, penyusunan portofolio, dan penilaian dari Kwarcab Jepara.</p>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                            <span class="text-muted small"><i class="fa-regular fa-file-pdf me-1" style="color: var(--color-teal);"></i> PDF (3.5 MB)</span>
                            <a href="#" class="btn btn-sm btn-accent fw-bold px-3"><i class="fa-solid fa-download me-1"></i> Unduh</a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- PAGINASI HALAMAN -->
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Navigasi Halaman Materi">
                    <ul class="pagination" id="pagination">
                        <!-- Generasi tombol navigasi via JavaScript -->
                    </ul>
                </nav>
            </div>
        </div>
    </section>

    <!-- FREQUENTLY ASKED QUESTIONS (FAQ) -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center max-w-lg mx-auto mb-5">
                <span class="section-tag">Tanya Jawab</span>
                <h2 class="section-title">Seputar Pengujian SKU & SKK</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        
                        <!-- FAQ 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                    Bagaimana prosedur pengujian SKU Bantara di SKAGARA?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted small">
                                    Pengujian SKU dilakukan secara bertahap bersama Pembina atau Dewan Ambalan yang ditunjuk. Anggota dapat meminta pengujian pada jadwal latihan rutin atau waktu khusus yang telah disepakati.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                    Di mana anggota bisa mendapatkan Buku SKU Fisik?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted small">
                                    Buku SKU fisik didapatkan dari Sanggar Bakti Pramuka SKAGARA saat pelaksanaan Penerimaan Tamu Ambalan (PTA) atau melalui pendaftaran ke Sanggar.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                    Apa saja syarat untuk bisa menempuh Pramuka Garuda Penegak?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted small">
                                    Syarat utama meliputi: Telah dilantik menjadi Penegak Laksana, memiliki minimal 10 TKK (Syarat Kecakapan Khusus), aktif dalam kegiatan bakti masyarakat/lingkungan, serta memenuhi persyaratan administratif dari Kwarcab Jepara.
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

                <!-- Col 2: Navigasi Cepat -->
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

                <!-- Col 3: Sekretariat -->
                <div class="col-lg-3 col-md-6">
                    <h5>Sanggar Bakti</h5>
                    <ul class="list-unstyled small text-white-50">
                        <li class="mb-2"><i class="fa-solid fa-building me-2" style="color: var(--color-mint-light);"></i>SMK Negeri 3 Jepara</li>
                        <li class="mb-2"><i class="fa-solid fa-location-dot me-2" style="color: var(--color-mint-light);"></i>Jl. KS Tubun No. 3, Kabupaten Jepara, Jawa Tengah 59418</li>
                        <li class="mb-2"><i class="fa-solid fa-clock me-2" style="color: var(--color-mint-light);"></i>Senin - Jumat: 07.00 - 16.00 WIB</li>
                    </ul>
                </div>

                <!-- Col 4: Tautan Luar -->
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

    <!-- SCRIPT FILTER, SEARCH, DAN PAGINATION INTERAKTIF -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const itemsPerPage = 6;
            let currentPage = 1;
            let currentCategory = 'all';
            let searchQuery = '';

            const allItems = Array.from(document.querySelectorAll('.materi-item'));
            const filterButtons = document.querySelectorAll('#filterButtons .btn-filter');
            const searchInput = document.getElementById('searchInput');
            const paginationContainer = document.getElementById('pagination');
            const materiCounter = document.getElementById('materiCounter');

            function getFilteredItems() {
                return allItems.filter(item => {
                    const matchesCategory = currentCategory === 'all' || item.dataset.category === currentCategory;
                    const titleText = item.querySelector('.materi-title').textContent.toLowerCase();
                    const descText = item.querySelector('p').textContent.toLowerCase();
                    const matchesSearch = titleText.includes(searchQuery) || descText.includes(searchQuery);
                    return matchesCategory && matchesSearch;
                });
            }

            function render() {
                const filteredItems = getFilteredItems();
                const totalItems = filteredItems.length;
                const totalPages = Math.ceil(totalItems / itemsPerPage) || 1;

                if (currentPage > totalPages) currentPage = totalPages;

                // Sembunyikan semua item lebih dulu
                allItems.forEach(item => item.style.display = 'none');

                // Tampilkan item untuk halaman aktif
                const start = (currentPage - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                const visibleItems = filteredItems.slice(start, end);

                visibleItems.forEach(item => item.style.display = 'block');

                // Update teks statistik
                const startNum = totalItems > 0 ? start + 1 : 0;
                const endNum = Math.min(end, totalItems);
                materiCounter.textContent = `Menampilkan ${startNum}-${endNum} dari ${totalItems} Modul`;

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

            // Event Filter Kategori
            filterButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    filterButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentCategory = this.dataset.category;
                    currentPage = 1;
                    render();
                });
            });

            // Event Input Pencarian
            searchInput.addEventListener('input', function () {
                searchQuery = this.value.toLowerCase().trim();
                currentPage = 1;
                render();
            });

            // Inisialisasi awal
            render();
        });
    </script>
</body>

</html>