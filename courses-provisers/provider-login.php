<?php
session_start();
include 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $error = 'Please enter email and password.';
    } else {
        $stmt = $conn->prepare('SELECT id, fullname, password FROM providers WHERE email=?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['provider_id'] = $row['id'];
                $_SESSION['provider_name'] = $row['fullname'];
                header('Location: provider-dashboard.php');
                exit;
            }
            $error = 'Incorrect password.';
        } else {
            $error = 'No provider account found for that email.';
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider sign in · EduSkill</title>
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
        <h1>Provider sign in</h1>
        <p class="provider-auth-kicker">Submit courses for admin review and track approval status.</p>
        <?php if ($error !== '') : ?>
            <div class="provider-auth-msg provider-auth-msg--error" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
        <form method="post" autocomplete="on">
            <input type="email" name="email" placeholder="Email" required autocomplete="username">
            <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
            <button type="submit">Sign in</button>
        </form>
        <div class="provider-auth-foot">
            New instructor? <a href="provider-register.php">Create a provider account</a>
        </div>
    </div>
</body>

</html>
