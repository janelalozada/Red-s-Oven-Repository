<?php
session_start();
require 'config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Set the view parameter based on the URL query string
$view = isset($_GET['view']) ? $_GET['view'] : 'inventory';  // Default to 'inventory'

// Fetch all products for inventory
$products = $conn->query("SELECT * FROM cake");

// Fetch Pending Orders
$pending_orders = $conn->query("SELECT * FROM orders WHERE status = 'pending'");

// Fetch Completed Orders (Order History)
$completed_orders = $conn->query("SELECT * FROM orders WHERE status = 'completed'");

// Update stock quantity
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_stock'])) {
    $product_id = $_POST['product_id'];
    $new_stock = $_POST['new_stock'];
    
    // Get the current timestamp
    $last_updated = date('Y-m-d H:i:s');

    // Update the stock and last updated time in the database
    $update_query = "UPDATE cake SET product_qty = product_qty + ?, last_updated = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('isi', $new_stock, $last_updated, $product_id);
    $stmt->execute();
    
    // Redirect to avoid form resubmission
    header("Location: admin_dashboard.php?view=inventory");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       body {
            padding-top: 80px; /* Adjust based on your navbar height */
            background-color: #FDD3E8;
        }
        .sidebar {
            margin-left: 20px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 180px;
            padding-top: 100px;
            font-family: Georgia, serif;
            color: #494747;
            display: flex;
            flex-direction: column;
            text-align: center;
        }
        .sidebar a {
            padding: 5px 20px;
            text-decoration: none;
            font-size: 15px;
            display: block;
            color: #333;

        }
        .sidebar a:hover {
            background-color: #FFFFFF;
            border-radius: 10px;
        }
        .content {
            margin-left: 220px;
            margin-right: 50px;
            padding: 30px;
        }
         table {
        background-color: white;
        border-radius: 10px;
        width: 100%; /* Make the table responsive */
        }
        table thead th {
            background-color: #D9D9D9;
            text-align: center;
            font-family: Georgia, serif; 
            color: #494747;
        }
        table td, table th {
            text-align: center;
            vertical-align: middle; /* Centers content vertically */
            padding: 15px; /* Adjust padding for row height */
            font-family: Georgia, serif;
            color: #494747;
        }

        /* Inventory Table Widths */
        table#inventory td:nth-child(1), table#inventory th:nth-child(1) {
            width: 100px !important; /* ID column */
        }
        table#inventory td:nth-child(2), table#inventory th:nth-child(2) {
            width: 250px !important; /* Product Name column */
        }
        table#inventory td:nth-child(3), table#inventory th:nth-child(3) {
            width: 150px !important; /* Price column */
        }
        table#inventory td:nth-child(4), table#inventory th:nth-child(4) {
            width: 100px !important; /* Stock column */
        }
        table#inventory td:nth-child(5), table#inventory th:nth-child(5) {
            width: 200px !important; /* Last Updated column */
        }
        table#inventory td:nth-child(6), table#inventory th:nth-child(6) {
            width: 100px !important; /* Update Stock column */
        }


        /* Pending Orders Table Widths */
        table#pending-orders td:nth-child(1), table#pending-orders th:nth-child(1) {
            width: 80px; /* ID column */
        }
        table#pending-orders td:nth-child(2), table#pending-orders th:nth-child(2) {
            width: 200px; /* Name column */
        }
        table#pending-orders td:nth-child(3), table#pending-orders th:nth-child(3) {
            width: 250px; /* Products column */
        }
        table#pending-orders td:nth-child(4), table#pending-orders th:nth-child(4) {
            width: 150px; /* Amount Paid column */
        }
        table#pending-orders td:nth-child(5), table#pending-orders th:nth-child(5) {
            width: 120px; /* Payment Mode column */
        }
        table#pending-orders td:nth-child(6), table#pending-orders th:nth-child(6) {
            width: 120px; /* Status column */
        }
        table#pending-orders td:nth-child(7), table#pending-orders th:nth-child(7) {
            width: 150px; /* Action column */
        }

        /* Order History Table Widths */
        table#order-history td:nth-child(1), table#order-history th:nth-child(1) {
            width: 80px; /* ID column */
        }
        table#order-history td:nth-child(2), table#order-history th:nth-child(2) {
            width: 200px; /* Name column */
        }
        table#order-history td:nth-child(3), table#order-history th:nth-child(3) {
            width: 250px; /* Products column */
        }
        table#order-history td:nth-child(4), table#order-history th:nth-child(4) {
            width: 150px; /* Amount Paid column */
        }
        table#order-history td:nth-child(5), table#order-history th:nth-child(5) {
            width: 120px; /* Payment Mode column */
        }
        table#order-history td:nth-child(6), table#order-history th:nth-child(6) {
            width: 120px; /* Status column */
        }
        .btn-primary {
            background-color: #D9D9D9 !important;
            border-color: #D9D9D9 !important;
            color: black !important;
        }
        .btn-danger {
            background-color: white !important;
            border-color: white !important;
            color: #F98CC2 !important;
    </style>
</head>
<body>
    <!-- Navbar start -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #FDD3E8;">
            <a class="navbar-brand" href="homepage.php">
                <img src="image/redovenlogo.png" style="height:65px; margin: 10px 0 0 25px;">
            </a>
        </nav>
    <!-- Navbar end -->

    <div class="sidebar">
        <h3 class="text-center">Admin Panel</h3>
        <a href="?view=inventory">Inventory List</a>
        <a href="?view=pending_orders">Pending Orders</a>
        <a href="?view=order_history">Order History</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <div class="content">
        <h3 style="font-family: Georgia, serif; color: #494747;">Welcome, Admin!</h3>
        <?php if ($view == 'inventory'): ?>
            <h4 style="font-family: Georgia, serif; color: #494747;">Inventory List</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Last Updated</th>
                        <th>Update Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $products->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['product_name']; ?></td>
                        <td>₱<?= number_format($row['product_price'], 2); ?></td>
                        <td><?= $row['product_qty']; ?></td>
                        <td><?= $row['last_updated'] ? date('Y-m-d H:i:s', strtotime($row['last_updated'])) : 'Never'; ?></td>
                        <td>
                        <form method="POST" action="" style="display: inline-flex; align-items: center; margin: 0;">
                            <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
                            <input type="number" name="new_stock" value="1" min="1" class="form-control" style="width: 60px; margin-right: 5px; padding: 5px;">
                            <button type="submit" name="update_stock" class="btn btn-primary btn-sm" style="padding: 5px 10px;">Update Stock</button>
                        </form>
                    </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        <?php elseif ($view == 'pending_orders'): ?>
            <h4 class="mt-4" style="font-family: Georgia, serif; color: #494747;">Pending Orders</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Products</th>
                        <th>Amount Paid</th>
                        <th>Payment Mode</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $pending_orders->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['products']; ?></td>
                        <td>₱<?= number_format($row['amount_paid'], 2); ?></td>
                        <td><?= $row['pmode']; ?></td>
                        <td><?= $row['status']; ?></td>
                        <td>
                            <a href="update_order.php?id=<?= $row['id']; ?>&status=completed" class="btn btn-success btn-sm">Mark as Completed</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        <?php elseif ($view == 'order_history'): ?>
            <h4 class="mt-4" style="font-family: Georgia, serif; color: #494747;">Order History</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Products</th>
                        <th>Amount Paid</th>
                        <th>Payment Mode</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $completed_orders->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['products']; ?></td>
                        <td>₱<?= number_format($row['amount_paid'], 2); ?></td>
                        <td><?= $row['pmode']; ?></td>
                        <td><?= $row['status']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
