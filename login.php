<?php
require_once __DIR__ . '/includes/auth.php';
if (is_logged_in()) { header('Location: dashboard.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
        $error = 'Enter a valid email address and password.';
    } else {
        $stmt = $pdo->prepare('SELECT id, full_name, email, password, role FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            unset($user['password']);
            $_SESSION['user'] = $user;
            header('Location: dashboard.php');
            exit;
        }
        $error = 'Email or password is incorrect.';
    }
}
$flash = get_flash();
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Login | SchoolLearn</title><link rel="stylesheet" href="assets/css/style.css"><link rel="stylesheet" href="assets/css/auth.css"></head>
<body class="auth-page">
<header class="navbar"><a href="index.php" class="logo"><span class="logo-icon">S</span>SchoolLearn</a><a href="register.php" class="register-btn">Create account</a></header>
<main class="auth-wrap"><section class="auth-card">
    <span class="eyebrow">WELCOME BACK</span><h1>Sign in to SchoolLearn</h1><p class="auth-subtitle">Continue your learning journey.</p>
    <?php if ($flash): ?><div class="notice <?= e($flash['type']) ?>"><?= e($flash['message']) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?>
    <form method="post" action="login.php">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <label for="email">Email address</label><input id="email" name="email" type="email" autocomplete="email" required value="<?= e($_POST['email'] ?? '') ?>">
        <label for="password">Password</label><input id="password" name="password" type="password" autocomplete="current-password" required>
        <button class="primary-btn auth-submit" type="submit">Login</button>
    </form>
    <p class="auth-switch">New to SchoolLearn? <a href="register.php">Create an account</a></p>
    <p class="back-home"><a href="index.php">← Back to homepage</a></p>
</section></main>
</body></html>