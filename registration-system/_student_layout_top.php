<?php

if (!isset($student_page_title)) {
    $student_page_title = 'Dashboard';
}
$student_nav = $student_nav ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($student_page_title); ?> · EduSkill</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/student.css">
</head>

<body class="student-app">
    <div class="student-shell">
        <aside class="student-sidebar" id="studentSidebar">
            <a class="student-brand" href="dashboard.php">
                <img src="../image/211.png" alt="EduSkill">
                <span>Learn</span>
            </a>
            <nav class="student-nav" aria-label="Student">
                <a href="dashboard.php" class="<?php echo $student_nav === 'dashboard' ? 'is-active' : ''; ?>">Dashboard</a>
                <a href="mycourses.php" class="<?php echo $student_nav === 'courses' ? 'is-active' : ''; ?>">My courses</a>
                <a href="profile.php" class="<?php echo $student_nav === 'profile' ? 'is-active' : ''; ?>">Profile</a>
            </nav>
            <div class="student-sidebar-foot">
                <a class="student-nav-secondary" href="../Pages/courses.php">Browse catalog</a>
                <a class="student-nav-secondary" href="../index.php">← Home</a>
                <a class="student-nav-secondary" href="logout.php">Log out</a>
            </div>
        </aside>
        <button type="button" class="student-backdrop" data-student-backdrop hidden aria-label="Close menu"></button>
        <div class="student-column">
            <header class="student-topbar">
                <button type="button" class="student-menu-toggle" data-student-menu-toggle aria-expanded="false" aria-controls="studentSidebar" aria-label="Open menu">
                    <span></span>
                </button>
                <div class="student-topbar-inner">
                    <h1 class="student-page-title"><?php echo htmlspecialchars($student_page_title); ?></h1>
                    <span class="student-pill"><?php echo htmlspecialchars((string) $student_profile['fullname'], ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
            </header>
            <main class="student-main">
