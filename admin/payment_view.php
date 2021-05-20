<?php
    if(!isset($_GET['payment_id']))
    {
      header("location: payment_list.php");
    }

    include('sidebar.php');
       
    $protocol           = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI             = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;

    $payment            =  mysqli_fetch_assoc($mysqli->query("SELECT * FROM payments WHERE id={$_GET['payment_id']}"));
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
            <div class="alert alert-<?=$_SESSION['msg_type']?> alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?=$_SESSION['message']?> 
                <?php unset($_SESSION['message']);?>
            </div>
        <?php endif ?> 
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
                              <td>
                                <?php if($field == "auto_assign"): ?> 
                                  Auto Assign to New Members?
                                <?php else: ?> 
                                  <?=ucfirst($field)?>
                                <?php endif ?> 
                              </td>
                              <td>
                                <?php if($field == "auto_assign"): ?> 
                                  <?=$payment['auto_assign'] == 1 ? "YES": "NO"?> 
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
                                <td>
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
              <div class="row my-2">
                <div class="col-md-12">
                  <div class="card shadow row mb-2">
                    <div class="card shadow">
                      <div class="card-header" style="background-color: #1b5b3a;  ">
                        <h6 class="m-0 font-weight-bold" style="color: white;">Users Assigned</h6>
                      </div>                   
                      <div class="card-body">
                        <table class='table table-hover overflow-auto'>
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>FULL NAME</th>
                              <th>EMAIL</th>
                              <th>STATUS</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                              <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                  <a href="#" class="btn btn-sm bg-gradient-primary text-white">
                                    <i class='fas fa-eye mr-2'></i>View
                                  </a>
                                </td>
                              </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan='4'></td>
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
            <form action="process_update_payment.php" method="POST">
              <div class="modal-body">
                <input type="hidden" class="form-control" name="id" placeholder="Title" id="title" value="<?=$payment['id']?>">
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
                <button class="btn bg-gradient-primary btn-sm text-white" name="update_payment">Update</button>
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
            <form action="process_add_user_payment.php" method="POST">
              <div class="modal-body">
                <div class="row mt-2 mb-3">
                  <input type="hidden" class="form-control" name="id" placeholder="Title" id="title" value="<?=$payment['id']?>">
                  <div class="col-md-12">
                    <label for="users">Users</label>
                    <select class="custom-select" name="user" id="users">
                      <?php foreach($users as $user): ?> 
                      <option value="<?=$user['id']?>">
                        <?php 
                          $fullname = strtoupper($user['last_name']) . ' ' . strtoupper($user['first_name']) . ' ' . strtoupper($user['middle_name']);
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
                <button class="btn bg-gradient-primary btn-sm text-white" name="add_user_payment">Assign</button>
              </div>
            </form>
          </div>
        </div>
      </div>
       <!-- End Add User Modal-->
<?php
  include('footer.php');
?>
      </div>
      <!-- End of Main Content -->