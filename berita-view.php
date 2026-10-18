<?php
require_once __DIR__ . '/config/database.php';

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM berita WHERE id = ?");
$stmt->execute([$id]);
$berita = $stmt->fetch();

if (!$berita) {
    http_response_code(404);
    $berita = null;
}

// Helper format tanggal
$bulan = [
    1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];
$tanggalFormatted = '-';
if ($berita && !empty($berita['tanggal'])) {
    $ts = strtotime($berita['tanggal']);
    $tanggalFormatted = date('d', $ts) . ' ' . $bulan[(int)date('m', $ts)] . ' ' . date('Y', $ts);
}

// Ambil berita terkait
$beritaTerkait = [];
if ($berita) {
    $sqlRel = "SELECT id, judul, kategori, tanggal, gambar, ringkasan 
               FROM berita 
               WHERE id != ? AND kategori = ? AND status = 'publish'
               ORDER BY tanggal DESC, id DESC 
               LIMIT 3";
    $stmtRel = $pdo->prepare($sqlRel);
    $stmtRel->execute([$id, $berita['kategori']]);
    $beritaTerkait = $stmtRel->fetchAll();
    if (count($beritaTerkait) == 0) {
        $sqlRel2 = "SELECT id, judul, kategori, tanggal, gambar, ringkasan 
                    FROM berita 
                    WHERE id != ? AND status = 'publish'
                    ORDER BY tanggal DESC, id DESC 
                    LIMIT 3";
        $stmtRel2 = $pdo->prepare($sqlRel2);
        $stmtRel2->execute([$id]);
        $beritaTerkait = $stmtRel2->fetchAll();
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $berita ? htmlspecialchars($berita['judul']) : 'Berita Tidak Ditemukan' ?> - Pramuka SKAGARA</title>
    <link rel="icon" type="image/png" href="https://placehold.co/60x60/4E1F6E/FFF?text=SKG">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --color-dark-purple: #4E1F6E;
            --color-navy-purple: #3E3E75;
            --color-teal: #45A9A9;
            --color-mint-light: #98E8DE;
            --color-bg-light: #F5F8F8;
            --color-text-main: #2B2B2B;
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
            background: linear-gradient(rgba(78, 31, 110, 0.9), rgba(62, 62, 117, 0.92)),
                        url('https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
            color: white;
            padding: 40px 0;
            border-bottom: 4px solid var(--color-teal);
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
        .article-img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            border-radius: 16px;
        }
        .article-content {
            line-height: 1.8;
            font-size: 1.05rem;
            color: #3f3f3f;
        }
        .article-content p {
            margin-bottom: 1.25rem;
        }
        .article-meta {
            color: #6c757d;
            font-size: 0.95rem;
        }
        .badge-custom {
            background-color: var(--color-dark-purple);
            color: #FFFFFF;
            padding: 6px 14px;
            border-radius: 50px;
            font-weight: 700;
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
        .btn-accent {
            background-color: var(--color-teal);
            color: #FFFFFF;
            font-weight: 700;
            border-radius: 50px;
        }
        .btn-accent:hover {
            background-color: #358d8d;
            color: #FFFFFF;
        }
    </style>
</head>

<body>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fa-solid fa-house me-1"></i> Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="tentangDropdown" role="button" data-bs-toggle="dropdown">Tentang Kami</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profil.php"><i class="fa-solid fa-compass me-2"></i>Profil & Sejarah</a></li>
                            <li><a class="dropdown-item" href="prestasi.php"><i class="fa-solid fa-trophy me-2"></i>Prestasi & Garuda</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="kegiatanDropdown" role="button" data-bs-toggle="dropdown">Kegiatan & Agenda</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="jadwal-latihan.php"><i class="fa-solid fa-clock me-2"></i>Jadwal Latihan</a></li>
                            <li><a class="dropdown-item" href="dokumentasi.php"><i class="fa-solid fa-images me-2"></i>Galeri Foto & Video</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link active" href="berita.php">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="materi.php">Materi</a></li>
                    <li class="nav-item ms-lg-2 my-2 my-lg-0"><a class="btn btn-accent btn-sm px-3 shadow-none" href="pendaftaran.php"><i class="fa-solid fa-user-plus me-1"></i> Pendaftaran</a></li>
                    <li class="nav-item"><a class="nav-link" href="kontak.php">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="page-header">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="index.php" class="text-white-50 text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="berita.php" class="text-white-50 text-decoration-none">Berita & Kegiatan</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Detail Berita</li>
                </ol>
            </nav>
            <?php if ($berita): ?>
                <h1 class="fw-extrabold text-white mb-2 fs-2"><?= htmlspecialchars($berita['judul']) ?></h1>
                <div class="article-meta text-white-50 d-flex flex-wrap gap-3 align-items-center mt-2">
                    <span><i class="fa-regular fa-calendar me-1"></i> <?= $tanggalFormatted ?></span>
                    <span><i class="fa-solid fa-tags me-1"></i> <?= htmlspecialchars($berita['kategori']) ?></span>
                    <?php if ($berita['status'] === 'draft'): ?>
                        <span class="badge bg-warning text-dark">Draft</span>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <h1 class="fw-extrabold text-white mb-2 fs-2">Berita Tidak Ditemukan</h1>
                <p class="text-white-50 mb-0">Halaman berita yang Anda cari tidak tersedia.</p>
            <?php endif; ?>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <?php if (!$berita): ?>
                <div class="text-center py-5">
                    <i class="fa-solid fa-circle-exclamation fa-3x text-muted mb-3"></i>
                    <h4 class="mb-3">Berita Tidak Ditemukan</h4>
                    <p class="text-muted mb-4">Berita dengan ID tersebut tidak ditemukan atau telah dihapus.</p>
                    <a href="berita.php" class="btn btn-accent px-4">
                        <i class="fa-solid fa-arrow-left me-2"></i>Kembali ke Daftar Berita
                    </a>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <!-- Artikel Utama -->
                    <div class="col-lg-8">
                        <div class="card-custom">
                            <?php if (!empty($berita['gambar'])): ?>
                                <img src="<?= htmlspecialchars($berita['gambar']) ?>" alt="<?= htmlspecialchars($berita['judul']) ?>" class="article-img">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center" style="height: 420px; background: linear-gradient(rgba(78,31,110,0.08), rgba(69,169,169,0.08));">
                                    <i class="fa-solid fa-image fa-3x text-muted opacity-25"></i>
                                </div>
                            <?php endif; ?>
                            <div class="card-body p-4 p-md-5">
                                <?php if (!empty($berita['ringkasan'])): ?>
                                    <div class="lead text-muted mb-4 p-3 rounded-3" style="background: rgba(152,232,222,0.15);">
                                        <?= htmlspecialchars($berita['ringkasan']) ?>
                                    </div>
                                <?php endif; ?>
                                <div class="article-content">
                                    <?= $berita['isi'] ? nl2br($berita['isi']) : '<p class="text-muted">Isi berita belum tersedia.</p>' ?>
                                </div>
                                <div class="mt-4 pt-3 border-top">
                                    <a href="berita.php" class="btn btn-outline-primary">
                                        <i class="fa-solid fa-arrow-left me-2"></i>Kembali ke Daftar Berita
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <div class="card-custom mb-4">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-3" style="color: var(--color-dark-purple);">
                                    <i class="fa-solid fa-info-circle me-2"></i>Info Berita
                                </h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-3 pb-3 border-bottom">
                                        <small class="text-muted d-block">Kategori</small>
                                        <span class="badge badge-custom mt-1"><?= htmlspecialchars($berita['kategori']) ?></span>
                                    </li>
                                    <li class="mb-3 pb-3 border-bottom">
                                        <small class="text-muted d-block">Tanggal Publikasi</small>
                                        <div class="fw-semibold mt-1"><i class="fa-regular fa-calendar me-1"></i> <?= $tanggalFormatted ?></div>
                                    </li>
                                    <li>
                                        <small class="text-muted d-block">Status</small>
                                        <div class="fw-semibold mt-1">
                                            <?php if ($berita['status'] === 'publish'): ?>
                                                <span class="badge bg-success"><i class="fa-solid fa-check-circle me-1"></i>Publish</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark"><i class="fa-solid fa-pen-to-square me-1"></i>Draft</span>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <?php if (!empty($beritaTerkait)): ?>
                            <div class="card-custom">
                                <div class="card-body p-4">
                                    <h5 class="fw-bold mb-3" style="color: var(--color-dark-purple);">
                                        <i class="fa-solid fa-newspaper me-2"></i>Berita Terkait
                                    </h5>
                                    <div class="d-flex flex-column gap-3">
                                        <?php foreach ($beritaTerkait as $rel): ?>
                                            <a href="berita-view.php?id=<?= $rel['id'] ?>" class="text-decoration-none text-dark d-flex gap-2">
                                                <div style="width:80px;height:60px;flex-shrink:0;border-radius:8px;overflow:hidden;">
                                                    <?php if (!empty($rel['gambar'])): ?>
                                                        <img src="<?= htmlspecialchars($rel['gambar']) ?>" alt="" style="width:100%;height:100%;object-fit:cover;">
                                                    <?php else: ?>
                                                        <div class="d-flex align-items-center justify-content-center h-100" style="background:#F1F3F5;">
                                                            <i class="fa-solid fa-image text-muted"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="small fw-semibold mb-1" style="line-height:1.3;"><?= htmlspecialchars($rel['judul']) ?></div>
                                                    <div class="small text-muted">
                                                        <i class="fa-regular fa-calendar me-1"></i>
                                                        <?= date('d/m/Y', strtotime($rel['tanggal'])) ?>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <footer class="pt-5 pb-3">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <h5 class="mb-0 text-white">PRASKA 3 JEPARA</h5>
                    </div>
                    <p class="small text-white-50">Gudep 05.127 - 05.128 Ambalan Wira Bhumi & Tri Buana Tungga Dewi Pangkalan SMK Negeri 3 Jepara.</p>
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
                        <li class="mb-2"><a href="berita.php">Berita</a></li>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
