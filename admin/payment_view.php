<?php
    if(!isset($_GET['payment_id']))
    {
      header("location: payment_list.php");
    }

    include('sidebar.php');

    $payment            =  mysqli_fetch_assoc($mysqli->query("SELECT * FROM payments WHERE id={$_GET['payment_id']}"));
       
    $protocol           = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI             = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;

    $users              =  ($mysqli->query("SELECT * FROM users WHERE level_access!='admin'"));
 
    $payment_status     = ["AWAITING VERIFICATION", "PENDING", "VERIFIED"];
    $payment_fields     = ["title", "category", "amount", "auto_assign", "created_at", "updated_at"];
?>
<title>Payment Summary</title>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

<?php require('topbar.php'); ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <?php if(isset($_SESSION['message'])): ?> 
            <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?=$_SESSION['message']?> 
                <?php unset($_SESSION['message']);?>
            </div>
        <?php endif ?> 
        <!-- Alert Here -->
        <?php if(isset($_SESSION['errors'])): ?> 
          <?php foreach($_SESSION["errors"] as $key => $value): ?>  
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?=$value?> 
            </div>
            <?php endforeach ?> 
          <?php unset($_SESSION['errors']); ?> 
        <?php endif ?> 
        <!-- End Alert Here -->
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Payment Summary</h1>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold" style="color: green;">Information</h6>
                        </div>
                        <div class="card-body py-0 px-0 overflow-hidden">
                          <table class='table'>
                            <tbody>
                            <?php foreach($payment_fields as $field): ?> 
                            <tr class='text-center'>
                              <td class="font-weight-bold">
                                <?php if($field == "auto_assign"): ?> 
                                  Auto Assign to New Members?
                                <?php else: ?> 
                                  <?=ucfirst($field)?>
                                <?php endif ?> 
                              </td>
                              <td>
                                <?php if($field == "auto_assign"): ?> 
                                  <?=$payment['auto_assign'] == 1 ? "YES": "NO"?> 
                                <?php elseif($field == "amount"): ?> 
                                  <?=number_format($payment['amount'], 2)?> 
                                <?php else: ?> 
                                  <?=$payment[$field]?> 
                                <?php endif ?> 
                              </td>
                            </tr>
                            <?php endforeach ?> 
                            </tbody>
                          </table>
                        </div>
                        <div class="card-footer bg-white text-right">
                          <button class="btn btn-sm btn-danger  text-white" data-toggle="modal" data-target="#modal_archive_payment">
                            Archive
                          </button>
                          <button class="btn btn-sm bg-gradient-primary text-white" data-toggle="modal" data-target="#modal_edit_payment">
                            Edit
                          </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="card shadow row mb-2">
                    <div class="card shadow">
                      <div class="card-header" style="background-color: #1b5b3a;  ">
                        <h6 class="m-0 font-weight-bold" style="color: white;">Statistics</h6>
                      </div>                   
                      <div class="card-body">
                        <table class='table table-hover'>
                          <thead>
                            <tr>
                              <th>Status</th>
                              <th>#</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($payment_status as $status): ?> 
                              <tr>
                                <td class="font-weight-bold">
                                  <?=$status?> 
                                </td>
                                <td>
                                  <?=mysqli_num_rows($mysqli->query("SELECT * FROM user_payments WHERE status='{$status}' AND payment_id ='{$_GET['payment_id']}'"))?> 
                                </td>
                              </tr>
                            <?php endforeach ?> 
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <?php 
                $statement = $mysqli->prepare("SELECT * FROM user_payments JOIN users ON users.id=user_payments.user_id WHERE payment_id=?");
                $statement->bind_param('i', $payment['id']); 
                $statement->execute(); 
                $user_payments = $statement->get_result(); 
              ?> 
              <div class="row my-2">
                <div class="col-md-12">
                  <div class="card shadow row mb-2">
                    <div class="card shadow">
                      <div class="card-header" style="background-color: #1b5b3a;  ">
                        <h6 class="m-0 font-weight-bold" style="color: white;">Users Assigned</h6>
                      </div>                   
                      <div class="card-body">
                        <table id="table_user_assigned" class='table table-hover overflow-auto'>
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>FULL NAME</th>
                              <th>STATUS</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=1; ?> 
                            <?php foreach($user_payments as $user_payment):?> 
                            <tr>
                              <td>
                                <?=$i?> 
                              </td>
                              <td>
                                <?php 
                                  $fullname = strtoupper($user_payment['last_name']) . ', ' . strtoupper($user_payment['first_name']) . ' ' . strtoupper($user_payment['middle_name']);
                                ?> 
                                <?=$fullname?>
                              </td>
                              <?php 
                                $textColor = null; 
                                
                                switch($user_payment['status'])
                                {
                                    case "AWAITING VERIFICATION": 
                                        $textColor = "text-info"; 
                                        break; 

                                    case "PENDING": 
                                        $textColor = "text-danger"; 
                                        break; 
                                    
                                    case "VERIFIED": 
                                        $textColor = "text-success"; 
                                        break; 
                                }
                              ?> 
                              <td class='font-weight-bold <?=$textColor?>'>
                                <?=$user_payment['status']?>
                              </td>
                              <td>
                                <a href="view_user_payment.php?user_payment_id=<?=$user_payment['id']?>" class="btn btn-sm bg-gradient-primary text-white">
                                  <i class='fas fa-eye mr-2'></i>View
                                </a>
                              </td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach ?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan='3'></td>
                              <td>
                                <button class="btn btn-sm bg-gradient-primary text-white" data-toggle="modal" data-target="#modal_add_user_payment">
                                  <i class='fas fa-plus mr-2'></i>Add
                                </button>
                              </td>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
       

          </div>
        </div>
        <!-- /.container-fluid -->

      <!-- Payment Edit Modal-->
      <div class="modal fade" id="modal_edit_payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Payment</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form action="process_payment.php?id=<?=$payment['id']?>" method="POST">
              <div class="modal-body">
                <div class="row mt-2 mb-3">
                  <div class="col-md-12">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" id="title" value="<?=$payment['title']?>" required>
                  </div>
                </div>
                <div class="row my-3">
                  <div class="col-md-6">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" name="category" placeholder="Category" id="category"  value="<?=$payment['category']?>" required>
                  </div>
                  <div class="col-md-6">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control" name="amount" placeholder="Amount" step="0.01" id="amount"  value="<?=$payment['amount']?>" required>
                  </div>
                </div>
                <div class="row my-3">
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="auto_assign" class="custom-control-input" id="auto_assign" <?=$payment['auto_assign'] == 1 ? 'checked' : '' ?> >
                      <label class="custom-control-label" for="auto_assign">Automatically assign this to new members?</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn bg-gradient-primary btn-sm text-white" name="update_payment">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- End Payment Edit Modal-->
      <!-- Payment Archive Modal-->
      <div class="modal fade" id="modal_archive_payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Archive Payment</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form action="process_payment.php?id=<?=$payment['id']?>" method="POST">
              <div class="modal-body">
                <div class="row mt-2 mb-3">
                  <div class="col-md-12">
                    <label for="title">Please Enter your password to continue:</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" id="password" required>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger btn-sm text-white" name="archive_payment">Archive</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- End Payment Edit Modal-->
      <!-- Add User Modal-->
      <div class="modal fade" id="modal_add_user_payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Assign Payment to User</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form action="process_user_payment.php" method="POST">
              <div class="modal-body">
                <div class="row mt-2 mb-3">
                  <input type="hidden" class="form-control" name="payment_id" value="<?=$payment['id']?>">
                  <div class="col-md-12">
                    <label for="users">Users</label>
                    <select class="custom-select" name="user" id="users">
                      <?php foreach($users as $user): ?> 
                      <option value="<?=$user['id']?>">
                        <?php 
                          $fullname = strtoupper($user['last_name']) . ', ' . strtoupper($user['first_name']) . ' ' . strtoupper($user['middle_name']);
                        ?>
                        <?=$fullname?> 
                      </option>
                      <?php endforeach ?> 
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn bg-gradient-primary btn-sm text-white" name="assign_user_payment">Assign</button>
              </div>
            </form>
          </div>
        </div>
      </div>
       <!-- End Add User Modal-->

<?php
  include('footer.php');
  ?>
  <script>
   $(document).ready(function() {
       $('#table_user_assigned').DataTable(
           {
               "pageLength": 50,
           }
       ); 
   } );
 </script>
      </div>
      <!-- End of Main Content -->