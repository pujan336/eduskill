<?php
session_start();
include 'db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim((string) ($_POST['fullname'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if ($fullname === '' || $email === '' || $password === '') {
        $error = 'All fields are required.';
    } else {
        $check = $conn->prepare('SELECT id FROM providers WHERE email = ? LIMIT 1');
        $check->bind_param('s', $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = 'That email is already registered.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare('INSERT INTO providers (fullname, email, password) VALUES (?, ?, ?)');
            $stmt->bind_param('sss', $fullname, $email, $hash);
            if ($stmt->execute()) {
                $success = 'Registration successful. You can sign in once an admin has approved your account if required—or sign in now if your org allows it.';
            } else {
                $error = 'Could not register: ' . $stmt->error;
            }
            $stmt->close();
        }
        $check->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider registration · EduSkill</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/provider.css">
</head>

<body class="provider-auth-body">
    <div class="provider-auth-back">
        <a href="index.php">← Provider portal</a>
        &nbsp;·&nbsp;
        <a href="../index.php">EduSkill home</a>
    </div>
    <div class="provider-auth-panel">
        <div class="provider-auth-logo">
            <img src="../image/211.png" alt="EduSkill">
        </div>
        <h1>Become a provider</h1>
        <p class="provider-auth-kicker">Create an account to submit courses. Admins approve listings before they go live.</p>

        <?php if ($error !== '') : ?>
            <div class="provider-auth-msg provider-auth-msg--error" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
        <?php if ($success !== '') : ?>
            <div class="provider-auth-msg provider-auth-msg--success" role="status"><?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <form method="post" autocomplete="on">
            <input type="text" name="fullname" placeholder="Full name" required autocomplete="name">
            <input type="email" name="email" placeholder="Email" required autocomplete="email">
            <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
            <button type="submit">Register</button>
        </form>

        <div class="provider-auth-foot">
            Already registered? <a href="provider-login.php">Sign in</a>
        </div>
    </div>
</body>

</html>
