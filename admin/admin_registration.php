<?php
session_start();
include "db.php"; // Make sure db.php points to your database

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Check if email already exists
        $check = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Email already exists!";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert into database
            $sql = "INSERT INTO admins (fullname, email, password) VALUES ('$fullname', '$email', '$hashed_password')";
            if (mysqli_query($conn, $sql)) {
                $success = "Admin registered successfully!";
            } else {
                $error = "Database error: " . mysqli_error($conn);
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
    <title>Admin Registration - EduSkill</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial;
            background: linear-gradient(135deg, #6a0dad, #28a745);
            margin: 0;
        }

        .register-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .register-container h2 {
            margin-bottom: 20px;
            color: #6a0dad;
        }

        .register-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .register-container button {
            width: 100%;
            padding: 12px;
            background: #6a0dad;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .register-container button:hover {
            background: #4b0082;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h2>Admin Registration</h2>

        <?php
        if (!empty($error)) echo "<div class='error'>$error</div>";
        if (!empty($success)) echo "<div class='success'>$success</div>";
        ?>

        <form method="POST">
            <input type="text" name="fullname" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Register Admin</button>
        </form>
        <p>Already have an account? <a href="admin-login.php">Login here</a></p>
    </div>
</body>

</html>