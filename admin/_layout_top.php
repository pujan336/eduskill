<?php

if (!isset($admin_page_title)) {
    $admin_page_title = 'Admin';
}
$admin_nav = $admin_nav ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($admin_page_title); ?> · EduSkill Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body class="admin-app">
    <div class="admin-shell">
        <aside class="admin-sidebar" id="adminSidebar" aria-label="Admin">
            <a class="admin-brand" href="admin-dashboard.php">
                <img src="../image/211.png" alt="EduSkill">
                <span>Admin</span>
            </a>
            <nav class="admin-nav">
                <a href="admin-dashboard.php" class="<?php echo $admin_nav === 'dashboard' ? 'is-active' : ''; ?>">Dashboard</a>
                <a href="courses.php" class="<?php echo $admin_nav === 'courses' ? 'is-active' : ''; ?>">Courses</a>
            </nav>
            <div class="admin-sidebar-foot">
                <a class="admin-nav-secondary" href="../index.php">← Public site</a>
                <a class="admin-nav-secondary" href="logout.php">Log out</a>
            </div>
        </aside>
        <button type="button" class="admin-backdrop" data-admin-backdrop hidden aria-label="Close menu"></button>
        <div class="admin-column">
            <header class="admin-topbar">
                <button type="button" class="admin-menu-toggle" data-admin-menu-toggle aria-expanded="false" aria-controls="adminSidebar" aria-label="Open menu">
                    <span></span>
                </button>
                <div class="admin-topbar-inner">
                    <h1 class="admin-page-title"><?php echo htmlspecialchars($admin_page_title); ?></h1>
                    <?php if (!empty($_SESSION['admin_name'])) : ?>
                        <span class="admin-user"><?php echo htmlspecialchars((string) $_SESSION['admin_name']); ?></span>
                    <?php endif; ?>
                </div>
            </header>
            <main class="admin-main">
