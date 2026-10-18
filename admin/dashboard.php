<?php
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/../config/database.php';

try {
    $totalBerita = $pdo->query("SELECT COUNT(*) FROM berita")->fetchColumn();
    $totalPrestasi = $pdo->query("SELECT COUNT(*) FROM prestasi")->fetchColumn();
    $totalDokumentasi = $pdo->query("SELECT COUNT(*) FROM dokumentasi")->fetchColumn();
    $totalPendaftaran = $pdo->query("SELECT COUNT(*) FROM pendaftaran")->fetchColumn();
    $totalMateri = $pdo->query("SELECT COUNT(*) FROM materi")->fetchColumn();
    $totalJadwalRutin = $pdo->query("SELECT COUNT(*) FROM jadwal_rutin")->fetchColumn();
    $totalAgenda = $pdo->query("SELECT COUNT(*) FROM jadwal")->fetchColumn();
    $pendaftaranBaru = $pdo->query("SELECT COUNT(*) FROM pendaftaran WHERE status='baru'")->fetchColumn();

    $beritaTerbaru = $pdo->query("SELECT id, judul, tanggal, status FROM berita ORDER BY tanggal DESC, id DESC LIMIT 5")->fetchAll();
    $pendaftaranTerbaru = $pdo->query("SELECT id, nama_lengkap, whatsapp, kelas, status, created_at FROM pendaftaran ORDER BY created_at DESC LIMIT 5")->fetchAll();
} catch (Exception $e) {
    $totalBerita = $totalPrestasi = $totalDokumentasi = $totalPendaftaran = $totalMateri = 0;
    $totalJadwalRutin = $totalAgenda = $pendaftaranBaru = 0;
    $beritaTerbaru = $pendaftaranTerbaru = [];
}
?>

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="page-title">Dashboard</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="berita.php" class="btn btn-primary-custom">
                <i class="fa-solid fa-plus me-2"></i>Kelola Berita
            </a>
            <a href="prestasi.php" class="btn btn-outline-custom">
                <i class="fa-solid fa-trophy me-2"></i>Kelola Prestasi
            </a>
        </div>
    </div>

    <!-- Welcome Card -->
    <div class="card-custom mb-4">
        <div class="card-body-custom">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                <div>
                    <h4 class="fw-bold mb-2" style="color: var(--color-dark-purple);">Selamat Datang, <?= htmlspecialchars($adminNama) ?>!</h4>
                    <p class="text-muted mb-0">Kelola konten website Pramuka SKAGARA dengan mudah dari dashboard ini.</p>
                </div>
                <div class="text-md-end">
                    <small class="text-muted d-block">Hari ini</small>
                    <h5 class="fw-bold mb-0"><?= date('l, d F Y') ?></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card-stat">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-value"><?= number_format($totalBerita) ?></div>
                        <div class="stat-label">Total Berita</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card-stat">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-value"><?= number_format($totalPrestasi) ?></div>
                        <div class="stat-label">Total Prestasi</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-trophy"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card-stat">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-value"><?= number_format($totalDokumentasi) ?></div>
                        <div class="stat-label">Dokumentasi</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-images"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card-stat">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-value"><?= number_format($totalPendaftaran) ?></div>
                        <div class="stat-label">Pendaftaran</div>
                        <?php if ($pendaftaranBaru > 0): ?>
                            <small class="text-danger fw-semibold">
                                <i class="fa-solid fa-circle-exclamation me-1"></i><?= $pendaftaranBaru ?> Baru
                            </small>
                        <?php endif; ?>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card-stat">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-value"><?= number_format($totalMateri) ?></div>
                        <div class="stat-label">Materi</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card-stat">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-value"><?= number_format($totalJadwalRutin) ?></div>
                        <div class="stat-label">Jadwal Rutin</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-calendar-day"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card-stat">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-value"><?= number_format($totalAgenda) ?></div>
                        <div class="stat-label">Agenda Kegiatan</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row g-4">
        <!-- Berita Terbaru -->
        <div class="col-lg-6">
            <div class="card-custom h-100">
                <div class="card-header-custom d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0" style="color: var(--color-dark-purple);">
                        <i class="fa-solid fa-newspaper me-2"></i>Berita Terbaru
                    </h5>
                    <a href="berita.php" class="btn btn-sm btn-outline-custom">Lihat Semua</a>
                </div>
                <div class="card-body-custom p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($beritaTerbaru)): ?>
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">Belum ada berita</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($beritaTerbaru as $b): ?>
                                        <tr>
                                            <td>
                                                <div class="fw-semibold text-truncate" style="max-width: 250px;">
                                                    <?= htmlspecialchars($b['judul']) ?>
                                                </div>
                                            </td>
                                            <td class="text-nowrap"><?= date('d/m/Y', strtotime($b['tanggal'])) ?></td>
                                            <td>
                                                <?php if ($b['status'] === 'publish'): ?>
                                                    <span class="badge bg-success">Publish</span>
                                                <?php elseif ($b['status'] === 'draft'): ?>
                                                    <span class="badge bg-warning text-dark">Draft</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Arsip</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendaftaran Terbaru -->
        <div class="col-lg-6">
            <div class="card-custom h-100">
                <div class="card-header-custom d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0" style="color: var(--color-dark-purple);">
                        <i class="fa-solid fa-user-plus me-2"></i>Pendaftaran Terbaru
                    </h5>
                    <a href="pendaftaran.php" class="btn btn-sm btn-outline-custom">Lihat Semua</a>
                </div>
                <div class="card-body-custom p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($pendaftaranTerbaru)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">Belum ada pendaftaran</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($pendaftaranTerbaru as $p): ?>
                                        <tr>
                                            <td class="fw-semibold"><?= htmlspecialchars($p['nama_lengkap']) ?></td>
                                            <td><?= htmlspecialchars($p['kelas'] ?: '-') ?></td>
                                            <td>
                                                <?php if ($p['status'] === 'baru'): ?>
                                                    <span class="badge bg-warning text-dark">Baru</span>
                                                <?php elseif ($p['status'] === 'diproses'): ?>
                                                    <span class="badge bg-info text-dark">Diproses</span>
                                                <?php elseif ($p['status'] === 'diterima'): ?>
                                                    <span class="badge bg-success">Diterima</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Ditolak</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-nowrap text-muted small"><?= date('d/m/Y H:i', strtotime($p['created_at'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
