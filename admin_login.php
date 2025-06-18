<?php
session_start();
require 'config.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check admin credentials
    if ($username === 'admin' && $password === 'password123') { // Change this to your real admin credentials
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid credentials!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FDD3E8;
        }
        .login-container {
            max-width: 400px;
            margin-top: 130px;
            margin-right: auto;
            margin-bottom: 0;
            margin-left: auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #F09A9A;
            border-color: #F09A9A;
            color: white;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #F98CC2; /* your new hover color */
            border-color: #F98CC2;
            color: white;
        }
        .form-control {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <!-- Navbar start -->
    <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="homepage.php"><img src="image/redovenlogo.png" style="height:65px; margin: 10px 0 0 25px;"></a>
    </nav>
    <!-- Navbar end -->

    <div class="login-container">
        <h2 style="font-family: Georgia, serif; color: #494747;">Admin Login</h2>
        <form method="POST">
            <div class="form-group">
                <label for="username" style="font-family: Georgia, serif; color: #494747;">Username:</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password" style="font-family: Georgia, serif; color: #494747;">Password:</label> 
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary" style="font-family: Georgia, serif; color: white;">Login</button>
        </form>
    </div>

</body>
</html>
