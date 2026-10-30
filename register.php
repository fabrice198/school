<?php
require_once __DIR__ . '/includes/auth.php';
if (is_logged_in()) { header('Location: dashboard.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim($_POST['full_name'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (mb_strlen($name) < 2) {
        $error = 'Enter your full name.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Enter a valid email address.';
    } elseif (strlen($password) < 8) {
        $error = 'Your password must contain at least 8 characters.';
    } elseif ($password !== $confirm) {
        $error = 'The passwords do not match.';
    } else {
        $check = $pdo->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
        $check->execute([$email]);
        if ($check->fetch()) {
            $error = 'An account with this email already exists.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare('INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)');
            $insert->execute([$name, $email, $hash, 'student']);
            session_regenerate_id(true);
            $_SESSION['user'] = [
                'id' => (int)$pdo->lastInsertId(),
                'full_name' => $name,
                'email' => $email,
                'role' => 'student'
            ];
            header('Location: dashboard.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Create account | SchoolLearn</title><link rel="stylesheet" href="assets/css/style.css"><link rel="stylesheet" href="assets/css/auth.css"></head>
<body class="auth-page">
<header class="navbar"><a href="index.php" class="logo"><span class="logo-icon">S</span>SchoolLearn</a><a href="login.php" class="login-btn">Login</a></header>
<main class="auth-wrap"><section class="auth-card">
    <span class="eyebrow">GET STARTED</span><h1>Create your account</h1><p class="auth-subtitle">Join your school's online learning platform.</p>
    <?php if ($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?>
    <form method="post" action="register.php">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <label for="full_name">Full name</label><input id="full_name" name="full_name" type="text" autocomplete="name" required maxlength="120" value="<?= e($_POST['full_name'] ?? '') ?>">
        <label for="email">Email address</label><input id="email" name="email" type="email" autocomplete="email" required value="<?= e($_POST['email'] ?? '') ?>">
        <label for="password">Password <small>(at least 8 characters)</small></label><input id="password" name="password" type="password" autocomplete="new-password" minlength="8" required>
        <label for="confirm_password">Confirm password</label><input id="confirm_password" name="confirm_password" type="password" autocomplete="new-password" minlength="8" required>
        <button class="primary-btn auth-submit" type="submit">Create account</button>
    </form>
    <p class="auth-switch">Already registered? <a href="login.php">Login here</a></p>
    <p class="back-home"><a href="index.php">← Back to homepage</a></p>
</section></main>
</body></html>