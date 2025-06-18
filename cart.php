<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cart</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" />
  <style>
    thead {
      background-color: white;
      color: black;
    }
    .product-image {
      width: 80px;
    }
    td, th {
      vertical-align: middle !important;
      color: #3D383A;
      font-family: Georgia, serif;
    }
  </style>
</head>

<body style="background-color: #FDD3E8;">

  <nav class="navbar navbar-expand-md navbar-dark">
    <a class="navbar-brand" href="homepage.php">
      <img src="image/redovenlogo.png" style="height:65px; margin: 10px 0 0 25px;">
    </a>
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
        <a class="nav-link" href="cart.php"><img src="logos/cart.png" style="height: 38px;"> <span id="cart-item" class="badge badge-danger"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="checkout.php"><img src="logos/account.png" style="height: 38px;"></a>
      </li>
    </ul>
  </nav>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div style="display:<?php echo isset($_SESSION['showAlert']) ? $_SESSION['showAlert'] : 'none'; ?>;" class="alert alert-success alert-dismissible mt-3">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php if (isset($_SESSION['message'])) echo $_SESSION['message']; unset($_SESSION['showAlert'], $_SESSION['message']); ?></strong>
        </div>

        <div class="table-responsive mt-2">
          <h3 class="text-center mb-4 mt-4" style="font-weight: bold; font-family: Georgia, serif; color: #494747;">
            Products in your Cart
          </h3>

          <table class="table table-bordered table-striped text-center" style="background-color: #D9D9D9; border-radius: 10px;">
            <thead>
              <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>
                  <a href="action.php?clear=all" class="badge p-1" onclick="return confirm('Are you sure want to clear your cart?');" style="background-color: white; color: #3D383A; font-size: 17px;">
                    <img src="logos/delete.png" style="height: 12px; margin-right: 2px; margin-top: -4px;">Clear Cart
                  </a>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              require 'config.php';
              $stmt = $conn->prepare('SELECT * FROM cart');
              $stmt->execute();
              $result = $stmt->get_result();
              $grand_total = 0;

              while ($row = $result->fetch_assoc()):
              ?>
              <tr>
                <td><img src="<?= $row['product_image'] ?>" class="product-image"></td>
                <td><?= $row['product_name'] ?></td>
                <td>&#8369;&nbsp;<?= number_format($row['product_price'], 2); ?></td>

                <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                <input type="hidden" class="pid" value="<?= $row['id'] ?>">

                <td>
                  <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:75px; margin: 0 auto;">
                </td>

                <td>&#8369;&nbsp;<?= number_format($row['total_price'], 2); ?></td>
                <td>
                  <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');">
                    <img src="logos/delete.png" style="height: 20px;">
                  </a>
                </td>
              </tr>
              <?php $grand_total += $row['total_price']; ?>
              <?php endwhile; ?>

              <tr>
                <td colspan="3">
                  <a href="heart.php" class="btn" style="background-color: white; color: #F98CC2; border-radius: 10px;">
                    <img src="logos/cart.png" style="height: 20px; margin-top: -5px; margin-right: 10px;">Continue Shopping
                  </a>
                </td>
                <td><b>Grand Total</b></td>
                <td><b>&#8369;&nbsp;<?= number_format($grand_total, 2); ?></b></td>
                <td>
                  <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>" style="background-color: white; color: #F98CC2; border-radius: 10px; border: none; width: 150px;">Checkout</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function () {
    // Update item quantity
    $(".itemQty").on('change', function () {
      var $el = $(this).closest('tr');
      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $(this).val();

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
          qty: qty,
          pid: pid,
          pprice: pprice
        },
        success: function (response) {
          location.reload();
        }
      });
    });

    // Load cart item count
    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: { cartItem: "cart_item" },
        success: function (response) {
          $("#cart-item").html(response);
        }
      });
    }

    load_cart_item_number();
  });
  </script>

</body>
</html>
