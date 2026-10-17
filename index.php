<?php
require_once __DIR__ . '/config/database.php';

function e($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function tanggalIndonesia(?string $tanggal): string {
    if (!$tanggal) return '-';
    $bulan = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $ts = strtotime($tanggal);
    return date('j', $ts) . ' ' . $bulan[(int)date('n', $ts)] . ' ' . date('Y', $ts);
}

function hariSingkat(string $hari): string {
    $map = ['Senin'=>'SEN','Selasa'=>'SEL','Rabu'=>'RAB','Kamis'=>'KAM','Jumat'=>'JUM','Sabtu'=>'SAB','Minggu'=>'MIN'];
    return $map[$hari] ?? strtoupper(substr($hari, 0, 3));
}

function waktuIndonesia(?string $waktu): string {
    return $waktu ? date('H.i', strtotime($waktu)) : '-';
}

function imageOrFallback(?string $image, string $fallback): string {
    $image = trim((string)$image);
    return $image !== '' ? $image : $fallback;
}

// Data yang sudah tersedia di database digunakan pada bagian beranda yang memang sudah memiliki tabel.
$berita = $pdo->query("SELECT id, judul, kategori, tanggal, gambar, ringkasan FROM berita WHERE status='publish' ORDER BY tanggal DESC, id DESC LIMIT 3")->fetchAll();
$jadwalRutin = $pdo->query("SELECT hari, nama_kegiatan, waktu_mulai, waktu_selesai, lokasi FROM jadwal_rutin ORDER BY id ASC LIMIT 2")->fetchAll();
$dokumentasi = $pdo->query("SELECT id, judul, kategori, tanggal, foto, deskripsi FROM dokumentasi ORDER BY tanggal DESC, id DESC LIMIT 4")->fetchAll();

$totalPrestasi = (int)$pdo->query("SELECT COUNT(*) FROM prestasi WHERE kategori <> 'Garuda'")->fetchColumn();
$totalGaruda = (int)$pdo->query("SELECT COUNT(*) FROM prestasi WHERE kategori = 'Garuda'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praska 3 Jepara - Gudep 05.127 - 05.128 SMK Negeri 3 Jepara</title>
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
            /* Palet Warna */
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

        /* HERO SLIDER - PERSEGI PRESISI */
        #heroSlider {
            overflow: hidden;
            background-color: #000;
            border-bottom: 4px solid var(--color-teal);
        }

        #heroSlider::after {
            display: none !important;
        }

        /* Tombol Navigasi Slider di Ujung Kiri dan Kanan */
        .carousel-control-prev-custom,
        .carousel-control-next-custom {
            width: 50px;
            height: 50px;
            top: 50%;
            transform: translateY(-50%);
            background-color: var(--color-teal);
            border-radius: 50%;
            border: 2px solid #FFFFFF;
            transition: all 0.3s ease;
            opacity: 0.9;
        }

        .carousel-control-prev-custom {
            left: 15px !important;
        }

        .carousel-control-next-custom {
            right: 15px !important;
        }

        .carousel-control-prev-custom:hover,
        .carousel-control-next-custom:hover {
            background-color: var(--color-dark-purple);
            opacity: 1;
            transform: translateY(-50%) scale(1.1);
        }

        @media (min-width: 992px) {
            .carousel-control-prev-custom { left: 25px !important; }
            .carousel-control-next-custom { right: 25px !important; }
        }

        .badge-scout {
            background-color: var(--color-mint-light);
            color: var(--color-dark-purple);
            border: 1px solid rgba(255, 255, 255, 0.6);
            padding: 8px 18px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.88rem;
            letter-spacing: 0.5px;
            display: inline-block;
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

        .btn-primary-custom {
            background-color: var(--color-navy-purple);
            color: #FFFFFF;
            font-weight: 700;
            padding: 10px 24px;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: var(--color-dark-purple);
            color: #FFFFFF;
            transform: translateY(-2px);
        }

        .btn-outline-custom {
            border: 2px solid #FFFFFF;
            color: #FFFFFF;
            font-weight: 700;
            padding: 10px 26px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background-color: #FFFFFF;
            color: var(--color-dark-purple);
            transform: translateY(-2px);
        }

        /* STAT CARDS */
        .stat-card-1 {
            background: var(--color-dark-purple);
            border-radius: 16px;
            padding: 28px 20px;
            box-shadow: 0 8px 24px rgba(78, 31, 110, 0.12);
            border-bottom: 5px solid var(--color-teal);
            transition: transform 0.3s ease;
            color: #FFFFFF;
        }

        .stat-card-2 {
            background: var(--color-navy-purple);
            border-radius: 16px;
            padding: 28px 20px;
            box-shadow: 0 8px 24px rgba(62, 62, 117, 0.12);
            border-bottom: 5px solid var(--color-mint-light);
            transition: transform 0.3s ease;
            color: #FFFFFF;
        }

        .stat-card-3 {
            background: var(--color-teal);
            border-radius: 16px;
            padding: 28px 20px;
            box-shadow: 0 8px 24px rgba(69, 169, 169, 0.12);
            border-bottom: 5px solid var(--color-dark-purple);
            transition: transform 0.3s ease;
            color: #FFFFFF;
        }

        .stat-card-4 {
            background: var(--color-mint-light);
            border-radius: 16px;
            padding: 28px 20px;
            box-shadow: 0 8px 24px rgba(152, 232, 222, 0.15);
            border-bottom: 5px solid var(--color-teal);
            transition: transform 0.3s ease;
            color: var(--color-dark-purple);
        }

        .stat-card-1:hover, .stat-card-2:hover, .stat-card-3:hover, .stat-card-4:hover {
            transform: translateY(-5px);
        }

        .stat-icon-light {
            width: 58px;
            height: 58px;
            background: rgba(255, 255, 255, 0.2);
            color: #FFFFFF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin: 0 auto 15px;
        }

        .stat-icon-dark {
            width: 58px;
            height: 58px;
            background: rgba(78, 31, 110, 0.12);
            color: var(--color-dark-purple);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin: 0 auto 15px;
        }

        /* Section Title Styling */
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

        /* Card Custom Styling */
        .card-custom {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(62, 62, 117, 0.08);
            transition: all 0.3s ease;
            background: #FFFFFF;
        }

        .card-custom:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 32px rgba(62, 62, 117, 0.15);
        }

        .card-img-wrapper {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .card-custom:hover .card-img-wrapper img {
            transform: scale(1.08);
        }

        .card-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--color-navy-purple);
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 50px;
        }

        .card-badge-accent {
            background: var(--color-mint-light);
            color: var(--color-dark-purple);
            font-weight: 700;
        }

        /* Program Box */
        .program-box {
            background-color: #FFFFFF;
            border-radius: 16px;
            padding: 26px;
            border-left: 5px solid var(--color-teal);
            height: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(62, 62, 117, 0.05);
        }

        .program-box:hover {
            border-left-color: var(--color-dark-purple);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(62, 62, 117, 0.12);
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
<?php /* Beranda mempertahankan seluruh desain asli; data berita, jadwal rutin, dan dokumentasi diambil dari database. */ ?>

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
                        <a class="nav-link active" href="index.php"><i class="fa-solid fa-house me-1"></i> Beranda</a>
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

    <!-- HERO SECTION SLIDER (TANPA LOGO AMBALAN) -->
    <section id="heroSlider" class="carousel slide carousel-fade position-relative" data-bs-ride="carousel"
        data-bs-interval="5000">
        <!-- Indikator Slider -->
        <div class="carousel-indicators z-3">
            <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <!-- Item Slide -->
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active" style="min-height: 520px;">
                <img src="https://images.unsplash.com/photo-1526772662000-3f88f10405ff?q=80&w=1600&auto=format&fit=crop"
                    class="d-block w-100 h-100 object-fit-cover position-absolute top-0 start-0"
                    alt="Kegiatan Pramuka 1">
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.45);"></div>

                <div class="container position-relative py-5 my-lg-4 z-1 text-white">
                    <div class="row align-items-center gy-4" style="min-height: 420px;">
                        <div class="col-lg-10 col-xl-8 text-center text-lg-start">
                            <span class="badge-scout mb-3"><i class="fa-solid fa-shield-halved me-2"></i>AMBALAN WIRA
                                BHUMI & TRI BUANA TUNGGA DEWI</span>
                            <h1 class="display-4 fw-extrabold mb-3 leading-tight text-white">Membentuk Karakter Generasi
                                Muda Berprestasi & Berwawasan Lingkungan</h1>
                            <p class="lead mb-4 opacity-90 fs-6 text-white">Pangkalan SMK Negeri 3 Jepara (Gudep 05.127
                                - 05.128) berkomitmen melahirkan insan kepanduan berjiwa kepemimpinan, terampil, dan
                                berkarakter vokasi unggul.</p>
                            <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                                <a href="pendaftaran.php" class="btn btn-accent"><i
                                        class="fa-solid fa-paper-plane me-2"></i>Gabung Ambalan</a>
                                <a href="jadwal-latihan.php" class="btn btn-outline-custom"><i
                                        class="fa-solid fa-calendar-days me-2"></i>Lihat Agenda Latihan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item" style="min-height: 520px;">
                <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=1600&auto=format&fit=crop"
                    class="d-block w-100 h-100 object-fit-cover position-absolute top-0 start-0"
                    alt="Kegiatan Pramuka 2">
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.45);"></div>

                <div class="container position-relative py-5 my-lg-4 z-1 text-white">
                    <div class="row align-items-center gy-4" style="min-height: 420px;">
                        <div class="col-lg-10 col-xl-8 text-center text-lg-start">
                            <span class="badge-scout mb-3"><i class="fa-solid fa-campground me-2"></i>PERKEMAHAN &
                                DIKNUS</span>
                            <h1 class="display-4 fw-extrabold mb-3 leading-tight text-white">Kedisiplinan & Kemandirian
                                di Alam Terbuka</h1>
                            <p class="lead mb-4 opacity-90 fs-6 text-white">Melalui perkemahan rutin dan penjelajahan,
                                Penegak praska 3 dilatih untuk tangguh, mandiri, dan mampu bekerja sama dalam tim.</p>
                            <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                                <a href="dokumentasi.php" class="btn btn-accent"><i
                                        class="fa-solid fa-images me-2"></i>Dokumentasi Kegiatan</a>
                                <a href="profil.php" class="btn btn-outline-custom"><i
                                        class="fa-solid fa-compass me-2"></i>Profil Ambalan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item" style="min-height: 520px;">
                <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=1600&auto=format&fit=crop"
                    class="d-block w-100 h-100 object-fit-cover position-absolute top-0 start-0"
                    alt="Kegiatan Pramuka 3">
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.45);"></div>

                <div class="container position-relative py-5 my-lg-4 z-1 text-white">
                    <div class="row align-items-center gy-4" style="min-height: 420px;">
                        <div class="col-lg-10 col-xl-8 text-center text-lg-start">
                            <span class="badge-scout mb-3"><i class="fa-solid fa-leaf me-2"></i>PRAMUKA PEDULI
                                LINGKUNGAN</span>
                            <h1 class="display-4 fw-extrabold mb-3 leading-tight text-white">Aksi Nyata untuk
                                Kelestarian Pesisir & Lingkungan</h1>
                            <p class="lead mb-4 opacity-90 fs-6 text-white">Bakti masyarakat melalui penanaman mangrove
                                dan penanganan sampah sebagai wujud pengamalan Dasa Darma Pramuka.</p>
                            <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                                <a href="pendaftaran.php" class="btn btn-accent"><i
                                        class="fa-solid fa-paper-plane me-2"></i>Gabung Sekarang</a>
                                <a href="kontak.php" class="btn btn-outline-custom"><i
                                        class="fa-solid fa-envelope me-2"></i>Hubungi Kami</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Navigasi Kiri & Kanan -->
        <button class="carousel-control-prev carousel-control-prev-custom z-3" type="button" data-bs-target="#heroSlider"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Sebelumnya</span>
        </button>
        <button class="carousel-control-next carousel-control-next-custom z-3" type="button" data-bs-target="#heroSlider"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Selanjutnya</span>
        </button>
    </section>

    <!-- STATISTIK RINGKAS -->
    <section class="container my-5">
        <div class="row g-3 justify-content-center">
            <!-- Kotak 1 -->
            <div class="col-6 col-md-3">
                <div class="stat-card-1 text-center">
                    <div class="stat-icon-light"><i class="fa-solid fa-flag"></i></div>
                    <h3 class="fw-bold mb-1">05.127/128</h3>
                    <p class="small mb-0 fw-bold opacity-90">No. Gugus Depan</p>
                </div>
            </div>
            <!-- Kotak 2 -->
            <div class="col-6 col-md-3">
                <div class="stat-card-2 text-center">
                    <div class="stat-icon-light"><i class="fa-solid fa-users"></i></div>
                    <h3 class="fw-bold mb-1">300+</h3>
                    <p class="small mb-0 fw-bold opacity-90">Penegak Aktif</p>
                </div>
            </div>
            <!-- Kotak 3 -->
            <div class="col-6 col-md-3">
                <div class="stat-card-3 text-center">
                    <div class="stat-icon-light"><i class="fa-solid fa-hands-holding-circle"></i></div>
                    <h3 class="fw-bold mb-1">50+ Jam</h3>
                    <p class="small mb-0 fw-bold opacity-90">Aksi Bakti Lingkungan</p>
                </div>
            </div>
            <!-- Kotak 4 -->
            <div class="col-6 col-md-3">
                <div class="stat-card-4 text-center">
                    <div class="stat-icon-dark"><i class="fa-solid fa-award"></i></div>
                    <h3 class="fw-bold mb-1">10+</h3>
                    <p class="small mb-0 fw-bold opacity-90">Program Kerja Tahunan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PENGENALAN AMBALAN -->
    <section class="py-5 my-4">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=800&auto=format&fit=crop"
                            class="img-fluid rounded-4 shadow-lg" alt="Pramuka SKAGARA">
                        <div class="position-absolute bottom-0 start-0 text-white p-3 m-3 rounded-3 d-none d-sm-block shadow"
                            style="background-color: var(--color-dark-purple);">
                            <i class="fa-solid fa-tree me-2" style="color: var(--color-mint-light);"></i><strong>Berwawasan
                                Lingkungan & Vokasi</strong>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="section-tag">Tentang Kami</span>
                    <h2 class="section-title fs-1 mb-3">Ambalan Wira Bhumi & Tri Buana Tungga Dewi</h2>
                    <p class="text-muted mb-3">Pramuka Pangkalan SMK Negeri 3 Jepara merupakan wadah pembinaan generasi
                        muda Penegak yang aktif, kreatif, serta peduli pada kelestarian lingkungan hidup dan pengabdian
                        masyarakat.</p>
                    <p class="text-muted mb-4">Melalui Kurikulum Kepramukaan Terintegrasi Vokasi, anggota ditempa untuk
                        memiliki kedisiplinan tinggi, keterampilan kepramukaan (*scout skill*), serta jiwa kewirausahaan
                        dan kepemimpinan berlandaskan Satya dan Darma Pramuka.</p>

                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-circle-check fs-5" style="color: var(--color-teal);"></i>
                                <span class="fw-semibold">Pembentukan Bantara & Laksana</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-circle-check fs-5" style="color: var(--color-teal);"></i>
                                <span class="fw-semibold">Pencapaian Pramuka Garuda</span>
                            </div>
                        </div>
                    </div>

                    <a href="profil.php" class="btn btn-outline-dark fw-bold px-4 py-2 rounded-3"
                        style="border-color: var(--color-dark-purple); color: var(--color-dark-purple);">Selengkapnya tentang Profil
                        <i class="fa-solid fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- KEGIATAN TERBARU / BERITA -->
    <section class="py-5" style="background-color: #FFFFFF;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <span class="section-tag">Kabar SKAGARA</span>
                    <h2 class="section-title mb-0">Kegiatan & Berita Terbaru</h2>
                </div>
                <a href="berita.php" class="btn btn-link fw-bold text-decoration-none d-none d-md-block"
                    style="color: var(--color-teal);">Lihat Semua Berita <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            <div class="row g-4">
                <?php if (empty($berita)): ?>
                    <div class="col-12">
                        <div class="alert alert-light border text-center">Belum ada berita yang dipublikasikan.</div>
                    </div>
                <?php else: ?>
                    <?php
                    $fallbackNews = [
                        'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=800&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1526772662000-3f88f10405ff?q=80&w=800&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=800&auto=format&fit=crop'
                    ];
                    foreach ($berita as $i => $item):
                        $img = imageOrFallback($item['gambar'] ?? '', $fallbackNews[$i] ?? $fallbackNews[0]);
                        $badgeClass = $i === 1 ? 'card-badge card-badge-accent' : 'card-badge';
                    ?>
                        <div class="col-md-4">
                            <div class="card-custom h-100 d-flex flex-column">
                                <div class="card-img-wrapper">
                                    <span class="<?= $badgeClass ?>"><?= e($item['kategori']) ?></span>
                                    <img src="<?= e($img) ?>" alt="<?= e($item['judul']) ?>">
                                </div>
                                <div class="card-body p-4 d-flex flex-column flex-grow-1">
                                    <div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> <?= e(tanggalIndonesia($item['tanggal'])) ?></div>
                                    <h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);"><?= e($item['judul']) ?></h5>
                                    <p class="card-text text-muted small mb-3 flex-grow-1"><?= e($item['ringkasan']) ?></p>
                                    <a href="berita-view.php?id=<?= (int)$item['id'] ?>" class="fw-bold text-decoration-none mt-auto" style="color: var(--color-teal);">Baca Selengkapnya <i class="fa-solid fa-chevron-right ms-1 small"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- JADWAL LATIHAN & PROGRAM UNGGULAN -->
    <section class="py-5">
        <div class="container">
            <div class="row gy-4">
                <!-- Schedule Block -->
                <div class="col-lg-5">
                    <div class="bg-white p-4 rounded-4 shadow-sm h-100 border-top border-4"
                        style="border-top-color: var(--color-teal) !important;">
                        <span class="section-tag">Evaluasi Latihan Mingguan</span>
                        <h3 class="fw-bold mb-3" style="color: var(--color-dark-purple);">Jadwal Latihan Ambalan</h3>
                        <p class="text-muted small">Evaluasi dan refleksi latihan mingguan untuk peningkatan kualitas latihan
                            Pramuka SMK Negeri 3 Jepara.</p>

                        <?php if (empty($jadwalRutin)): ?>
                            <div class="d-flex align-items-center gap-3 p-3 mb-3 rounded-3"
                                style="background-color: var(--color-bg-light);">
                                <div class="p-3 rounded-3 text-center fw-bold text-white"
                                    style="min-width: 65px; background-color: var(--color-teal);">
                                    SAB
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Evaluasi Latihan Mingguan</h6>
                                    <div class="small text-muted"><i class="fa-regular fa-clock me-1"></i> 15.00 - 16.30 WIB</div>
                                    <div class="small text-muted"><i class="fa-solid fa-location-dot me-1"></i> Sanggar Bakti Pramuka SMK Negeri 3 Jepara</div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php foreach ($jadwalRutin as $i => $jadwal): ?>
                                <div class="d-flex align-items-center gap-3 p-3 <?= $i === 0 ? 'mb-3' : 'rounded-3 mb-3' ?> rounded-3"
                                    style="background-color: var(--color-bg-light);">
                                    <div class="p-3 rounded-3 text-center fw-bold text-white"
                                        style="min-width: 65px; background-color: <?= $i === 0 ? 'var(--color-teal)' : 'var(--color-navy-purple)' ?>;">
                                        <?= e(hariSingkat($jadwal['hari'])) ?>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1"><?= (stripos($jadwal['nama_kegiatan'], 'gladian') !== false || stripos($jadwal['nama_kegiatan'], 'rutin') !== false || stripos($jadwal['nama_kegiatan'], 'agenda') !== false) ? 'Evaluasi Latihan Mingguan' : e($jadwal['nama_kegiatan']) ?></h6>
                                        <div class="small text-muted"><i class="fa-regular fa-clock me-1"></i> <?= e(waktuIndonesia($jadwal['waktu_mulai'])) ?> - <?= e(waktuIndonesia($jadwal['waktu_selesai'])) ?> WIB</div>
                                        <div class="small text-muted"><i class="fa-solid fa-location-dot me-1"></i> <?= e($jadwal['lokasi']) ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <a href="jadwal-latihan.php" class="btn btn-sm btn-primary-custom w-100 py-2 fw-semibold">Lihat
                            Kalender Agenda Lengkap</a>
                    </div>
                </div>

                <!-- Flagship Programs Block -->
                <div class="col-lg-7">
                    <div class="h-100 d-flex flex-column justify-content-between">
                        <div>
                            <span class="section-tag">Inisiatif Unggulan</span>
                            <h3 class="fw-bold mb-3" style="color: var(--color-dark-purple);">Program Kerja Ambalan</h3>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="program-box">
                                    <i class="fa-solid fa-campground fs-2 mb-3"
                                        style="color: var(--color-teal);"></i>
                                    <h5 class="fw-bold" style="color: var(--color-dark-purple);">Penerimaan Tamu Ambalan</h5>
                                    <p class="text-muted small mb-0">Masa orientasi kepramukaan bagi calon Penegak baru
                                        SMK Negeri 3 Jepara.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="program-box">
                                    <i class="fa-solid fa-compass fs-2 mb-3" style="color: var(--color-teal);"></i>
                                    <h5 class="fw-bold" style="color: var(--color-dark-purple);">Kompetisi Sangga (KKS)</h5>
                                    <p class="text-muted small mb-0">Ajang kecakapan teknik kepramukaan (scout skill)
                                        antar Sangga secara berkala.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="program-box">
                                    <i class="fa-solid fa-leaf fs-2 mb-3" style="color: var(--color-teal);"></i>
                                    <h5 class="fw-bold" style="color: var(--color-dark-purple);">Bakti Lingkungan</h5>
                                    <p class="text-muted small mb-0">Aksi penghijauan, kelola sampah vokasi, dan
                                        kampanye kepedulian alam.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="program-box">
                                    <i class="fa-solid fa-medal fs-2 mb-3" style="color: var(--color-teal);"></i>
                                    <h5 class="fw-bold" style="color: var(--color-dark-purple);">Pramuka Garuda</h5>
                                    <p class="text-muted small mb-0">Program bimbingan khusus pencapaian kualifikasi
                                        tertinggi Pramuka Penegak.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- DOKUMENTASI CAROUSEL -->
    <section class="py-5" style="background-color: #FFFFFF;">
        <div class="container">
            <div class="text-center max-w-lg mx-auto mb-4">
                <span class="section-tag">Dokumentasi</span>
                <h2 class="section-title">Galeri Aksi Pramuka SKAGARA</h2>
            </div>

            <div id="galleryCarousel" class="carousel slide shadow-lg rounded-4 overflow-hidden"
                data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="0"
                        class="active"></button>
                    <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="1"></button>
                </div>
                <div class="carousel-inner">
                    <?php
                    $fallbackGallery = [
                        'https://images.unsplash.com/photo-1510312305653-8ed496efae75?q=80&w=1600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?q=80&w=1600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=1600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=1600&auto=format&fit=crop'
                    ];
                    if (empty($dokumentasi)):
                    ?>
                        <div class="carousel-item active" style="height: 420px;">
                            <img src="<?= e($fallbackGallery[0]) ?>" class="d-block w-100 h-100 object-fit-cover" alt="Dokumentasi Pramuka SKAGARA">
                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-70 rounded-3 p-3">
                                <h5>Dokumentasi Pramuka SKAGARA</h5>
                                <p>Galeri kegiatan akan tampil setelah data dokumentasi ditambahkan.</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($dokumentasi as $i => $item): ?>
                            <?php $img = imageOrFallback($item['foto'] ?? '', $fallbackGallery[$i] ?? $fallbackGallery[0]); ?>
                            <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>" style="height: 420px;">
                                <img src="<?= e($img) ?>" class="d-block w-100 h-100 object-fit-cover" alt="<?= e($item['judul']) ?>">
                                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-70 rounded-3 p-3">
                                    <h5><?= e($item['judul']) ?></h5>
                                    <p><?= e($item['deskripsi']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>

            <div class="text-center mt-4">
                <a href="dokumentasi.php" class="btn btn-primary-custom fw-bold">Lihat Galeri Foto & Video
                    Selengkapnya</a>
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
                    &copy; 2026 Ambalan SMK Negeri 3 Jepara. Hak Cipta Dilindungi.
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