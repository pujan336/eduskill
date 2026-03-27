<?php

require_once '_provider_init.php';
require_once '_provider_helpers.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim((string) ($_POST['title'] ?? ''));
    $description = trim((string) ($_POST['description'] ?? ''));

    if ($title === '' || $description === '') {
        $error = 'Title and description are required.';
    } else {
        $stmt = $conn->prepare("INSERT INTO courses (title, description, provider_id, status) VALUES (?, ?, ?, 'pending')");
        if ($stmt) {
            $stmt->bind_param('ssi', $title, $description, $provider_id);
            if ($stmt->execute()) {
                $success = 'Course submitted. An admin will review it shortly.';
            } else {
                $error = 'Could not save: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $error = 'Database error. Please try again.';
        }
    }
}

$course_rows = [];
$res = mysqli_query($conn, 'SELECT * FROM courses WHERE provider_id=' . $provider_id . ' ORDER BY id DESC');
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $course_rows[] = $row;
    }
} else {
    $error = $error ?: ('Could not load courses: ' . mysqli_error($conn));
}

$provider_page_title = 'Dashboard';
$provider_nav = 'dashboard';

include '_provider_layout_top.php';
?>

<section class="provider-card">
    <h2 class="provider-card-title">Submit a course <span>New</span></h2>
    <?php if ($error !== '') : ?>
        <div class="provider-msg provider-msg--error" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>
    <?php if ($success !== '') : ?>
        <div class="provider-msg provider-msg--success" role="status"><?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>
    <form class="provider-form" method="post" action="">
        <label for="course-title">Course title</label>
        <input id="course-title" type="text" name="title" placeholder="e.g. Intro to Web Design" required value="<?php echo isset($_POST['title']) ? htmlspecialchars((string) $_POST['title'], ENT_QUOTES, 'UTF-8') : ''; ?>">

        <label for="course-desc">Description</label>
        <textarea id="course-desc" name="description" placeholder="What will learners achieve? Prerequisites, format, length…" required><?php echo isset($_POST['description']) ? htmlspecialchars((string) $_POST['description'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>

        <button type="submit" class="provider-btn-submit">Submit for review</button>
    </form>
</section>

<section class="provider-card">
    <h2 class="provider-card-title">Your courses <span>Status</span></h2>
    <?php if (count($course_rows) > 0) : ?>
        <div class="provider-course-grid">
            <?php foreach ($course_rows as $row) : ?>
                <article class="provider-course-card">
                    <h3><?php echo htmlspecialchars((string) $row['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="desc"><?php echo htmlspecialchars((string) $row['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <span class="provider-badge <?php echo provider_badge_class($row['status']); ?>"><?php echo htmlspecialchars(ucfirst((string) $row['status']), ENT_QUOTES, 'UTF-8'); ?></span>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div class="provider-empty">No courses yet. Submit one above—it will appear here as <strong>pending</strong> until an admin approves it.</div>
    <?php endif; ?>
</section>

<?php
include '_provider_layout_bottom.php';
