<?php

require_once '_student_init.php';
require_once '_student_helpers.php';

$studentId = (int) $_SESSION['student_id'];

$query = '
SELECT c.title, c.description, c.status, p.fullname AS provider_name
FROM student_courses sc
JOIN courses c ON sc.course_id = c.id
JOIN providers p ON c.provider_id = p.id
WHERE sc.student_id = ?
ORDER BY sc.assigned_at DESC
';

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $studentId);
$stmt->execute();
$result = $stmt->get_result();

$assigned_courses = [];
while ($row = $result->fetch_assoc()) {
    $assigned_courses[] = $row;
}
$stmt->close();

$course_count = count($assigned_courses);

$student_page_title = 'Dashboard';
$student_nav = 'dashboard';

include '_student_layout_top.php';
?>

<?php include '_student_quick_links.php'; ?>

<section class="student-welcome">
    <h2>Welcome back, <?php echo htmlspecialchars((string) $student_profile['fullname'], ENT_QUOTES, 'UTF-8'); ?></h2>
    <p>Pick up where you left off. Your enrolled courses and new recommendations are below.</p>
    <div class="student-stats">
        <div class="student-stat">
            <strong><?php echo (int) $course_count; ?></strong>
            Assigned course<?php echo $course_count === 1 ? '' : 's'; ?>
        </div>
        <div class="student-stat">
            <strong><?php echo htmlspecialchars((string) ($student_profile['email'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></strong>
            Account email
        </div>
    </div>
</section>

<h2 class="student-section-title">Your learning <span>Assigned</span></h2>

<?php if ($course_count > 0) : ?>
    <div class="student-course-grid">
        <?php foreach ($assigned_courses as $course) : ?>
            <article class="student-course-card">
                <h3><?php echo htmlspecialchars((string) $course['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                <p class="meta"><?php echo htmlspecialchars((string) $course['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="meta"><strong>Provider:</strong> <?php echo htmlspecialchars((string) $course['provider_name'], ENT_QUOTES, 'UTF-8'); ?></p>
                <span class="student-badge <?php echo student_badge_class($course['status']); ?>"><?php echo htmlspecialchars(ucfirst((string) $course['status']), ENT_QUOTES, 'UTF-8'); ?></span>
            </article>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="student-empty">
        <p>No courses assigned yet. Explore the catalog and ask your admin to enroll you.</p>
        <p style="margin-top:0.75rem;"><a href="../Pages/courses.php">Browse courses</a></p>
    </div>
<?php endif; ?>

<div class="student-card" style="margin-top:2rem;">
    <h2 class="student-section-title" style="margin-bottom:0.75rem;">Featured topics <span>Explore</span></h2>
    <p class="meta" style="margin:0 0 1rem;color:var(--ink-muted);">Ideas for what to study next—same look as the public site gallery.</p>
    <div class="student-showcase-wrap">
        <div class="student-showcase" data-student-showcase>
            <div class="student-showcase-slide is-active">
                <img src="../image/image1.jpg" alt="">
                <div class="student-showcase-caption">Learn web development from scratch</div>
            </div>
            <div class="student-showcase-slide">
                <img src="../image/programming_image.jpg" alt="">
                <div class="student-showcase-caption">Master practical programming</div>
            </div>
            <div class="student-showcase-slide">
                <img src="../image/python.jpg" alt="">
                <div class="student-showcase-caption">Grow your career with new skills</div>
            </div>
            <button type="button" class="student-showcase-nav student-showcase-nav--prev" aria-label="Previous slide">‹</button>
            <button type="button" class="student-showcase-nav student-showcase-nav--next" aria-label="Next slide">›</button>
        </div>
        <div class="student-showcase-dots" role="tablist" aria-label="Slides">
            <button type="button" class="student-showcase-dot is-active" aria-label="Slide 1"></button>
            <button type="button" class="student-showcase-dot" aria-label="Slide 2"></button>
            <button type="button" class="student-showcase-dot" aria-label="Slide 3"></button>
        </div>
    </div>
</div>

<?php
include '_student_layout_bottom.php';
