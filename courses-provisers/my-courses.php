<?php
session_start();
include "db.php";

// Redirect if student not logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: student-login.php");
    exit();
}

$studentName = $_SESSION['student_name'];

// Fetch approved courses
$courses = mysqli_query($conn, "SELECT courses.*, providers.fullname AS provider_name
                                FROM courses
                                JOIN providers ON courses.provider_id = providers.id
                                WHERE courses.status='approved'
                                ORDER BY courses.id DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Courses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f4f4;
        }

        header {
            background: linear-gradient(135deg, #4b0082, #4caf50);
            color: white;
            padding: 15px;
            text-align: center;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }

        .course-card {
            background: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .course-card h3 {
            margin: 0 0 10px 0;
            color: #4b0082;
        }

        .course-card p {
            margin: 5px 0;
        }
    </style>
</head>

<body>

    <header>
        <h1>Welcome, <?php echo htmlspecialchars($studentName); ?></h1>
    </header>

    <div class="container">
        <h2>Available Courses</h2>
        <?php
        if ($courses && mysqli_num_rows($courses) > 0) {
            while ($row = mysqli_fetch_assoc($courses)) { ?>
                <div class="course-card">
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p><strong>Provider:</strong> <?php echo htmlspecialchars($row['provider_name']); ?></p>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                </div>
        <?php }
        } else {
            echo "<p>No courses available yet. Please check back later.</p>";
        }
        ?>
    </div>

</body>

</html>