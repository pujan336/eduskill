<?php

require_once '_provider_init.php';
require_once '_provider_helpers.php';

$course_rows = [];
$res = mysqli_query($conn, 'SELECT * FROM courses WHERE provider_id=' . $provider_id . ' ORDER BY id DESC');
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $course_rows[] = $row;
    }
}

$provider_page_title = 'My submissions';
$provider_nav = 'courses';

include '_provider_layout_top.php';
?>

<p style="margin:0 0 1.25rem;color:var(--ink-muted);line-height:1.55;max-width:42rem;">All courses you have submitted. Only <strong>approved</strong> courses can appear on the public catalog and be assigned to students by admins.</p>

<?php if (count($course_rows) > 0) : ?>
    <div class="provider-table-wrap">
        <table class="provider-data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($course_rows as $row) : ?>
                    <tr>
                        <td><?php echo (int) $row['id']; ?></td>
                        <td><strong><?php echo htmlspecialchars((string) $row['title'], ENT_QUOTES, 'UTF-8'); ?></strong></td>
                        <td class="cell-desc"><?php echo htmlspecialchars((string) $row['description'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><span class="provider-badge <?php echo provider_badge_class($row['status']); ?>"><?php echo htmlspecialchars(ucfirst((string) $row['status']), ENT_QUOTES, 'UTF-8'); ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <div class="provider-empty">You have not submitted any courses. <a href="provider-dashboard.php" style="color:#4f46e5;font-weight:600;">Go to the dashboard</a> to create one.</div>
<?php endif; ?>

<?php
include '_provider_layout_bottom.php';
