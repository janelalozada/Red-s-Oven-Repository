<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<?php
  require 'config.php';
  session_start();
  
  if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Orders</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
</head>
<body>
  <div class="container mt-5">
    <h2>Pending Orders</h2>
    <a href="admin_dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Customer</th>
          <th>Items</th>
          <th>Total</th>
          <th>Payment Mode</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $result = $conn->query("SELECT * FROM orders WHERE status='pending'");
          while ($row = $result->fetch_assoc()):
        ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['customer_name'] ?></td>
          <td><?= $row['items'] ?></td>
          <td>₱<?= number_format($row['total_price'], 2) ?></td>
          <td><?= $row['payment_mode'] ?></td>
          <td>
            <form method="post" action="update_order_status.php">
              <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
              <button type="submit" name="complete" class="btn btn-success">Mark as Completed</button>
            </form>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
