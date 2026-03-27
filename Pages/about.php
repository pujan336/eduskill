<?php
$pageTitle = 'About';
$nav_active = 'about';

require_once __DIR__ . '/../Components/page-start.php';
require_once __DIR__ . '/../Components/navbar.php';
?>

<main class="page-main container">
    <header class="page-hero">
        <h1>About EduSkill</h1>
        <p class="page-lead">We are building a straightforward learning platform where quality matters more than hype—clear lessons, honest pricing, and room to grow.</p>
    </header>

    <div class="prose-card" style="max-width:100%;">
        <h2>Our mission</h2>
        <p>Help busy people build durable skills through structured courses, practice, and feedback—without sacrificing depth for speed.</p>

        <h2>What you can do here</h2>
        <ul>
            <li>Enroll in free or paid tracks and track progress in your dashboard</li>
            <li>Learn from curated paths instead of random video playlists</li>
            <li>Connect with instructors through the provider portal when courses include live elements</li>
        </ul>

        <h2>For course providers</h2>
        <p>If you teach professionally, use the <a href="<?php echo htmlspecialchars($ROOT); ?>courses-provisers/provider-login.php">provider portal</a> to manage offerings. Administrators review new submissions before they appear in the catalog.</p>

        <p style="margin-top:1.5rem;"><a class="btn btn-primary" href="<?php echo htmlspecialchars($ROOT); ?>Pages/contact.php">Talk to us</a></p>
    </div>
</main>

<?php require_once __DIR__ . '/../Components/page-end.php'; ?>
