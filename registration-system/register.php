<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student registration · EduSkill</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>

<body>
    <div class="auth-page">
        <div class="auth-back">
            <a href="../index.php">← Back to EduSkill</a>
        </div>
        <div class="auth-panel">
            <div class="logo">
                <img src="../image/211.png" alt="EduSkill">
            </div>
            <h2>Create your account</h2>

            <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="auth-message error" role="alert">' . htmlspecialchars((string) $_SESSION['error'], ENT_QUOTES, 'UTF-8') . '</div>';
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo '<div class="auth-message success" role="status">' . htmlspecialchars((string) $_SESSION['success'], ENT_QUOTES, 'UTF-8') . '</div>';
                unset($_SESSION['success']);
            }
            ?>

            <form action="register-action.php" method="post" autocomplete="on">
                <input type="text" name="fullname" placeholder="Full name" required autocomplete="name">
                <input type="email" name="email" placeholder="Email" required autocomplete="email">
                <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
                <button type="submit">Register</button>
            </form>

            <div class="auth-link">
                Already have an account? <a href="login.php">Log in</a>
            </div>
        </div>
    </div>
</body>

</html>
