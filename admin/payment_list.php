<?php
    require_once('../process_post.php');
    include('sidebar.php');

    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;

    $payments           =   $mysqli->query("SELECT * FROM payments WHERE deleted_at is null");
    $member_categories  =   $mysqli->query("SELECT * FROM member_category WHERE is_active='1'");
?>
<title>Payment List</title>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow overflow-auto">
                        <div class="card-header bg-gradient-primary text-white font-weight-bold">
                            Payments                        
                        </div>
                        <div class="card-body">
                            <table id="table_payments" class="table table-hover text-sm">
                                <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>TITLE</th>
                                      <th>CATEGORY</th>
                                      <th style="display: none">AMOUNT</th>
                                      <th>USERS</th>
                                      <th>CREATED AT</th>
                                      <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $i=1; ?> 
                                  <?php foreach($payments as $payment):?> 
                                  <tr class="cursor-pointer">
                                    <td>
                                      <?=$i?>
                                    </td>
                                    <td>
                                        <?=$payment['title']?>
                                    </td>
                                    <td style="display: none">
                                      <?=$payment['category']?> 
                                    </td>
                                    <td>
                                      <?=number_format($payment['amount'], 2)?> 
                                    </td>
                                    <td>
                                      <?=mysqli_num_rows($mysqli->query("SELECT * FROM user_payments WHERE payment_id = {$payment['id']}"))?> 
                                    </td>
                                    <td>
                                      <?=$payment['created_at']?> 
                                    </td>
                                    <td>
                                      <a href="payment_view.php?payment_id=<?=$payment['id']?>" class="btn btn-sm bg-gradient-primary text-white">
                                        <i class='fas fa-eye mr-2'></i>View
                                      </a>
                                    </td>
                                  </tr>
                                  <?php $i++; ?> 
                                  <?php endforeach ?> 
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <td colspan=5>
                                    </td>
                                    <td colspan='1'>
                                      <button class="btn btn-sm bg-gradient-primary text-white" data-toggle="modal" data-target="#modal_create_payment">
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
        <!-- /.container-fluid -->
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Payment Create Modal-->
      <div class="modal fade" id="modal_create_payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Payment</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form action="process_payment.php" method="POST">
              <div class="modal-body">
                <div class="row mt-2 mb-3">
                  <div class="col-md-12">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" id="title" value="" required>
                  </div>
                </div>
                <div class="row my-3">
                  <div class="col-md-6">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" name="category" placeholder="Category" id="category" value="" required>
                  </div>
                  <div class="col-md-6">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control" name="amount" placeholder="Amount" step="0.01" id="amount" value="" required>
                  </div>
                </div>
                <div class="row my-3">
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="auto_assign" class="custom-control-input" id="auto_assign">
                      <label class="custom-control-label" for="auto_assign">Automatically Assign Payment to NEWLY REGISTERED USERS</label>
                    </div>
                  </div>
                </div>
                <hr>
                <h5 class="my-2">Member Category</h5>
                <?php foreach($member_categories as $category): ?>
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="member_category[]" class="custom-control-input" id="member_<?=$category['id']?>" value="<?=$category['id']?>">
                        <label class="custom-control-label" for="member_<?=$category['id']?>">Assign Payment to <?=$category['name']?></label>
                      </div>
                    </div>
                  </div>
                <?php endforeach ?>  
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn bg-gradient-primary btn-sm text-white" name="create_payment">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
       <!-- End Payment Create Modal-->
<?php
  include('footer.php');
?>

<script>
    $(document).ready(function() {
        $('#table_payments').DataTable(
            {
                "pageLength": 50,
            }
        ); 
    } );
</script>