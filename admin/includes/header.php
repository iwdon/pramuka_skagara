<?php
require_once __DIR__ . '/auth.php';
ob_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pramuka SKAGARA</title>
    <link rel="icon" type="image/png" href="https://placehold.co/60x60/4E1F6E/FFF?text=SKG">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <style>
        :root {
            --color-dark-purple: #4E1F6E;
            --color-navy-purple: #3E3E75;
            --color-teal: #45A9A9;
            --color-mint-light: #98E8DE;
            --color-bg-light: #F5F8F8;
            --color-text-main: #2B2B2B;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-bg-light);
            color: var(--color-text-main);
            overflow-x: hidden;
        }

        .topbar {
            background: #FFFFFF;
            height: 70px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width);
            z-index: 1030;
            transition: all 0.3s ease;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, var(--color-dark-purple) 0%, var(--color-navy-purple) 100%);
            color: #FFFFFF;
            overflow-y: auto;
            z-index: 1040;
            transition: all 0.3s ease;
            box-shadow: 4px 0 20px rgba(78, 31, 110, 0.15);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar-brand h5 {
            font-weight: 800;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
        }

        .sidebar-brand small {
            opacity: 0.8;
            font-size: 0.75rem;
        }

        .sidebar-nav {
            padding: 20px 12px;
        }

        .nav-section-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.5);
            padding: 0 16px;
            margin-bottom: 8px;
            margin-top: 16px;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 11px 16px;
            border-radius: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 4px;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: var(--color-dark-purple);
            background-color: var(--color-mint-light);
        }

        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: 70px;
            padding: 32px 24px;
            min-height: calc(100vh - 70px);
            transition: all 0.3s ease;
        }

        .page-title {
            font-weight: 800;
            color: var(--color-dark-purple);
            margin-bottom: 8px;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 0;
        }

        .breadcrumb-item a {
            color: var(--color-teal);
            text-decoration: none;
            font-weight: 600;
        }

        .card-stat {
            background: #FFFFFF;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(62, 62, 117, 0.08);
            border-left: 4px solid var(--color-teal);
            transition: all 0.3s ease;
            height: 100%;
        }

        .card-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 28px rgba(62, 62, 117, 0.12);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            background: rgba(152, 232, 222, 0.25);
            color: var(--color-dark-purple);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--color-dark-purple);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            color: #6C757D;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .card-custom {
            background: #FFFFFF;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(62, 62, 117, 0.08);
            border: none;
        }

        .card-header-custom {
            background: transparent;
            border-bottom: 1px solid #F1F3F5;
            padding: 20px 24px 16px;
        }

        .card-body-custom {
            padding: 20px 24px 24px;
        }

        .btn-primary-custom {
            background-color: var(--color-teal);
            border: none;
            color: #FFFFFF;
            font-weight: 700;
            padding: 9px 20px;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .btn-primary-custom:hover {
            background-color: #358d8d;
            color: #FFFFFF;
            transform: translateY(-1px);
        }

        .btn-outline-custom {
            border: 2px solid var(--color-navy-purple);
            color: var(--color-navy-purple);
            font-weight: 600;
            border-radius: 10px;
        }

        .btn-outline-custom:hover {
            background-color: var(--color-navy-purple);
            color: #FFFFFF;
        }

        .table thead th {
            background-color: #F8F9FA;
            font-weight: 700;
            color: #495057;
            border-bottom: 2px solid #E9ECEF;
            padding: 14px 16px;
            font-size: 0.9rem;
        }

        .table tbody td {
            padding: 14px 16px;
            vertical-align: middle;
        }

        .badge {
            padding: 6px 10px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--color-teal), var(--color-mint-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-dark-purple);
            font-weight: 700;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .topbar,
            .main-content {
                left: 0;
            }

            .main-content {
                padding: 24px 16px;
            }
        }
    </style>
</head>

<body>
    <?php require_once __DIR__ . '/sidebar.php'; ?>

    <!-- Topbar -->
    <nav class="topbar d-flex align-items-center justify-content-between px-4">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-light d-lg-none" id="sidebarToggle">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div>
                <h6 class="mb-0 fw-bold">Dashboard Admin</h6>
                <small class="text-muted">Pramuka SKAGARA Gudep 05.127 - 05.128</small>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            <a href="../index.php" target="_blank" class="btn btn-outline-custom btn-sm d-none d-md-flex align-items-center gap-2">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                Lihat Website
            </a>

            <div class="dropdown">
                <a class="d-flex align-items-center gap-2 text-decoration-none dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    <div class="avatar">
                        <?= strtoupper(substr($adminNama, 0, 1)) ?>
                    </div>
                    <div class="d-none d-md-block text-start">
                        <div class="fw-semibold small"><?= htmlspecialchars($adminNama) ?></div>
                        <div class="text-muted" style="font-size: 0.75rem;"><?= htmlspecialchars($adminRole) ?></div>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <h6 class="dropdown-header">Halo, <?= htmlspecialchars($adminNama) ?></h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php" onclick="return confirm('Yakin ingin logout?')">
                            <i class="fa-solid fa-right-from-bracket me-2 text-danger"></i>Logout
                        </a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
