<?php

if (!isset($provider_page_title)) {
    $provider_page_title = 'Provider';
}
$provider_nav = $provider_nav ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($provider_page_title); ?> · EduSkill Teach</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/provider.css">
</head>

<body class="provider-app">
    <div class="provider-shell">
        <aside class="provider-sidebar" id="providerSidebar">
            <a class="provider-brand" href="provider-dashboard.php">
                <img src="../image/211.png" alt="EduSkill">
                <span>Teach</span>
            </a>
            <nav class="provider-nav" aria-label="Provider">
                <a href="provider-dashboard.php" class="<?php echo $provider_nav === 'dashboard' ? 'is-active' : ''; ?>">Dashboard</a>
                <a href="my-courses.php" class="<?php echo $provider_nav === 'courses' ? 'is-active' : ''; ?>">My submissions</a>
            </nav>
            <div class="provider-sidebar-foot">
                <a class="provider-nav-secondary" href="index.php">Portal home</a>
                <a class="provider-nav-secondary" href="../Pages/courses.php">Public catalog</a>
                <a class="provider-nav-secondary" href="../index.php">EduSkill home</a>
                <a class="provider-nav-secondary" href="logout.php">Log out</a>
            </div>
        </aside>
        <button type="button" class="provider-backdrop" data-provider-backdrop hidden aria-label="Close menu"></button>
        <div class="provider-column">
            <header class="provider-topbar">
                <button type="button" class="provider-menu-toggle" data-provider-menu-toggle aria-expanded="false" aria-controls="providerSidebar" aria-label="Open menu">
                    <span></span>
                </button>
                <div class="provider-topbar-inner">
                    <h1 class="provider-page-title"><?php echo htmlspecialchars($provider_page_title); ?></h1>
                    <span class="provider-pill" title="<?php echo htmlspecialchars($provider_name, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($provider_name, ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
            </header>
            <main class="provider-main">
