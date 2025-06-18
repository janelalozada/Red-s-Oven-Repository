<?php
    // Include the database connection file
    require 'config.php';

    // Start session to access session data
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }

    // Retrieve the logged-in user's ID from session
    $user_id = $_SESSION['user_id'];

    // Fetch user data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // If password is provided, hash it
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            // Keep the current password if not changing
            $password = null;
        }

        // Query to update user information
        $sql = "UPDATE user SET email = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($password) {
            $stmt->bind_param("ssi", $email, $password, $user_id);
        } else {
            $stmt->bind_param("si", $email, $user_id);
        }

        if ($stmt->execute()) {
            echo "Information updated successfully!";
            header("Location: user_info.php"); // Redirect back to the user info page
        } else {
            echo "Error updating information.";
        }
    }

    // Query to get user information from the database
    $sql = "SELECT first_name, last_name, email FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
    } else {
        echo "User not found!";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Info</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Added Font Awesome CDN -->
    <style>
        body {
            background-color: #FDD3E8;
        }

        .side-buttons {
            position: fixed;
            left: 20px;
            top: 100px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .side-buttons a {
            background-color: #FFFFFF;
            color: #F98CC2;
            padding: 5px;
            border-radius: 10px;
            text-align: center;
            text-decoration: none;
            width: 180px;
            font-family: Georgia, serif;
        }

        .side-buttons a:hover {
            background-color: #F98CC2;
        }

        .eye-icon {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background-color: transparent; /* Removed background color */
            border: none; /* Ensure no border is applied */
        }
        button[type="submit"] {
            background-color: #F09A9A; /* Updated background color */
            color: white; /* Set text color to white */
            border: none; /* Remove border */
            font-weight: bold; /* Optional: makes text bold */
            font-family: Georgia, serif;
        }

        button[type="submit"]:hover {
            background-color: #F98CC2; /* Slightly darker shade on hover */
        }
    </style>
</head>

<body>
    <!-- Navbar start -->
    <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="homepage.php"><img src="image/redovenlogo.png" style="height:65px; margin: 10px 0 0 25px;"></a>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><img src="logos/cart.png" style="height: 40px;"> <span id="cart-item" class="badge badge-danger"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="checkout.php"><img src="logos/account.png" style="height: 40px;"></a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Navbar end -->

    <!-- Side buttons -->
    <div class="side-buttons">
        <a href="user_info.php" class="btn">User Info</a>
        <a href="past_orders.php" class="btn">Order History</a>
        <a href="logout_user.php" class="btn">Logout</a>
    </div>

    <div class="container mt-5">
        <h2 class="text-center" style="  font-family: Georgia, serif; color: #494747;">Edit User Information</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="font-family: Georgia, serif; color: #494747;">Edit Info for <?= $first_name . " " . $last_name; ?></h4>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="email" style="font-family: Georgia, serif; color: #494747;" >Email</label>
                                <input type="email" name="email" class="form-control" value="<?= $email; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password" style="font-family:Georgia, serif; color: #494747;" >Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Leave empty to keep current password">
                                    <div class="input-group-append">
                                        <span class="input-group-text eye-icon" onclick="togglePassword()">
                                            <i class="fas fa-eye" id="eye-icon"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Update Info</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash'); // Change icon to "eye-slash"
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye'); // Change icon back to "eye"
            }
        }
    </script>
</body>

</html>
