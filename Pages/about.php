<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About - Course Platform</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }

        /* Sidebar */
        .navbar {
            width: 250px;
            background: #4b0082;
            color: white;
            min-height: 100vh;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Logo */
        .logo {
            width: 120px;
            margin-bottom: 10px;
        }

        .navbar h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 8px 0;
            display: block;
            padding: 8px;
            width: 100%;
            text-align: center;
            border-radius: 4px;
        }

        .navbar a:hover {
            background: #6a0dad;
        }

        /* Main content */
        .container {
            flex: 1;
            padding: 30px;
            background: #f4f4f4;
        }

        h1 {
            color: #4b0082;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
            line-height: 1.6;
        }

        ul {
            margin-left: 20px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="navbar">
        <img src="../image/211.png" alt="logo" class="logo">
        <h2>Course Platform</h2>

        <a href="../index.php">Home</a>
        <a href="provider-dashboard.html">Dashboard</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact</a>
    </div>

    <!-- Main content -->
    <div class="container">
        <h1>About Our Platform</h1>

        <div class="card">
            <p>
                Welcome to our Course Management System. This platform allows course providers
                to create, manage, and submit their courses online. All courses are reviewed
                by an administrator before being published.
            </p>

            <h3>Our Features:</h3>
            <ul>
                <li>📚 Easy course submission</li>
                <li>🧑‍🏫 Provider dashboard</li>
                <li>✅ Admin approval system</li>
                <li>📊 Course tracking and status updates</li>
            </ul>

            <p>
                Our mission is to make education accessible and easy to manage through a
                simple and user-friendly platform.
            </p>
        </div>
    </div>

</body>

</html>