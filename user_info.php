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

    // Query to get user information from the database
    $sql = "SELECT first_name, last_name, email, password FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Fetch user data
    if ($row = $result->fetch_assoc()) {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        // Password should be kept hidden or securely hashed; not displayed directly
        $password = "********"; // Placeholder for password, do not display the real password
    } else {
        // If user not found
        echo "User not found!";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
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
        .btn-warning {
            background-color: #F09A9A;
            color: white;
            border: none;
        }
        .btn-warning:hover {
            background-color: #F98CC2;  /* New hover background color */
            color: white;  /* Text color on hover (optional) */
            border: none;  /* Ensure no border on hover */
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
        <h2 class="text-center" style="font-family: Georgia, serif; color: #494747;">User Information</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="font-family: Georgia, serif; color: #494747;">Hello, <?= $first_name . " " . $last_name; ?>!</h4>
                        <p style="font-family: Georgia, serif; color: #494747;"><strong>Email:</strong> <?= $email; ?></p>
                        <p style="font-family: Georgia, serif; color: #494747;"><strong>Password:</strong> <?= $password; ?></p>
                        <a href="edit_user_info.php" class="btn btn-warning" style="font-family: Georgia, serif;">Edit Info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Optional Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
