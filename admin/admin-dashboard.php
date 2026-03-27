<?php
session_start();
include "db.php";

// Redirect if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

// Handle course approval/denial
if (isset($_GET['approve'])) {
    $course_id = intval($_GET['approve']);
    mysqli_query($conn, "UPDATE courses SET status='approved' WHERE id=$course_id");
    header("Location: admin-dashboard.php?message=approved");
    exit();
}

if (isset($_GET['deny'])) {
    $course_id = intval($_GET['deny']);
    mysqli_query($conn, "UPDATE courses SET status='denied' WHERE id=$course_id");
    header("Location: admin-dashboard.php?message=denied");
    exit();
}

// Handle student deletion
if (isset($_GET['delete_student'])) {
    $student_id = intval($_GET['delete_student']);
    mysqli_query($conn, "DELETE FROM students WHERE id=$student_id");
    header("Location: admin-dashboard.php?message=student_deleted");
    exit();
}

// Handle course assignment
if (isset($_POST['assign_course'])) {
    $student_id = intval($_POST['student_id']);
    $course_id = intval($_POST['course_id']);

    // Prevent duplicate assignment
    $check = mysqli_query($conn, "SELECT * FROM student_courses WHERE student_id=$student_id AND course_id=$course_id");
    if (mysqli_num_rows($check) > 0) {
        $popup = "This course is already assigned to the selected student!";
    } else {
        mysqli_query($conn, "INSERT INTO student_courses (student_id, course_id) VALUES ($student_id, $course_id)");
        $popup = "Course assigned successfully!";
    }
}

// Fetch students
$students = mysqli_query($conn, "SELECT * FROM students ORDER BY fullname ASC");

// Fetch courses with provider info
$courses = mysqli_query($conn, "
    SELECT courses.*, providers.fullname AS provider_name 
    FROM courses 
    JOIN providers ON courses.provider_id = providers.id
    ORDER BY courses.id DESC
");

// Popup messages
$popup = $popup ?? "";
if (isset($_GET['message'])) {
    switch ($_GET['message']) {
        case 'approved':
            $popup = "Course approved successfully!";
            break;
        case 'denied':
            $popup = "Course denied!";
            break;
        case 'student_deleted':
            $popup = "Student deleted!";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EduSkill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f0f2f5;
        }

        header {
            background: linear-gradient(135deg, #4b0082, #4caf50);
            color: white;
            padding: 15px;
            text-align: center;
        }

        .container {
            display: flex;
        }

        .sidebar {
            width: 220px;
            background: #4b0082;
            height: 100vh;
            color: white;
            padding: 20px;
            position: fixed;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 0;
        }

        .sidebar a:hover {
            background: #6a0dad;
            border-radius: 5px;
        }

        .main {
            margin-left: 240px;
            padding: 20px;
            flex: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background: linear-gradient(135deg, #4b0082, #4caf50);
            color: white;
        }

        .status-approved {
            color: green;
            font-weight: bold;
        }

        .status-denied {
            color: red;
            font-weight: bold;
        }

        .status-pending {
            color: orange;
            font-weight: bold;
        }

        button {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button.approve {
            background: green;
            color: white;
        }

        button.deny {
            background: red;
            color: white;
        }

        button.delete {
            background: #dc3545;
            color: white;
        }

        button.assign {
            background: #4b0082;
            color: white;
        }

        select {
            padding: 5px;
            border-radius: 3px;
        }

        .popup {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #4b0082, #4caf50);
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            font-weight: bold;
            z-index: 1000;
            transition: all 0.5s ease;
        }

        @media(max-width:768px) {
            .main {
                margin-left: 0;
            }

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Admin Dashboard - Welcome <?php echo htmlspecialchars($_SESSION['admin_name']); ?></h1>
    </header>

    <div class="container">
        <div class="sidebar">
            <a href="admin-dashboard.php">Dashboard</a>
            <a href="admin-logout.php">Logout</a>
        </div>

        <div class="main">
            <h2>Students</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Registered At</th>
                    <th>Actions</th>
                </tr>
                <?php while ($student = mysqli_fetch_assoc($students)) { ?>
                    <tr>
                        <td><?php echo $student['id']; ?></td>
                        <td><?php echo htmlspecialchars($student['fullname']); ?></td>
                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                        <td><?php echo $student['created_at']; ?></td>
                        <td><a href="?delete_student=<?php echo $student['id']; ?>"><button class="delete">Delete</button></a></td>
                    </tr>
                <?php } ?>
            </table>

            <h2>Courses Submitted by Providers</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Provider</th>
                    <th>Status</th>
                    <th>Assign to Student</th>
                    <th>Actions</th>
                </tr>
                <?php
                mysqli_data_seek($courses, 0); // reset pointer
                while ($course = mysqli_fetch_assoc($courses)) { ?>
                    <tr>
                        <td><?php echo $course['id']; ?></td>
                        <td><?php echo htmlspecialchars($course['title']); ?></td>
                        <td><?php echo htmlspecialchars($course['provider_name']); ?></td>
                        <td class="status-<?php echo $course['status']; ?>"><?php echo ucfirst($course['status']); ?></td>
                        <td>
                            <?php if ($course['status'] == 'approved') { ?>
                                <form method="POST" style="display:flex; gap:5px;">
                                    <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                                    <select name="student_id" required>
                                        <option value="">Select Student</option>
                                        <?php
                                        $student_list2 = mysqli_query($conn, "SELECT * FROM students ORDER BY fullname ASC");
                                        while ($student_option = mysqli_fetch_assoc($student_list2)) {
                                            echo "<option value='{$student_option['id']}'>" . htmlspecialchars($student_option['fullname']) . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <button type="submit" name="assign_course" class="assign">Assign</button>
                                </form>
                            <?php } else {
                                echo "-";
                            } ?>
                        </td>
                        <td>
                            <?php if ($course['status'] == 'pending') { ?>
                                <a href="?approve=<?php echo $course['id']; ?>"><button class="approve">Approve</button></a>
                                <a href="?deny=<?php echo $course['id']; ?>"><button class="deny">Deny</button></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <div class="popup" id="popup"><?php echo $popup; ?></div>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const popup = document.getElementById('popup');
            if (popup.innerText.trim() !== '') {
                popup.style.display = 'block';
                setTimeout(() => {
                    popup.style.display = 'none';
                }, 3000);
            }
        });
    </script>
</body>

</html>