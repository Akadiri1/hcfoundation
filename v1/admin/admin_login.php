<?php
ob_start();

$error = '';
$rd = $_GET['rd'] ?? '/admin';

if (array_key_exists('submit', $_POST)) {
    $email = trim($_POST['email'] ?? '');
    $pword = trim($_POST['pword'] ?? '');

    if (empty($email) || empty($pword)) {
        $error = 'Please enter both email/username and password.';
    } else {
        // Check admin table by email or username
        $stmt = $conn->prepare("SELECT * FROM admin WHERE input_email = :e OR input_username = :u LIMIT 1");
        $stmt->execute([':e' => $email, ':u' => $email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($pword, $admin['input_password'])) {
            if ((int)$admin['user_status'] === 2) {
                $error = 'Your admin account has been suspended.';
            } else {
                $_SESSION['admin_id'] = $admin['hash_id'];
                $_SESSION['admin_username'] = $admin['input_username'];
                $_SESSION['admin_level'] = $admin['level'];
                header("Location: " . $rd);
                exit();
            }
        } else {
            $error = 'Invalid admin credentials.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login — Hathany Cosmos Foundation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="/assets/images/favicon.png" type="image/png">
    <link rel="stylesheet" href="/da/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/da/assets/plugins/animation/css/animate.min.css">
    <link rel="stylesheet" href="/da/assets/css/style.css">
    <style>
        body {
            background: linear-gradient(135deg, #0d3b4c 0%, #1c7c9c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .auth-wrapper {
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }
        .auth-card {
            background: #ffffff;
            border-radius: 1.25rem;
            padding: 2.5rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
        .brand-logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .brand-logo img {
            max-height: 56px;
            width: auto;
        }
        .auth-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: #1e293b;
            text-align: center;
            margin-bottom: 0.5rem;
        }
        .auth-subtitle {
            font-size: 0.875rem;
            color: #64748b;
            text-align: center;
            margin-bottom: 2rem;
        }
        .btn-admc {
            background: #1c7c9c;
            color: #ffffff;
            border: none;
            padding: 0.85rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            width: 100%;
            transition: background 0.2s ease;
        }
        .btn-admc:hover {
            background: #155e77;
            color: #ffffff;
        }
        .form-control {
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            border: 1px solid #cbd5e1;
        }
        .form-control:focus {
            border-color: #1c7c9c;
            box-shadow: 0 0 0 3px rgba(28, 124, 156, 0.15);
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="brand-logo">
                <img src="/assets/images/logo.png" alt="HC Foundation" onerror="this.src='/logo.png'">
            </div>
            <h1 class="auth-title">Admin Console</h1>
            <p class="auth-subtitle">Sign in to manage the Hathany Cosmos Foundation website</p>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" role="alert" style="border-radius: 0.75rem; font-size: 0.875rem;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="" method="post">
                <div class="form-group mb-3">
                    <label class="form-label text-muted small font-weight-bold">EMAIL OR USERNAME</label>
                    <input type="text" name="email" class="form-control" placeholder="admin@hcfoundations.com" required autofocus>
                </div>
                <div class="form-group mb-4">
                    <label class="form-label text-muted small font-weight-bold">PASSWORD</label>
                    <input type="password" name="pword" class="form-control" placeholder="••••••••••••" required>
                </div>
                <button type="submit" name="submit" class="btn btn-admc">Sign In to Dashboard</button>
            </form>

            <div class="text-center mt-4">
                <a href="/home" class="text-muted small">&larr; Back to Public Website</a>
            </div>
        </div>
    </div>
</body>
</html>
