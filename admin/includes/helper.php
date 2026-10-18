<?php
/**
 * Helper upload gambar untuk admin
 * Mengembalikan nama file hasil upload, atau null jika gagal.
 */
function uploadGambar(array $file, string $subfolder = 'berita'): ?string
{
    if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
    $maxSize    = 2 * 1024 * 1024; // 2MB

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt, true)) {
        return null;
    }
    if ($file['size'] > $maxSize) {
        return null;
    }

    $uploadDir = __DIR__ . '/../../uploads/' . $subfolder . '/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $filename = uniqid('img_', true) . '.' . $ext;
    $dest     = $uploadDir . $filename;

    if (move_uploaded_file($file['tmp_name'], $dest)) {
        return 'uploads/' . $subfolder . '/' . $filename;
    }
    return null;
}

/**
 * Hapus file gambar berdasarkan path relatif terhadap root project.
 */
function hapusGambar(?string $relPath): void
{
    if (!$relPath) {
        return;
    }
    $abs = __DIR__ . '/../../' . ltrim($relPath, '/');
    if (file_exists($abs)) {
        @unlink($abs);
    }
}

/**
 * Generate slug dari judul.
 */
function slugify(string $text): string
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

/**
 * Format tanggal Indonesia.
 */
function tanggalIndo(string $date): string
{
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    $ts = strtotime($date);
    return date('d', $ts) . ' ' . $bulan[(int)date('m', $ts)] . ' ' . date('Y', $ts);
}
