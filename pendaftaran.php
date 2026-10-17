<?php
$pesan_sukses = '';
$pesan_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "INSERT INTO pendaftaran
            (nama_lengkap, nisn, tempat_lahir, tanggal_lahir, jenis_kelamin, whatsapp, agama, kelas, jurusan, alamat, nama_orang_tua, no_whatsapp_orang_tua)
            VALUES
            (:nama_lengkap, :nisn, :tempat_lahir, :tanggal_lahir, :jenis_kelamin, :whatsapp, :agama, :kelas, :jurusan, :alamat, :nama_orang_tua, :no_whatsapp_orang_tua)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nama_lengkap' => trim($_POST['nama_lengkap'] ?? ''),
            ':nisn' => trim($_POST['nisn'] ?? ''),
            ':tempat_lahir' => trim($_POST['tempat_lahir'] ?? ''),
            ':tanggal_lahir' => $_POST['tanggal_lahir'] ?? null,
            ':jenis_kelamin' => $_POST['jenis_kelamin'] ?? '',
            ':whatsapp' => trim($_POST['whatsapp'] ?? ''),
            ':agama' => $_POST['agama'] ?? '',
            ':kelas' => $_POST['kelas'] ?? '',
            ':jurusan' => trim($_POST['jurusan'] ?? ''),
            ':alamat' => trim($_POST['alamat'] ?? ''),
            ':nama_orang_tua' => trim($_POST['nama_orang_tua'] ?? ''),
            ':no_whatsapp_orang_tua' => trim($_POST['no_whatsapp_orang_tua'] ?? '')
        ]);
        $pesan_sukses = 'Pendaftaran berhasil dikirim. Terima kasih.';
    } catch (PDOException $e) {
        $pesan_error = 'Pendaftaran gagal disimpan. Silakan periksa kembali data Anda.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Online - Gudep 05-127 & 05-128 SMK Negeri 3 Jepara</title>
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
            padding: 60px 0;
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

        /* Form Card */
        .form-card {
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(62, 62, 117, 0.08);
            border: none;
        }

        .form-section-title {
            color: var(--color-dark-purple);
            font-weight: 700;
            font-size: 1.1rem;
            border-left: 4px solid var(--color-teal);
            padding-left: 12px;
            margin-bottom: 20px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 11px 16px;
            border: 1px solid #E2E8F0;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--color-teal);
            box-shadow: 0 0 0 0.25rem rgba(69, 169, 169, 0.25);
        }

        /* Alur Step Box */
        .step-box {
            background: #FFFFFF;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 6px 20px rgba(62, 62, 117, 0.06);
            height: 100%;
            border-top: 4px solid var(--color-teal);
        }

        .step-number {
            width: 45px;
            height: 45px;
            background: var(--color-mint-light);
            color: var(--color-dark-purple);
            font-weight: 800;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        /* Buttons */
        .btn-accent {
            background-color: var(--color-teal);
            color: #FFFFFF;
            font-weight: 800;
            padding: 12px 30px;
            border-radius: 10px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-accent:hover {
            background-color: #358d8d;
            color: #FFFFFF;
            transform: translateY(-2px);
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
                        <a class="btn btn-accent btn-sm px-3 shadow-none active" href="pendaftaran.php"><i
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
    <?php if ($pesan_sukses || $pesan_error): ?>
<div class="container mt-4">
    <?php if ($pesan_sukses): ?><div class="alert alert-success"><?= htmlspecialchars($pesan_sukses) ?></div><?php endif; ?>
    <?php if ($pesan_error): ?><div class="alert alert-danger"><?= htmlspecialchars($pesan_error) ?></div><?php endif; ?>
</div>
<?php endif; ?>
<header class="page-header text-center">
        <div class="container">
            <span class="badge bg-white text-dark fw-bold mb-3 px-3 py-2 rounded-pill"><i class="fa-solid fa-user-plus me-2"></i>REGISTRASI ANGGOTA BARU</span>
            <h1 class="display-5 fw-extrabold text-white mb-2">Pendaftaran Anggota Ambalan </h1>
            <p class="lead opacity-90 mx-auto" style="max-width: 680px; font-size: 1.05rem;">
                Bergabunglah bersama Ambalan Wira Bhumi & Tri Buana Tungga Dewi SMK Negeri 3 Jepara.
            </p>
        </div>
    </header>

    <!-- ALUR PENDAFTARAN -->
    <section class="py-5">
        <div class="container">
            <div class="text-center max-w-lg mx-auto mb-4">
                <span class="section-tag">Langkah Mudah</span>
                <h2 class="section-title">Alur Penerimaan Calon Penegak</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="step-box text-center">
                        <div class="step-number mx-auto">1</div>
                        <h5 class="fw-bold" style="color: var(--color-dark-purple);">Isi Formulir Online</h5>
                        <p class="text-muted small mb-0">Lengkapi data diri, program keahlian vokasi, dan riwayat kepramukaan Anda secara akurat.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-box text-center">
                        <div class="step-number mx-auto">2</div>
                        <h5 class="fw-bold" style="color: var(--color-dark-purple);">Konfirmasi WhatsApp</h5>
                        <p class="text-muted small mb-0">Setelah submit, cetak atau simpan bukti registrasi lalu kirim pesan konfirmasi ke Sanggar.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-box text-center">
                        <div class="step-number mx-auto">3</div>
                        <h5 class="fw-bold" style="color: var(--color-dark-purple);">Orientasi & PTA</h5>
                        <p class="text-muted small mb-0">Ikuti kegiatan Latihan Perdana dan Perkemahan Penerimaan Tamu Ambalan (PTA).</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FORMULIR PENDAFTARAN -->
    <section class="pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="form-card p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-extrabold" style="color: var(--color-dark-purple);">Formulir Pendaftaran Penegak SKAGARA</h3>
                            <p class="text-muted small">Silakan isi formulir di bawah ini dengan data yang sebenar-benarnya.</p>
                        </div>

                        <form action="pendaftaran.php" method="POST">
                            <!-- BAGIAN 1: DATA DIRI -->
                            <div class="form-section-title"><i class="fa-solid fa-user me-2"></i>1. Data Diri Calon Anggota</div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-8">
                                    <label class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap sesuai ijazah" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold small">NISN <span class="text-danger">*</span></label>
                                    <input type="text" name="nisn" class="form-control" placeholder="10 digit NISN" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold small">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" name="tempat_lahir" class="form-control" placeholder="Kota/Kabupaten lahir" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold small">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold small">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                                        <option value="L">Laki-Laki (Ambalan Wira Bhumi)</option>
                                        <option value="P">Perempuan (Ambalan Tri Buana Tungga Dewi)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Nomor WhatsApp Aktif <span class="text-danger">*</span></label>
                                    <input type="tel" name="whatsapp" class="form-control" placeholder="Contoh: 08123456789" required>
                                </div>
                            </div>

                            <!-- BAGIAN 2: DATA AKADEMIK -->
                            <div class="form-section-title"><i class="fa-solid fa-graduation-cap me-2"></i>2. Data Sekolah di SMKN 3 Jepara</div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Kelas <span class="text-danger">*</span></label>
                                    <select name="kelas" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Tingkat Kelas --</option>
                                        <option value="X">Kelas X (Sepuluh)</option>
                                        <option value="XI">Kelas XI (Sebelas)</option>
                                        <option value="XII">Kelas XII (Dua Belas)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Program Keahlian / Jurusan <span class="text-danger">*</span></label>
                                    <select name="jurusan" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Jurusan --</option>
                                        <option value="Teknik Otomotif">Teknik Otomotif</option>
                                        <option value="Teknik Mesin">Teknik Mesin</option>
                                        <option value="Teknik Ketenagalistrikan">Teknik Ketenagalistrikan</option>
                                        <option value="Desain Komunikasi Visual">Desain Komunikasi Visual (DKV)</option>
                                        <option value="Busana / Tata Busana">Tata Busana</option>
                                        <option value="Lainnya">Jurusan Lainnya</option>
                                    </select>
                                </div>
                            </div>

                            <!-- BAGIAN 3: RIWAYAT & KEPERLUAN -->
                            <div class="form-section-title"><i class="fa-solid fa-campground me-2"></i>3. Riwayat & Kecakapan Kepramukaan</div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Pangkalan SMP/MTs Asal <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Nama sekolah SMP/MTs asal" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Tingkat Pramuka Terakhir</label>
                                    <select class="form-select">
                                        <option value="Penggalang Ramu">Penggalang Ramu</option>
                                        <option value="Penggalang Rakit">Penggalang Rakit</option>
                                        <option value="Penggalang Terap">Penggalang Terap</option>
                                        <option value="Penggalang Garuda">Penggalang Garuda</option>
                                        <option value="Belum Pernah">Belum Pernah / Baru Bergabung</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Minat Bidang Keahlian Ambalan</label>
                                    <select class="form-select">
                                        <option value="Teknik Kepramukaan">Teknik Kepramukaan (Scout Skill)</option>
                                        <option value="Pramuka Peduli & Lingkungan">Pramuka Peduli & Conservasi Pesisir</option>
                                        <option value="Jurnalistik & Humas">Jurnalistik, DKV & Publikasi</option>
                                        <option value="Giat Operasional">Giat Operasional & Kedisiplinan</option>
                                    </select>
                                </div>
                            </div>

                            <!-- SYARAT & KETENTUAN -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="syaratCheck" required>
                                <label class="form-check-label small text-muted" for="syaratCheck">
                                    Saya menyatakan bahwa data yang diisikan adalah benar. Saya bersedia mengikuti seluruh tata tertib dan kegiatan Ambalan SKAGARA SMK Negeri 3 Jepara.
                                </label>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-accent btn-lg w-100 fw-bold">
                                    <i class="fa-solid fa-paper-plane me-2"></i>Kirim Pendaftaran
                                </button>
                            </div>
                        </form>
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