<?php
session_start();
include 'db.php';

$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM students WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['student_id'] = $row['id'];
        $_SESSION['student_name'] = $row['fullname'];
        $success = true;
    } else {
        $error = 'Invalid email or password!';
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
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>

<body>
    <div class="auth-page">
        <div class="auth-back">
            <a href="../index.php">← Back to EduSkill</a>
        </div>
        <div class="auth-panel">
            <h2>Student login</h2>
            <?php if ($error !== '') : ?>
                <div class="auth-message error" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>
            <form method="post" autocomplete="on">
                <input type="email" name="email" placeholder="Email" required autocomplete="username">
                <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
                <button type="submit">Log in</button>
            </form>
            <div class="auth-link">
                New here? <a href="register.php">Create an account</a>
            </div>
        </div>
    </div>

    <div id="successModal" class="auth-modal<?php echo $success ? ' is-visible' : ''; ?>" role="dialog" aria-modal="true" aria-labelledby="modal-title">
        <div class="auth-modal-box">
            <h2 id="modal-title">Login successful</h2>
            <p>Redirecting to your dashboard…</p>
            <button type="button" onclick="redirectDashboard()">Go now</button>
        </div>
    </div>

    <script>
        <?php if ($success) : ?>
            function redirectDashboard() {
                window.location.href = 'dashboard.php';
            }
            setTimeout(redirectDashboard, 2000);
        <?php endif; ?>
    </script>
</body>

</html>
