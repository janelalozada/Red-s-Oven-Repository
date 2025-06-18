<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Red's Oven</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <style>
      body {
        background-color: #FDD3E8;
      }
      .image-upload>input {
        display: none;
         
      }
      .unorderedlist
      {
        list-style-type: none;
        background-color: none;
        font-family: ariel, helvetic, sans-serif; 
        margin-right: 250px;
        margin-left: 250px;
      }
      .data
      {
        margin: 40px;
        text-indent: 10px;
        float: left;
      }     
      .data a
      {
        color: #494747;
        text-align: center;
        text-decoration: none;
        border-radius: 50px;
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
          <form method="post">
            <input class="search-txt" type="text" placeholder="Search"name="search" style="outline: none; background: white; border: 1px; border-radius: 50px; text-indent: 15px; width: 250px; height: 35px; margin-top: 13px; margin-right: 30px;">
            <div class="image-upload" style="margin-top:-34px; margin-left: 162px;">
              <label for="file-upload">
              <img src="logos/search.png" style="height: 25px; margin-left: 50px; margin-top: 4px; pointer-events: none; ">
              </label>
            <input id="file-input" type="file"name="submit"/>
            </form>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><img src="logos/cart.png" style="height: 38px;"> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php"><img src="logos/account.png" style="height: 38px;"></a>
        </li>
        
      </ul>
    </div>
  </nav>
  <!-- Navbar end -->
<div>
    <ul class="unorderedlist">
        <li class="data"><a  href="index.php">Heart Cake</a></li>
        <li class="data"><a  href="face.php">Classic Cake</a></li>
        <li class="data"><a  href="body.php">Bento</a></li>
        <li class="data"><a  href="sets.php">Special</a></li>
        <li class="data"><a  href="tools.php">Bundle</a></li>
    </ul>
  </div>
  <!-- Displaying Products Start -->
  <section style="height: 50px; margin-top: 150px; margin-bottom: -70px;"><h1 style="text-align: center;">Sets</h1></section>
  <div class="container" style="margin-top: 120px; z-index: -1;">
    <div id="message"></div>
    <div class="row mt-2 pb-3">
      <?php
        include 'config.php';
        $stmt = $conn->prepare('SELECT * FROM cake WHERE brand_name ="set";');
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()):
      ?>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-2" style="z-index: 1; margin-right: 95px;">
        <div class="card-deck" style="height: 500px; width: 350px;">
          <div class="card p-2 border-secondary mb-2">
            <img src="<?= $row['product_image'] ?>" class="card-img-top" height="250">
            <div class="card-body p-1">
              <h6 style="font-size: 16px; text-align: center; font-family: arial, helvetic font-weight: bold;"><?= $row['product_name'] ?></h6>
              <h5 class="card-text text-center text-danger">₱</i>&nbsp;&nbsp;<?= number_format($row['product_price'],2) ?></h5>

            </div>
            <div class="card-footer p-1">
              <form action="" class="form-submit">
                <div class="row p-2">
                  <div class="col-md-6 py-1 pl-4">
                    <b>Quantity : </b>
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control pqty" value="<?= $row['product_qty'] ?>">
                  </div>
                </div>
                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
                <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
                <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
                <button class="btn btn-info btn-block addItemBtn" style="background: green;"><img src="logos/cart.png" style="height: 22px; margin-right:7px; margin-top: -5px;">Add to cart</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>

  <!-- Displaying Products Category Start! -->
  <!-- Displaying Products End -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var pimage = $form.find(".pimage").val();
      var pcode = $form.find(".pcode").val();

      var pqty = $form.find(".pqty").val();

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
          pid: pid,
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          pimage: pimage,
          pcode: pcode
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
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

<?php

$con = new PDO("mysql:host=localhost;dbname=red_oven",'root','');

if (isset($_POST["submit"])) {
  $str = $_POST["search"];
  $sth = $con->prepare("SELECT * FROM cake WHERE brand_name = '$str'");

  $sth->setFetchMode(PDO:: FETCH_OBJ);
  $sth -> execute();

    while($row = $sth->fetch()){
      echo $row->product_name;
      echo "<br>";
    }
  }
?>
