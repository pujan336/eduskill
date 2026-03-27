<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>

    <style>
        /* Full page gradient background */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #6a0dad, #28a745);
        }

        /* Registration container */
        .register-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            width: 360px;
            max-width: 90%;
            text-align: center;
            transition: all 0.3s ease;
        }

        /* Logo */
        .register-container .logo img {
            width: 100px;
            margin-bottom: 20px;
        }

        /* Heading */
        .register-container h2 {
            margin-bottom: 20px;
            color: #6a0dad;
            font-size: 24px;
        }

        /* Form input fields */
        .register-container input[type="text"],
        .register-container input[type="email"],
        .register-container input[type="password"] {
            width: 100%;
            padding: 12px 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            transition: 0.3s;
        }

        .register-container input[type="text"]:focus,
        .register-container input[type="email"]:focus,
        .register-container input[type="password"]:focus {
            border-color: #6a0dad;
            box-shadow: 0 0 5px rgba(106, 13, 173, 0.5);
            outline: none;
        }

        /* Submit button */
        .register-container button {
            width: 100%;
            padding: 12px;
            background: #6a0dad;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .register-container button:hover {
            background: #4b0082;
        }

        /* Messages */
        .message {
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
        }

        .success {
            background: #d4edda;
            color: #155724;
        }

        /* Login link */
        .login-link {
            font-size: 14px;
            margin-top: 15px;
        }

        .login-link a {
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Responsive Styles */
        @media (max-width: 480px) {
            .register-container {
                padding: 30px 20px;
                width: 95%;
            }

            .register-container h2 {
                font-size: 20px;
            }

            .register-container button {
                font-size: 15px;
                padding: 10px;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 20px;
            }

            .register-container {
                width: 400px;
            }
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="logo">
            <img src="image/211.png" alt="Website Logo">
        </div>
        <h2>Student Registration</h2>

        <!-- Display messages -->
        <?php
        if (isset($_SESSION['error'])) {
            echo "<div class='message error'>{$_SESSION['error']}</div>";
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo "<div class='message success'>{$_SESSION['success']}</div>";
            unset($_SESSION['success']);
        }
        ?>

        <form action="register-action.php" method="POST">
            <input type="text" name="fullname" placeholder="Enter full name" required>
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <button type="submit">Register</button>
        </form>

        <div class="login-link">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>

</html>