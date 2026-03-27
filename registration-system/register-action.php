<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // check if email exists
    $check = $conn->prepare("SELECT id FROM students WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['error'] = "Email already registered!";
        header("Location: register.php");
        exit();
    }

    // insert data
    $stmt = $conn->prepare("INSERT INTO students(fullname,email,password) VALUES(?,?,?)");
    $stmt->bind_param("sss", $fullname, $email, $hashedPassword);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful!";
    } else {
        $_SESSION['error'] = "Registration failed!";
    }

    header("Location: register.php");
    exit();
}
