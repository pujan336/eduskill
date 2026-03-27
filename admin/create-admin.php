<?php
include "db.php"; // Make sure this path is correct

$fullname = "Super Admin";
$email = "admin@eduskill.com";
$password = password_hash("Admin@123", PASSWORD_DEFAULT); // hash the password

// Check if admin already exists
$check = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
    die("Admin already exists!");
}

// Insert admin
$sql = "INSERT INTO admins (fullname, email, password) VALUES ('$fullname', '$email', '$password')";
if (mysqli_query($conn, $sql)) {
    echo "Admin added successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}
