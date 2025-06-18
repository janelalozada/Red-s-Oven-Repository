<?php 
require 'config.php';
session_start();

// Assuming the user's email is stored in the session
$user_email = $_SESSION['user_email'] ?? '';

// Fetch user's past orders
$sql = "SELECT products, amount_paid, status, pmode, created_at FROM orders WHERE email = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Orders</title>
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

        /* Optional: To make the table header stand out */
        .table thead th {
            background-color: #F98CC2;
            color: white;
        }

        /* Make the table a bit wider */
        .table {
            width: 100%; /* Ensures the table takes full width */
        }

        .table th, .table td {
            text-align: center; /* Aligns content to center */
        }

        /* Remove background from the status badges */
        .badge {
            background-color: transparent;  /* Remove background color */
            color: inherit;  /* Keep text color */
            padding: 5px 10px; /* Add padding for better spacing */
            font-size: 16px;
            font-weight: inherit;
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
        <h2 class="text-center" style="font-family: Georgia, serif; color: #494747;">Order History</h2>
        <div class="row justify-content-center">
            <div class="col-md-10"> <!-- Increased column size for more space -->
                <div class="card">
                    <div class="card-body">
                        <?php if ($result->num_rows > 0): ?>
                            <table class="table table-bordered" style="font-family: Georgia, serif; color: #494747;">
                                <thead class="main">
                                    <tr>
                                        <th style="width: 30%;">Products</th>
                                        <th style="width: 25%;">Total Amount</th>
                                        <th style="width: 20%;">Payment Mode</th>
                                        <th style="width: 10%;">Status</th>
                                        <th style="width: 15%;">Order Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['products']) ?></td>
                                        <td>₱<?= number_format($row['amount_paid'], 2) ?></td>
                                        <td><?= htmlspecialchars($row['pmode']) ?></td>
                                        <td>
                                            <?php if ($row['status'] == 'Pending'): ?>
                                                <span class="badge text-warning">Pending</span>
                                            <?php elseif ($row['status'] == 'Completed'): ?>
                                                <span class="badge"><?= htmlspecialchars($row['status']) ?></span>
                                            <?php elseif ($row['status'] == 'Cancelled'): ?>
                                                <span class="badge text-danger">Cancelled</span>
                                            <?php else: ?>
                                                <span class="badge text-secondary"><?= htmlspecialchars($row['status']) ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $row['created_at'] ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p class="text-center">You have no past orders.</p>
                        <?php endif; ?>
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
