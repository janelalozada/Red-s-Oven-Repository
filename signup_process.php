<?php
session_start();
require 'config.php'; // Make sure this file connects to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Check if any field is empty
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $_SESSION['message'] = "All fields are required!";
        header("Location: signup.php");
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format!";
        header("Location: signup.php");
        exit();
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT email FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['message'] = "Email is already registered!";
        header("Location: signup.php");
        exit();
    }

    $stmt->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);

    if ($stmt->execute()) {
        // Automatically log in the user
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['user_name'] = $first_name . " " . $last_name;
        header("Location: homepage.php");
        exit();
    } else {
        $_SESSION['message'] = "Something went wrong. Please try again.";
        header("Location: signup.php");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: signup.php");
    exit();
}
?>
