<?php
$pageTitle = 'Courses';
$nav_active = 'courses';
$course_list = require __DIR__ . '/../Components/catalog-data.php';

require_once __DIR__ . '/../Components/page-start.php';
require_once __DIR__ . '/../Components/navbar.php';
?>

<main class="page-main container">
    <header class="page-hero">
        <h1>Course catalog</h1>
        <p class="page-lead">Browse every public offering, compare pricing, and enroll when you find the right fit. Paid courses unlock extra projects and mentor Q&amp;A on this demo site.</p>
    </header>

    <section class="section" style="padding-top:0;" aria-labelledby="all-courses-heading">
        <h2 class="visually-hidden" id="all-courses-heading">All courses</h2>
        <div class="course-scroll">
            <?php require __DIR__ . '/../Components/course-grid.php'; ?>
        </div>
    </section>

    <section class="prose-card" style="max-width:100%; margin-top:2rem;">
        <h2>For organizations</h2>
        <p>Need a tailored cohort or private reporting? Email us from the contact page and we will outline options for teams.</p>
    </section>
</main>

<?php require_once __DIR__ . '/../Components/page-end.php'; ?>
