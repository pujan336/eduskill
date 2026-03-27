<?php
session_start();
include 'db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        $check = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $error = 'That email is already registered.';
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO admins (fullname, email, password) VALUES ('$fullname', '$email', '$hashed_password')";
            if (mysqli_query($conn, $sql)) {
                $success = 'Admin account created. You can sign in now.';
            } else {
                $error = 'Database error: ' . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin registration · EduSkill</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body class="admin-auth-page">
    <div class="admin-auth-back">
        <a href="admin-login.php">← Admin login</a>
    </div>
    <div class="admin-auth-panel">
        <h1>New admin</h1>
        <p class="admin-auth-kicker">Create a secure administrator account</p>

        <?php if ($error !== '') : ?>
            <div class="admin-auth-msg admin-auth-msg--error" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
        <?php if ($success !== '') : ?>
            <div class="admin-auth-msg admin-auth-msg--success" role="status"><?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <form method="post" autocomplete="on">
            <input type="text" name="fullname" placeholder="Full name" required autocomplete="name">
            <input type="email" name="email" placeholder="Email" required autocomplete="email">
            <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
            <input type="password" name="confirm_password" placeholder="Confirm password" required autocomplete="new-password">
            <button type="submit">Create admin</button>
        </form>
        <div class="admin-auth-links">
            Already registered? <a href="admin-login.php">Sign in</a>
        </div>
    </div>
</body>

</html>
