<?php
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/helper.php';

// ===================== HAPUS =====================
if (isset($_GET['hapus']) && is_numeric($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    $stmt = $pdo->prepare("SELECT gambar FROM berita WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if ($row) {
        hapusGambar($row['gambar']);
        $pdo->prepare("DELETE FROM berita WHERE id = ?")->execute([$id]);
    }
    header('Location: berita.php?pesan=hapus');
    exit;
}

// ===================== AMBIL DATA =====================
$filterStatus = $_GET['status'] ?? 'semua';
$q            = trim($_GET['q'] ?? '');

$sql    = "SELECT * FROM berita WHERE 1=1";
$params = [];

if ($filterStatus !== 'semua') {
    $sql .= " AND status = ?";
    $params[] = $filterStatus;
}
if ($q !== '') {
    $sql .= " AND (judul LIKE ? OR kategori LIKE ? OR ringkasan LIKE ?)";
    $like = "%$q%";
    array_push($params, $like, $like, $like);
}

$sql .= " ORDER BY tanggal DESC, id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$beritaList = $stmt->fetchAll();

$pesan = $_GET['pesan'] ?? '';
?>

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="page-title">Berita & Kegiatan</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                    <li class="breadcrumb-item active">Berita & Kegiatan</li>
                </ol>
            </nav>
        </div>
        <a href="berita_tambah.php" class="btn btn-primary-custom">
            <i class="fa-solid fa-plus me-2"></i>Tambah Berita
        </a>
    </div>

    <!-- Alert -->
    <?php if ($pesan === 'tambah'): ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>
            <div>Berita baru berhasil ditambahkan.</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php elseif ($pesan === 'edit'): ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>
            <div>Berita berhasil diperbarui.</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php elseif ($pesan === 'hapus'): ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
            <i class="fa-solid fa-trash me-2"></i>
            <div>Berita berhasil dihapus.</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Filter & Search -->
    <div class="card-custom mb-4">
        <div class="card-body-custom">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Cari</label>
                    <input type="text" name="q" class="form-control" placeholder="Judul, kategori, ringkasan..."
                        value="<?= htmlspecialchars($q) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold small">Status</label>
                    <select name="status" class="form-select">
                        <option value="semua" <?= $filterStatus === 'semua' ? 'selected' : '' ?>>Semua Status</option>
                        <option value="publish" <?= $filterStatus === 'publish' ? 'selected' : '' ?>>Publish</option>
                        <option value="draft" <?= $filterStatus === 'draft' ? 'selected' : '' ?>>Draft</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary-custom w-100">
                        <i class="fa-solid fa-filter me-2"></i>Filter
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="berita.php" class="btn btn-outline-custom w-100">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Berita -->
    <div class="card-custom">
        <div class="card-body-custom p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th style="width:70px;">Gambar</th>
                            <th>Judul</th>
                            <th style="width:140px;">Kategori</th>
                            <th style="width:120px;">Tanggal</th>
                            <th style="width:90px;">Status</th>
                            <th style="width:140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($beritaList)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    <i class="fa-solid fa-newspaper fa-2x mb-2 d-block opacity-25"></i>
                                    Belum ada berita<?= $q !== '' || $filterStatus !== 'semua' ? ' yang sesuai filter' : '' ?>.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($beritaList as $b): ?>
                                <tr>
                                    <td>
                                        <?php if ($b['gambar']): ?>
                                            <img src="../<?= htmlspecialchars($b['gambar']) ?>" alt=""
                                                class="rounded" style="width:56px;height:42px;object-fit:cover;">
                                        <?php else: ?>
                                            <div class="rounded d-flex align-items-center justify-center"
                                                style="width:56px;height:42px;background:#F1F3F5;">
                                                <i class="fa-solid fa-image text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="fw-semibold"><?= htmlspecialchars($b['judul']) ?></div>
                                        <small class="text-muted"><?= htmlspecialchars($b['slug'] ?: '-') ?></small>
                                    </td>
                                    <td><span class="badge bg-info text-dark"><?= htmlspecialchars($b['kategori']) ?></span></td>
                                    <td class="text-nowrap small"><?= tanggalIndo($b['tanggal']) ?></td>
                                    <td>
                                        <?php if ($b['status'] === 'publish'): ?>
                                            <span class="badge bg-success">Publish</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">Draft</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="berita_edit.php?id=<?= $b['id'] ?>" class="btn btn-sm btn-outline-custom"
                                                title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                onclick="konfirmasiHapus(<?= $b['id'] ?>, '<?= htmlspecialchars(addslashes($b['judul']), ENT_QUOTES) ?>')"
                                                title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function konfirmasiHapus(id, judul) {
            Swal.fire({
                title: 'Hapus Berita?',
                html: 'Berita <strong>' + judul + '</strong> akan dihapus permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'berita.php?hapus=' + id;
                }
            });
        }
    </script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
