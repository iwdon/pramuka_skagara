<?php
require_once __DIR__ . '/config/database.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan & Berita - Gudep 05-127 & 05-128 SMK Negeri 3 Jepara</title>
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
        .card-badge-accent {
            background-color: var(--color-teal);
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
    <header class="page-header text-center">
        <div class="container">
            <span class="badge bg-white text-dark fw-bold mb-3 px-3 py-2 rounded-pill"><i class="fa-solid fa-newspaper me-2"></i>KABAR SKAGARA</span>
            <h1 class="display-5 fw-extrabold text-white mb-2">Kegiatan & Berita Ambalan</h1>
            <p class="lead opacity-90 mx-auto" style="max-width: 680px; font-size: 1.05rem;">Dokumentasi rekam jejak aksi nyata, lomba, perkemahan, dan program kerja Pramuka SMK Negeri 3 Jepara.</p>
        </div>
    </header>
    <section class="py-4 bg-white border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap gap-2 justify-content-center">
                <button class="btn btn-filter active" data-filter="all">Semua Kegiatan</button>
                <button class="btn btn-filter" data-filter="pelantikan">Pelantikan Bantara/Laksana</button>
                <button class="btn btn-filter" data-filter="kompetisi">Kompetisi & Prestasi</button>
                <button class="btn btn-filter" data-filter="bakti">Bakti & Konservasi</button>
                <button class="btn btn-filter" data-filter="perkemahan">Perkemahan (PTA & Diknus)</button>
                <button class="btn btn-filter" data-filter="lainnya">Lainnya</button>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row g-4" id="beritaGrid">
                <div class="col-md-4 berita-item" data-category="pelantikan"><div class="card-custom h-100 d-flex flex-column"><div class="card-img-wrapper"><span class="card-badge">Pelantikan</span><img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=800&auto=format&fit=crop" alt="Pelantikan"></div><div class="card-body p-4 d-flex flex-column flex-grow-1"><div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> 18 Oktober 2026</div><h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Pelantikan Penegak Bantara & Laksana 2026</h5><p class="card-text text-muted small mb-3 flex-grow-1">Ujian penjelajahan dan perkemahan diikuti 45 calon Bantara penuh antusias.</p><a href="berita-view.php?id=1" class="fw-bold text-decoration-none mt-auto" style="color: var(--color-teal);">Baca Selengkapnya <i class="fa-solid fa-chevron-right ms-1 small"></i></a></div></div></div>
                <div class="col-md-4 berita-item" data-category="kompetisi"><div class="card-custom h-100 d-flex flex-column"><div class="card-img-wrapper"><span class="card-badge card-badge-accent">Kompetisi</span><img src="https://images.unsplash.com/photo-1526772662000-3f88f10405ff?q=80&w=800&auto=format&fit=crop" alt="KKS"></div><div class="card-body p-4 d-flex flex-column flex-grow-1"><div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> 05 September 2026</div><h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Kompetisi Keterampilan Sangga (KKS) 2026</h5><p class="card-text text-muted small mb-3 flex-grow-1">Unjuk kebolehan pioneering, navigasi darat, dan PBB antar Sangga.</p><a href="berita-view.php?id=2" class="fw-bold text-decoration-none mt-auto" style="color: var(--color-teal);">Baca Selengkapnya <i class="fa-solid fa-chevron-right ms-1 small"></i></a></div></div></div>
                <div class="col-md-4 berita-item" data-category="bakti"><div class="card-custom h-100 d-flex flex-column"><div class="card-img-wrapper"><span class="card-badge">Aksi Peduli</span><img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=800&auto=format&fit=crop" alt="Mangrove"></div><div class="card-body p-4 d-flex flex-column flex-grow-1"><div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> 22 Agustus 2026</div><h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Aksi Reboisasi & Clean-Up Pesisir Jepara</h5><p class="card-text text-muted small mb-3 flex-grow-1">Penanaman bibit mangrove dan penanganan sampah pesisir.</p><a href="berita-view.php?id=3" class="fw-bold text-decoration-none mt-auto" style="color: var(--color-teal);">Baca Selengkapnya <i class="fa-solid fa-chevron-right ms-1 small"></i></a></div></div></div>
                <div class="col-md-4 berita-item" data-category="perkemahan"><div class="card-custom h-100 d-flex flex-column"><div class="card-img-wrapper"><span class="card-badge">Orientasi</span><img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=800&auto=format&fit=crop" alt="PTA"></div><div class="card-body p-4 d-flex flex-column flex-grow-1"><div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> 15 Juli 2026</div><h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Perkemahan Penerimaan Tamu Ambalan (PTA)</h5><p class="card-text text-muted small mb-3 flex-grow-1">Orientasi kepramukaan bagi siswa baru kelas X.</p><a href="berita-view.php?id=4" class="fw-bold text-decoration-none mt-auto" style="color: var(--color-teal);">Baca Selengkapnya <i class="fa-solid fa-chevron-right ms-1 small"></i></a></div></div></div>
                <div class="col-md-4 berita-item" data-category="kompetisi"><div class="card-custom h-100 d-flex flex-column"><div class="card-img-wrapper"><span class="card-badge card-badge-accent">Prestasi</span><img src="https://images.unsplash.com/photo-1510312305653-8ed496efae75?q=80&w=800&auto=format&fit=crop" alt="Garuda"></div><div class="card-body p-4 d-flex flex-column flex-grow-1"><div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> 10 Juni 2026</div><h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Penetapan 8 Anggota Pramuka Garuda 2026</h5><p class="card-text text-muted small mb-3 flex-grow-1">Penganugerahan predikat kualifikasi tertinggi tingkat Kwarcab Jepara.</p><a href="berita-view.php?id=5" class="fw-bold text-decoration-none mt-auto" style="color: var(--color-teal);">Baca Selengkapnya <i class="fa-solid fa-chevron-right ms-1 small"></i></a></div></div></div>
                <div class="col-md-4 berita-item" data-category="lainnya"><div class="card-custom h-100 d-flex flex-column"><div class="card-img-wrapper"><span class="card-badge">Gladian</span><img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?q=80&w=800&auto=format&fit=crop" alt="Gladian"></div><div class="card-body p-4 d-flex flex-column flex-grow-1"><div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> 02 Mei 2026</div><h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Gladian Dewan Ambalan (GDA) & LPK</h5><p class="card-text text-muted small mb-3 flex-grow-1">Pelatihan kepemimpinan dan manajemen organisasi bagi fungsionaris.</p><a href="berita-view.php?id=6" class="fw-bold text-decoration-none mt-auto" style="color: var(--color-teal);">Baca Selengkapnya <i class="fa-solid fa-chevron-right ms-1 small"></i></a></div></div></div>
                <div class="col-md-4 berita-item d-none" data-category="bakti"><div class="card-custom h-100 d-flex flex-column"><div class="card-img-wrapper"><span class="card-badge">Bakti</span><img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=800&auto=format&fit=crop" alt="Bakti"></div><div class="card-body p-4 d-flex flex-column flex-grow-1"><div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> 20 April 2026</div><h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Bakti Sosial & Donasi Panti Asuhan</h5><p class="card-text text-muted small mb-3 flex-grow-1">Kegiatan bakti sosial dengan berbagi kebaikan bersama.</p><a href="berita-view.php?id=7" class="fw-bold text-decoration-none mt-auto" style="color: var(--color-teal);">Baca Selengkapnya <i class="fa-solid fa-chevron-right ms-1 small"></i></a></div></div></div>
                <div class="col-md-4 berita-item d-none" data-category="kompetisi"><div class="card-custom h-100 d-flex flex-column"><div class="card-img-wrapper"><span class="card-badge card-badge-accent">Kompetisi</span><img src="https://images.unsplash.com/photo-1511499767150-a48a237f0083?q=80&w=800&auto=format&fit=crop" alt="Sandi"></div><div class="card-body p-4 d-flex flex-column flex-grow-1"><div class="text-muted small mb-2"><i class="fa-regular fa-calendar me-1"></i> 15 Maret 2026</div><h5 class="card-title fw-bold mb-2" style="color: var(--color-dark-purple);">Juara 1 Lomba Sandi Tingkat Kwarcab</h5><p class="card-text text-muted small mb-3 flex-grow-1">Prestasi membanggakan dalam ajang lomba sandi.</p><a href="berita-view.php?id=8" class="fw-bold text-decoration-none mt-auto" style="color: var(--color-teal);">Baca Selengkapnya <i class="fa-solid fa-chevron-right ms-1 small"></i></a></div></div></div>
            </div>
            <div id="noResult" class="text-center py-4 d-none"><p class="text-muted">Tidak ada berita untuk filter ini.</p></div>
            <nav class="mt-5"><ul class="pagination justify-content-center" id="pagination"></ul></nav>
        </div>
    </section>
    <footer class="pt-5 pb-3">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-4 col-md-6"><div class="d-flex align-items-center gap-2 mb-3"><h5 class="mb-0 text-white">PRASKA 3 JEPARA</h5></div><p class="small text-white-50">Gudep 05.127 - 05.128 Ambalan Wira Bhumi & Tri Buana Tungga Dewi Pangkalan SMK Negeri 3 Jepara.</p><div class="mt-3"><a href="#" class="social-btn"><i class="fa-brands fa-instagram"></i></a><a href="#" class="social-btn"><i class="fa-brands fa-youtube"></i></a><a href="#" class="social-btn"><i class="fa-brands fa-tiktok"></i></a><a href="#" class="social-btn"><i class="fa-brands fa-whatsapp"></i></a></div></div>
                <div class="col-lg-2 col-md-6"><h5>Navigasi</h5><ul class="list-unstyled small"><li class="mb-2"><a href="profil.php">Profil Ambalan</a></li><li class="mb-2"><a href="berita.php">Berita</a></li><li class="mb-2"><a href="materi.php">Materi SKU/TKU</a></li><li class="mb-2"><a href="pendaftaran.php">Pendaftaran Online</a></li></ul></div>
                <div class="col-lg-3 col-md-6"><h5>Sanggar Bakti</h5><ul class="list-unstyled small text-white-50"><li class="mb-2"><i class="fa-solid fa-building me-2" style="color: var(--color-mint-light);"></i>SMK Negeri 3 Jepara</li><li class="mb-2"><i class="fa-solid fa-location-dot me-2" style="color: var(--color-mint-light);"></i>Jl. KS Tubun No. 3, Kabupaten Jepara, Jawa Tengah 59418</li><li class="mb-2"><i class="fa-solid fa-clock me-2" style="color: var(--color-mint-light);"></i>Senin - Jumat: 07.00 - 16.00 WIB</li></ul></div>
                <div class="col-lg-3 col-md-6"><h5>Tautan Resmi</h5><ul class="list-unstyled small"><li class="mb-2"><a href="https://www.scout.org/" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square me-1"></i> WOSM (scout.org)</a></li><li class="mb-2"><a href="#" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Kwarnas Gerakan Pramuka</a></li><li class="mb-2"><a href="#" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Kwarda Jawa Tengah</a></li><li class="mb-2"><a href="#" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Kwarcab Jepara</a></li></ul></div>
            </div>
            <hr class="border-secondary my-4" style="opacity: 0.2;">
            <div class="row align-items-center small text-white-50"><div class="col-md-6 text-center text-md-start">&copy; 2026 Ambalan SKAGARA SMK Negeri 3 Jepara. Hak Cipta Dilindungi.</div><div class="col-md-6 text-center text-md-end mt-2 mt-md-0"><span>Dikembangkan untuk Kepramukaan Vokasi SKAGARA</span></div></div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.btn-filter');
            const items = document.querySelectorAll('.berita-item');
            const noResult = document.getElementById('noResult');
            const pagination = document.getElementById('pagination');
            const perPage = 6;
            let currentFilter = 'all';
            let currentPage = 1;

            function render() {
                let visibleItems = [];
                items.forEach(item => {
                    const cat = item.dataset.category;
                    if (currentFilter === 'all' || cat === currentFilter) visibleItems.push(item);
                });
                if (noResult) {
                    if (visibleItems.length === 0) noResult.classList.remove('d-none');
                    else noResult.classList.add('d-none');
                }
                const totalPages = Math.max(1, Math.ceil(visibleItems.length / perPage));
                if (currentPage > totalPages) currentPage = totalPages;
                items.forEach(item => item.classList.add('d-none'));
                const start = (currentPage - 1) * perPage;
                for (let i = start; i < start + perPage && i < visibleItems.length; i++) {
                    visibleItems[i].classList.remove('d-none');
                }
                renderPagination(totalPages);
            }

            function renderPagination(totalPages) {
                pagination.innerHTML = '';
                if (totalPages <= 1) return;
                const prev = document.createElement('li');
                prev.className = 'page-item' + (currentPage === 1 ? ' disabled' : '');
                prev.innerHTML = '<a class="page-link" href="#">Sebelumnya</a>';
                prev.onclick = function(e){ e.preventDefault(); if (currentPage>1){ currentPage--; render(); window.scrollTo({top:0,behavior:'smooth'}); }};
                pagination.appendChild(prev);
                for (let p = 1; p <= totalPages; p++) {
                    const li = document.createElement('li');
                    li.className = 'page-item' + (p === currentPage ? ' active' : '');
                    li.innerHTML = '<a class="page-link" href="#">' + p + '</a>';
                    li.onclick = function(e){ e.preventDefault(); currentPage=p; render(); window.scrollTo({top:0,behavior:'smooth'}); };
                    pagination.appendChild(li);
                }
                const next = document.createElement('li');
                next.className = 'page-item' + (currentPage === totalPages ? ' disabled' : '');
                next.innerHTML = '<a class="page-link" href="#">Selanjutnya</a>';
                next.onclick = function(e){ e.preventDefault(); if (currentPage<totalPages){ currentPage++; render(); window.scrollTo({top:0,behavior:'smooth'}); }};
                pagination.appendChild(next);
            }

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentFilter = this.dataset.filter;
                    currentPage = 1;
                    render();
                });
            });

            render();
        });
    </script>
</body>
</html>
