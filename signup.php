<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #FDD3E8;

        } .signup-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
            width: 100%;
            margin-top: -100px;
        }

        .signup-container {
            padding: 80px;
            border-radius: 10px;
            text-align: center;
            width: 800px;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
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

           .btn-custom {
            background-color: #F09A9A;
            border: none;
            color: white;
    </style>
</head>
<body>
     <!-- Navbar start -->
        <nav class="navbar navbar-expand-md navbar-dark">
            <a class="navbar-brand" href="homepage.php"><img src="image/redovenlogo.png" style="height:65px; margin: 10px 0 0 25px;"></a>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav ml-auto">
                
                <li class="nav-item">
                  <form action="search.php" method="post">
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
                <li class="data"><a  href="heart.php">Heart Cake</a></li>
                <li class="data"><a  href="circle.php">Classic Cake</a></li>
                <li class="data"><a  href="bento.php">Bento</a></li>
                <li class="data"><a  href="special.php">Special</a></li>
                <li class="data"><a  href="bundle.php">Bundle</a></li>
            </ul>
          </div>
    
      <div class="signup-wrapper">
       <div class="signup-container">
            <h2 class="mb-4">Create Account</h2>
            <form action="signup_process.php" method="POST">
                <div class="form-group">
                    <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group" style="position: relative;">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password" style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer;"></span>
                </div>
                <button type="submit" class="btn btn-custom btn-block">Sign Up</button>
            </form>
            <p class="mt-3">Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
        <script>
            document.querySelector('.toggle-password').addEventListener('click', function () {
                const passwordField = document.querySelector('#password');
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);

                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        </script>
</body>
</html>
