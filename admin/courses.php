<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin-login.php');
    exit();
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action === 'approve') {
        mysqli_query($conn, "UPDATE courses SET status='approved' WHERE id=$id");
    } elseif ($action === 'deny') {
        mysqli_query($conn, "UPDATE courses SET status='denied' WHERE id=$id");
    } elseif ($action === 'delete') {
        mysqli_query($conn, "DELETE FROM courses WHERE id=$id");
    }
    header('Location: courses.php?message=updated');
    exit();
}

$admin_toast = '';
$admin_toast_success = false;
$admin_toast_error = false;

if (isset($_GET['message']) && $_GET['message'] === 'updated') {
    $admin_toast = 'Courses list updated.';
    $admin_toast_success = true;
}

$courses = mysqli_query($conn, 'SELECT courses.*, providers.fullname AS provider_name FROM courses JOIN providers ON courses.provider_id=providers.id ORDER BY courses.id DESC');

$admin_page_title = 'Courses';
$admin_nav = 'courses';

include '_layout_top.php';
?>

<section class="admin-card">
    <h2 class="admin-card-title">All courses <span>Management</span></h2>
    <p style="margin:0 0 1rem;color:var(--ink-muted);font-size:0.92rem;">Approve, deny, or remove courses submitted by providers. Deletion cannot be undone.</p>
    <div class="admin-table-wrap">
        <table class="admin-data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Provider</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($courses)) {
                    $st = strtolower((string) $row['status']);
                    $badgeClass = 'badge--pending';
                    if ($st === 'approved') {
                        $badgeClass = 'badge--approved';
                    }
                    if ($st === 'denied') {
                        $badgeClass = 'badge--denied';
                    }
                    $desc = (string) ($row['description'] ?? '');
                    if (strlen($desc) > 120) {
                        $desc = substr($desc, 0, 117) . '…';
                    }
                    ?>
                    <tr>
                        <td><?php echo (int) $row['id']; ?></td>
                        <td><?php echo htmlspecialchars((string) $row['title'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="desc-cell"><?php echo htmlspecialchars($desc, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars((string) $row['provider_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars(ucfirst((string) $row['status']), ENT_QUOTES, 'UTF-8'); ?></span></td>
                        <td>
                            <div class="admin-actions">
                                <a class="btn-admin btn-admin--approve" href="?action=approve&amp;id=<?php echo (int) $row['id']; ?>">Approve</a>
                                <a class="btn-admin btn-admin--deny" href="?action=deny&amp;id=<?php echo (int) $row['id']; ?>">Deny</a>
                                <a class="btn-admin btn-admin--delete" href="?action=delete&amp;id=<?php echo (int) $row['id']; ?>" onclick="return confirm('Delete this course permanently?');">Delete</a>
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
