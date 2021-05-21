<?php
    if(!isset($_GET['user_payment_id']))
    {
      header("location: payment_list.php");
    }

    include('sidebar.php');
      
    $protocol           = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI             = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;

    $payment            = null; 

?>
<title>Payment Summary</title>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

<?php require('topbar.php'); ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <?php if(isset($_SESSION['message'])): ?> 
            <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?=$_SESSION['message']?> 
                <?php unset($_SESSION['message']);?>
            </div>
        <?php endif ?> 
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
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Payment Summary</h1>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold" style="color: green;">Information</h6>
                        </div>
                        <div class="card-body py-0 px-0 overflow-hidden">
                          <table class='table'>
                            <tbody>
    
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                  <div class="card shadow row mb-2">
                    <div class="card shadow">
                      <div class="card-header" style="background-color: #1b5b3a;  ">
                        <h6 class="m-0 font-weight-bold" style="color: white;">Proof of Payment</h6>
                      </div>                   
                      <div class="card-body">
                        <img src="" class="img-fluid" alt="Responsive image">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        <!-- /.container-fluid -->
      </div>
<?php
  include('footer.php');
?>
      <!-- End of Main Content -->