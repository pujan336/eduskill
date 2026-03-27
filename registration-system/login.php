<?php
session_start();
include 'db.php';

$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM students WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['student_id'] = $row['id'];
        $_SESSION['student_name'] = $row['fullname'];
        $success = true;
    } else {
        $error = 'Invalid email or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student login · EduSkill</title>
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
        <h1>Sign in</h1>
        <p class="student-auth-kicker">Access your courses, profile, and learning tools.</p>
        <?php if ($error !== '') : ?>
            <div class="student-auth-msg student-auth-msg--error" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
        <form method="post" autocomplete="on">
            <input type="email" name="email" placeholder="Email" required autocomplete="username">
            <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
            <button type="submit">Continue</button>
        </form>
        <div class="student-auth-foot">
            New here? <a href="register.php">Create an account</a>
        </div>
    </div>

    <div id="successModal" class="student-modal<?php echo $success ? ' is-visible' : ''; ?>" role="dialog" aria-modal="true" aria-labelledby="modal-title">
        <div class="student-modal-box">
            <h2 id="modal-title">You’re in</h2>
            <p>Opening your dashboard…</p>
            <button type="button" onclick="goDashboard()">Go now</button>
        </div>
    </div>

    <script>
        <?php if ($success) : ?>
            function goDashboard() {
                window.location.href = 'dashboard.php';
            }
            setTimeout(goDashboard, 1800);
        <?php endif; ?>
    </script>
</body>

</html>
