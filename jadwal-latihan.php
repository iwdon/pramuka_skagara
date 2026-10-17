<?php
require_once __DIR__ . '/config/database.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Latihan - Pramuka SKAGARA Gudep 05.127 - 05.128</title>
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
                        url('https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
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

        /* Stat Counter Card */
        .stat-banner {
            background: #FFFFFF;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 8px 24px rgba(62, 62, 117, 0.08);
            border-bottom: 4px solid var(--color-teal);
        }

        /* Program Cards */
        .card-proker {
            background: #FFFFFF;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 8px 24px rgba(62, 62, 117, 0.06);
            transition: all 0.3s ease;
            border-top: 4px solid var(--color-teal);
            height: 100%;
        }

        .card-proker:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(62, 62, 117, 0.12);
            border-top-color: var(--color-dark-purple);
        }

        .proker-icon {
            width: 50px;
            height: 50px;
            background: rgba(152, 232, 222, 0.3);
            color: var(--color-dark-purple);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 16px;
        }

        /* Tab Navigation */
        .nav-pills-custom .nav-link {
            color: var(--color-navy-purple);
            font-weight: 700;
            border-radius: 50px;
            padding: 10px 24px;
            border: 2px solid var(--color-navy-purple);
            background: transparent;
            transition: all 0.3s ease;
        }

        .nav-pills-custom .nav-link.active {
            background-color: var(--color-dark-purple);
            color: #FFFFFF;
            border-color: var(--color-dark-purple);
            box-shadow: 0 6px 18px rgba(78, 31, 110, 0.25);
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
                            <li><a class="dropdown-item" href="ambalan.php"><i class="fa-solid fa-users me-2"></i>Dewan Ambalan</a></li>
                            <li><a class="dropdown-item" href="prestasi.php"><i class="fa-solid fa-trophy me-2"></i>Prestasi & Garuda</a></li>
                        </ul>
                    </li>

                    <!-- Dropdown 2: Kegiatan & Agenda -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="kegiatanDropdown" role="button" data-bs-toggle="dropdown">
                            Kegiatan & Agenda
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item active" href="jadwal-latihan.php"><i class="fa-solid fa-clock me-2"></i>Jadwal Latihan</a></li>
                            <li><a class="dropdown-item" href="dokumentasi.php"><i class="fa-solid fa-images me-2"></i>Galeri Foto & Video</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="berita.php">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="materi.php">Materi</a>
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

    <!-- PAGE HEADER -->
    <header class="page-header text-center">
        <div class="container">
            <span class="badge bg-white text-dark fw-bold mb-3 px-3 py-2 rounded-pill"><i class="fa-solid fa-clock me-2"></i>AGENDA RUTIN</span>
            <h1 class="display-5 fw-extrabold text-white mb-2">Jadwal Latihan Ambalan</h1>
            <p class="lead opacity-90 mx-auto" style="max-width: 680px; font-size: 1.05rem;">
                Jadwal latihan rutin, agenda kegiatan dan penugasan untuk seluruh anggota Ambalan Wira Bhumi & Tri Buana Tungga Dewi.
            </p>
        </div>
    </header>

    <!-- STATISTIK PROGRAM KERJA -->
    <section class="container mt-n4 position-relative" style="z-index: 10;">
        <div class="stat-banner">
            <div class="row text-center gy-3">
                <div class="col-6 col-md-3 border-end">
                    <h2 class="fw-extrabold mb-0" style="color: var(--color-dark-purple);">4</h2>
                    <small class="text-muted fw-semibold">Kegiatan Rutin</small>
                </div>
                <div class="col-6 col-md-3 border-end-md">
                    <h2 class="fw-extrabold mb-0" style="color: var(--color-dark-purple);">2</h2>
                    <small class="text-muted fw-semibold">Kegiatan Insidental</small>
                </div>
                <div class="col-6 col-md-3 border-end">
                    <h2 class="fw-extrabold mb-0" style="color: var(--color-dark-purple);">4</h2>
                    <small class="text-muted fw-semibold">Kegiatan Khusus</small>
                </div>
                <div class="col-6 col-md-3">
                    <h2 class="fw-extrabold mb-0" style="color: var(--color-dark-purple);">2</h2>
                    <small class="text-muted fw-semibold">Kegiatan Projek</small>
                </div>
            </div>
        </div>
    </section>

    <!-- TABS FILTER KLASIFIKASI PROGRAM KERJA -->
    <section class="py-5">
        <div class="container">
            <div class="text-center max-w-lg mx-auto mb-4">
                <span class="section-tag">Rencana Kegiatan</span>
                <h2 class="section-title">Kategori Kegiatan</h2>
            </div>

            <ul class="nav nav-pills nav-pills-custom justify-content-center gap-2 mb-5" id="prokerTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="rutin-tab" data-bs-toggle="pill" data-bs-target="#rutin" type="button" role="tab">
                        <i class="fa-solid fa-clock me-2"></i>Rutin
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="insidental-tab" data-bs-toggle="pill" data-bs-target="#insidental" type="button" role="tab">
                        <i class="fa-solid fa-bolt me-2"></i>Insidental
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="khusus-tab" data-bs-toggle="pill" data-bs-target="#khusus" type="button" role="tab">
                        <i class="fa-solid fa-star me-2"></i>Khusus
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="projek-tab" data-bs-toggle="pill" data-bs-target="#projek" type="button" role="tab">
                        <i class="fa-solid fa-diagram-project me-2"></i>Projek
                    </button>
                </li>
            </ul>

            <!-- KONTEN TAB PROGRAM KERJA -->
            <div class="tab-content" id="prokerTabContent">
                
                <!-- TAB 1: KEGIATAN RUTIN -->
                <div class="tab-pane fade show active" id="rutin" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-3">
                            <div class="card-proker">
                                <div class="proker-icon"><i class="fa-solid fa-dumbbell"></i></div>
                                <span class="badge mb-2" style="background-color: var(--color-mint-light); color: var(--color-dark-purple);">Mingguan</span>
                                <h5 class="fw-bold mb-2" style="color: var(--color-dark-purple);">Latihan Rutin Penegak</h5>
                                <p class="text-muted small mb-3">Pendalaman materi SKU Penegak Bantara/Laksana, PBB, Sandi, Pioneering, dan Kepramukaan Vokasi.</p>
                                <div class="text-muted small mb-2"><i class="fa-regular fa-clock me-1"></i> Setiap Hari Jumat (15.00 WIB)</div>
                                <div class="text-muted small"><i class="fa-solid fa-location-dot me-1"></i> Sanggar Bakti Pramuka SMK Negeri 3 Jepara</div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <div class="card-proker">
                                <div class="proker-icon"><i class="fa-solid fa-clipboard-check"></i></div>
                                <span class="badge mb-2" style="background-color: var(--color-mint-light); color: var(--color-dark-purple);">Mingguan</span>
                                <h5 class="fw-bold mb-2" style="color: var(--color-dark-purple);">Evaluasi Latihan Mingguan</h5>
                                <p class="text-muted small mb-3">Evaluasi pelaksanaan latihan mingguan, penyusunan LPK, serta persiapan materi latihan berikutnya.</p>
                                <div class="text-muted small mb-2"><i class="fa-regular fa-clock me-1"></i> Setiap Hari Sabtu (13.30 WIB)</div>
                                <div class="text-muted small"><i class="fa-solid fa-location-dot me-1"></i> Sanggar Bakti Pramuka SMK Negeri 3 Jepara</div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <div class="card-proker">
                                <div class="proker-icon"><i class="fa-solid fa-camera-retro"></i></div>
                                <span class="badge bg-info text-dark mb-2">Mingguan</span>
                                <h5 class="fw-bold mb-2" style="color: var(--color-dark-purple);">Pengelolaan Media & Website</h5>
                                <p class="text-muted small mb-3">Publikasi dokumentasi, artikel latihan, serta pembaruan materi SKU secara berkala di portal resmi SKAGARA.</p>
                                <div class="text-muted small mb-2"><i class="fa-regular fa-clock me-1"></i> Berkala / Tiap Minggu</div>
                                <div class="text-muted small"><i class="fa-solid fa-location-dot me-1"></i> Sekretariat Gudep / Online</div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <div class="card-proker">
                                <div class="proker-icon"><i class="fa-solid fa-list-check"></i></div>
                                <span class="badge bg-dark mb-2">Bulanan</span>
                                <h5 class="fw-bold mb-2" style="color: var(--color-dark-purple);">Rapat Evaluasi Bulanan</h5>
                                <p class="text-muted small mb-3">Pertemuan koordinasi fungsionaris Dewan Ambalan bersama Pembina Gudep guna evaluasi giat bulanan.</p>
                                <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> Akhir Bulan</div>
                                <div class="text-muted small"><i class="fa-solid fa-location-dot me-1"></i> Ruang Pertemuan Gudep / Sanggar Bakti</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 2: KEGIATAN INSIDENTAL -->
                <div class="tab-pane fade" id="insidental" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card-proker">
                                <div class="proker-icon"><i class="fa-solid fa-box-tissue"></i></div>
                                <span class="badge bg-warning text-dark mb-2">Insidental</span>
                                <h5 class="fw-bold mb-2" style="color: var(--color-dark-purple);">Bumbung Kemanusiaan & Bakti Sosial</h5>
                                <p class="text-muted small mb-3">Penggalangan dana, penyaluran bantuan bencana alam, serta aksi kepedulian sosial bagi masyarakat yang membutuhkan.</p>
                                <div class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Sesuai Kondisi / Bencana</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-proker">
                                <div class="proker-icon"><i class="fa-solid fa-trophy"></i></div>
                                <span class="badge bg-warning text-dark mb-2">Insidental</span>
                                <h5 class="fw-bold mb-2" style="color: var(--color-dark-purple);">Partisipasi Lomba & Loka-Giat</h5>
                                <p class="text-muted small mb-3">Pengiriman kontingen Sangga/Pramuka Penegak dalam ajang perlombaan, giat prestasi, atau pertemuan besar tingkat Kwartir.</p>
                                <div class="text-muted small"><i class="fa-regular fa-calendar me-1"></i> Sesuai Undangan / Edaran Kwartir</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 3: KEGIATAN KHUSUS -->
                <div class="tab-pane fade" id="khusus" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-3">
                            <div class="card-proker">
                                <div class="proker-icon"><i class="fa-solid fa-campground"></i></div>
                                <span class="badge bg-primary mb-2">Tahunan</span>
                                <h5 class="fw-bold mb-2" style="color: var(--color-dark-purple);">Penerimaan Tamu Ambalan (PTA)</h5>
                                <p class="text-muted small mb-3">Orientasi awal kepramukaan tingkat Penegak bagi seluruh siswa baru kelas X pangkalan SKAGARA.</p>
                                <div class="text-muted small"><i class="fa-regular fa-calendar me-1"></i> Bulan Juli</div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <div class="card-proker">
                                <div class="proker-icon"><i class="fa-solid fa-award"></i></div>
                                <span class="badge bg-success mb-2">Semesteran</span>
                                <h5 class="fw-bold mb-2" style="color: var(--color-dark-purple);">Pelantikan Bantara & Laksana</h5>
                                <p class="text-muted small mb-3">Ujian penjelajahan, penataan adat, dan pengukuhan tingkatan kecakapan umum (TKU) Penegak.</p>
                                <div class="text-muted small"><i class="fa-regular fa-calendar me-1"></i> Oktober & Mei</div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <div class="card-proker">
                                <div class="proker-icon"><i class="fa-solid fa-handshake"></i></div>
                                <span class="badge bg-secondary mb-2">Semesteran</span>
                                <h5 class="fw-bold mb-2" style="color: var(--color-dark-purple);">Studi Banding Lintas Gudep</h5>
                                <p class="text-muted small mb-3">Kunjungan antar-Pangkalan Pramuka Penegak se-Kabupaten Jepara guna mempererat persaudaraan.</p>
                                <div class="text-muted small"><i class="fa-regular fa-calendar me-1"></i> Bulan November</div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <div class="card-proker">
                                <div class="proker-icon"><i class="fa-solid fa-gavel"></i></div>
                                <span class="badge bg-danger mb-2">Tahunan</span>
                                <h5 class="fw-bold mb-2" style="color: var(--color-dark-purple);">Musyawarah Ambalan (MUSYAM)</h5>
                                <p class="text-muted small mb-3">Laporan pertanggungjawaban kepengurusan lama dan pemilihan Pradana/Dewan Ambalan masa bakti berikutnya.</p>
                                <div class="text-muted small"><i class="fa-regular fa-calendar me-1"></i> Bulan Desember</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 4: KEGIATAN PROJEK -->
                <div class="tab-pane fade" id="projek" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card-proker">
                                <div class="proker-icon"><i class="fa-solid fa-seedling"></i></div>
                                <span class="badge bg-success mb-2">Tahunan / Projek</span>
                                <h5 class="fw-bold mb-2" style="color: var(--color-dark-purple);">Pramuka Peduli Pesisir (Reboisasi)</h5>
                                <p class="text-muted small mb-3">Projek konservasi lingkungan berupa penanaman bibit mangrove dan pembersihan sampah pesisir pantai di Jepara.</p>
                                <div class="text-muted small"><i class="fa-regular fa-calendar me-1"></i> Bulan Agustus</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-proker">
                                <div class="proker-icon"><i class="fa-solid fa-cubes-stacked"></i></div>
                                <span class="badge bg-primary mb-2">Tahunan / Projek</span>
                                <h5 class="fw-bold mb-2" style="color: var(--color-dark-purple);">Kompetisi Keterampilan Sangga (KKS)</h5>
                                <p class="text-muted small mb-3">Projek unjuk kreativitas, teknik kepramukaan, dan terapan vokasi antarsangga dalam pangkalan SKAGARA.</p>
                                <div class="text-muted small"><i class="fa-regular fa-calendar me-1"></i> Bulan September</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- KALENDER AGENDA TAHUNAN -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center max-w-lg mx-auto mb-5">
                <span class="section-tag">Agenda Utama</span>
                <h2 class="section-title">Jadwal & Agenda 2026</h2>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle border">
                    <thead class="text-white" style="background-color: var(--color-navy-purple);">
                        <tr>
                            <th scope="col" class="py-3 ps-4">Pelaksanaan</th>
                            <th scope="col" class="py-3">Nama Agenda / Kegiatan</th>
                            <th scope="col" class="py-3">Kategori</th>
                            <th scope="col" class="py-3">Peserta</th>
                            <th scope="col" class="py-3 pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4 fw-bold">Setiap Jumat<br><small class="text-muted">Sanggar Bakti Pramuka SMK Negeri 3 Jepara</small></td>
                            <td>Latihan Rutin Penegak</td>
                            <td><span class="badge bg-secondary">Rutin</span></td>
                            <td>Seluruh Penegak</td>
                            <td><span class="badge bg-success">Berjalan</span></td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold">Setiap Sabtu<br><small class="text-muted">Sanggar Bakti Pramuka SMK Negeri 3 Jepara</small></td>
                            <td>Evaluasi Latihan Mingguan</td>
                            <td><span class="badge bg-secondary">Rutin</span></td>
                            <td>Dewan Ambalan</td>
                            <td><span class="badge bg-success">Berjalan</span></td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold">15 - 16 Juli 2026<br><small class="text-muted">SMK Negeri 3 Jepara / Bumi Perkemahan</small></td>
                            <td>Penerimaan Tamu Ambalan (PTA)</td>
                            <td><span class="badge bg-primary">Khusus</span></td>
                            <td>Siswa Baru Kelas X</td>
                            <td><span class="badge bg-success">Selesai</span></td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold">22 Agustus 2026<br><small class="text-muted">Pesisir Jepara (Lokasi Bakti Lingkungan)</small></td>
                            <td>Reboisasi Mangrove & Clean-Up Pesisir</td>
                            <td><span class="badge bg-success">Projek</span></td>
                            <td>Penegak Bantara & DA</td>
                            <td><span class="badge bg-success">Selesai</span></td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold">05 September 2026<br><small class="text-muted">SMK Negeri 3 Jepara</small></td>
                            <td>Kompetisi Keterampilan Sangga (KKS)</td>
                            <td><span class="badge bg-success">Projek</span></td>
                            <td>Seluruh Sangga Penegak</td>
                            <td><span class="badge bg-success">Selesai</span></td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold">18 - 19 Oktober 2026<br><small class="text-muted">SMK Negeri 3 Jepara</small></td>
                            <td>Pelantikan Penegak Bantara & Laksana</td>
                            <td><span class="badge bg-primary">Khusus</span></td>
                            <td>Calon Bantara & Laksana</td>
                            <td><span class="badge" style="background-color: var(--color-teal);">Akan Datang</span></td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold">12 Desember 2026<br><small class="text-muted">Sanggar Bakti Pramuka SMK Negeri 3 Jepara</small></td>
                            <td>Musyawarah Ambalan (MUSYAM)</td>
                            <td><span class="badge bg-primary">Khusus</span></td>
                            <td>Dewan Ambalan & Pembina</td>
                            <td><span class="badge bg-secondary">Mendatang</span></td>
                        </tr>
                    </tbody>
                </table>
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
                        <li class="mb-2"><a href="jadwal-latihan.php">Jadwal Latihan</a></li>
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
</body>

</html>