<?php
session_start();
include "db.php";

$error = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM students WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['student_id'] = $row['id'];
        $_SESSION['student_name'] = $row['fullname'];
        $success = true;
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #6a0dad, #28a745);
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            width: 360px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            background: #6a0dad;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-container button:hover {
            background: #4b0082;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        /* Modal CSS */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        .modal button {
            margin-top: 15px;
            padding: 10px 20px;
            border: none;
            background: #6a0dad;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Student Login</h2>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <button type="submit">Login</button>
        </form>
    </div>

    <!-- Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <h2>Login Successful!</h2>
            <p>Redirecting to your dashboard...</p>
            <button onclick="redirectDashboard()">Go Now</button>
        </div>
    </div>

    <script>
        <?php if ($success): ?>
            // Show modal if login successful
            document.getElementById('successModal').style.display = 'block';

            // Auto redirect after 2 seconds
            setTimeout(() => {
                window.location.href = 'dashboard.php';
            }, 2000);

            function redirectDashboard() {
                window.location.href = 'dashboard.php';
            }
        <?php endif; ?>
    </script>

</body>

</html>