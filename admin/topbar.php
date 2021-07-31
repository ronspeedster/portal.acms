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

            <?php 
              $id = $_SESSION['user_id']; 
              $notifications = $mysqli->query("SELECT * FROM user_notifications WHERE user_id='$id' ORDER BY created_at DESC"); 
              $unread       = mysqli_num_rows( $mysqli->query("SELECT * FROM user_notifications WHERE user_id='$id' AND is_read=0"));
            ?>

            <!-- Nav Item - Notifications -->
            <li class="nav-item dropdown no-arrow">
             <a class="nav-link dropdown-toggle text-success" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <span class="fas fa-bell mr-2"></span> 
               <span>Notifications</span> 
               <span class="badge badge-pill badge-danger mx-2">
                 <?=$unread?> 
               </span>
               <!-- <i class="fas fa-user text-gray-800"></i> -->
             </a>
             <!-- Dropdown - Notifications -->
             <div class="dropdown-list dropdown-menu dropdown-menu-right shadow-lg animated--grow-in" style="max-height:550px; overflow:auto" aria-labelledby="notificationDropdown">

             

                <div class="d-flex justify-content-between px-3 pb-2">
                  <span id="notifications_clear" class="text-danger font-weight-bold" style="cursor:pointer;">
                    Clear All 
                  </span>
                  <span id="notifications_mark" class="font-weight-bolder" style="cursor:pointer;">
                    Mark As Read
                  </span>
                </div>
                <ul class="list-group list-group-flush">
                  <?php if(mysqli_num_rows($notifications) == 0 ): ?> 
                      <li class="list-group-item text-center font-weight-bold">
                        No New Notifications
                      </li>
                  <?php else: ?> 
                    <?php foreach($notifications as $notification): ?>  
                      <li class="list-group-item text-justify font-weight-bold <?=$notification['is_read'] == 1 ? 'text-black': 'text-info'?>">
                        <?=$notification['notification']?> at  <?=$notification['created_at']?>
                      </li>
                    <?php endforeach ?>
                  <?php endif ?> 
                </ul>
                  </div>
            </li>

            <!-- Logic is in footer.php -->
            <form id="notifications_clear_form" action="./process_notification.php" method="post">
              <input type="hidden" name="clear_all">
            </form>

            <form id="notifications_mark_form" action="./process_notification.php" method="post">
              <input type="hidden" name="mark_read">
            </form>

              
            <div class="topbar-divider d-none d-sm-block"></div>


            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-800 small"><?php echo strtoupper($_SESSION['full_name']); ?></span>
                <img src="<?php echo '../'.$_SESSION['profile_image']; ?>" style="width: 2rem; height: 2rem; border-radius: 50%;">
                <!-- <i class="fas fa-user text-gray-800"></i> -->
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow-lg animated--grow-in" aria-labelledby="userDropdown" style="background-color: #1B5B3A;">
                <h6 class="dropdown-header" style="background-color: white; border-color: white; color: #1B5B3A;">
                  Information
                </h6>
                <div style="background-color: white;">
                  <div style="text-align: center;"><a href="profile.php" class="text-gray-800"><?php echo strtolower($_SESSION['email']); ?></a></div>
                  <div style="text-align: center;"><hr/>
                    <a style="color: #5D4037;" class="btn btn-sm btn-danger text-white" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                    Logout
                  </a>
                  <br/>
                  <br/>
                </div>
              </div>
              </div>
            </li>

            <!--<div class="topbar-divider d-none d-sm-block"></div>
            $field_of_practice
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