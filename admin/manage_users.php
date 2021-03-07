<?php
    include('process_users.php');
    include('sidebar.php');

    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;
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
            <!-- Add User Here -->
            <div class="col-md-12" style="/* width: 70%;height:500px;background-color:green; */">
              <!-- Feed Container -->
              <div class="card shadow row mb-2" style="/*height:150px ; background-color: red;*/">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #1b5b3a;  ">
                    <h6 class="m-0 font-weight-bold" style="color: white;">Add Users / Doctors</h6>
                  </div>
                 <div class="card-body">
                  <div class="text-center">
                  </div>
                    <form accept-charset="UTF-8" action="process_users.php" method="post" id="form-status">
                        <label style="margin-bottom: 15px !important;" class="font-weight-bold">Personal Information:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="First Name" name="fname">
                                <br/>
                                <input class="form-control" type="text" placeholder="Middle Name" name="mname">
                                <br/>
                            </div>
                            <br/>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="Last Name" name="lname">
                                <br/>
                            </div>
                        </div>
                        <!-- Additional Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="Mailing Address" name="mailing_address">
                                <br/>
                                <input class="form-control" type="text" placeholder="Contact Number" name="contact_num">
                                <br/>
                            </div>
                            <br/>
                            <div class="col-md-6">
                                <input class="form-control" type="email" placeholder="Email address" name="email">
                                <br/>
                                <input class="form-control" type="date" placeholder="Birthday" name="birthday">
                                <br/>
                            </div>
                        </div>

                        <label style="margin-bottom: 15px !important;" class="font-weight-bold">License Information:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="PMA Number" name="pma_number">
                                <br/>
                            </div>
                            <br/>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="PRC Number" name="prc_number">
                                <br/>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="date" placeholder="Expiration Date" name="expiration_date">
                                <br/>
                            </div>
                            <br/>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="Field of Practice" name="field_of_practice">
                                <br/>
                            </div>
                        </div>

                      <br/>
                      <button type="submit" class="btn btn-sm ml-auto float-right" style="background-color: #1b5b3a; color: white;" name="add_user">
                          <i class="far fa-save"></i>
                          Save
                      </button>
                    </form>
                </div>
                </div>
              </div>
            </div>
            <!-- End Add User Here -->

            <!-- User List Here  -->
            <div class="col-md-12" style="/* width: 70%;height:500px;background-color:green; */">
                  <!-- Feed Container -->
                  <div class="card shadow row mb-2" style="/*height:150px ; background-color: red;*/">
                      <div class="card shadow">
                          <div class="card-header" style="background-color: #1b5b3a;  ">
                              <h6 class="m-0 font-weight-bold" style="color: white;">Add User</h6>
                          </div>
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="table table-bordered" id="userTable" width="100%" cellspacing="0">
                                      <thead>
                                      <tr>
                                          <th>Item Code</th>
                                          <th>Item Name</th>
                                          <th>Description</th>
                                          <th>QTY (Stock)</th>
                                          <th>Market Price</th>
                                          <th>Price (Your Price)</th>
                                          <th>Update QTY</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr>
                                          <td>asdf</td>
                                          <td>asdf</td>
                                          <td>asdf</td>
                                          <td>asdf</td>
                                          <td>asdf</td>
                                          <td>asdf</td>
                                          <td>asf</td>
                                      </tr>
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
        $('#inventoryTable').DataTable( {
            "pageLength": 25
        } );
    } );
</script>
