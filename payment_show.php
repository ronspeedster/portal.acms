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
                                        payments.amount 
                                        FROM user_payments 
                                        JOIN payments ON user_payments.payment_id=payments.id 
                                        WHERE user_payments.id=?"
                                    ); 
        $statement->bind_param("i", $_GET["user_payment_id"]); 
        $statement->execute(); 

        $result       = $statement->get_result(); 
        
        if($result->num_rows == 0)
        {
            header("location: payment_index.php");
        }
        else 
        {
            $user_payment = $result->fetch_assoc();

            if($user_payment['user_id'] != $_SESSION['user_id'])
            {
                header("location: payment_index.php");
            }
        }
    }
    
    include('sidebar.php');

    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;

?>
<title><?=$user_payment['title']?></title>
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
                <h1 class="h3 mb-0 text-gray-800"><?=$user_payment['title'] . ' - ' . $user_payment['category']?></h1>
            </div>
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
                        <?php 
                            if(isset($user_payment['proof_of_payment']) && !empty($user_payment['proof_of_payment']))
                            {
                                $filePath = "storage/proof_of_payment/{$user_payment['proof_of_payment']}";
                            }
                            else 
                            {
                                $filePath = "storage/misc/no-image.jpg"; 
                            }
                        ?> 
                        <?php if($user_payment['status'] == "VERIFIED"): ?>
                        <form action="process_certificate.php"" method="POST" target="_blank">
                            <div class="card-body">
                                <img src="<?=$filePath?>" id="preview_image" alt="" class="img-fluid w-100">
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <!-- <button type="submit" name="generate_certificate" class="btn btn-sm bg-gradient-primary text-white">
                                    Generate Certificate
                                </button> -->
                            </div>
                        </form>
                        <?php else: ?> 
                        <form action="process_payment.php?id=<?=$user_payment['id']?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <img src="<?=$filePath?>" id="preview_image" alt="" class="img-fluid w-100">
                                <div class="custom-file my-4">
                                    <input type="file" class="custom-file-input" name="proof_of_payment" id="file_proof_of_payment" aria-describedby="customFileInput">
                                    <label class="custom-file-label" for="customFileInput">Select file</label>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" name="upload_proof_of_payment" class="btn btn-sm bg-gradient-primary text-white">
                                    Submit 
                                </button>
                            </div>
                        </form>
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
                            <div class="row border-bottom py-3" style="display: none">
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
                                            $balance = number_format(($user_payment['amount'] - $user_payment['amount_paid']) ,2)
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
                                        <?=$user_payment['updated_at']?> 
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class='text-justify'>
                                <?php if($user_payment['status'] == "VERIFIED"): ?> 
                                    Your Payment has been Verified. There is nothing else to do here.
                                <?php else: ?> 
                                    <?php if($_SESSION['level_access'] == "temporary"): ?> 
                                        For New Members: your account may be verified if this payment is successfully resolved. An Email will be sent to notify you after we have carefully verify your provided proof of payment. 
                                    <?php else: ?> 
                                        Your Certificate of Good Standing will be sent to your email once your proof of payment has been verified.
                                    <?php endif ?> 
                                <?php endif ?> 
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

<script>
    $(document).ready(function() 
        {
            $('.custom-file-input').on('change', function (e) 
                {
                    let name                  = $("#file_proof_of_payment")[0].files[0].name;
                    let nextSibling           = e.target.nextElementSibling
                        nextSibling.innerText = name

                    readURL(this);
                }
            );

            function readURL(input) 
            {
                if (input.files && input.files[0]) 
                {
                    const reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $('#preview_image').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                }
            }
        }
    );

</script>