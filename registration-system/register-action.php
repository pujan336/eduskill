<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$fullname = trim((string) ($_POST['fullname'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$password = (string) ($_POST['password'] ?? '');

if ($fullname === '' || $email === '' || $password === '') {
    $_SESSION['error'] = 'Please fill in all fields.';
    header('Location: register.php');
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$check = $conn->prepare('SELECT id FROM students WHERE email=?');
$check->bind_param('s', $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    $_SESSION['error'] = 'That email is already registered.';
    header('Location: register.php');
    exit;
}

$stmt = $conn->prepare('INSERT INTO students(fullname,email,password) VALUES(?,?,?)');
$stmt->bind_param('sss', $fullname, $email, $hashedPassword);

if ($stmt->execute()) {
    $_SESSION['success'] = 'Registration successful. You can sign in now.';
} else {
    $_SESSION['error'] = 'Registration could not be completed. Try again.';
}

header('Location: register.php');
exit;
