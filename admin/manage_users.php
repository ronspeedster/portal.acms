<?php
    include('process_users.php');
    include('sidebar.php');

    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;


    #Get Registered Information
    $getAllUserInformation = mysqli_query($mysqli, "SELECT * FROM users");
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
            <div class="col-md-12">
              <!-- Feed Container -->
              <div class="card shadow row mb-2">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #1b5b3a;  ">
                    <h6 class="m-0 font-weight-bold" style="color: white;"><?php if($isEdit){ echo 'Update User';} else { echo 'Add User';} ?></h6>
                  </div>
                 <div class="card-body">
                  <div class="text-right">
                      <?php if($isEdit){?>
                      <a href="manage_users.php" class="btn btn-sm btn-primary">
                          <i class="fas fa-plus"></i>
                          Add Users / Doctors
                      </a>
                      <?php } ?>
                  </div>
                    <form accept-charset="UTF-8" action="process_users.php" method="post" id="form-status">
                        <label style="margin-bottom: 15px !important;" class="font-weight-bold">Personal Information:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="First Name" name="fname" value="<?php if($isEdit){echo $newUserInformation['first_name'];} ?>" required>
                                <br/>
                                <input class="form-control" type="text" placeholder="Middle Name" name="mname" value="<?php if($isEdit){echo $newUserInformation['middle_name'];} ?>">
                                <br/>
                            </div>
                            <br/>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="Last Name" name="lname" value="<?php if($isEdit){echo $newUserInformation['last_name'];} ?>">
                                <br/>
                            </div>
                        </div>
                        <!-- Additional Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="Mailing Address" name="mailing_address" value="<?php if($isEdit){echo $newUserInformation['mailing_address'];} ?>">
                                <br/>
                                <input class="form-control" type="text" placeholder="Contact Number" name="contact_num" value="<?php if($isEdit){echo $newUserInformation['contact_num'];} ?>">
                                <br/>
                            </div>
                            <br/>
                            <div class="col-md-6">
                                <input class="form-control" type="email" placeholder="Email address" name="email" value="<?php if($isEdit){echo $newUserInformation['email'];} ?>">
                                <br/>
                                <input class="form-control" type="date" placeholder="Birthday" name="birthday" value="<?php if($isEdit){echo $newUserInformation['birthday'];} ?>">
                                <br/>
                            </div>
                        </div>

                        <label style="margin-bottom: 15px !important;" class="font-weight-bold">License Information:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="PMA Number" name="pma_number" value="<?php if($isEdit){echo $newUserInformation['pma_number'];} ?>">
                                <br/>
                            </div>
                            <br/>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="PRC Number" name="prc_number" value="<?php if($isEdit){echo $newUserInformation['prc_number'];} ?>" required>
                                <br/>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="date" placeholder="Expiration Date" name="expiration_date" value="<?php if($isEdit){echo $newUserInformation['expiration_date'];} ?>">
                                <br/>
                            </div>
                            <br/>
                            <div class="col-md-6">
                                <input class="form-control" type="text" placeholder="Field of Practice" name="field_of_practice" value="<?php if($isEdit){echo $newUserInformation['field_of_practice'];} ?>">
                                <br/>
                            </div>
                        </div>

                        <?php 
                           $categories   =   $mysqli->query("SELECT * FROM member_category");
                        ?> 

                        <?php if($isEdit): ?> 
                        <label style="margin-bottom: 15px !important;" class="font-weight-bold">Member Status:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control" name="member_category" id="">
                                    <?php foreach($categories as $category): ?> 
                                        <option value="<?=$category['id']?>" <?=$category['id'] == $newUserInformation['member_category_id'] ? 'selected' : ''?>>
                                            <?=$category['name']?> 
                                        </option>
                                    <?php endforeach ?> 
                                </select>
                                <br/>
                            </div>
                        </div>
                        <?php endif ?> 
                      <br/>
                       <?php if(!$isEdit){ ?>
                      <button type="submit" class="btn btn-sm ml-auto float-right" style="background-color: #1b5b3a; color: white;" name="add_user">
                          <i class="far fa-save"></i>
                          Save
                      </button>
                      <?php }else{ ?>
                      <input type="text" name="user_id" style="visibility: hidden;" value="<?php echo $newUserInformation['id'];  ?>">
                      <button type="submit" class="btn btn-sm ml-auto float-right" style="background-color: #1b5b3a; color: white;" name="update_user">
                          <i class="far fa-save"></i>
                          Update
                      </button>
                      <?php } ?>
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
                              <h6 class="m-0 font-weight-bold" style="color: white;">Users</h6>
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
                                          <th>Birthday</th>
                                          <th>PMA Number</th>
                                          <th>PRC Number</th>
                                          <th>Expiration Date</th>
                                          <th>Field of Practice</th>
                                          <th>Actions</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php while($newUserInformation = $getAllUserInformation->fetch_assoc()){ ?>
                                      <tr>
                                          <td><?php echo $newUserInformation['id']; ?></td>
                                          <td><?php echo $newUserInformation['first_name'].' '.$newUserInformation['last_name']; ?></td>
                                          <td><?php echo $newUserInformation['mailing_address']; ?></td>
                                          <td><?php echo $newUserInformation['contact_num']; ?></td>
                                          <td><?php echo $newUserInformation['email']; ?></td>
                                          <td><?php echo $newUserInformation['birthday']; ?></td>
                                          <td><?php echo $newUserInformation['pma_number']; ?></td>
                                          <td><?php echo $newUserInformation['prc_number']; ?></td>
                                          <td><?php echo $newUserInformation['expiration_date']; ?></td>
                                          <td><?php echo $newUserInformation['field_of_practice']; ?></td>
                                          <td>
                                              <a class="btn btn-sm btn-primary mb-1" href="manage_users.php?edit=<?php echo $newUserInformation['id']; ?>"><i class="fas fa-edit"></i> Edit </a>
                                              <!-- Start Drop down Delete here -->
                                              <button class="btn btn-danger btn-secondary dropdown-toggle btn-sm mb-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="far fa-trash-alt"></i> Delete
                                              </button>
                                              <div class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton btn-sm">
                                                  Are you sure you want to delete? You cannot undo the changes<br/>
                                                  <a href="process_users.php?delete=<?php echo $newUserInformation['id']; ?>" class='btn btn-danger btn-sm'>
                                                      <i class="far fa-trash-alt"></i> Confirm Delete
                                                  </a>
                                                  <a href="#" class='btn btn-warning btn-sm text-dark'><i class="far fa-window-close"></i> Cancel</a>
                                              </div>
                                              <!-- End Dropdown here -->
                                          </td>
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
    } );
</script>
