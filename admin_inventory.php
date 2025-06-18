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

  if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $conn->query("DELETE FROM products WHERE id=$id");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Inventory</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
</head>
<body>
  <div class="container mt-5">
    <h2>Inventory List</h2>
    <a href="admin_dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Product Name</th>
          <th>Price</th>
          <th>Stock</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $result = $conn->query("SELECT * FROM products");
          while ($row = $result->fetch_assoc()):
        ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['product_name'] ?></td>
          <td><?= $row['price'] ?></td>
          <td><?= $row['stock'] ?></td>
          <td>
            <form method="post">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <button type="submit" name="delete" class="btn btn-danger">Delete</button>
            </form>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
