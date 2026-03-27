<?php
session_start();
include "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "All fields are required!";
    } else {

        $stmt = $conn->prepare(
            "SELECT id, fullname, password FROM providers WHERE email=?"
        );
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {

                $_SESSION['provider_id']   = $row['id'];
                $_SESSION['provider_name'] = $row['fullname'];

                header("Location: provider-dashboard.php");
                exit();
            } else {
                $error = "Incorrect password!";
            }
        } else {
            $error = "No provider found with this email!";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Provider Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #4b0082, #4caf50);
            padding: 15px 20px;
            color: white;
            display: flex;
            justify-content: space-between;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            font-weight: bold;
        }

        .container {
            max-width: 400px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #4b0082;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #4b0082, #4caf50);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div><b>Course Platform</b></div>
        <div>
            <a href="index.php">Home</a>
            <a href="provider-login.php">Provider Login</a>
        </div>
    </div>

    <div class="container">
        <h2>Provider Login</h2>

        <?php if ($error) echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

    </div>

</body>

</html>