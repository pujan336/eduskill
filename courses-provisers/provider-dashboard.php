<?php
session_start();
include "db.php";

//Ensure provider is logged in
if (!isset($_SESSION['provider_id']) || empty($_SESSION['provider_id'])) {
    header("Location: provider-login.php");
    exit();
}

$providerId = $_SESSION['provider_id'];
$providerName = $_SESSION['provider_name'];

$error = "";
$success = "";

// Handle course submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if (empty($title) || empty($description)) {
        $error = "All fields are required!";
    } else {
        // Prevent null provider_id
        if (empty($providerId)) {
            $error = "Provider ID is missing. Please log in again.";
        } else {
            $stmt = $conn->prepare("INSERT INTO courses (title, description, provider_id, status) VALUES (?, ?, ?, 'pending')");
            $stmt->bind_param("ssi", $title, $description, $providerId);

            if ($stmt->execute()) {
                $success = "Course submitted successfully! Wait for admin approval.";
            } else {
                $error = "Database error: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}

// Fetch provider's courses safely
$courses = mysqli_query($conn, "SELECT * FROM courses WHERE provider_id=" . intval($providerId) . " ORDER BY id DESC");
if ($courses === false) {
    $error = "Database error: " . mysqli_error($conn);
    $courses = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Provider Dashboard - Submit Course</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        /* Navbar */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, #4b0082, #4caf50);
            padding: 10px 20px;
            color: white;
        }

        .navbar .logo img {
            width: 80px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            font-weight: bold;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        h2 {
            color: #4b0082;
        }

        /* Form styling */
        .course-form {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .course-form input[type="text"],
        .course-form textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .course-form button {
            padding: 12px 20px;
            background: linear-gradient(45deg, #4b0082, #4caf50);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .course-form button:hover {
            transform: scale(1.03);
        }

        .message {
            margin: 10px 0;
            font-weight: bold;
        }

        .error {
            color: #d32f2f;
        }

        .success {
            color: green;
        }

        /* Courses container */
        .courses-container {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .course-card {
            background: white;
            min-width: 250px;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
            position: relative;
        }

        .course-card h3 {
            margin: 0 0 10px 0;
            color: #4b0082;
        }

        .course-card p {
            margin: 0 0 10px 0;
        }

        .course-card .status {
            font-weight: bold;
            color: #555;
        }

        @media (max-width: 768px) {
            .courses-container {
                flex-direction: column;
            }

            .course-card {
                min-width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <img src="../image/211.png" alt="Logo">
        </div>
        <div>
            <span>Hello, <?php echo htmlspecialchars($providerName); ?></span>
            <a href="provider-dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <!-- Display messages -->
        <?php if ($error) echo "<p class='message error'>$error</p>"; ?>
        <?php if ($success) echo "<p class='message success'>$success</p>"; ?>

        <!-- Course Form -->
        <div class="course-form">
            <h2>Submit New Course</h2>
            <form method="POST">
                <input type="text" name="title" placeholder="Course Title" required>
                <textarea name="description" placeholder="Course Description" rows="4" required></textarea>
                <button type="submit">Submit Course</button>
            </form>
        </div>

        <!-- Display Courses -->
        <h2>My Courses</h2>
        <div class="courses-container">
            <?php
            if (!empty($courses) && mysqli_num_rows($courses) > 0) {
                while ($row = mysqli_fetch_assoc($courses)) { ?>
                    <div class="course-card" data-status="<?php echo htmlspecialchars($row['status']); ?>">
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <p class="status">Status: <?php echo ucfirst(htmlspecialchars($row['status'])); ?></p>
                    </div>
            <?php }
            } else {
                echo "<p>No courses submitted yet.</p>";
            } ?>
        </div>
    </div>

</body>

</html>