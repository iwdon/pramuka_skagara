<?php
require_once __DIR__ . '/config/database.php';

echo '<h2>Koneksi database berhasil!</h2>';
echo '<p>Database: <strong>pramuka_skagara</strong></p>';

$stmt = $pdo->query("SELECT COUNT(*) AS jumlah FROM prestasi");
$data = $stmt->fetch();

echo '<p>Jumlah data prestasi: <strong>' . $data['jumlah'] . '</strong></p>';
