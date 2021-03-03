<?php
  require_once('process_post.php');
  include('sidebar.php');

  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  $_SESSION['getURI'] = $getURI;


  #Get User Information
  $getUserInformation = mysqli_query($mysqli, " SELECT * FROM users WHERE id = '$user_id' ");
  $newUserInformation = $getUserInformation->fetch_array();


?>
<title><?php echo $newUserInformation['firstname'].' '.$newUserInformation['lastname']; ?></title>
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
                <button class="btn" id="asd" data-toggle="modal" data-target="#ModalChangeDP" aria-haspopup="true" aria-expanded="false"><img style="width: 10rem; height: 10rem; border-radius: 50%; border: 3px solid #17A673;" src="<?php echo  $newUserInformation['profile_image']; ?>"></button>
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
                <h3 class="m-0 font-weight-bold" style="color: #1b5b3a; text-align:center;"><?php echo $newUserInformation['firstname'].' '.$newUserInformation['lastname'];?></h3>
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
                    <form accept-charset="UTF-8" action="process_post.php" method="post" id="form-status"
                      onclick="navigator.geolocation.getCurrentPosition(showPosition);"
                    >
                        Personal Information:
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="First Name">
                                <br/>
                                <input class="form-control" type="text" placeholder="Middle Name">
                                <br/>
                            </div>
                            <br/>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="Last Name">
                                <br/>
                            </div>
                        </div>

                        License Information:
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="PMA Number">
                                <br/>
                            </div>
                            <br/>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="PRC Number">
                                <br/>
                            </div>
                        </div>

                      <br/>
                      <button type="submit" class="btn btn-sm ml-auto float-right" style="background-color: #1b5b3a; color: white;" name="status_post">
                          <i class="far fa-save"></i> Update
                      </button>
                      <span id="status-post-message" class="float-right" style="margin:5px;color:red;display:none;">You need to allow location to post</span>
                      <br/>
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
