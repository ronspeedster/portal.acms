<?php
  require_once 'process_registration.php';

  if(isset($_SESSION['email'])){
        header('location: index.php');
    }  
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ACMS - Forgot Password</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="icon" href="img/logo/acms.png" sizes="16x16">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
<style>
  .bg-gradient-primary {
    background-color: #1B5B3A !important;
    background-image: -webkit-gradient(linear,left top,left bottom,color-stop(50%,##1B5B3A),to(#1B5B3A)) !important;
    background-image: linear-gradient(180deg,#29c675 10%,#1B5B3A 100%) !important;
    background-size: cover !important;
}
</style>
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          
          <!-- Alert Here -->
          <?php if(isset($_SESSION['errors'])): ?>
            <?php foreach($_SESSION['errors'] as $error): ?> 
              <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?=$error?> 
              </div>
            <?php endforeach ?> 
            <?php unset($_SESSION['errors'])?> 
          <?php endif ?> 
          
          <?php if(isset($_SESSION['message'])): ?>
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?=$_SESSION['message']?> 
              </div>
          <?php unset($_SESSION['message'])?> 
          <?php endif ?> 
          <!-- End Alert Here -->          
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
<!--              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>-->
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                    <p class="mb-4">Enter your email address below and we'll send you a link to reset your password</p>
                  </div>
                  <form class="user" action="process_forgot_password.php" method="POST">
                    <div class="form-group"> 
                      <input type="email" class="form-control form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" required>
                    </div>
                    <button class="btn btn-success btn-block" name="forgot_password">
                      Reset Password
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="login.php">Already have an account? Login!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
