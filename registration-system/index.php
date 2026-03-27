<?php
session_start();

if (isset($_SESSION['student_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student portal · EduSkill</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/student.css">
</head>

<body class="student-hub-body">
    <div class="student-hub">
        <img src="../image/211.png" alt="EduSkill">
        <h1>Student portal</h1>
        <p>Log in to see your dashboard, or create an account to get started. Staff use the separate admin console.</p>
        <div class="student-hub-grid">
            <a class="student-hub-card student-hub-card--primary" href="login.php">Sign in</a>
            <a class="student-hub-card student-hub-card--accent" href="register.php">Create account</a>
            <a class="student-hub-card" href="../Pages/courses.php">Browse course catalog</a>
            <a class="student-hub-card student-hub-card--ghost" href="../index.php">EduSkill marketing site</a>
            <a class="student-hub-card" href="../admin/admin-login.php">Staff admin login</a>
        </div>
        <p class="student-hub-note">Teachers and providers have their own portals. <a href="../courses-provisers/index.php">Provider portal</a></p>
    </div>
</body>

</html>
