<?php
session_start();
require('../config/db.php');
include('../config/header-sign.php');

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM admin WHERE user='$username' AND pass='$password'";
  $result = mysqli_query($db, $query);

  if (mysqli_num_rows($result) == 1) {
    $_SESSION['username'] = $username;
    header('Location: ../includes/dashboard.php');
    exit();
  }

  $query = "SELECT * FROM client WHERE email='$username' AND password='$password'";
  $result = mysqli_query($db, $query);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['client_id'] = $row['client_id'];
    $_SESSION['fname'] = $row['Fname'];
    $_SESSION['lname'] = $row['Lname'];
    header('Location: ../order/dist/order.php');
    exit();
  }

  echo '
    <div class="alert alert-danger" role="alert">
    Incorrect <a href="#" class="alert-link">Email or User / Password!</a>. Try Again.
    <button style="color:Black" type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  ';
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
include('includes/header.php');
?>

<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">

      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('../img/images.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Welcome!</h4>
                  <div class="row mt-3">
                    <div class="col-12 text-center me-auto">
                      <a class="btn btn-link px-3" href="https://www.nike.com/ph/">
                      <img src="../assets/img/white-nike.png" width="40" height="40" alt="main_logo">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form method="POST" role="form" class="text-start">
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Email/User</label>
                    <input type="text" class="form-control" name="username">
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                  </div>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                    <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                  </div>
                  <div class="text-center">
                    <button type="submit" name="login" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
                  </div>
                  <p class="mt-4 text-sm text-center">
                    Don't have an account?
                    <a href="sign-up.php" class="text-primary text-gradient font-weight-bold">Sign up</a>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <script src="../assets/js/material-dashboard.min.js?v=3.0.5"></script>
</body>

</html>