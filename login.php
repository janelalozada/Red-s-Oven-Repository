<?php
session_start();
require 'config.php';

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
  header("Location: homepage.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  if (empty($email) || empty($password)) {
    $error = "Please fill in all fields!";
  } else {
    // Verify regular user credentials from the database
    $sql = "SELECT id, first_name, last_name, password FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Debugging section
    if ($user) {
      echo "Entered Email: " . htmlspecialchars($email) . "<br>";
      echo "Entered Password: " . htmlspecialchars($password) . "<br>";
      echo "Hashed from DB: " . htmlspecialchars($user['password']) . "<br>";

      if (password_verify($password, $user['password'])) {
        echo "✅ Password matched!<br>";
      } else {
        echo "❌ Password mismatch!<br>";
      }
    } else {
      echo "❌ No user found with that email.<br>";
    }

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['first_name'] . " " . $user['last_name'];
      $_SESSION['user_email'] = $email;
      header("Location: homepage.php");
      exit();
    } else {
      $error = "Invalid email or password!";
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Font Awesome CDN -->
  <style>
    body {
        background-color: #FDD3E8;
      }
    .eye-icon {
      cursor: pointer;
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
    }
    .card {
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      border-radius: 1rem;
      transition: transform 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
    }

  </style>
</head>
<body style="background-color: #FDD3E8;">
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

 <div class="container d-flex justify-content-center" style="padding-top: 100px; min-height: 50vh;">
    <div class="card p-4 shadow-lg border-0 rounded-lg" style="width: 400px; background-color: #FFFFFF; backdrop-filter: blur(8px);">
      <h3 class="text-center mb-4">Login</h3>
      <?php if (isset($error)): ?>
        <div class="alert alert-danger text-center"> <?= htmlspecialchars($error); ?> </div>
      <?php endif; ?>
      <form method="POST" action="">
        <div class="form-group">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group position-relative">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
          <span class="eye-icon" onclick="togglePassword()">
            <i class="fas fa-eye" id="eye-icon"></i> <!-- Font Awesome eye icon -->
          </span>
        </div>
        <button type="submit" name="login" class="btn btn-block" style="background-color: #F09A9A; border: none; color: white;">Login</button>
      </form>
        <p class="mt-3 text-center">Don't have an account? <a href="signup.php" style="color: #e67373;">Create one</a></p>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    function togglePassword() {
      const passwordField = document.getElementById('password');
      const icon = document.getElementById('eye-icon');
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash'); // Change icon to "eye-slash"
      } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye'); // Change icon back to "eye"
      }
    }
  </script>
</body>
</html>
