<?php
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/helper.php';

$id   = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM berita WHERE id = ?");
$stmt->execute([$id]);
$berita = $stmt->fetch();

if (!$berita) {
    header('Location: berita.php');
    exit;
}

$errors = [];
$old    = [
    'judul'     => $berita['judul'],
    'kategori'  => $berita['kategori'],
    'tanggal'   => $berita['tanggal'],
    'ringkasan' => $berita['ringkasan'] ?? '',
    'isi'       => $berita['isi'] ?? '',
    'status'    => $berita['status'] ?? 'draft',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old['judul']     = trim($_POST['judul'] ?? '');
    $old['kategori']  = trim($_POST['kategori'] ?? '');
    $old['tanggal']   = trim($_POST['tanggal'] ?? '');
    $old['ringkasan'] = trim($_POST['ringkasan'] ?? '');
    $old['isi']       = trim($_POST['isi'] ?? '');
    $old['status']    = in_array($_POST['status'] ?? '', ['draft', 'publish'], true) ? $_POST['status'] : 'draft';

    if ($old['judul'] === '')    $errors[] = 'Judul wajib diisi.';
    if ($old['kategori'] === '') $errors[] = 'Kategori wajib diisi.';
    if ($old['tanggal'] === '')  $errors[] = 'Tanggal wajib diisi.';

    $gambarPath = $berita['gambar'];

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
        $newGambar = uploadGambar($_FILES['gambar'], 'berita');
        if ($newGambar === null) {
            $errors[] = 'Gagal upload gambar. Pastikan format JPG/PNG/WEBP dan ukuran maks 2MB.';
        } else {
            hapusGambar($berita['gambar']);
            $gambarPath = $newGambar;
        }
    }

    if (isset($_POST['hapus_gambar']) && $_POST['hapus_gambar'] === '1') {
        hapusGambar($berita['gambar']);
        $gambarPath = null;
    }

    if (empty($errors)) {
        $slug = slugify($old['judul']);
        $stmt = $pdo->prepare("UPDATE berita SET judul=?, kategori=?, tanggal=?, gambar=?, ringkasan=?, isi=?, slug=?, status=?, updated_at=NOW() WHERE id=?");
        $stmt->execute([
            $old['judul'], $old['kategori'], $old['tanggal'], $gambarPath,
            $old['ringkasan'], $old['isi'], $slug, $old['status'], $id
        ]);
        header('Location: berita.php?pesan=edit');
        exit;
    }
}

$kategoriRows = $pdo->query("SELECT DISTINCT kategori FROM berita ORDER BY kategori")->fetchAll(PDO::FETCH_COLUMN);
?>

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="page-title">Edit Berita</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                    <li class="breadcrumb-item"><a href="berita.php">Berita & Kegiatan</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
        <a href="berita.php" class="btn btn-outline-custom">
            <i class="fa-solid fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <!-- Errors -->
    <?php if ($errors): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <strong><i class="fa-solid fa-circle-exclamation me-2"></i>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-1">
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="row g-4">
            <!-- Kolom Utama -->
            <div class="col-lg-8">
                <div class="card-custom">
                    <div class="card-header-custom">
                        <h5 class="fw-bold mb-0" style="color: var(--color-dark-purple);">
                            <i class="fa-solid fa-pen-nib me-2"></i>Isi Berita
                        </h5>
                    </div>
                    <div class="card-body-custom">
                        <div class="mb-3">
                            <label for="judul" class="form-label fw-semibold">Judul Berita <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="judul" name="judul"
                                value="<?= htmlspecialchars($old['judul']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="ringkasan" class="form-label fw-semibold">Ringkasan</label>
                            <textarea class="form-control" id="ringkasan" name="ringkasan" rows="3"
                                placeholder="Ringkasan singkat berita (opsional)"><?= htmlspecialchars($old['ringkasan']) ?></textarea>
                        </div>

                        <div class="mb-0">
                            <label for="isi" class="form-label fw-semibold">Isi Berita</label>
                            <textarea class="ckeditor form-control" id="isi" name="isi"
                                placeholder="Tulis isi berita lengkap di sini..."><?= htmlspecialchars($old['isi']) ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Sidebar -->
            <div class="col-lg-4">
                <div class="card-custom mb-4">
                    <div class="card-header-custom">
                        <h5 class="fw-bold mb-0" style="color: var(--color-dark-purple);">
                            <i class="fa-solid fa-cogs me-2"></i>Pengaturan
                        </h5>
                    </div>
                    <div class="card-body-custom">
                        <div class="mb-3">
                            <label for="kategori" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kategori" name="kategori" list="kategori-list"
                                value="<?= htmlspecialchars($old['kategori']) ?>" placeholder="Pilih atau ketik kategori" required>
                            <datalist id="kategori-list">
                                <?php foreach ($kategoriRows as $kat): ?>
                                    <option value="<?= htmlspecialchars($kat) ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="<?= htmlspecialchars($old['tanggal']) ?>" required>
                        </div>

                        <div class="mb-0">
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="draft" <?= $old['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
                                <option value="publish" <?= $old['status'] === 'publish' ? 'selected' : '' ?>>Publish</option>
                            </select>
                            <small class="text-muted d-block mt-1">
                                <i class="fa-solid fa-info-circle me-1"></i>Draft hanya terlihat di admin, Publish tampil di website.
                            </small>
                        </div>
                    </div>
                </div>

                <div class="card-custom mb-4">
                    <div class="card-header-custom">
                        <h5 class="fw-bold mb-0" style="color: var(--color-dark-purple);">
                            <i class="fa-solid fa-image me-2"></i>Gambar Sampul
                        </h5>
                    </div>
                    <div class="card-body-custom">
                        <?php if ($old['gambar'] ?? $berita['gambar']): ?>
                            <div class="text-center mb-3">
                                <img src="../<?= htmlspecialchars($berita['gambar']) ?>" alt="Gambar saat ini"
                                    class="img-fluid rounded" style="max-height:180px;">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="hapus_gambar" name="hapus_gambar" value="1">
                                    <label class="form-check-label text-danger small" for="hapus_gambar">
                                        <i class="fa-solid fa-trash me-1"></i>Hapus gambar saat ini
                                    </label>
                                </div>
                            </div>
                        <?php endif; ?>

                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                        <small class="text-muted d-block mt-2">
                            <i class="fa-solid fa-info-circle me-1"></i>Format: JPG, PNG, WEBP. Maks 2MB.
                            Kosongkan jika tidak ingin mengubah gambar.
                        </small>
                        <div class="mt-3 text-center" id="preview-wrap" style="display:none;">
                            <img id="preview-img" src="" alt="Preview" class="img-fluid rounded" style="max-height:180px;">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary-custom w-100 mb-2">
                    <i class="fa-solid fa-save me-2"></i>Simpan Perubahan
                </button>
                <a href="berita.php" class="btn btn-outline-custom w-100">Batal</a>
            </div>
        </div>
    </form>

    <script>
        document.getElementById('gambar').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (ev) {
                    document.getElementById('preview-img').src = ev.target.result;
                    document.getElementById('preview-wrap').style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('preview-wrap').style.display = 'none';
            }
        });
    </script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
