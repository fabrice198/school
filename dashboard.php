<?php
require_once __DIR__ . '/includes/auth.php';
require_login();
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Dashboard | SchoolLearn</title><link rel="stylesheet" href="assets/css/style.css"><link rel="stylesheet" href="assets/css/auth.css"></head>
<body class="auth-page">
<header class="navbar"><a href="index.php" class="logo"><span class="logo-icon">S</span>SchoolLearn</a><div class="nav-actions"><span class="welcome-name">Hello, <?= e($user['full_name']) ?></span><a href="logout.php" class="register-btn">Logout</a></div></header>
<main class="dashboard-wrap">
    <span class="eyebrow">YOUR LEARNING SPACE</span>
    <h1>Welcome, <?= e($user['full_name']) ?>!</h1>
    <p class="auth-subtitle">You are signed in to your SchoolLearn account.</p>
    <div class="dashboard-grid">
        <article class="dashboard-tile"><div class="feature-icon blue">📚</div><h2>Learning Materials</h2><p>Your notes and learning resources will appear here.</p><span class="coming-soon">Coming next</span></article>
        <article class="dashboard-tile"><div class="feature-icon green">📝</div><h2>Assessments</h2><p>Online quizzes, tests, and exams will be available here.</p><span class="coming-soon">Coming next</span></article>
        <article class="dashboard-tile"><div class="feature-icon orange">📂</div><h2>Assignments</h2><p>View tasks and submit your schoolwork here.</p><span class="coming-soon">Coming next</span></article>
        <article class="dashboard-tile"><div class="feature-icon purple">📈</div><h2>Grades &amp; Feedback</h2><p>Check your results and teacher feedback here.</p><span class="coming-soon">Coming next</span></article>
    </div>
    <p class="role-note">Account role: <strong><?= e(ucfirst($user['role'])) ?></strong></p>
</main>
</body></html>