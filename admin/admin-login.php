<?php
session_start();
include 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");
    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    $admin = mysqli_fetch_assoc($result);

    if ($admin) {
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['fullname'];
            header('Location: admin-dashboard.php');
            exit();
        }
        $error = 'Invalid password.';
    } else {
        $error = 'Admin account not found.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login · EduSkill</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body class="admin-auth-page">
    <div class="admin-auth-back">
        <a href="../index.php">← Back to site</a>
    </div>
    <div class="admin-auth-panel">
        <h1>Admin login</h1>
        <p class="admin-auth-kicker">EduSkill control center</p>
        <?php if ($error !== '') : ?>
            <div class="admin-auth-msg admin-auth-msg--error" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
        <form method="post" autocomplete="on">
            <input type="email" name="email" placeholder="Email" required autocomplete="username">
            <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
            <button type="submit">Sign in</button>
        </form>
        <div class="admin-auth-links">
            <a href="admin_registration.php">Register new admin</a>
        </div>
    </div>
</body>

</html>
