<?php
  include('dbh.php');
  
  if(!isset($_SESSION['email'])){
    header("Location: login.php");
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


  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="icon" href="img/logo/acms.png" sizes="16x16">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style type="text/css">
a:link {
  text-decoration: none;
}

a:visited {
  text-decoration: none;
}
.dropdown-menu{
  padding: 10px !important;
}
.topbar {
  /*height: 3rem !important;*/
}
.bg-gradient-primary {
  background-color: #1b5b3a !important;
  background-image: none !important;
  background-image: none !important;
  background-size: cover !important;
}
.page-item.active .page-link {
  z-index: 1;
  color: #fff;
  background-color: #1b5b3a  !important;
  border-color: #1b5b3a  !important;
}
.container-fluid{
  background-color: white;
  padding-left: 5% !important;
  padding-right: 5% !important;
}
#content-wrapper{
  background-color: white !important;
}
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  opacity: 0.7 !important; /* Firefox */
}
.center-div{
  display:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%,-50%);
}
</style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <div class="nav-item">ACMS</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active" id="nav-item-home">
            <a class="nav-link" href="index.php">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
        </li>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active" id="nav-item-home">
            <a class="nav-link" href="profile.php">
                <i class="far fa-user"></i>
                <span>Profile</span>
            </a>
        </li>

          <!-- Nav Item - Dashboard -->
        <li class="nav-item active" id="nav-item-home">
            <a class="nav-link" href="payment_index.php">
                <i class="fa fa-credit-card"></i>
                <span>My Payments</span>
            </a>
        </li>

        <?php if($_SESSION['level_access'] == 'admin'): ?>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active" id="nav-item-home">
            <a class="nav-link" href="admin/">
                <i class="fas fa-sliders-h"></i>
                <span>Admin</span>
            </a>
        </li>
        <?php endif ?>

      <!-- Nav Item - Pages Collapse Menu -->
<!--      <li class="nav-item">-->
<!--        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#buildings" aria-expanded="true" aria-controls="buildings">-->
<!--          <i class="fas fa-search-location"></i>-->
<!--          <span>Find Relatives</span>-->
<!--        </a>-->
<!--        <div id="buildings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">-->
<!--          <div class="bg-white py-2 collapse-inner rounded">-->
<!--            <h6 class="collapse-header">Customize Buildings:</h6>-->
<!--            <a class="collapse-item" href="view_links.php"><i class="fas fa-link"></i> View All Links</a>-->
<!--            <a class="collapse-item" href="view_pending_request.php"><i class="fas fa-clock"></i> View Pending Request</a>-->
<!--             <a class="collapse-item" href="view_sent_request.php"><i class="fas fa-share"></i> View Sent Request</a>-->
<!--          </div>-->
<!--        </div>-->
<!--      </li>-->

<!--      <li class="nav-item" id = "nav-item-safelocation">-->
<!--        <a class="nav-link" href="safelocation.php">-->
<!--          <i class="fas fa-street-view"></i><i class="fas fa-street-view"></i>-->
<!--          <span>Safe Location</span></a>-->
<!--      </li>-->

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Heading -->
<!--      <div class="sidebar-heading">-->
<!--        Misc.-->
<!--      </div>-->

<!--      <li class="nav-item" style="display: none;">-->
<!--        <a class="nav-link" href="#">-->
<!--          <i class="fas fa-users"></i>-->
<!--          <span>Users</span></a>-->
<!--      </li>-->

<!--      <li class="nav-item" style="display: none;">-->
<!--        <a class="nav-link" href="#">-->
<!--          <i class="fas fa-history"></i>-->
<!--          <span>Activity Logs</span></a>-->
<!--      </li>-->

<!--      <li class="nav-item">-->
<!--        <a class="nav-link" href="tips.php">-->
<!--          <i class="fas fa-lightbulb"></i>-->
<!--          <span>Tips</span></a>-->
<!--      </li>            -->


      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
