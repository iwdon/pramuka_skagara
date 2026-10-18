<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidebar">
    <div class="sidebar-brand">
        <h5>PRASKA 3 JEPARA</h5>
        <small>GUDEP 05.127 - 05.128</small>
    </div>

    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?= $currentPage === 'dashboard.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <div class="nav-section-title">Konten Website</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="berita.php" class="nav-link <?= in_array($currentPage, ['berita.php', 'berita_tambah.php', 'berita_edit.php']) ? 'active' : '' ?>">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Berita & Kegiatan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="kategori_berita.php" class="nav-link <?= $currentPage === 'kategori_berita.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-tags"></i>
                    <span>Kategori Berita</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="prestasi.php" class="nav-link <?= in_array($currentPage, ['prestasi.php', 'prestasi_tambah.php', 'prestasi_edit.php']) ? 'active' : '' ?>">
                    <i class="fa-solid fa-trophy"></i>
                    <span>Prestasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="dokumentasi.php" class="nav-link <?= in_array($currentPage, ['dokumentasi.php', 'dokumentasi_tambah.php', 'dokumentasi_edit.php', 'dokumentasi_foto.php']) ? 'active' : '' ?>">
                    <i class="fa-solid fa-images"></i>
                    <span>Dokumentasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="jadwal_rutin.php" class="nav-link <?= $currentPage === 'jadwal_rutin.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-calendar-day"></i>
                    <span>Jadwal Rutin</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="jadwal_agenda.php" class="nav-link <?= in_array($currentPage, ['jadwal_agenda.php', 'jadwal_agenda_tambah.php', 'jadwal_agenda_edit.php']) ? 'active' : '' ?>">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Agenda Tahunan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="materi.php" class="nav-link <?= in_array($currentPage, ['materi.php', 'materi_tambah.php', 'materi_edit.php']) ? 'active' : '' ?>">
                    <i class="fa-solid fa-book-open"></i>
                    <span>Materi</span>
                </a>
            </li>
        </ul>

        <div class="nav-section-title">Pendaftaran</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="pendaftaran.php" class="nav-link <?= $currentPage === 'pendaftaran.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Pendaftaran</span>
                    <?php
                    try {
                        $countMenunggu = $pdo->query("SELECT COUNT(*) FROM pendaftaran WHERE status='baru'")->fetchColumn();
                        if ($countMenunggu > 0) {
                            echo '<span class="badge bg-danger ms-auto">' . $countMenunggu . '</span>';
                        }
                    } catch (Exception $e) {
                    }
                    ?>
                </a>
            </li>
        </ul>

        <div class="nav-section-title">Manajemen Website</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="slider.php" class="nav-link <?= $currentPage === 'slider.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-images"></i>
                    <span>Slider / Banner</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="pengurus.php" class="nav-link <?= $currentPage === 'pengurus.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-users"></i>
                    <span>Pengurus & Pembina</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="pengaturan.php" class="nav-link <?= $currentPage === 'pengaturan.php' ? 'active' : '' ?>">
                    <i class="fa-solid fa-gear"></i>
                    <span>Pengaturan Website</span>
                </a>
            </li>
            <?php if ($adminRole === 'superadmin'): ?>
                <li class="nav-item">
                    <a href="users.php" class="nav-link <?= $currentPage === 'users.php' ? 'active' : '' ?>">
                        <i class="fa-solid fa-user-shield"></i>
                        <span>Manajemen User</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>

        <hr class="border-secondary opacity-25 my-3">

        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="../index.php" target="_blank" class="nav-link">
                    <i class="fa-solid fa-house"></i>
                    <span>Lihat Website</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link text-danger" onclick="return confirm('Yakin ingin logout?')">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>

<div class="sidebar-backdrop d-lg-none" id="sidebarBackdrop" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.5); z-index:1035;"></div>
