<?php
session_start();
require 'config.php';

// Add product to cart (1 qty only)
if (isset($_POST['pid'])) {
  $pid = $_POST['pid'];
  $pname = $_POST['pname'];
  $pprice = $_POST['pprice'];
  $pimage = $_POST['pimage'];
  $pcode = $_POST['pcode'];
  $pqty = 1; // Always add one
  $total_price = $pprice * $pqty;

  // Check if product already in cart
  $stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code = ?');
  $stmt->bind_param('s', $pcode);
  $stmt->execute();
  $res = $stmt->get_result();
  $code = $res->fetch_assoc()['product_code'] ?? '';

  if (!$code) {
    $query = $conn->prepare('INSERT INTO cart (product_name, product_price, product_image, qty, total_price, product_code) VALUES (?, ?, ?, ?, ?, ?)');
    $query->bind_param('sdsdis', $pname, $pprice, $pimage, $pqty, $total_price, $pcode);
    $query->execute();

    echo '<div class="alert alert-success alert-dismissible mt-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Item added to your cart!</strong>
          </div>';
  } else {
    echo '<div class="alert alert-danger alert-dismissible mt-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Item already in your cart!</strong>
          </div>';
  }
}



// Count items in cart
if (isset($_GET['cartItem']) && $_GET['cartItem'] == 'cart_item') {
  $stmt = $conn->prepare('SELECT * FROM cart');
  $stmt->execute();
  $stmt->store_result();
  echo $stmt->num_rows;
}

// Remove one item
if (isset($_GET['remove'])) {
  $id = $_GET['remove'];
  $stmt = $conn->prepare('DELETE FROM cart WHERE id = ?');
  $stmt->bind_param('i', $id);
  $stmt->execute();

  $_SESSION['showAlert'] = 'block';
  $_SESSION['message'] = 'Item removed from the cart!';
  header('location:cart.php');
  exit();
}

// Clear all items
if (isset($_GET['clear'])) {
  $conn->query('DELETE FROM cart');
  $_SESSION['showAlert'] = 'block';
  $_SESSION['message'] = 'All items removed from the cart!';
  header('location:cart.php');
  exit();
}

// Update qty & total
if (isset($_POST['qty'])) {
  $qty = $_POST['qty'];
  $pid = $_POST['pid'];
  $pprice = $_POST['pprice'];
  $tprice = $qty * $pprice;

  $stmt = $conn->prepare('UPDATE cart SET qty = ?, total_price = ? WHERE id = ?');
  $stmt->bind_param('idi', $qty, $tprice, $pid);
  $stmt->execute();
}

// Checkout and deduct stock
if (isset($_POST['action']) && $_POST['action'] == 'order') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $products = $_POST['products'];
  $grand_total = $_POST['grand_total'];
  $address = $_POST['address'];
  $pmode = $_POST['pmode'];
  $data = '';

  // Loop through cart
  $cartQuery = $conn->query("SELECT product_code, qty FROM cart");
  while ($cartItem = $cartQuery->fetch_assoc()) {
    $product_code = $cartItem['product_code'];
    $qty = $cartItem['qty'];

    // Check available stock
    $stockCheck = $conn->prepare("SELECT product_qty FROM cake WHERE product_code = ?");
    $stockCheck->bind_param("s", $product_code);
    $stockCheck->execute();
    $stockResult = $stockCheck->get_result();
    $product = $stockResult->fetch_assoc();

    if ($product && $product['product_qty'] >= $qty) {
      // Deduct stock
      $updateStock = $conn->prepare("UPDATE cake SET product_qty = product_qty - ? WHERE product_code = ?");
      $updateStock->bind_param("is", $qty, $product_code);
      $updateStock->execute();
    } else {
      echo "<div class='text-danger text-center'>Insufficient stock for product: $product_code</div>";
      exit();
    }
  }

  // Insert order
  $stmt = $conn->prepare('INSERT INTO orders (name, email, phone, address, pmode, products, amount_paid) VALUES (?, ?, ?, ?, ?, ?, ?)');
  $stmt->bind_param('sssssss', $name, $email, $phone, $address, $pmode, $products, $grand_total);
  $stmt->execute();

  // Clear cart
  $conn->query('DELETE FROM cart');

  // Order summary
	$data .= '
	<div style="max-width: 600px; margin: 40px auto; font-family: Georgia, serif; color: #494747;">
	  <div style="border: 1px solid #f3f3f3; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); background-color: #fff;">
	    <div style="background-color: #F98CC2; color: white; padding: 20px; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
	      <h2 style="margin: 0;">Order Confirmation</h2>
	    </div>
	    <div style="padding: 30px;">
	      <h3 style="color: #F98CC2; text-align: center;">Thank You!</h3>
	      <p style="text-align: center; font-size: 18px; margin-bottom: 30px;">Your order has been placed successfully.</p>
	      <hr>
	      <p><strong>Items Purchased:</strong> ' . $products . '</p>
	      <p><strong>Name:</strong> ' . $name . '</p>
	      <p><strong>Email:</strong> ' . $email . '</p>
	      <p><strong>Phone:</strong> ' . $phone . '</p>
	      <p><strong>Shipping Address:</strong> ' . $address . '</p>
	      <p><strong>Total Amount Paid:</strong> ₱' . number_format($grand_total, 2) . '</p>
	      <p><strong>Payment Mode:</strong> ' . $pmode . '</p>
	    </div>
	  </div>
	</div>';

  echo $data;
}
?>
