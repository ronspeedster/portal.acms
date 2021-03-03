<?php
$getLinkRequest = mysqli_query($mysqli, "SELECT u.firstname, u.profile_image, u.lastname, u.id, ul.date_added
FROM user_links ul
JOIN users u
ON u.id = ul.from_user_id
WHERE ul.to_user_id = '$user_id' AND ul.linked = 'false'
LIMIT 3 ");
$noRequest=false;
//print_r($getLinkRequest);
if(mysqli_num_rows($getLinkRequest)==0){
  $noRequest=true;
}

?>
<!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars" style="color: green;"></i>
          </button>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <!-- <i class="fas fa-bell fa-fw"></i> -->
                <i class="fas fa-user-friends" style="color: #1B5B3A;"></i>
                <!-- Counter - Alerts -->
                <!-- <span class="badge badge-danger badge-counter">3+</span> -->
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow-lg animated--grow-in" aria-labelledby="alertsDropdown" style="background-color: #1B5B3A;">
                <h6 class="dropdown-header" style="background-color: white; border-color: white; color: #1B5B3A;">
                  Link Requests
                </h6>
<?php while($newLinkRequest=$getLinkRequest->fetch_assoc()){
  $getDateAdded = date_create($newLinkRequest['date_added']);
  $date_added = date_format($getDateAdded, 'F j, Y');
  ?>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo "link.php?linkid=".$newLinkRequest['id']; ?>" target="" style="background-color: white;">
                  <div class="mr-3">
                    <div class="">
                      <img style="width: 2rem; height: auto; border-radius: 50%;" src="<?php echo $newLinkRequest['profile_image']; ?>">
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500"><?php echo $date_added; ?></div>
                    <span class="font-weight-bold"><?php echo $newLinkRequest['firstname'].' '.$newLinkRequest['lastname']; ?></span>
                  </div>
                </a>
<?php }  
            if($noRequest==true){ ?>
                <a class="dropdown-item d-flex align-items-center" style="background-color: white;">
                  No pending link request
                </a>
              <?php  } else{ ?>
                <a style="background-color: white;" class="dropdown-item text-center small text-gray-600" href="#">Show All Link Requests</a>
              <?php } ?>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-800 small"><?php echo $_SESSION['full_name']; ?></span>
                <img src="<?php echo $_SESSION['profile_image']; ?>" style="width: 2rem; height: 2rem; border-radius: 50%;">
                <!-- <i class="fas fa-user text-gray-800"></i> -->
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow-lg animated--grow-in" aria-labelledby="userDropdown" style="background-color: #1B5B3A;">
                <h6 class="dropdown-header" style="background-color: white; border-color: white; color: #1B5B3A;">
                  Information
                </h6>
                <div style="background-color: white;">
                  <center><a href="profile.php" class="text-gray-800"><?php echo $_SESSION['email']; ?></a></center>
                  <center><hr/>
                    <a style="color: #5D4037;" class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                    Logout
                  </a><br/><br/>
                </center>
              </div>
              </div>
            </li>

            <!--<div class="topbar-divider d-none d-sm-block"></div>
            
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <span>
                <center><?php echo $_SESSION['email']; ?></center><br/>
                <center><a style='color: #5D4037;' class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                  Logout
                </a>
                </center>
                </span>
              </div>
            -->
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->