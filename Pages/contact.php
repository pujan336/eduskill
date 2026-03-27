<?php
session_start();

$pageTitle = 'Contact';
$nav_active = 'contact';
$sent = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['contact_flash'] = true;
    header('Location: contact.php?sent=1');
    exit;
}

if (isset($_GET['sent']) && isset($_SESSION['contact_flash'])) {
    $sent = true;
    unset($_SESSION['contact_flash']);
}

require_once __DIR__ . '/../Components/page-start.php';
require_once __DIR__ . '/../Components/navbar.php';
?>

<main class="page-main container">
    <header class="page-hero">
        <h1>Contact</h1>
        <p class="page-lead">Questions about a course, partnerships, or technical support? Send a note and we will respond as soon as we can.</p>
    </header>

    <?php if ($sent) : ?>
        <p class="flash flash-success" role="status">Thanks—your message has been recorded for this demo. In production you would wire this form to email or a ticketing system.</p>
    <?php endif; ?>

    <div class="prose-card">
        <form class="form-stack" method="post" action="">
            <div class="two-col">
                <div>
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" autocomplete="name" required placeholder="Your name">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required placeholder="you@example.com">
                </div>
            </div>
            <label for="topic">Topic</label>
            <input id="topic" name="topic" type="text" placeholder="e.g. Billing, course access, partnership">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="6" required placeholder="How can we help?"></textarea>
            <button type="submit" class="btn btn-primary" style="width:auto;">Send message</button>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../Components/page-end.php'; ?>
