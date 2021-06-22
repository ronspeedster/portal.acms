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

  <title>Register</title>

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

    <div class="row py-5">
      <div class="col-md-12">
        <!-- Alert Here -->
        <?php if(isset($_SESSION['errors'])): ?> 
          <?php foreach($_SESSION["errors"] as $key => $value): ?>  
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?=$value?> 
            </div>
            <?php endforeach ?> 
          <?php unset($_SESSION['errors']); ?> 
        <?php endif ?> 
        <!-- End Alert Here -->
          <div class="card shadow">
            <div class="card-header bg-white p-4">
              <h5 class="m-0 font-weight-bold text-center">Create An Account!</h5>
            </div>
            <div class="card-body px-5">
              <form accept-charset="UTF-8" method="post" action="process_registration.php">
                <h5 class="font-weight-bold my-3 pb-3 border-bottom">
                  Personal Information:
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-12 my-2">
                            <label for="firstName">First Name</label>
                            <input class="form-control" id="firstName" type="text" placeholder="First Name" name="firstName" value="<?=$_GET['firstName'] ?? null ?>" required>
                          </div>
                          <div class="col-md-12 my-2">
                            <label for="middleName">Middle Name</label>
                            <input class="form-control" id="middleName" type="text" placeholder="Middle Name" name="middleName" value="<?=$_GET['middleName'] ?? null ?>" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-12 my-2">
                            <label for="lastName">Last Name</label>
                            <input class="form-control" id="lastName" type="text" placeholder="Last Name" name="lastName" value="<?=$_GET['lastName'] ?? null ?>" required>
                          </div>
                          <div class="col-md-12 my-2">
                            <label for="birthDate">Date of Birth</label>
                            <input class="form-control" id="birthDate" type="date" placeholder="Birth Date" name="birthDate" value="<?=$_GET['birthDate'] ?? null ?>" required>
                          </div>
                        </div>
                      </div>
                  </div>
                  <h5 class="font-weight-bold my-3 pb-3 border-bottom">
                    Contact Information:
                  </h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-12 my-2">
                          <label for="mailingAddress">Mailing Address</label>
                          <input class="form-control" id="mailingAddress" type="text" placeholder="Mailing Address" name="mailingAddress" value="<?=$_GET['mailingAddress'] ?? null ?>" required>
                        </div>
                        <div class="col-md-12 my-2">
                          <label for="contactNumber">Contact Number</label>
                          <input class="form-control" id="contactNumber" type="text" placeholder="Contact Number" name="contactNumber" value="<?=$_GET['contactNumber'] ?? null ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-12 my-2">
                          <label for="email">Email</label>
                          <input class="form-control" id="email" tyemail" placeholder="Email Address" name="email" value="<?=$_GET['email'] ?? null ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <h5 class="font-weight-bold my-3 pb-3 border-bottom">
                    License Information:
                  </h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-12 my-2">
                          <label for="pmaNumber">PMA Number</label>
                          <input class="form-control" id="pmaNumber" type="text" placeholder="PMA Number" name="pmaNumber" value="<?=$_GET['pmaNumber'] ?? null ?>" required>
                        </div>
                        <div class="col-md-12 my-2">
                          <label for="expirationDate">Expiration Date</label>
                          <input class="form-control" id="expirationDate" type="date" placeholder="Expiration Date" name="expirationDate" value="<?=$_GET['expirationDate'] ?? null ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-12 my-2">
                          <label for="prcNumber">PRC Number</label>
                          <input class="form-control" id="prcNumber" type="text" placeholder="PRC Number" name="prcNumber" value="<?=$_GET['prcNumber'] ?? null ?>" required>
                        </div>
                        <div class="col-md-12 my-2">
                          <label for="field">Field of Practice</label>
                          <input class="form-control" id="field" type="text" placeholder="Field of Practice" name="field" value="<?=$_GET['field'] ?? null ?>" required>
                        </div>
                      </div>
                    </div>  
                  </div>
                  <h5 class="font-weight-bold my-3 pb-3 border-bottom">
                    Account Information:
                  </h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-12 my-2">
                          <label for="username">Username</label>
                          <input class="form-control" id="username" type="text" placeholder="Username" name="username" value="<?=$_GET['username'] ?? null ?>" required>
                        </div>
                    
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-12 my-2">
                          <label for="password">Password</label>
                          <input class="form-control" id="password" type="password" placeholder="Password" name="password" value="<?=$_GET['password'] ?? null ?>" required>
                        </div>
                        <div class="col-md-12 my-2">
                          <label for="confirm_password">Confirm Password</label>
                          <input class="form-control" id="confirm_password" type="password" placeholder="Confirm Password" name="confirm_password" value="<?=$_GET['confirm_password'] ?? null ?>" required>
                        </div>
                      </div>
                    </div>  
                  </div>
                  <button type="submit" class="btn btn-success btn-block mt-3" name="register">
                    Register Account
                  </button>
              </form>
              <hr>
              <!--
              <div class="text-center my-1">
                <a class="small" href="forgot-password.php">Forgot Password?</a>
              </div>
              -->
              <div class="text-center my-1 pb-3">
                <a class="small" href="login.php">Already have an account? Login!</a>
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
