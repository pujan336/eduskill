<?php
$pageTitle = 'FAQ';
$nav_active = 'faq';

require_once __DIR__ . '/../Components/page-start.php';
require_once __DIR__ . '/../Components/navbar.php';
?>

<main class="page-main container">
    <header class="page-hero">
        <h1>Frequently asked questions</h1>
        <p class="page-lead">Quick answers about accounts, billing, and how EduSkill is structured.</p>
    </header>

    <div class="faq-list" style="max-width:720px;">
        <details>
            <summary>Is enrollment instant?</summary>
            <p>Yes. When you click enroll on the demo catalog, we confirm your selection on the spot. A full LMS would also add you to modules and email a receipt.</p>
        </details>
        <details>
            <summary>Do free courses include certificates?</summary>
            <p>Certificates depend on the individual course. Look for the “certificate included” note inside the course overview once it is connected to your dashboard.</p>
        </details>
        <details>
            <summary>How do I become an instructor?</summary>
            <p>Use the Teach link in the header to reach the provider portal. You will need an approved provider account before courses appear publicly.</p>
        </details>
        <details>
            <summary>Who do I contact for billing help?</summary>
            <p>Email <a href="mailto:info@eduskill.com">info@eduskill.com</a> or use the contact form. Include the email on your account and the course name.</p>
        </details>
    </div>
</main>

<?php require_once __DIR__ . '/../Components/page-end.php'; ?>
