<?php
session_start();
include "db.php"; // make sure db.php is in the same folder

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM providers WHERE email='$email'");
    if (!$check) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($check) > 0) {
        $error = "Email already registered!";
    } else {
        $sql = "INSERT INTO providers (fullname, email, password) VALUES ('$fullname', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            $success = "Registration successful! Wait for admin approval.";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Provider Registration</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #e6e0f8;
            /* soft purple background */
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 420px;
            margin: 80px auto;
            background: #fff;
            padding: 35px 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        .logo {
            margin-bottom: 20px;
        }

        .logo img {
            width: 120px;
            border-radius: 15px;

            /* logo background color */
            padding: 10px;
        }

        h2 {
            margin-bottom: 25px;
            color: #4b0082;
            /* dark purple to match logo */
            font-size: 28px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px 18px;
            margin: 10px 0 20px 0;
            border: 1px solid #b19cd9;
            /* light purple border */
            border-radius: 8px;
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #4b0082;
            outline: none;
            box-shadow: 0 0 5px #4b0082;
        }

        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(45deg, #4b0082, #6a0dad);
            /* gradient purple button */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background: linear-gradient(45deg, #6a0dad, #4b0082);
            transform: scale(1.03);
        }

        .message {
            margin: 12px 0;
            font-weight: bold;
        }

        .error {
            color: #d32f2f;
            /* red error */
        }

        .success {
            color: #388e3c;
            /* green success */
        }

        a.login-link {
            display: block;
            margin-top: 18px;
            text-decoration: none;
            color: #4b0082;
            font-weight: bold;
        }

        a.login-link:hover {
            text-decoration: underline;
            color: #6a0dad;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <!-- Add your logo here -->
            <img src="../image/211.png" alt="EduSkill Logo">
        </div>
        <h2>Provider Registration</h2>

        <?php if ($error) echo "<p class='message error'>$error</p>"; ?>
        <?php if ($success) echo "<p class='message success'>$success</p>"; ?>

        <form method="POST">
            <input type="text" name="fullname" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>

        <a class="login-link" href="provider-login.php">Already have an account? Login</a>
    </div>
</body>

</html>