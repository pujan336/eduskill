<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php';

if (!isset($_SESSION['student_id'])) {
    header('Location: login.php');
    exit;
}

$sid = (int) $_SESSION['student_id'];
$stmt = $conn->prepare('SELECT * FROM students WHERE id = ? LIMIT 1');
if (!$stmt) {
    die('Database error.');
}
$stmt->bind_param('i', $sid);
$stmt->execute();
$res = $stmt->get_result();
$student_profile = $res->fetch_assoc();
$stmt->close();

if (!$student_profile) {
    session_destroy();
    header('Location: login.php');
    exit;
}

$_SESSION['student_name'] = $student_profile['fullname'];
