<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$adminId = $_SESSION['admin_id'] ?? null;
$adminNama = $_SESSION['admin_nama'] ?? 'Administrator';
$adminRole = $_SESSION['admin_role'] ?? 'editor';

require_once __DIR__ . '/../../config/database.php';
