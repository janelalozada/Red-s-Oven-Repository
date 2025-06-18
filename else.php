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
      .unorderedlist {
          list-style-type: none;
          font-family: Georgia, serif;
          display: flex;
          justify-content: center;
          padding: 0;
          margin: 20px auto;
          width: 100%;
      }

      .unorderedlist .data {
          margin: 0 20px;
      }

      .unorderedlist .data a {
          color: #494747;
          text-decoration: none;
          font-size: 18px;
          font-weight: bold;
          padding: 10px 15px;
          border-radius: 5px;
      }

      #message {
          position: fixed;
          top: 20px;
          left: 50%;
          transform: translateX(-50%);
          background-color: #ff7ea5;
          color: white;
          padding: 10px 20px;
          border-radius: 10px;
          font-weight: bold;
          box-shadow: 0 4px 8px rgba(0,0,0,0.2);
          z-index: 9999;
          display: none;
          transition: all 0.3s ease-in-out;
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
  
  <!-- Displaying Products Start -->
<section id="noProductMsg" style="height: 55px; margin-top: 300px; text-align: center; color: #494747; font-weight: bold; font-size: 20px;">
  This product is not available.
</section>
<!-- Displaying Products End -->

<script>
  // Wait 1 second, then redirect to homepage.php
  setTimeout(function () {
    window.location.href = "heart.php";
  }, 1000); // 1000 milliseconds = 1 second
</script>

  <!-- Notification -->
  <div id="message"></div>

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
            $("#message").html(response).fadeIn();

            // Hide after 1 second
            setTimeout(function () {
              $("#message").fadeOut();
            }, 1000); // 1 second

            window.scrollTo(0, 0);
            load_cart_item_number();
          }
        });
      });

      // Load total no. of items added in the cart and display in the navbar
      load_cart_item_number();

      function load_cart_item_number() {
        $.ajax({
          url: 'action.php',
          method: 'get',
          data: { cartItem: "cart_item" },
          success: function(response) {
            $("#cart-item").html(response);
          }
        });
      }
    });

    $("#searchForm").submit(function(e) {
      e.preventDefault();
      const searchValue = $("#searchInput").val();

      $.ajax({
        url: "search.php",
        method: "POST",
        data: { search: searchValue },
        dataType: "json",
        success: function(response) {
          if (response.status === "success") {
            window.location.href = response.redirect;
          } else {
            $("#searchMessage").text(response.message);
            setTimeout(() => {
              $("#searchMessage").text("");
            }, 3000);
          }
        }
      });
    });
  </script>
</body>
</html>
