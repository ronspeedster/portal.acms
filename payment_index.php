<?php
    include('dbh.php');
    include('sidebar.php');

    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;

    $my_payments    =   $mysqli->query("SELECT 
                                        user_payments.id, 
                                        user_payments.status, 
                                        payments.title, 
                                        payments.category, 
                                        payments.amount 
                                        FROM user_payments 
                                        JOIN payments ON payments.id=user_payments.payment_id 
                                        WHERE payments.deleted_at is NULL AND user_id={$_SESSION['user_id']}"
                                        ); 

?>
<title>My Payments</title>
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
                        Payment Methods                        
                    </div>
                    <div class="card-body">
                    <h5><b>Settle your dues by depositing the amount to this account, then upload proof of payment here.</b></h5>
                    Eastwest Bank Angeles City Branch<br>
                    Account Name: Angeles City Medical Society<br>
                    Account Number: 200019295744<br>

                    </div>
                    </div>
                    <br>
                    <div class="card shadow overflow-auto">
                        <div class="card-header bg-gradient-primary text-white font-weight-bold">
                            My Payments                        
                        </div>
                        <div class="card-body">
                            <table id="table_payments" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>TITLE</th>
                                        <th>CATEGORY</th>
                                        <th>AMOUNT DUE</th>
                                        <th>STATUS</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;?>
                                    <?php foreach($my_payments as $payment): ?> 
                                    <tr class="cursor-pointer">
                                        <td><?=$i?></td>
                                        <td>
                                            <?=$payment['title']?> 
                                        </td>
                                        <td>
                                            <?=$payment['category']?> 
                                        </td>
                                        <td style="display: none">
                                            <?=number_format($payment['amount'], 2)?> 
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
                                            <a href="payment_show.php?user_payment_id=<?=$payment['id']?>" class="btn btn-sm bg-gradient-primary text-white">
                                                <i class='fas fa-eye mr-2'></i>View
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?> 
                                    <?php endforeach ?> 
                                </tbody>
                            </table>
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
    $(document).ready(function() {
        $('#table_payments').DataTable(
            {
                "pageLength": 50,
            }
        ); 
    } );
</script>