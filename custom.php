<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customize Cake - Red's Oven</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <style>
    body {
      background-color: #FDD3E8;
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
    .form-section-title {
      text-align: center;
      margin: 50px 0;
      color: #494747;
      font-family: Georgia, serif;
    }
    .btn-custom {
      background-color: #F98CC2;
      color: white;
      border: none;
    }
    .option-container {
      margin: 0 auto 40px auto;
      max-width: 900px;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      background: #fff;
    }
    .cake-image {
      width: 100%;
      border-radius: 10px;
    }
    .price-tag {
      font-size: 25px;
      color: #F98CC2;
      font-weight: bold;
      margin-bottom: 10px;
    }
    .btn-cart {
      background: #FFFFFF;
      color: #F98CC2;
      border-color: #D9D9D9;
      border-radius: 10px;
      width: 250px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-dark">
  <a class="navbar-brand" href="homepage.php">
    <img src="image/redovenlogo.png" style="height:65px; margin: 10px 0 0 25px;">
  </a>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <form action="search.php" method="post" class="form-inline">
          <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" style="width: 250px; border-radius: 50px;">
          <button type="submit" style="background: none; border: none;">
            <img src="logos/search.png" style="height: 25px;">
          </button>
        </form>
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

<!-- Category Navigation -->
<div>
  <ul class="unorderedlist">
    <li class="data"><a href="heart.php">Heart Cake</a></li>
    <li class="data"><a href="circle.php">Classic Cake</a></li>
    <li class="data"><a href="bento.php">Bento</a></li>
    <li class="data"><a href="special.php">Special</a></li>
    <li class="data"><a href="bundle.php">Bundle</a></li>
    <li class="data"><a href="custom.php">Customize Cake</a></li>
  </ul>
</div>

<!-- Section Title -->
<h2 class="form-section-title">Customize Your Cake</h2>

<div class="container">

  <!-- Alphabet Letter Cake -->
  <form action="submit_customization.php" method="POST">
    <div class="option-container row align-items-center">
      <div class="col-md-4">
        <img src="image/Cakes/custom/letter.png" alt="Alphabet Cake" class="cake-image">
      </div>
      <div class="col-md-8">
        <h4>Alphabet Letter Cake</h4>
        <p class="price-tag">₱899.00</p>
        <div class="form-group">
          <label>Cake Size</label>
          <select class="form-control" name="alphabet_size">
            <option>Regular</option>
            <option>Large</option>
          </select>
        </div>
        <div class="form-group">
          <label>Design Color</label>
          <select class="form-control" name="alphabet_color">
            <option>Blue</option><option>Green</option><option>Pink</option><option>Purple</option><option>Yellow</option>
          </select>
        </div>
        <div class="form-group">
          <label>Flavor</label>
          <select class="form-control" name="alphabet_flavor">
            <option>Vanilla</option><option>Chocolate</option>
          </select>
        </div>
        <div class="form-group">
          <label>Alphabet Design</label>
          <select class="form-control" name="alphabet_letter">
            <?php foreach (range('A', 'Z') as $letter) echo "<option>$letter</option>"; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Card Message</label>
          <input type="text" class="form-control" name="alphabet_message">
        </div>
        <button type="submit" class="btn btn-cart btn-block"><img src="logos/cart.png" style="height: 22px; margin-right:7px;">Add to cart</button>
      </div>
    </div>
  </form>

  <!-- Number Digit Cake -->
  <form action="submit_customization.php" method="POST">
    <div class="option-container row align-items-center">
      <div class="col-md-4">
        <img src="image/Cakes/custom/digit.png" alt="Number Cake" class="cake-image">
      </div>
      <div class="col-md-8">
        <h4>Number Digit Cake</h4>
        <p class="price-tag">₱899.00</p>
        <div class="form-group">
          <label>Cake Size</label>
          <select class="form-control" name="number_size">
            <option>Regular</option><option>Large</option>
          </select>
        </div>
        <div class="form-group">
          <label>Design Color</label>
          <select class="form-control" name="number_color">
            <option>Blue</option><option>Green</option><option>Pink</option><option>Purple</option><option>Yellow</option>
          </select>
        </div>
        <div class="form-group">
          <label>Flavor</label>
          <select class="form-control" name="number_flavor">
            <option>Vanilla</option><option>Chocolate</option>
          </select>
        </div>
        <div class="form-group">
          <label>Digit Design</label>
          <select class="form-control" name="number_digit">
            <?php for ($i = 0; $i <= 9; $i++) echo "<option>$i</option>"; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Card Message</label>
          <input type="text" class="form-control" name="number_message">
        </div>
        <button type="submit" class="btn btn-cart btn-block"><img src="logos/cart.png" style="height: 22px; margin-right:7px;">Add to cart</button>
      </div>
    </div>
  </form>

  <!-- Minimalist Custom Cake -->
  <form action="submit_customization.php" method="POST">
    <div class="option-container row align-items-center">
      <div class="col-md-4">
        <img src="image/Cakes/custom/round.png" alt="Minimalist Cake" class="cake-image">
      </div>
      <div class="col-md-8">
        <h4>Minimalist Custom Cake (Ombre Design)</h4>
        <p class="price-tag">₱799.00</p>
        <div class="form-group">
          <label>Flavor</label>
          <select class="form-control" name="minimalist_flavor">
            <option>Choco Moist</option><option>Red Velvet</option>
          </select>
        </div>
        <div class="form-group">
          <label>Cake Color</label>
          <select class="form-control" name="minimalist_color">
            <option>Blue</option><option>Green</option><option>Pink</option><option>Purple</option><option>Yellow</option>
          </select>
        </div>
        <div class="form-group">
          <label>Custom Message on Cake</label>
          <select class="form-control" name="minimalist_custom_message">
            <option>Yes</option><option>No</option>
          </select>
        </div>
        <div class="form-group">
          <label>Candles</label>
          <input type="text" class="form-control" name="minimalist_candles" placeholder="e.g. 1 Big, 2 Small">
        </div>
        <button type="submit" class="btn btn-cart btn-block"><img src="logos/cart.png" style="height: 22px; margin-right:7px;">Add to cart</button>
      </div>
    </div>
  </form>

</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
</body>
</html>
