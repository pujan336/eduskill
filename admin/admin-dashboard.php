<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin-login.php');
    exit();
}

if (isset($_GET['approve'])) {
    $course_id = intval($_GET['approve']);
    mysqli_query($conn, "UPDATE courses SET status='approved' WHERE id=$course_id");
    header('Location: admin-dashboard.php?message=approved');
    exit();
}

if (isset($_GET['deny'])) {
    $course_id = intval($_GET['deny']);
    mysqli_query($conn, "UPDATE courses SET status='denied' WHERE id=$course_id");
    header('Location: admin-dashboard.php?message=denied');
    exit();
}

if (isset($_GET['delete_student'])) {
    $student_id = intval($_GET['delete_student']);
    mysqli_query($conn, "DELETE FROM students WHERE id=$student_id");
    header('Location: admin-dashboard.php?message=student_deleted');
    exit();
}

$popup = '';
if (isset($_POST['assign_course'])) {
    $student_id = intval($_POST['student_id']);
    $course_id = intval($_POST['course_id']);

    $check = mysqli_query($conn, "SELECT * FROM student_courses WHERE student_id=$student_id AND course_id=$course_id");
    if (mysqli_num_rows($check) > 0) {
        $popup = 'This course is already assigned to the selected student.';
    } else {
        mysqli_query($conn, "INSERT INTO student_courses (student_id, course_id) VALUES ($student_id, $course_id)");
        $popup = 'Course assigned successfully.';
    }
}

if (isset($_GET['message'])) {
    switch ($_GET['message']) {
        case 'approved':
            $popup = 'Course approved successfully.';
            break;
        case 'denied':
            $popup = 'Course marked as denied.';
            break;
        case 'student_deleted':
            $popup = 'Student removed.';
            break;
    }
}

$admin_toast = $popup;
$admin_toast_success = false;
$admin_toast_error = false;
if ($admin_toast !== '') {
    if (stripos($admin_toast, 'already') !== false) {
        $admin_toast_error = true;
    } else {
        $admin_toast_success = true;
    }
}

$students = mysqli_query($conn, 'SELECT * FROM students ORDER BY fullname ASC');

$courses = mysqli_query($conn, '
    SELECT courses.*, providers.fullname AS provider_name
    FROM courses
    JOIN providers ON courses.provider_id = providers.id
    ORDER BY courses.id DESC
');

$admin_page_title = 'Dashboard';
$admin_nav = 'dashboard';

include '_layout_top.php';
?>

<section class="admin-card">
    <h2 class="admin-card-title">Students <span>List</span></h2>
    <div class="admin-table-wrap">
        <table class="admin-data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($student = mysqli_fetch_assoc($students)) { ?>
                    <tr>
                        <td><?php echo (int) $student['id']; ?></td>
                        <td><?php echo htmlspecialchars((string) $student['fullname'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars((string) $student['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars((string) ($student['created_at'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <a class="btn-admin btn-admin--delete"
                                href="?delete_student=<?php echo (int) $student['id']; ?>"
                                onclick="return confirm('Remove this student?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<section class="admin-card">
    <h2 class="admin-card-title">Provider courses <span>Review</span></h2>
    <div class="admin-table-wrap">
        <table class="admin-data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Provider</th>
                    <th>Status</th>
                    <th>Assign</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                mysqli_data_seek($courses, 0);
                while ($course = mysqli_fetch_assoc($courses)) {
                    $st = strtolower((string) $course['status']);
                    $badgeClass = 'badge--pending';
                    if ($st === 'approved') {
                        $badgeClass = 'badge--approved';
                    }
                    if ($st === 'denied') {
                        $badgeClass = 'badge--denied';
                    }
                    ?>
                    <tr>
                        <td><?php echo (int) $course['id']; ?></td>
                        <td><?php echo htmlspecialchars((string) $course['title'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars((string) $course['provider_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars(ucfirst((string) $course['status']), ENT_QUOTES, 'UTF-8'); ?></span></td>
                        <td>
                            <?php if ($course['status'] === 'approved') { ?>
                                <form class="admin-assign-form" method="post" action="">
                                    <input type="hidden" name="course_id" value="<?php echo (int) $course['id']; ?>">
                                    <select name="student_id" required aria-label="Select student">
                                        <option value="">Select student</option>
                                        <?php
                                        $student_list2 = mysqli_query($conn, 'SELECT * FROM students ORDER BY fullname ASC');
                                        while ($student_option = mysqli_fetch_assoc($student_list2)) {
                                            echo '<option value="' . (int) $student_option['id'] . '">' . htmlspecialchars((string) $student_option['fullname'], ENT_QUOTES, 'UTF-8') . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <button type="submit" name="assign_course" class="btn-admin btn-admin--assign" value="1">Assign</button>
                                </form>
                            <?php } else { ?>
                                <span class="admin-muted">—</span>
                            <?php } ?>
                        </td>
                        <td>
                            <div class="admin-actions">
                                <?php if ($course['status'] === 'pending') { ?>
                                    <a class="btn-admin btn-admin--approve" href="?approve=<?php echo (int) $course['id']; ?>">Approve</a>
                                    <a class="btn-admin btn-admin--deny" href="?deny=<?php echo (int) $course['id']; ?>">Deny</a>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<?php
include '_layout_bottom.php';
