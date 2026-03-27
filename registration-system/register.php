<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create account · EduSkill</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/student.css">
</head>

<body class="student-auth-body">
    <div class="student-auth-back">
        <a href="index.php">← Student portal</a>
        &nbsp;·&nbsp;
        <a href="../index.php">EduSkill home</a>
    </div>
    <div class="student-auth-panel">
        <div class="student-auth-logo">
            <img src="../image/211.png" alt="EduSkill">
        </div>
        <h1>Create your account</h1>
        <p class="student-auth-kicker">Join with your email—your school or admin can assign courses afterward.</p>

        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="student-auth-msg student-auth-msg--error" role="alert">' . htmlspecialchars((string) $_SESSION['error'], ENT_QUOTES, 'UTF-8') . '</div>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo '<div class="student-auth-msg student-auth-msg--success" role="status">' . htmlspecialchars((string) $_SESSION['success'], ENT_QUOTES, 'UTF-8') . '</div>';
            unset($_SESSION['success']);
        }
        ?>

        <form action="register-action.php" method="post" autocomplete="on">
            <input type="text" name="fullname" placeholder="Full name" required autocomplete="name">
            <input type="email" name="email" placeholder="Email" required autocomplete="email">
            <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
            <button type="submit">Register</button>
        </form>

        <div class="student-auth-foot">
            Already have an account? <a href="login.php">Sign in</a>
        </div>
    </div>
</body>

</html>
