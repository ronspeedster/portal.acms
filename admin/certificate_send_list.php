<?php
    include('dbh.php');
    include('sidebar.php');

    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;

    $users                      =   $mysqli->query("SELECT 
                                                        users.id, 
                                                        users.email,
                                                        CONCAT(users.last_name, ', ' ,users.first_name , ' ' ,users.middle_name) AS fullname
                                                    FROM 
                                                        users"
                                                    ) or die($mysqli->error); 

?>
<title> Send Certificate List</title>
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
                            Send Certificate                      
                        </div>
                        <div class="card-body">
                            <table id="table_user_payments" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>MEMBER</th>
                                        <th>EMAIL</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;?>
                                    <?php foreach($users as $user): ?> 
                                    <?php 
                                        $pending_payments = $mysqli->query("SELECT 
                                                                                payments.id, 
                                                                                user_payments.payment_id  
                                                                            FROM 
                                                                                user_payments 
                                                                            JOIN 
                                                                                payments ON user_payments.payment_id=payments.id 
                                                                            WHERE 
                                                                                status IN ('PENDING', 'AWAITING VERIFICATION') 
                                                                                AND payments.deleted_at IS NULL    
                                                                                AND user_id={$user['id']}"
                                                                            )
                                    ?> 
                                    <?php if(mysqli_num_rows($pending_payments) == 0):?> 
                                        <tr class="cursor-pointer">
                                            <td><?=$i?></td>
                                            <td>
                                                <?=strtoupper($user['fullname'])?> 
                                            </td>
                                            <td>
                                                <?=$user['email']?> 
                                            </td>
                                            <td>
                                            <form action="process_email.php" method="post">
                                                <input type="hidden" name="id" value="<?=$user['id']?>">

                                                <?php 
                                                    $user_id = $user['id']; 
                                                    $exists  =mysqli_num_rows($mysqli->query("SELECT id  FROM certificates_sent WHERE user_id='$user_id'")); 
                                                ?>  
                                                <button type="submit" name="verify_payment_certificate" class="btn btn-sm <?=$exists >= 1 ? 'btn-danger' : 'btn-info' ?> ml-2">
                                                    <?=$exists >= 1 ? 'Resend Email with Certificate' : 'Send Email with Certificate' ?> 
                                                </button>     
                                            </form>
                                            </td>
                                        </tr>
                                    <?php $i++; ?> 
                                    <?php endif ?> 
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