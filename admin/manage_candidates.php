<?php
include('process_candidates.php');
include('sidebar.php');

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['getURI'] = $getURI;


#Get Registered Information
$getAllUserInformation = mysqli_query($mysqli, "SELECT * FROM candidates");
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
                                <h6 class="m-0 font-weight-bold" style="color: white;">Add / Edit Candidate</h6>
                            </div>
                            <div class="card-body">
                                <div class="text-right">
                                    <?php if($isEdit){?>
                                        <a href="manage_candidates.php" class="btn btn-sm btn-primary">
                                            <i class="fas fa-plus"></i>
                                            Add Candidate
                                        </a>
                                    <?php } ?>
                                </div>
                                <form accept-charset="UTF-8" action="manage_candidates.php" method="post" id="form-status">
                                    <label style="margin-bottom: 15px !important;" class="font-weight-bold">Personal Information:</label>
                                    <div class="row">
                                        <div class="col-md-6">
<!--                                            User ID-->
<!--                                            <input class="form-control" type="number" placeholder="User ID" name="mname" value="--><?php //if($isEdit){echo $newUserInformation['middle_name'];} ?><!--" required>-->
<!--                                            <label> To check their ID, <a target="_blank" href="manage_users.php">click here:</a> </label>-->
                                            First Name
                                            <input class="form-control" type="text" placeholder="First Name" name="fname" value="<?php if($isEdit){echo $newUserInformation['first_name'];} ?>">
                                            <br/>
                                            Middle Name
                                            <input class="form-control" type="text" placeholder="Middle Name" name="mname" value="<?php if($isEdit){echo $newUserInformation['middle_name'];} ?>">
                                        </div>
                                        <br/>
                                        <div class="col-md-6">
                                            Last Name
                                            <input class="form-control" type="text" placeholder="Last Name" name="lname" value="<?php if($isEdit){echo $newUserInformation['last_name'];} ?>">
                                            <br/>
                                            <br/>
                                        </div>
                                    </div>

                                    <br/>
                                    <?php if(!$isEdit){ ?>
                                        <button type="submit" class="btn btn-sm ml-auto float-right" style="background-color: #1b5b3a; color: white;" name="add_candidate">
                                            <i class="far fa-save"></i>
                                            Save Candidate Information
                                        </button>
                                    <?php }else{ ?>
                                        <input type="text" name="user_id" style="visibility: hidden;" value="<?php echo $newUserInformation['id'];  ?>">
                                        <button type="submit" class="btn btn-sm ml-auto float-right" style="background-color: #1b5b3a; color: white;" name="update_user">
                                            <i class="far fa-save"></i>
                                            Update Candidate Information
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
                                <h6 class="m-0 font-weight-bold" style="color: white;">2021 Candidates</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="userTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Candidate ID</th>
                                            <th>Full Name</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($newUserInformation = $getAllUserInformation->fetch_assoc()){ ?>
                                            <tr>
                                                <td><?php echo $newUserInformation['id']; ?></td>
                                                <td><?php echo $newUserInformation['first_name'].' '.$newUserInformation['last_name']; ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary mb-1" href="manage_candidates.php?edit=<?php echo $newUserInformation['id']; ?>"><i class="fas fa-edit"></i> Edit </a>
                                                    <!-- Start Drop down Delete here -->
                                                    <button class="btn btn-danger btn-secondary dropdown-toggle btn-sm mb-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="far fa-trash-alt"></i> Delete
                                                    </button>
                                                    <div class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton btn-sm">
                                                        Are you sure you want to delete? You cannot undo the changes<br/>
                                                        <a href="process_candidates.php?delete=<?php echo $newUserInformation['id']; ?>" class='btn btn-danger btn-sm'>
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
