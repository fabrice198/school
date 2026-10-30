<?php
require_once __DIR__ . '/includes/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SchoolLearn | Learning Platform</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="navbar">
    <a href="index.php" class="logo"><span class="logo-icon">S</span>SchoolLearn</a>
    <nav><a href="#home">Home</a><a href="#features">Features</a><a href="#about">About</a></nav>
    <div class="nav-actions">
        <?php if (is_logged_in()): ?>
            <a href="dashboard.php" class="login-btn">Dashboard</a>
            <a href="logout.php" class="register-btn">Logout</a>
        <?php else: ?>
            <a href="login.php" class="login-btn">Login</a>
            <a href="register.php" class="register-btn">Get Started</a>
        <?php endif; ?>
    </div>
</header>
<main>
    <section class="hero" id="home">
        <div class="hero-content">
            <span class="eyebrow">YOUR FUTURE STARTS HERE</span>
            <h1>Learn Better.<br>Achieve <span>More.</span></h1>
            <p>One platform for learning materials, assessments, assignments, grades, and communication between teachers and students.</p>
            <div class="hero-actions">
                <a href="register.php" class="primary-btn">Join the Platform →</a>
                <a href="#about" class="secondary-btn">Learn More</a>
            </div>
            <div class="hero-note"><span>✓</span> Learn anywhere <span>✓</span> Track your progress</div>
        </div>
        <div class="hero-visual">
            <div class="visual-circle"></div>
            <div class="study-card">
                <div class="study-icon">🎓</div>
                <h3>Your learning journey</h3>
                <p>Everything you need, in one place.</p>
                <div class="study-item"><span class="item-icon blue">📚</span><div><strong>Learning Materials</strong><small>Notes and resources</small></div></div>
                <div class="study-item"><span class="item-icon green">📝</span><div><strong>Assessments</strong><small>Tests, quizzes and exams</small></div></div>
                <div class="study-item"><span class="item-icon orange">📊</span><div><strong>Academic Progress</strong><small>Grades and feedback</small></div></div>
                <div class="progress-label"><span>Keep moving forward</span><span>100%</span></div>
                <div class="progress-bar"><div></div></div>
            </div>
            <div class="floating-badge">✨ Learn without limits</div>
        </div>
    </section>
    <section class="features" id="features">
        <div class="section-heading"><span class="eyebrow">OUR PLATFORM</span><h2>Everything for better learning</h2><p>Tools designed to make schoolwork easier and more organized.</p></div>
        <div class="feature-grid">
            <article class="feature-card"><div class="feature-icon blue">📖</div><h3>Learning Materials</h3><p>Access and download notes, PDFs, and study resources.</p></article>
            <article class="feature-card"><div class="feature-icon green">📝</div><h3>Assessments</h3><p>Take quizzes, tests, and exams online.</p></article>
            <article class="feature-card"><div class="feature-icon orange">📂</div><h3>Assignments</h3><p>Submit homework and projects before deadlines.</p></article>
            <article class="feature-card"><div class="feature-icon purple">📈</div><h3>Grades &amp; Feedback</h3><p>Review your marks, teacher comments, and progress.</p></article>
        </div>
    </section>
    <section class="about" id="about"><h2>One school. One connected learning platform.</h2><p>Teachers manage learning activities, students access their schoolwork, and administrators organize the entire platform.</p></section>
</main>
<footer><a href="index.php" class="logo"><span class="logo-icon">S</span>SchoolLearn</a><p>© <?php echo date('Y'); ?> SchoolLearn. All rights reserved.</p></footer>
</body>
</html>