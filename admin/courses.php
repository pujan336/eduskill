<?php
session_start();
include "db.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

// Handle actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action == 'approve') {
        mysqli_query($conn, "UPDATE courses SET status='approved' WHERE id=$id");
    } elseif ($action == 'deny') {
        mysqli_query($conn, "UPDATE courses SET status='denied' WHERE id=$id");
    } elseif ($action == 'delete') {
        mysqli_query($conn, "DELETE FROM courses WHERE id=$id");
    }
    header("Location: courses.php");
    exit();
}

// Fetch all courses with provider info
$courses = mysqli_query($conn, "SELECT courses.*, providers.fullname AS provider_name FROM courses JOIN providers ON courses.provider_id=providers.id ORDER BY courses.id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - Courses Management</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        th {
            background: #6a0dad;
            color: white;
        }

        a.button {
            padding: 5px 10px;
            background: #6a0dad;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 5px;
        }

        a.button.deny {
            background: red;
        }

        a.button.delete {
            background: gray;
        }
    </style>
</head>

<body>
    <h2>Courses Submitted by Providers</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Provider</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($courses)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td><?php echo htmlspecialchars($row['provider_name']); ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <a class="button" href="?action=approve&id=<?php echo $row['id']; ?>">Approve</a>
                    <a class="button deny" href="?action=deny&id=<?php echo $row['id']; ?>">Deny</a>
                    <a class="button delete" href="?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this course?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>