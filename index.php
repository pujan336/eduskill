<?php
$enrollMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_name'])) {
    $course = htmlspecialchars((string) $_POST['course_name'], ENT_QUOTES, 'UTF-8');
    $enrollMessage = 'You have successfully enrolled in <strong>' . $course . '</strong>!';
}

$pageTitle = 'Home';
$nav_active = 'home';
$course_list = require __DIR__ . '/Components/catalog-data.php';

require_once __DIR__ . '/Components/page-start.php';
require_once __DIR__ . '/Components/navbar.php';
?>

<main>
    <section class="hero" aria-label="Featured">
        <div class="hero-slides" aria-hidden="true">
            <?php
            $images = glob(__DIR__ . '/image/*.{jpg,jpeg,png}', GLOB_BRACE);
            $first = true;
            foreach ($images as $imgPath) {
                $img = htmlspecialchars($ROOT . 'image/' . basename($imgPath), ENT_QUOTES, 'UTF-8');
                $active = $first ? ' is-active' : '';
                echo '<img src="' . $img . '" alt="" class="hero-slide' . $active . '">';
                $first = false;
            }
            ?>
        </div>
        <div class="hero-inner">
            <span class="hero-badge">Learn at your pace</span>
            <h1>Upgrade your skills with structured, mentor-backed courses</h1>
            <p>Short lessons, hands-on practice, and credentials you can share. Start free or choose a paid track when you are ready to go deeper.</p>
            <div class="hero-cta">
                <a class="btn btn-primary" href="<?php echo htmlspecialchars($ROOT); ?>Pages/courses.php">Browse courses</a>
                <a class="btn btn-ghost" href="<?php echo htmlspecialchars($ROOT); ?>Pages/about.php">Why EduSkill</a>
            </div>
        </div>
    </section>

    <?php if ($enrollMessage !== '') : ?>
        <div class="container">
            <p class="flash flash-success" role="status"><?php echo $enrollMessage; ?></p>
        </div>
    <?php endif; ?>

    <section class="section container" aria-labelledby="cat-heading">
        <div class="section-head">
            <p class="section-kicker" id="cat-heading">Categories</p>
            <h2 class="section-title">Explore by topic</h2>
            <p class="section-desc">Pick a path that matches your goals—each category bundles courses from fundamentals to project work.</p>
        </div>
        <div class="grid-cats">
            <div class="cat-card"><img src="<?php echo htmlspecialchars($ROOT); ?>image/programming_image.jpg" alt=""><span>Programming</span></div>
            <div class="cat-card"><img src="<?php echo htmlspecialchars($ROOT); ?>image/python.jpg" alt=""><span>Design</span></div>
            <div class="cat-card"><img src="<?php echo htmlspecialchars($ROOT); ?>image/python.jpg" alt=""><span>Marketing</span></div>
            <div class="cat-card"><img src="<?php echo htmlspecialchars($ROOT); ?>image/python.jpg" alt=""><span>Business</span></div>
            <div class="cat-card"><img src="<?php echo htmlspecialchars($ROOT); ?>image/programming_image.jpg" alt=""><span>Data</span></div>
            <div class="cat-card"><img src="<?php echo htmlspecialchars($ROOT); ?>image/python.jpg" alt=""><span>Career skills</span></div>
        </div>
    </section>

    <section class="section container" id="courses" aria-labelledby="courses-heading">
        <div class="section-head">
            <p class="section-kicker">Catalog</p>
            <h2 class="section-title" id="courses-heading">Popular courses</h2>
            <p class="section-desc">Enroll in seconds—your spot is confirmed on this demo flow.</p>
        </div>
        <div class="course-scroll">
            <?php require __DIR__ . '/Components/course-grid.php'; ?>
        </div>
    </section>

    <section class="section container" aria-labelledby="tools-heading">
        <div class="section-head">
            <p class="section-kicker">Platform</p>
            <h2 class="section-title" id="tools-heading">Built-in learning tools</h2>
            <p class="section-desc">Everything in one place so you can focus on progress, not logistics.</p>
        </div>
        <div class="grid-tools">
            <div class="tool-card">
                <h3>Interactive quizzes</h3>
                <p>Check understanding after each module with instant feedback.</p>
            </div>
            <div class="tool-card">
                <h3>Certificates</h3>
                <p>Download proof of completion to share with employers or schools.</p>
            </div>
            <div class="tool-card">
                <h3>Student community</h3>
                <p>Ask questions, share projects, and learn alongside peers.</p>
            </div>
        </div>
    </section>

    <section class="section container split-about" aria-labelledby="about-snippet-heading">
        <img src="<?php echo htmlspecialchars($ROOT); ?>image/image1.jpg" alt="Students collaborating">
        <div>
            <h2 id="about-snippet-heading">Why learners choose EduSkill</h2>
            <ul>
                <li>Curriculum reviewed for clarity and real-world relevance</li>
                <li>Study on mobile or desktop with the same account</li>
                <li>Paths for beginners through to job-ready portfolios</li>
            </ul>
            <p style="margin-top:1rem;"><a class="btn btn-primary" href="<?php echo htmlspecialchars($ROOT); ?>Pages/about.php">Read our story</a></p>
        </div>
    </section>

    <section class="section reviews" aria-labelledby="reviews-heading">
        <div class="container">
            <div class="section-head">
                <p class="section-kicker">Voices</p>
                <h2 class="section-title" id="reviews-heading">What students say</h2>
            </div>
            <div class="review-grid">
                <div class="review-card">
                    <div class="stars" aria-hidden="true">★★★★★</div>
                    <p>“EduSkill helped me land my first IT role—the projects actually matched interview questions.”</p>
                    <strong>— Sita Sharma</strong>
                </div>
                <div class="review-card">
                    <div class="stars" aria-hidden="true">★★★★☆</div>
                    <p>“Lessons are short and practical. I could study after work without burning out.”</p>
                    <strong>— Ram Thapa</strong>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-band" aria-labelledby="cta-heading">
        <h2 id="cta-heading">Ready to start learning?</h2>
        <p>Create a free student account and pick your first course in minutes.</p>
        <a class="btn" href="<?php echo htmlspecialchars($ROOT); ?>registration-system/register.php">Create account</a>
    </section>
</main>

<script>
    (function () {
        var slides = document.querySelectorAll('.hero-slide');
        if (!slides.length) return;
        var i = 0;
        setInterval(function () {
            slides[i].classList.remove('is-active');
            i = (i + 1) % slides.length;
            slides[i].classList.add('is-active');
        }, 4000);
    })();
</script>

<?php require_once __DIR__ . '/Components/page-end.php'; ?>
