<?php
  require_once('process_profile.php');
  include('sidebar.php');

  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  $_SESSION['getURI'] = $getURI;


  #Get User Information
  $getUserInformation = mysqli_query($mysqli, " SELECT * FROM users WHERE id = '$user_id' ");
  $newUserInformation = $getUserInformation->fetch_array();


?>
<title><?php echo $newUserInformation['first_name'].' '.$newUserInformation['last_name']; ?></title>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

<?php require('topbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <?php
        if(isset($_SESSION['message'])){?>
          <div class="alert alert-<?=$_SESSION['msg_type']?> alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
          </div>
          <?php } ?>
          <!-- Page Heading -->
          <!-- Page Heading -->
            <div class="align-items-center mb-4">
              <p style="text-align:center;">
                <button class="btn" id="asd" data-toggle="modal" data-target="#ModalChangeDP" aria-haspopup="true" aria-expanded="false"><img style="width: 10rem; height: 10rem; border-radius: 50%; border: 3px solid #17A673;" src="<?php echo '../'.$newUserInformation['profile_image']; ?>"></button>
                <!-- Modal For Request Here -->
                <div class="modal fade" id="ModalChangeDP" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Change Display Picture</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <!-- Contents Here -->
                       <form action="process_profile.php"  method="POST" enctype="multipart/form-data">
                        <input class="" type="file" name="profile_image" accept="image/*" value="Select Photo" required>
                        <button class="btn btn-sm btn-primary" name="upload_photo">Upload</button>
                       </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="far fa-window-close"></i> Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                    <!-- End Modal For PC Equipments -->                 
                <h3 class="m-0 font-weight-bold" style="color: #1b5b3a; text-align:center;"><?php echo $newUserInformation['first_name'].' '.$newUserInformation['last_name'];?></h3>
              </p>
            </div>

          <div class="row">
            <div class="col-md-12" style="/* width: 70%;height:500px;background-color:green; */">
              <!-- Feed Container -->
              <div class="card shadow row mb-2" style="/*height:150px ; background-color: red;*/">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #1b5b3a;  ">
                    <h6 class="m-0 font-weight-bold" style="color: white;">Update Profile</h6>
                  </div>
                 <div class="card-body">
                  <div class="text-center">
                  </div>
                     <form accept-charset="UTF-8" action="process_profile.php" method="post" id="form-status">
                         <label style="margin-bottom: 15px !important;" class="font-weight-bold">Personal Information:</label>
                         <div class="row">
                             <div class="col-md-6">
                                 First Name
                                 <input class="form-control" type="text" placeholder="First Name" name="fname" value="<?php echo $newUserInformation['first_name']; ?>" required>
                                 <br/>
                                 Middle Name
                                 <input class="form-control" type="text" placeholder="Middle Name" name="mname" value="<?php echo $newUserInformation['middle_name']; ?>" required>
                                 <br/>
                             </div>
                             <br/>
                             <div class="col-md-6">
                                 Last Name
                                 <input class="form-control" type="text" placeholder="Last Name" name="lname" value="<?php echo $newUserInformation['last_name']; ?>" required>
                                 <br/>
                             </div>
                         </div>
                         <!-- Additional Information -->
                         <div class="row">
                             <div class="col-md-6">
                                 Mailing Address
                                 <input class="form-control" type="text" placeholder="Mailing Address" name="mailing_address" value="<?php echo $newUserInformation['mailing_address']; ?>" required>
                                 <br/>
                                 Contact Number
                                 <input class="form-control" type="text" placeholder="Contact Number" name="contact_num" value="<?php echo $newUserInformation['contact_num'];?>" required>
                                 <br/>
                             </div>
                             <br/>
                             <div class="col-md-6">
                                 Email Address
                                 <input class="form-control" type="email" placeholder="Email address" name="email" value="<?php echo $newUserInformation['email']; ?>" required>
                                 <br/>
                                 Birthday
                                 <input class="form-control" type="date" placeholder="Birthday" name="birthday" value="<?php echo $newUserInformation['birthday']; ?>" required>
                                 <br/>
                             </div>
                         </div>

                         <label style="margin-bottom: 15px !important;" class="font-weight-bold">License Information:</label>
                         <div class="row">
                             <div class="col-md-6">
                                 PMA number
                                 <input class="form-control" type="text" placeholder="PMA Number" name="pma_number" value="<?php echo $newUserInformation['pma_number']; ?>" required>
                                 <br/>
                             </div>
                             <br/>
                             <div class="col-md-6">
                                 PRC Number
                                 <input class="form-control" type="text" placeholder="PRC Number" name="prc_number" value="<?php echo $newUserInformation['prc_number']; ?>" required>
                                 <br/>
                             </div>
                             <div class="col-md-6">
                                 Expiration Date
                                 <input class="form-control" type="date" placeholder="Expiration Date" name="expiration_date" value="<?php echo $newUserInformation['expiration_date']; ?>" required>
                                 <br/>
                             </div>
                             <br/>
                             <div class="col-md-6">
                                 Field of Practice
                                 <input class="form-control" type="text" placeholder="Field of Practice" name="field_of_practice" value="<?php echo $newUserInformation['field_of_practice']; ?>" required>
                                 <br/>
                             </div>
                         </div>

                         <br/>
                             <input type="text" name="user_id" style="visibility: hidden;" value="<?php echo $newUserInformation['id'];  ?>">
                             <button type="submit" class="btn btn-sm ml-auto float-right" style="background-color: #1b5b3a; color: white;" name="update_profile">
                                 <i class="far fa-save"></i>
                                 Update
                             </button>
                     </form>
                </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php
  include('footer.php');
?>
<script>

</script>
