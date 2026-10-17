<?php
/**
 * Koneksi Database Website Pramuka SKAGARA
 * Laragon + MySQL/MariaDB
 */

$host = '127.0.0.1';
$port = '3306';
$db   = 'pramuka_skagara';
$user = 'root';
$pass = '';

$dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die(
        '<div style="font-family:Arial;padding:30px;color:#842029;background:#f8d7da;">
            <h3>Koneksi Database Gagal</h3>
            <p>' . htmlspecialchars($e->getMessage()) . '</p>
        </div>'
    );
}
