<?php
require_once __DIR__ . '/config/database.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Pramuka SKAGARA Gudep 05.127 - 05.128</title>
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
            background: linear-gradient(rgba(78, 31, 110, 0.88), rgba(62, 62, 117, 0.92)),
                        url('https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
            color: white;
            padding: 70px 0;
            border-bottom: 4px solid var(--color-teal);
        }

        /* Section Titles */
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
            padding: 12px 28px;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(69, 169, 169, 0.4);
        }

        .btn-accent:hover {
            background-color: #358d8d;
            color: #FFFFFF;
            transform: translateY(-2px);
        }

        /* Visi Misi Cards */
        .card-visi {
            background: var(--color-dark-purple);
            color: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(78, 31, 110, 0.15);
            height: 100%;
        }

        .card-misi {
            background: #FFFFFF;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(62, 62, 117, 0.08);
            border-top: 5px solid var(--color-teal);
            height: 100%;
        }

        /* Feature / Values Cards */
        .value-box {
            background: #FFFFFF;
            border-radius: 16px;
            padding: 28px 24px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(62, 62, 117, 0.06);
            height: 100%;
            border-bottom: 4px solid var(--color-navy-purple);
        }

        .value-box:hover {
            transform: translateY(-6px);
            border-bottom-color: var(--color-teal);
            box-shadow: 0 12px 28px rgba(62, 62, 117, 0.12);
        }

        .value-icon {
            width: 55px;
            height: 55px;
            background: rgba(152, 232, 222, 0.3);
            color: var(--color-dark-purple);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 18px;
        }

        /* Pembina / Pengurus Card */
        .team-card {
            background: #FFFFFF;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(62, 62, 117, 0.08);
            transition: all 0.3s ease;
            text-center;
        }

        .team-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(62, 62, 117, 0.15);
        }

        .team-img-wrapper {
            height: 260px;
            overflow: hidden;
            position: relative;
        }

        .team-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Ambalan Badge Banner */
        .ambalan-banner {
            background: linear-gradient(135deg, var(--color-navy-purple), var(--color-dark-purple));
            border-radius: 20px;
            padding: 40px;
            color: white;
            box-shadow: 0 10px 30px rgba(78, 31, 110, 0.2);
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
                        <a class="nav-link dropdown-toggle active" href="#" id="tentangDropdown" role="button"
                            data-bs-toggle="dropdown">
                            Tentang Kami
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item active" href="profil.php"><i class="fa-solid fa-compass me-2"></i>Profil & Sejarah</a></li>
                            <li><a class="dropdown-item" href="prestasi.php"><i class="fa-solid fa-trophy me-2"></i>Prestasi & Garuda</a></li>
                        </ul>
                    </li>

                    <!-- Dropdown 2: Kegiatan & Agenda -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="kegiatanDropdown" role="button"
                            data-bs-toggle="dropdown">
                            Kegiatan & Agenda
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="jadwal-latihan.php"><i class="fa-solid fa-clock me-2"></i>Jadwal Latihan</a></li>
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
            <span class="badge-scout mb-3"><i class="fa-solid fa-compass me-2"></i>PROFIL PANGKALAN</span>
            <h1 class="display-5 fw-extrabold text-white mb-2">Tentang Pramuka SKAGARA</h1>
            <p class="lead opacity-90 mx-auto" style="max-width: 700px; font-size: 1.05rem;">
                Gugus Depan 05.127 - 05.128 Pangkalan SMK Negeri 3 Jepara, membentuk Penegak tangguh, terampil, dan berwawasan lingkungan.
            </p>
        </div>
    </header>

    <!-- SEJARAH & REKAM JEJAK -->
    <section class="py-5 my-3">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1526772662000-3f88f10405ff?q=80&w=800&auto=format&fit=crop"
                            alt="Kegiatan Pramuka SKAGARA" class="img-fluid rounded-4 shadow-lg">
                        <div class="position-absolute bottom-0 end-0 p-3 m-3 bg-white rounded-3 shadow d-none d-sm-block text-start border-start border-4" style="border-color: var(--color-teal) !important;">
                            <div class="fw-bold text-dark fs-5">Gudep 05.127 - 05.128</div>
                            <small class="text-muted">SMK Negeri 3 Jepara</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="section-tag">Sejarah & Rekam Jejak</span>
                    <h2 class="section-title fs-2 mb-3">Tumbuh Bersama Semangat Kepanduan Vokasi</h2>
                    <p class="text-muted mb-3">
                        Gerakan Pramuka Pangkalan SMK Negeri 3 Jepara didirikan sebagai wadah pembinaan karakter, jiwa kepemimpinan, dan kedisiplinan siswa-siswi Penegak. Berada di wilayah pesisir Jepara, pangkalan kami mengintegrasikan nilai-nilai Trisatya dan Dasa Darma dengan pendidikan keahlian vokasi.
                    </p>
                    <p class="text-muted mb-4">
                        Hingga kini, Ambalan SKAGARA terus melahirkan generasi Penegak Bantara, Laksana, hingga Pramuka Garuda yang aktif berkontribusi dalam berbagai bakti masyarakat, kegiatan konservasi pantai/mangrove, serta kompetisi kepramukaan tingkat daerah maupun nasional.
                    </p>

                    <div class="d-flex flex-wrap gap-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 rounded-circle" style="background-color: rgba(152, 232, 222, 0.3); color: var(--color-dark-purple);">
                                <i class="fa-solid fa-award fs-3"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0 text-dark">Pramuka Garuda</h5>
                                <small class="text-muted">Pencapaian Tertinggi Penegak</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 rounded-circle" style="background-color: rgba(69, 169, 169, 0.2); color: var(--color-navy-purple);">
                                <i class="fa-solid fa-tree fs-3"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0 text-dark">Eco-Scout Action</h5>
                                <small class="text-muted">Konservasi Pesisir Jepara</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- KIDENTITAS AMBALAN BANNER -->
    <section class="container my-4">
        <div class="ambalan-banner">
            <div class="row align-items-center gy-4 text-center text-md-start">
                <div class="col-md-8">
                    <span class="badge bg-white text-dark fw-bold mb-2 px-3 py-2 rounded-pill">Dua Ambalan, Satu Semangat</span>
                    <h3 class="fw-bold mb-2">Ambalan Wira Bhumi & Tri Buana Tungga Dewi</h3>
                    <p class="mb-0 opacity-90 small">
                        <strong>Wira Bhumi (Gudep 05.127):</strong> Ksatria ketangguhan dan penjaga kelestarian bumi (Putra).<br>
                        <strong>Tri Buana Tungga Dewi (Gudep 05.128):</strong> Ketauladanan, keanggunan, dan keberanian pemimpin perempuan (Putri).
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- VISI & MISI SECTION -->
    <section class="py-5" style="background-color: #FFFFFF;">
        <div class="container">
            <div class="text-center max-w-lg mx-auto mb-5">
                <span class="section-tag">Landasan Gerak</span>
                <h2 class="section-title">Visi & Misi Pangkalan</h2>
            </div>

            <div class="row g-4">
                <!-- VISI -->
                <div class="col-lg-5">
                    <div class="card-visi d-flex flex-column justify-content-center position-relative overflow-hidden">

                        <span class="text-uppercase fw-bold text-teal mb-2" style="color: var(--color-mint-light); letter-spacing: 1px;">Visi Utama</span>
                        <h3 class="fw-extrabold mb-3 lh-base">Mewujudkan Penegak SKAGARA yang Berkarakter Vokasi, Berwawasan Lingkungan, Berjiwa Kepemimpinan, dan Berprestasi Unggul.</h3>
                        <p class="opacity-75 small mb-0">Menjadi pangkalan gerakan pramuka rujukan di Kabupaten Jepara dalam pembinaan karakter berbasis keahlian terpadu.</p>
                    </div>
                </div>

                <!-- MISI -->
                <div class="col-lg-7">
                    <div class="card-misi">
                        <span class="section-tag mb-2 d-block">Misi Strategis</span>
                        <h3 class="fw-bold mb-4" style="color: var(--color-dark-purple);">Langkah & Komitmen Kami</h3>

                        <ul class="list-unstyled d-flex flex-column gap-3 mb-0">
                            <li class="d-flex align-items-start gap-3">
                                <span class="p-2 rounded-circle mt-1" style="background-color: var(--color-mint-light); color: var(--color-dark-purple);">
                                    <i class="fa-solid fa-check fs-6 fw-bold"></i>
                                </span>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">Pendidikan Karakter & Kedisiplinan</h6>
                                    <p class="text-muted small mb-0">Menyelenggarakan latihan kepramukaan yang sistematis, menyenangkan, dan konsisten berdasarkan Dasa Darma.</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start gap-3">
                                <span class="p-2 rounded-circle mt-1" style="background-color: var(--color-mint-light); color: var(--color-dark-purple);">
                                    <i class="fa-solid fa-check fs-6 fw-bold"></i>
                                </span>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">Integrasi Keterampilan Vokasi (Scout Skill)</h6>
                                    <p class="text-muted small mb-0">Mengembangkan kecakapan teknis kepramukaan yang selaras dengan bidang keahlian siswa di SMK Negeri 3 Jepara.</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start gap-3">
                                <span class="p-2 rounded-circle mt-1" style="background-color: var(--color-mint-light); color: var(--color-dark-purple);">
                                    <i class="fa-solid fa-check fs-6 fw-bold"></i>
                                </span>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">Aksi Peduli Lingkungan & Pesisir</h6>
                                    <p class="text-muted small mb-0">Menginisiasi program Pramuka Peduli melalui reboisasi, pengolahan sampah, dan konservasi pesisir pantai.</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start gap-3">
                                <span class="p-2 rounded-circle mt-1" style="background-color: var(--color-mint-light); color: var(--color-dark-purple);">
                                    <i class="fa-solid fa-check fs-6 fw-bold"></i>
                                </span>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">Bimbingan Pencapaian Pramuka Garuda</h6>
                                    <p class="text-muted small mb-0">Mendorong dan memfasilitasi setiap Penegak untuk mencapai tingkatan Bantara, Laksana, hingga Pramuka Garuda.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PILAR NILAI KAMI -->
    <section class="py-5">
        <div class="container">
            <div class="text-center max-w-lg mx-auto mb-5">
                <span class="section-tag">Nilai Utama</span>
                <h2 class="section-title">4 Pilar Pembinaan SKAGARA</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="value-box">
                        <div class="value-icon"><i class="fa-solid fa-shield-halved"></i></div>
                        <h5 class="fw-bold" style="color: var(--color-dark-purple);">Kedisiplinan</h5>
                        <p class="text-muted small mb-0">Membentuk mental tangguh, tepat waktu, dan penuh tanggung jawab dalam setiap tindakan.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="value-box">
                        <div class="value-icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                        <h5 class="fw-bold" style="color: var(--color-dark-purple);">Keahlian Vokasi</h5>
                        <p class="text-muted small mb-0">Mengasah keterampilan praktis yang siap diterapkan dalam dunia kerja dan bermasyarakat.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="value-box">
                        <div class="value-icon"><i class="fa-solid fa-compass-drafting"></i></div>
                        <h5 class="fw-bold" style="color: var(--color-dark-purple);">Kepemimpinan</h5>
                        <p class="text-muted small mb-0">Melatih kemampuan berorganisasi, berpikir kritis, dan memimpin kelompok secara bijaksana.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="value-box">
                        <div class="value-icon"><i class="fa-solid fa-seedling"></i></div>
                        <h5 class="fw-bold" style="color: var(--color-dark-purple);">Peduli Alam</h5>
                        <p class="text-muted small mb-0">Menanamkan kesadaran pelestarian lingkungan hidup dan pengabdian nyata bagi daerah pesisir.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TIM PEMBINA & MAJELIS BIMSUS -->
    <section class="py-5" style="background-color: #FFFFFF;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <span class="section-tag">Pengayom & Pembina</span>
                    <h2 class="section-title mb-0">Struktur Pembina Pangkalan</h2>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Card 1 -->
                <div class="col-md-6 col-lg-3">
                    <div class="team-card">
                        <div class="team-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=600&auto=format&fit=crop" alt="Mabigus">
                        </div>
                        <div class="p-3 text-center">
                            <h6 class="fw-bold mb-1" style="color: var(--color-dark-purple);">Kamabigus SKAGARA</h6>
                            <p class="text-muted small mb-0">Kepala SMK Negeri 3 Jepara</p>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-md-6 col-lg-3">
                    <div class="team-card">
                        <div class="team-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=600&auto=format&fit=crop" alt="Pembina Satuan Putra">
                        </div>
                        <div class="p-3 text-center">
                            <h6 class="fw-bold mb-1" style="color: var(--color-dark-purple);">Pembina Gudep Putra</h6>
                            <p class="text-muted small mb-0">Gudep 05.127 (Wira Bhumi)</p>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-md-6 col-lg-3">
                    <div class="team-card">
                        <div class="team-img-wrapper">
                            <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=600&auto=format&fit=crop" alt="Pembina Satuan Putri">
                        </div>
                        <div class="p-3 text-center">
                            <h6 class="fw-bold mb-1" style="color: var(--color-dark-purple);">Pembina Gudep Putri</h6>
                            <p class="text-muted small mb-0">Gudep 05.128 (Tri Buana)</p>
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
</body>

</html>