<?php
    include('process_users.php');
    include('sidebar.php');

    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;


    #Get Registered Information
    $getAllUserInformationUpdated = mysqli_query($mysqli, "SELECT * FROM users WHERE is_update = '1' ");
    $getAllUserInformationNotUpdated = mysqli_query($mysqli, "SELECT * FROM users WHERE is_update = '0' ");
?>
<title>Add Users / Doctors</title>
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

          <div class="row">

            <!-- User List Here  -->
            <!-- User that updated -->
            <div class="col-md-12" style="/* width: 70%;height:500px;background-color:green; */">

                  <div class="card shadow row mb-2" style="/*height:150px ; background-color: red;*/">
                      <div class="card shadow">
                          <div class="card-header" style="background-color: #1b5b3a;  ">
                              <h6 class="m-0 font-weight-bold" style="color: white;">User Status (See user who updated their profile)</h6>
                          </div>
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="table table-bordered" id="userTable" width="100%" cellspacing="0">
                                      <thead>
                                      <tr>
                                          <th>ID</th>
                                          <th>Full Name</th>
                                          <th>Mailing Address</th>
                                          <th>Contact Number</th>
                                          <th>Email Address</th>
                                          <th>PMA Number</th>
                                          <th>PRC Number</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                      while($newUserInformation = $getAllUserInformationUpdated->fetch_assoc()){
                                          ?>
                                      <tr>
                                          <td><?php echo strtoupper($newUserInformation['id']); ?></td>
                                          <td><?php echo strtoupper($newUserInformation['first_name'].' '.$newUserInformation['last_name']); ?></td>
                                          <td><?php echo strtoupper($newUserInformation['mailing_address']) ?></td>
                                          <td><?php echo strtoupper($newUserInformation['contact_num']); ?></td>
                                          <td><?php echo strtoupper($newUserInformation['email']); ?></td>
                                          <td><?php echo strtoupper($newUserInformation['pma_number']); ?></td>
                                          <td><?php echo strtoupper($newUserInformation['prc_number']); ?></td>
                                      </tr>
                                      <?php } ?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
            </div>
            <!-- End User List Here  -->

            <!-- User that updated -->
            <div class="col-md-12" style="/* width: 70%;height:500px;background-color:green; */">

              <div class="card shadow row mb-2" style="/*height:150px ; background-color: red;*/">
                  <div class="card shadow">
                      <div class="card-header" style="background-color: #7f0707;  ">
                          <h6 class="m-0 font-weight-bold" style="color: white;">User Status (See user who did not update their profile)</h6>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-bordered" id="userTableNotUpdated" width="100%" cellspacing="0">
                                  <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Full Name</th>
                                      <th>Mailing Address</th>
                                      <th>Contact Number</th>
                                      <th>Email Address</th>
                                      <th>PMA Number</th>
                                      <th>PRC Number</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                  while($newUserInformation = $getAllUserInformationNotUpdated->fetch_assoc()){
                                  ?>
                                      <tr>
                                          <td><?php echo strtoupper($newUserInformation['id']); ?></td>
                                          <td><?php echo strtoupper($newUserInformation['first_name'].' '.$newUserInformation['last_name']); ?></td>
                                          <td><?php echo strtoupper($newUserInformation['mailing_address']); ?></td>
                                          <td><?php echo strtoupper($newUserInformation['contact_num']); ?></td>
                                          <td><?php echo strtoupper($newUserInformation['email']); ?></td>
                                          <td><?php echo strtoupper($newUserInformation['pma_number']); ?></td>
                                          <td><?php echo strtoupper($newUserInformation['prc_number']); ?></td>
                                      </tr>
                                  <?php } ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <!-- End User List Here  -->


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php
  include('footer.php');
?>
<script>
    $(document).ready(function() {
        $('#userTable').DataTable( {
            "pageLength": 50
        } );
        $('#userTableNotUpdated').DataTable( {
            "pageLength": 25
        } );
    } );
</script>
