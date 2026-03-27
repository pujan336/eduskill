<?php
if (!isset($ROOT)) {
    require_once __DIR__ . '/paths.php';
}
$nav = $nav_active ?? '';
?>
<header class="site-header">
    <div class="nav-inner">
        <a class="site-logo" href="<?php echo htmlspecialchars($ROOT); ?>index.php">
            <img src="<?php echo htmlspecialchars($ROOT); ?>image/211.png" alt="EduSkill">
            <span class="visually-hidden">EduSkill</span>
        </a>
        <button type="button" class="nav-toggle" data-nav-toggle aria-expanded="false" aria-controls="primary-nav" aria-label="Open menu">
            <span class="nav-toggle-icon" aria-hidden="true"></span>
        </button>
        <nav id="primary-nav" class="nav-menu" data-nav-menu aria-label="Primary">
            <a href="<?php echo htmlspecialchars($ROOT); ?>index.php" <?php echo $nav === 'home' ? 'aria-current="page"' : ''; ?>>Home</a>
            <a href="<?php echo htmlspecialchars($ROOT); ?>Pages/courses.php" <?php echo $nav === 'courses' ? 'aria-current="page"' : ''; ?>>Courses</a>
            <a href="<?php echo htmlspecialchars($ROOT); ?>Pages/about.php" <?php echo $nav === 'about' ? 'aria-current="page"' : ''; ?>>About</a>
            <a href="<?php echo htmlspecialchars($ROOT); ?>Pages/contact.php" <?php echo $nav === 'contact' ? 'aria-current="page"' : ''; ?>>Contact</a>
            <a href="<?php echo htmlspecialchars($ROOT); ?>Pages/faq.php" <?php echo $nav === 'faq' ? 'aria-current="page"' : ''; ?>>FAQ</a>
            <div class="nav-actions">
                <a class="btn btn-ghost" href="<?php echo htmlspecialchars($ROOT); ?>courses-provisers/provider-login.php">Teach</a>
                <a class="btn btn-primary" href="<?php echo htmlspecialchars($ROOT); ?>registration-system/login.php">Log in</a>
                <a class="btn btn-secondary" href="<?php echo htmlspecialchars($ROOT); ?>registration-system/register.php">Sign up</a>
            </div>
        </nav>
    </div>
</header>
