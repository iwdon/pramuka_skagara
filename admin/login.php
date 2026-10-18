<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$error = '';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Username dan password wajib diisi.';
    } else {
        $stmt = $pdo->prepare("SELECT id, nama, username, password, role, status FROM users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && $user['status'] === 'aktif') {
            $isValid = password_verify($password, $user['password']);
            if (!$isValid && $user['password'] === $password) {
                $isValid = true;
            }

            if ($isValid) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_nama'] = $user['nama'];
                $_SESSION['admin_username'] = $user['username'];
                $_SESSION['admin_role'] = $user['role'];

                try {
                    $update = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
                    $update->execute([$user['id']]);
                } catch (Exception $e) {
                    // ignore
                }

                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'Password salah.';
            }
        } else {
            $error = 'Username tidak ditemukan atau akun nonaktif.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Pramuka SKAGARA</title>
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
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, var(--color-dark-purple), var(--color-navy-purple));
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
        }

        .login-header {
            background: linear-gradient(rgba(78, 31, 110, 0.95), rgba(62, 62, 117, 0.98)),
                url('https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=1600&auto=format&fit=crop') center/cover;
            color: #FFFFFF;
            padding: 40px 30px 30px;
            text-align: center;
        }

        .login-body {
            padding: 40px 30px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 16px;
            border: 2px solid #E9ECEF;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--color-teal);
            box-shadow: 0 0 0 0.2rem rgba(69, 169, 169, 0.15);
        }

        .btn-login {
            background-color: var(--color-teal);
            border: none;
            color: #FFFFFF;
            font-weight: 700;
            padding: 12px;
            border-radius: 12px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(69, 169, 169, 0.4);
        }

        .btn-login:hover {
            background-color: #358d8d;
            color: #FFFFFF;
            transform: translateY(-2px);
        }

        .logo-badge {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .alert {
            border-radius: 12px;
            border: none;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-header">
            <div class="logo-badge">
                <i class="fa-solid fa-compass fs-2"></i>
            </div>
            <h4 class="fw-bold mb-1">Admin Panel</h4>
            <p class="mb-0 small opacity-90">Pramuka SKAGARA Gudep 05.127 - 05.128</p>
        </div>
        <div class="login-body">
            <?php if ($error): ?>
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    <div><?= htmlspecialchars($error) ?></div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form method="POST" autocomplete="off">
                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fa-solid fa-user text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 ps-0" id="username" name="username"
                            placeholder="Masukkan username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fa-solid fa-lock text-muted"></i>
                        </span>
                        <input type="password" class="form-control border-start-0 ps-0" id="password" name="password"
                            placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fa-solid fa-right-to-bracket me-2"></i>Masuk ke Dashboard
                </button>
            </form>

            <div class="text-center mt-4">
                <small class="text-muted">Default: <strong>admin</strong> / <strong>admin123</strong></small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
