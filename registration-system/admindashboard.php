<?php
session_start();
include "db.php";

// Admin authentication
if (!isset($_SESSION['admin_id'])) {
    header("Location: admindashboard.php");
    exit();
}

// Fetch stats
$totalStudentsQuery = "SELECT COUNT(*) AS total FROM students";
$totalStudentsResult = mysqli_query($conn, $totalStudentsQuery);
$totalStudents = mysqli_fetch_assoc($totalStudentsResult)['total'];

$totalCoursesQuery = "SELECT COUNT(*) AS total FROM courses";
$totalCoursesResult = mysqli_query($conn, $totalCoursesQuery);
$totalCourses = mysqli_fetch_assoc($totalCoursesResult)['total'];

// Fetch recent students
$recentStudentsQuery = "SELECT id, fullname, email, created_at FROM students ORDER BY created_at DESC LIMIT 5";
$recentStudentsResult = mysqli_query($conn, $recentStudentsQuery);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSkill Admin Dashboard</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Body and page */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #f0f0f0;
        }

        .page-container {
            display: flex;
            flex: 1;
        }

        /* Sidebar */
        .navbar {
            width: 220px;
            background: #6a0dad;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }

        .navbar h2 img {
            width: 120px;
            display: block;
            margin: 0 auto 20px auto;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 12px;
            margin: 5px 0;
            border-radius: 5px;
            font-weight: bold;
        }

        .navbar a:hover {
            background: #4b0082;
        }

        /* Main content */
        .main-content {
            margin-left: 240px;
            padding: 30px;
            flex: 1;
        }

        h1 {
            color: #6a0dad;
            margin-bottom: 20px;
        }

        /* Stats cards */
        .stats {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            flex: 1;
            min-width: 200px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h3 {
            color: #6a0dad;
            margin-bottom: 10px;
            font-size: 22px;
        }

        .card p {
            font-size: 18px;
            color: #333;
        }

        /* Recent students table */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background: #6a0dad;
            color: white;
        }

        table tr:hover {
            background: #f2f2f2;
        }

        .action-btn {
            background: #6a0dad;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .action-btn:hover {
            background: #4b0082;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            background: #6a0dad;
            color: white;
            margin-top: auto;
        }
    </style>
</head>

<body>

    <div class="page-container">
        <!-- Sidebar -->
        <div class="navbar">
            <h2><img src="../image/211.png" alt="logo"></h2>
            <a href="admin-dashboard.php">Dashboard</a>
            <a href="admin-students.php">Manage Students</a>
            <a href="admin-courses.php">Manage Courses</a>
            <a href="logout.php">Logout</a>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Admin Dashboard</h1>

            <!-- Stats Cards -->
            <div class="stats">
                <div class="card">
                    <h3>Total Students</h3>
                    <p><?php echo $totalStudents; ?></p>
                </div>
                <div class="card">
                    <h3>Total Courses</h3>
                    <p><?php echo $totalCourses; ?></p>
                </div>
            </div>

            <!-- Recent Students -->
            <h2>Recent Students</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Registered At</th>
                    <th>Actions</th>
                </tr>
                <?php while ($student = mysqli_fetch_assoc($recentStudentsResult)) { ?>
                    <tr>
                        <td><?php echo $student['id']; ?></td>
                        <td><?php echo htmlspecialchars($student['fullname']); ?></td>
                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                        <td><?php echo $student['created_at']; ?></td>
                        <td>
                            <a class="action-btn" href="view-student.php?id=<?php echo $student['id']; ?>">View</a>
                            <a class="action-btn" href="delete-student.php?id=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>

        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; <?php echo date('Y'); ?> EduSkill Admin. All rights reserved.
    </div>

</body>

</html>