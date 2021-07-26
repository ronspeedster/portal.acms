<?php
  include('dbh.php');
  
  if(!isset($_SESSION['email'])){
    header("Location: ../login.php");
  }

  if($_SESSION['level_access'] != 'admin'){
      header("Location: ../index.php");
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
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="icon" href="../img/logo/acms.png" sizes="16x16">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
  background-color:  #1b5b3a !important;
  border-color:  #1b5b3a !important;
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
            <a class="nav-link" href="../index.php">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
        </li>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active" id="nav-item-home">
            <a class="nav-link" href="manage_users.php">
                <i class="far fa-user"></i>
                <span>Users</span>
            </a>
        </li>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active" id="nav-item-home">
            <a class="nav-link" href="status_users.php">
                <i class="far fa-folder-open"></i>
                <span>Status</span>
            </a>
        </li>

      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#payments" aria-expanded="true" aria-controls="buildings">
          <i class="fa fa-credit-card"></i>
          <span>Payments</span>
        </a>
        <div id="payments" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Payments</h6>
            <a class="collapse-item" href="payment_list.php"><i class="fas fa-eye"></i> Payment List</a>
            <a class="collapse-item" href="payment_archives.php"><i class="fas fa-eye"></i> Payment Archives</a>
            <a class="collapse-item" href="payment_user_list.php"><i class="fas fa-eye"></i> Check User Payments </a>
          </div>
        </div>
      </li>
      <!-- Divider -->

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#buildings" aria-expanded="true" aria-controls="buildings">
          <i class="fas fa-search-location"></i>
          <span>2021 Election</span>
        </a>
        <div id="buildings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage 2021 Election</h6>
            <a class="collapse-item" href="manage_candidates.php"><i class="fas fa-plus"></i> Add / Edit Candidate</a>
            <a class="collapse-item" href="view_voter_status.php"><i class="fas fa-eye"></i> View Voter's Status</a>
            <a class="collapse-item" href="view_election_status.php"><i class="fas fa-eye"></i> View Election status</a>
            <a class="collapse-item" href="view_election_status_cross_check.php"><i class="fas fa-eye"></i> View Vote's Liquidation (Cross Check)</a>
          </div>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#certificate" aria-expanded="true" aria-controls="buildings">
          <i class="fas fa-certificate"></i>
          <span>Certificate</span>
        </a>
        <div id="certificate" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Certificate</h6>
            <a class="collapse-item" href="certificate_send_list.php"><i class="fas fa-certificate"></i> Send Certificate</a>
          </div>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#settings" aria-expanded="true" aria-controls="buildings">
          <i class="fas fa-cogs"></i>
          <span>Settings</span>
        </a>
        <div id="settings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Settings</h6>
            <a class="collapse-item" href="manage_certificate.php"><i class="fas fa-address-card"></i> Manage Certificate Signature</a>
            <a class="collapse-item" href="manage_member_category.php"><i class="fas fa-address-book"></i> Manage Member Category</a>
            <a class="collapse-item" href="manage_email_settings.php"><i class="fas fa-envelope"></i> Manage Email Settings</a>
            <a class="collapse-item" href="manage_notification_settings.php"><i class="fas fa-bell"></i> Manage Notification Settings</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider d-none d-md-block">
<!--      <li class="nav-item" id = "nav-item-safelocation">-->
<!--        <a class="nav-link" href="safelocation.php">-->
<!--          <i class="fas fa-street-view"></i><i class="fas fa-street-view"></i>-->
<!--          <span>Safe Location</span></a>-->
<!--      </li>-->


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
