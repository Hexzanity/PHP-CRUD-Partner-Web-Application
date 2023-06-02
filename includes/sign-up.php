<?php
include ('../config/db.php');
include('../config/header-sign.php');

if (isset($_POST['submit'])) {
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $birthday = mysqli_real_escape_string($db, $_POST['birthday']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  $sql = "INSERT INTO client (Fname, Lname, Birthday, address, email, password)
          VALUES ('$fname', '$lname', '$birthday', '$address','$email','$password')";

  if (mysqli_query($db, $sql)) {
    echo "<script>alert('You created account successfully');</script>";
  } else {
    echo '
    <div class="alert alert-danger" role="alert">
    Incorrect <a href="#" class="alert-link">Please fill the empty field</a>. Try Again.
    <button style="color:Black" type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
  ';
}
}
$query = "SET @autoid :=0";
mysqli_query($db, $query);
$query = "UPDATE client SET id = @autoid := (@autoid+1)";
mysqli_query($db, $query);
$query = "ALTER TABLE client AUTO_INCREMENT = 1";
mysqli_query($db, $query);
mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="en">

  <?php
  include('includes/header.php');
  ?>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">

      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" 
              style="background-image: url('../images/fx.jpg'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                <div class="login">
      <div class="container">
        <h1>Sign Up!<br> Your account</h1>
        <div class="login-form">
                  <form method="POST" action="sign-in.php">
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">First Name</label>
                      <input type="text" id = "fname" name="fname" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Last Name</label>
                      <input type="text" id = "lname" name="lname" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">
                      Birthday</label>
                      <input type="date" id ="birthday" name="birthday" class="form-control text-center">
                    </div>
                    
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Address</label>
                      <input type="text" id = "address" name="address" class="form-control">
                    </div>

                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Email</label>
                      <input type="email" id = "email" name="email" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Password</label>
                      <input type="password" id ="password" name="password" class="form-control">
                    </div>
                    <div class="text-center">
                      <button type="submit" name="submit"class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Sign Up</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="sign-in.php" class="text-primary text-gradient font-weight-bold">Sign in</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.5"></script>
</body>

</html>