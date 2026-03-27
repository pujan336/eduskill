<?php

require_once '_student_init.php';

$student_page_title = 'Profile';
$student_nav = 'profile';

$created = $student_profile['created_at'] ?? null;

include '_student_layout_top.php';
?>

<div class="student-card">
    <h2 class="student-section-title">Your account <span>Details</span></h2>
    <p style="margin:0 0 1.25rem;color:var(--ink-muted);line-height:1.55;">This information is stored securely. To change your email or name, contact your administrator.</p>

    <dl class="student-profile-grid">
        <div class="student-profile-row">
            <dt>Full name</dt>
            <dd><?php echo htmlspecialchars((string) $student_profile['fullname'], ENT_QUOTES, 'UTF-8'); ?></dd>
        </div>
        <div class="student-profile-row">
            <dt>Email</dt>
            <dd><?php echo htmlspecialchars((string) ($student_profile['email'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></dd>
        </div>
        <?php if (!empty($created)) : ?>
            <div class="student-profile-row">
                <dt>Registered</dt>
                <dd><?php echo htmlspecialchars((string) $created, ENT_QUOTES, 'UTF-8'); ?></dd>
            </div>
        <?php endif; ?>
        <div class="student-profile-row">
            <dt>Student ID</dt>
            <dd><?php echo (int) $student_profile['id']; ?></dd>
        </div>
    </dl>
</div>

<?php
include '_student_layout_bottom.php';
