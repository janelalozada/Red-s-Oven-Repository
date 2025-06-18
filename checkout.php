<?php
session_start();
require 'config.php';

// Fetch the user's information if logged in
$user_id = $_SESSION['user_id'] ?? null;
$user_info = null;

if ($user_id) {
    $sql = "SELECT first_name, last_name, email FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_info = $result->fetch_assoc();
}

$grand_total = 0;
$allItems = '';
$items = [];

$sql = "SELECT CONCAT(product_name, '(', qty, ')') AS ItemQty, total_price FROM cart";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $grand_total += $row['total_price'];
    $items[] = $row['ItemQty'];
}
$allItems = implode(', ', $items);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Checkout</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<body>
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
    .btn-place-order {
      background-color: #F09A9A;
      border-color: #F09A9A;
      color: white;
    }

    .btn-place-order:hover {
      background-color: #F98CC2;
      border-color: #F98CC2;
    }

  </style>

  <nav class="navbar navbar-expand-md navbar-dark">
    <a class="navbar-brand" href="homepage.php"><img src="image/redovenlogo.png" style="height:65px; margin: 10px 0 0 25px;"></a>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <form action="search.php" method="post">
            <input class="search-txt" type="text" placeholder="Search" name="search" style="outline: none; background: white; border: 1px; border-radius: 50px; text-indent: 15px; width: 250px; height: 35px; margin-top: 13px; margin-right: 30px;">
            <div class="image-upload" style="margin-top:-34px; margin-left: 162px;">
              <label for="file-upload">
                <img src="logos/search.png" style="height: 25px; margin-left: 50px; margin-top: 4px; pointer-events: none;">
              </label>
            </div>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><img src="logos/cart.png" style="height: 40px;"> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php"><img src="logos/account.png" style="height: 40px;"></a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="side-buttons">
    <a href="user_info.php" class="btn">User Info</a>
    <a href="past_orders.php" class="btn">Order History</a>
    <a href="logout_user.php" class="btn">Logout</a>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
        <h4 class="text-center text-info p-2">Complete your order!</h4>
        <div class="jumbotron p-3 mb-2 text-center">
          <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
          <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
          <h5><b>Total Amount Payable : ₱</b><?= number_format($grand_total, 2) ?></h5>
        </div>
        <form action="" method="post" id="placeOrder">
          <input type="hidden" name="products" value="<?= $allItems; ?>">
          <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?= $user_info ? $user_info['first_name'] . ' ' . $user_info['last_name'] : ''; ?>" required>
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" value="<?= $user_info ? $user_info['email'] : ''; ?>" required>
          </div>
          <div class="form-group">
            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
          </div>
          <div class="form-group">
            <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Enter Delivery Address Here..."></textarea>
          </div>
          <h6 class="text-center lead">Select Payment Mode</h6>
          <div class="form-group">
            <select name="pmode" class="form-control">
              <option value="" selected disabled>-Select Payment Mode-</option>
              <option value="cod">Cash On Delivery</option>
              <option value="netbanking">Net Banking</option>
              <option value="cards">Debit/Credit Card</option>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Place Order" class="btn btn-place-order btn-block">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function() {

      // Sending Form data to the server
      $("#placeOrder").submit(function(e) {
        e.preventDefault();
        $.ajax({
          url: 'action.php',
          method: 'post',
          data: $('form').serialize() + "&action=order",
          success: function(response) {
            $("#order").html(response);
          }
        });
      });

      // Load total no.of items added in the cart and display in the navbar
      load_cart_item_number();

      function load_cart_item_number() {
        $.ajax({
          url: 'action.php',
          method: 'get',
          data: {
            cartItem: "cart_item"
          },
          success: function(response) {
            $("#cart-item").html(response);
          }
        });
      }
    });
  </script>
</body>

</html>
