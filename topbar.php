<?php

?>
<!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars" style="color: green;"></i>
          </button>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-800 small"><?php echo strtoupper($_SESSION['full_name']); ?></span>
                <img src="<?php echo $_SESSION['profile_image']; ?>" style="width: 2rem; height: 2rem; border-radius: 50%;">
                <!-- <i class="fas fa-user text-gray-800"></i> -->
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow-lg animated--grow-in" aria-labelledby="userDropdown" style="background-color: #1B5B3A;">
                <h6 class="dropdown-header" style="background-color: white; border-color: white; color: #1B5B3A;">
<!--                  Information-->
                </h6>
                <div style="background-color: white;">
                  <div style="text-align: center;">
                      <a href="profile.php" class="text-gray-800">
                          Profile
<!--                          --><?php //echo strtoupper($_SESSION['email']); ?>
                      </a>
                  </div>
                  <div style="text-align: center;"><hr/>
                    <a style="color: #5D4037;" class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                    Logout
                  </a>
                  <br/>
                  <br/>
                </div>
              </div>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <span>
                <center><?php echo $_SESSION['email']; ?></center><br/>
                <center><a style='color: #5D4037;' class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                  Logout
                </a>
                </center>
                </span>

            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->