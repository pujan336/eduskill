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

$student_page_title = 'My courses';
$student_nav = 'courses';

include '_student_layout_top.php';
?>

<?php include '_student_quick_links.php'; ?>

<p style="margin:0 0 1.25rem;color:var(--ink-muted);max-width:42rem;line-height:1.55;">Everything your administrator has enrolled you in. Status reflects the provider course record.</p>

<?php if (count($assigned_courses) > 0) : ?>
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
        <p>You do not have any courses yet.</p>
        <p style="margin-top:0.75rem;"><a href="../Pages/courses.php">Browse the catalog</a> or contact your school.</p>
    </div>
<?php endif; ?>

<?php
include '_student_layout_bottom.php';
