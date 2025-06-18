<?php
session_start(); // Move this to the top before any HTML output

$con = new PDO("mysql:host=localhost;dbname=red_oven", 'root', '');

if (isset($_POST["submit"])) {
  $str = $_POST["search"];
  $sth = $con->prepare("SELECT * FROM cake WHERE brand_name = :brand_name");
  $sth->bindParam(':brand_name', $str, PDO::PARAM_STR);
  $sth->execute();
}

?>

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
        display: flex;
        flex-direction: column;
        min-height: 150vh;
      }
      .content-wrapper {
        flex: 1;
      }
      .image-upload>input {
        display: none; 
      }
      .unorderedlist {
          list-style-type: none;
          font-family: Georgia, serif;
          display: flex; /* Enables flexbox */
          justify-content: center; /* Centers items horizontally */
          padding: 0; /* Removes default padding */
          margin: 20px auto; /* Centers the list and provides spacing */
          width: 100%; /* Ensures it spans the full width */
      }

      .unorderedlist .data {
          margin: 0 20px; /* Adds spacing between items */
      }

      .unorderedlist .data a {
          color: #494747;
          text-decoration: none;
          font-size: 18px;
          font-weight: bold;
          padding: 10px 15px;
          border-radius: 5px;
      }
      .container {
        position: center;
        width: 50%;
      }

      /* Style the button and place it in the middle of the container/image */
      .container .btn {
        margin-top: 14px;
        position: absolute;
        top: 86%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        background-color:#ebebe0;
        color: white;
        font-size: 16px;
        padding: 8px 30px;
        border: none;
        cursor: pointer;
        border-radius: 15px;
        border: 2px solid black;
      }

      .container .btn:hover {
        background-color:  #afaf83;
      }
      .slidershow {
          width: 900px;
          height: 550px;
          margin-top: 80px;
          overflow: hidden;
          z-index:-1;
      }

      .middle {
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
        
      }

      .navigation {
          position: absolute;
          bottom: 20px;
          left: 50%;
          transform: translateX(-50%);
          display: flex;
      }

      .bar {
          width: 5px;
          height: 5px;
          border: 2px solid #fff;
          padding: 5px;
          border-radius: 10px;
          margin: 4px;
          cursor: pointer;
          transition: 0.4s;
      }

      .bar:hover {
          background: black;
      }

      input[name="r"] {
          position: absolute;
          visibility: hidden;
      }

      .slides {
          width: 500%;
          height: 100%;
          display: flex;
      }

      .slide {
          width: 20%;
          transition: 0.5s;
      }

      .slide img {
          width: 100%;
          height: 100%;
      }

      #r1:checked~.s1 {
          margin-left: 0;
      }

      #r2:checked~.s1 {
          margin-left: -20%;
      }

      #r3:checked~.s1 {
          margin-left: -40%;
      }

      #r4:checked~.s1 {
          margin-left: -60%;
      }

      #r5:checked~.s1 {
          margin-left: -80%;
      }

      #r6:checked~.s1 {
          margin-left: -100%;
      }
      footer {
          background-color: #FDD3E8;
        }

        footer .text-center {
          background-color: #f1b5cd;
          padding: 15px;
        }

    </style>
</head>
<body>
<body>
  <!-- Navbar start -->
  <nav class="navbar navbar-expand-md navbar-dark">
    <a class="navbar-brand" href="homepage.php"><img src="image/redovenlogo.png" style="height:65px; margin: 10px 0 0 25px;"></a>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <form action="search.php" method="post">
            <input class="search-txt" type="text" placeholder="Search" name="search" style="outline: none; background: white; border: 1px; border-radius: 50px; text-indent: 15px; width: 250px; height: 35px; margin-top: 13px; margin-right: 30px;">
            <button type="submit" name="submit" style="border: none; background: none;">
              <img src="logos/search.png" style="height: 25px; margin-left: -120px; margin-top: -5px; pointer-events: none;">
            </button>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><img src="logos/cart.png" style="height: 38px;"> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
        <li class="nav-item">
          <?php
          if (isset($_SESSION['user_id'])) {
              echo '<a class="nav-link" href="checkout.php"><img src="logos/account.png" style="height: 38px;"></a>';
          } else {
              echo '<a class="nav-link" href="login.php"><img src="logos/account.png" style="height: 38px;"></a>';
          }
          ?>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navbar end -->
  
  <!-- Start content wrapper -->
  <div class="content-wrapper">
    <div>
        <ul class="unorderedlist">
            <li class="data"><a  href="heart.php">Heart Cake</a></li>
            <li class="data"><a  href="circle.php">Classic Cake</a></li>
            <li class="data"><a  href="bento.php">Bento</a></li>
            <li class="data"><a  href="special.php">Special</a></li>
            <li class="data"><a  href="bundle.php">Bundle</a></li>
            <li class="data"><a  href="custom.php">Customize Cake</a></li>
        </ul>
    </div>
    
    <div class="slidershow middle">
      <div class="slides">
          <input type="radio" name="r" id="r1" checked>
        <div class="slide s1">
          <img src="homepageimages/display.png" alt="">
        </div>
      
      </div>

      <div class="navigation">
        <label for="r1" class="bar"></label>
      </div>
    </div>
  </div> <!-- End content-wrapper -->

    <!-- Footer start -->
      <div class="text-center p-3" style="background-color: #f1b5cd; margin-top: -20px;">
        © 2025 Red's Oven. All rights reserved.
      </div>
    </footer>
    <!-- Footer end -->


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
  }
?>