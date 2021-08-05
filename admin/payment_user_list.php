<?php
    include('dbh.php');
    include('sidebar.php');

    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;

    $user_payments    =   $mysqli->query("SELECT 
                                        user_payments.id, 
                                        user_payments.status, 
                                        payments.title, 
                                        payments.category, 
                                        payments.amount,
                                        user_payments.amount_paid,
                                        CONCAT(users.last_name, ', ' ,users.first_name , ' ' ,users.middle_name) AS fullname 
                                        FROM user_payments 
                                        JOIN payments ON payments.id=user_payments.payment_id 
                                        JOIN users ON users.id=user_payments.user_id 
                                        WHERE payments.deleted_at is NULL"
                                    ); 

    $payments          =    $mysqli->query("SELECT * FROM payments WHERE deleted_at is NULL"); 
    $users             =    $mysqli->query("SELECT * FROM users"); 

?>
<title>User Payments List</title>
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
                            User Payments                        
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-end mt-2 mb-4">
                                <button type="button "class="btn btn-success"  data-toggle="modal" data-target="#modal_generate_excel">
                                    Generate Excel
                                </button>
                            </div>
                            <table id="table_user_payments" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>MEMBER</th>
                                        <th>PAYMENT</th>
                                        <th>AMOUNT DUE</th>
                                        <th>STATUS</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;?>
                                    <?php foreach($user_payments as $payment): ?> 
                                    <tr class="cursor-pointer">
                                        <td><?=$i?></td>
                                        <td>
                                            <?=strtoupper($payment['fullname'])?> 
                                        </td>
                                        <td>
                                            <?=$payment['title']?> 
                                        </td>
                                        <td>
                                            <?=number_format(($payment['amount_paid']-$payment['amount']), 2)?> 
                                        </td>
                                        <?php 
                                            $textColor = null; 
                                            
                                            switch($payment['status'])
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
                                            <?=$payment['status']?> 
                                        </td>
                                        <td>
                                            <a href="payment_user_view.php?user_payment_id=<?=$payment['id']?>" class="btn btn-sm bg-gradient-primary text-white">
                                                <i class='fas fa-eye mr-2'></i>View
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?> 
                                    <?php endforeach ?> 
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan='5'></td>
                                        <td colspan='1'>
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
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

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
                    <input type="hidden" name="route" value="list">
                    <div class="col-md-12 my-2">
                        <label for="users">User</label>
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
                    <div class="col-md-12 my-2">
                        <label for="payment">Payment</label>
                        <select class="custom-select" name="payment" id="payment">
                        <?php foreach($payments as $payment): ?> 
                        <option value="<?=$payment['id']?>">
                            <?=$payment['title']?>
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

    <!-- Excel Modal-->
    <div class="modal fade" id="modal_generate_excel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Generate Excel</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form action="process_spreadsheet.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="route" value="payment_user_list.php">
                    <div class="row my-2 mb-3">
                        <div class="col-md-12 my-2">
                            <label for="formats">File Format</label>
                            <select class="custom-select" name="format" id="formats">
                            <?php 
                                $formats = ['csv', 'ods', 'xls', 'xlsx'];
                            ?> 
                            <?php foreach($formats as $format): ?> 
                            <option value="<?=$format?>">
                                <?=$format?> 
                            </option>
                            <?php endforeach ?> 
                            </select>
                        </div>
                        <div class="col-md-12 my-2">
                            <label for="date">Generate by: </label>
                            <select class="custom-select" name="date" id="date">
                            <?php 
                                $dates = ['all', 'from and to', 'today', 'month', 'year'];
                            ?> 
                            <?php foreach($dates as $date): ?> 
                            <option value="<?=$date?>">
                                <?=strtoupper($date)?> 
                            </option>
                            <?php endforeach ?> 
                            </select>
                        </div>
                        <div class="col-md-12 my-2 date-field date-range border-top pt-3 d-none">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="date_from">From</label>
                                    <input class='form-control' type="date" name="date_from" id="date_from">                                
                                </div>
                                <div class="col-md-6">
                                    <label for="date_to">To</label>
                                    <input class='form-control' type="date" name="date_to" id="date_to">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 my-2 date-field date-month border-top pt-3 d-none">
                            <label for="month">Month: </label>
                            <select class="custom-select" name="month" id="month">
                            <?php 
                                $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                            ?> 
                            <?php foreach($months as $month): ?> 
                            <option value="<?=$month?>">
                                <?=strtoupper($month)?> 
                            </option>
                            <?php endforeach ?> 
                            </select>
                        </div>
                        <div class="col-md-12 my-2 date-field date-year border-top pt-3 d-none">
                            <label for="year">Year: </label>
                            <input type="number" class='form-control' name="year" id="year" placeholder="Year">
                        </div>
                    </div>
                </div>
              <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn bg-gradient-primary btn-sm text-white" name="excel_user_payment_list">Generate</button>
              </div>
            </form>
          </div>
        </div>
      </div>
       <!-- End Excel Modal-->

<?php
  include('footer.php');
?>

<script src="./generate_excel.js"></script>
<script>
    $(document).ready(function() {
        $('#table_user_payments').DataTable(
            {
                "pageLength": 25,
            }
        ); 
    } );
</script>