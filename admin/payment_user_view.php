<?php
    include('dbh.php');
    if(!isset($_GET["user_payment_id"]))
    {
        header("location: payment_index.php");
    }
    else 
    {
        $statement = $mysqli->prepare("SELECT 
                                        user_payments.id, 
                                        user_payments.status, 
                                        user_payments.user_id, 
                                        user_payments.amount_paid, 
                                        user_payments.proof_of_payment, 
                                        user_payments.date_of_payment, 
                                        user_payments.updated_at, 
                                        payments.title, payments.category, 
                                        payments.amount, 
                                        users.level_access, 
                                        users.id as user_id, 
                                        CONCAT(users.last_name, ', ' ,users.first_name , ' ' ,users.middle_name) AS fullname 
                                        FROM user_payments 
                                        JOIN payments ON user_payments.payment_id=payments.id 
                                        JOIN users ON users.id=user_payments.user_id 
                                        WHERE user_payments.id=?"
                                    ); 

        $statement->bind_param("i", $_GET["user_payment_id"]); 
        $statement->execute(); 

        $result       = $statement->get_result(); 
        
        if($result->num_rows == 0)
        {
            header("location: payment_user_list.php");
        }
        else 
        {
            $user_payment = $result->fetch_assoc();
        }
      
    }
    
    include('sidebar.php');

    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;

?>
<title><?=$user_payment['title']?> | <?=$user_payment['fullname']?></title>
<style>
    .custom-file-input.selected:lang(en)::after {
      content: "" !important;
    }

    .custom-file {
      overflow: hidden;
    }

    .custom-file-input {
      white-space: nowrap;
    }
</style>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

<?php require('topbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><?=$user_payment['fullname'] . ' | ' . $user_payment['title'] . ' - ' . $user_payment['category'] ?></h1>
            </div>
            <?php if($user_payment['level_access'] == "temporary"): ?>
                <div class="alert alert-warning alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    This Member is currently using a temporary account, 
                <a class='text-danger cursor-pointer' data-toggle="modal" data-target="#modal_auth_user">
                    Please click here to modify his/her access
                </a>.
                </div>
            <?php endif ?> 
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
                <!--Upload Proof Of Payment Form--> 
                <div class="col-md-5">
                    <div class="card shadow overflow-auto">
                        <div class="card-header bg-gradient-primary text-white text-center font-weight-bold">
                            Proof Of Payment
                        </div>
                        <div class="card-body">
                            <?php 
                                if(isset($user_payment['proof_of_payment']) && !empty($user_payment['proof_of_payment']))
                                {
                                    $filePath = "../storage/proof_of_payment/{$user_payment['proof_of_payment']}";
                                }
                                else 
                                {
                                    $filePath = "../storage/misc/no-image.jpg"; 
                                }
                            ?> 
                            <img src="<?=$filePath?>" id="preview_image" alt="" class="img-fluid w-100">
                        </div>
                        <?php if((isset($user_payment['proof_of_payment']) && !empty($user_payment['proof_of_payment']))): ?> 
                        <div class="card-footer d-flex justify-content-end">
                            <button type="button" class="btn btn-sm bg-gradient-primary text-white"  data-toggle="modal" data-target="#modal_verify_payment">
                                <?php if($user_payment['status'] != "VERIFIED"): ?> 
                                    Verify Payment
                                <?php else: ?> 
                                    Modify Payment
                                <?php endif ?> 
                            </button>
                            <?php if($user_payment['status'] == "VERIFIED"): ?>
                                <form action="process_email.php" method="post">
                                    <input type="hidden" name="id" value="<?=$user_payment['user_id']?>">
                                    <button type="submit" name="verify_payment_certificate" class="btn btn-sm btn-info ml-2">
                                        Send Email with Certificate
                                    </button>     
                                </form>
                            <?php endif ?> 
                        </div>
                        <?php endif ?> 
                    </div>
                </div>
                <!--End Upload Proof OF Payment Form--> 

                <!--Summary--->
                <div class="col-md-7">
                    <div class="card shadow overflow-auto">
                        <div class="card-header font-weight-bold text-center">
                            Payment Summary
                        </div>
                        <div class="card-body py-0">
                            <div class="row border-bottom py-3">
                                <div class="col-md-6 text-center">
                                    Amount
                                </div>
                                <div class="col-md-6 text-center">
                                    <span class="bg-success text-white rounded px-2 py-1">
                                        <?=number_format($user_payment['amount'], 2)?> 
                                    </span>
                                </div>
                            </div>
                            <div class="row border-bottom py-3">
                                <div class="col-md-6 text-center">
                                    Payment
                                </div>
                                <div class="col-md-6 text-center">
                                    <span class="bg-success text-white rounded px-2 py-1">
                                        <?=number_format($user_payment['amount_paid'], 2)?> 
                                    </span>
                                </div>
                            </div>
                            <div class="row border-bottom py-3">
                                <div class="col-md-6 text-center">
                                    Balance
                                </div>
                                <div class="col-md-6 text-center">
                                    <span class="bg-success text-white rounded px-2 py-1">
                                        <?php
                                            $balance = number_format(($user_payment['amount'] - $user_payment['amount_paid']) ,2);
                                            //Make Balance 0 if balance is less than 0
                                            if($balance<0){
                                                $balance = number_format((0) ,2);
                                            }                                            
                                        ?> 
                                        <?=$balance?> 
                                    </span>
                                </div>
                            </div>
                            <div class="row border-bottom py-3">
                                <div class="col-md-6 text-center">
                                    Date of Payment 
                                </div>
                                <div class="col-md-6 text-center">
                                    <span class="bg-success text-white rounded px-2 py-1">
                                        <?=$user_payment['date_of_payment'] ?? 'N/A'?> 
                                    </span>
                                </div>
                            </div>
                            <div class="row border-bottom py-3">
                                <div class="col-md-6 text-center">
                                    Status 
                                </div>
                                <div class="col-md-6 text-center">
                                    <span class="bg-success text-white rounded px-2 py-1">
                                        <?=$user_payment['status']?> 
                                    </span>
                                </div>
                            </div>
                            <div class="row py-3">
                                <div class="col-md-6 text-center">
                                    Last Update
                                </div>
                                <div class="col-md-6 text-center">
                                    <span class="bg-success text-white rounded px-2 py-1">
                                        <?=$user_payment['updated_at'] ?? 'N/A'?> 
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class='text-center'>
                                Notify Member if Payment Status is changed
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- End Summary --> 

            </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php
  include('footer.php');
?>

   <!-- Payment Verify Modal-->
   <div class="modal fade" id="modal_verify_payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verify Payment</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="process_payment.php?id=<?=$user_payment['id']?>" method="POST">
                    <div class="modal-body">
                        <div class="row mt-2 mb-3">
                            <div class="col-md-12 mb-2">
                                <label for="member">Member Name</label>
                                <input type="text" class="form-control" placeholder="Title" id="member" value="<?=$user_payment['fullname']?>" disabled>
                            </div>
                            <div class="col-md-12 my-2 border-bottom pb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="payment">Payment</label>
                                        <input type="text" class="form-control" placeholder="Payment" id="payment" value="<?=$user_payment['title']?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="amount">Amount Due</label>
                                        <input type="text" class="form-control" placeholder="Amount" id="amount" value="<?=number_format($user_payment['amount'], 2)?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 my-2">
                                <label for="amount_paid">Enter Amount Paid based on Proof of Payment</label>
                                <input type="text" name="amount_paid" class="form-control" placeholder="Amount" id="amount" value="<?=$user_payment['amount_paid'] ?? ""?>" required>
                            </div>
                            <div class="col-md-12 my-2">
                                <label for="status">Payment Status</label>
                                <select name="status" id="status" class="custom-select">
                                    <option value="AWAITING VERIFICATION" <?=isset($user_payment['status']) && $user_payment['status'] == "AWAIT VERIFICATION" ? 'selected' : ''?>>
                                        AWAIT VERIFICATION
                                    </option>
                                    <option value="VERIFIED" <?=isset($user_payment['status']) && $user_payment['status'] == "VERIFIED" ? 'selected' : ''?>>
                                        VERIFIED
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn bg-gradient-primary btn-sm text-white" name="verify_payment">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Payment Edit Modal-->
    <!-- User Verify -->
    <div class="modal fade" id="modal_auth_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Verify Member</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form action="process_users.php?id=<?=$user_payment['user_id']?>" method="POST">
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
                <button type="submit" class="btn btn-danger btn-sm text-white" name="verify_user">Verify</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- User Verify-->
