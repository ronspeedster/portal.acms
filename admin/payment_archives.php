<?php
    require_once('../process_post.php');
    include('sidebar.php');

    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;

    $payments   =   $mysqli->query("SELECT * FROM payments WHERE deleted_at is NOT NULL");
?>
<title>Payment Archives</title>
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
                            Archived Payments                        
                        </div>
                        <div class="card-body">
                            <table id="table_payments" class="table table-hover text-sm">
                                <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>TITLE</th>
                                      <th>CATEGORY</th>
                                      <th>AMOUNT</th>
                                      <th>ARCHIVED AT</th>
                                      <th>ACTIONS</th>
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
                                        <td>
                                            <?=$payment['category']?> 
                                        </td>
                                        <td>
                                            <?=$payment['amount']?> 
                                        </td>
                                        <td>
                                            <?=$payment['deleted_at']?> 
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <form action="process_payment.php?payment_id=<?=$payment['id']?>" method="post">
                                                        <button type="submit" name="delete_payment" href="process_payment.php?payment_id=<?=$payment['id']?>" class="btn btn-sm btn-danger text-white">
                                                            <i class='fa fa-trash mr-2'></i>Delete
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-md-5">
                                                    <form action="process_payment.php?payment_id=<?=$payment['id']?>" method="post">
                                                        <button type="submit" name="restore_payment" href="process_payment.php?payment_id=<?=$payment['id']?>" class="btn btn-sm btn-info text-white">
                                                            <i class='fa fa-wrench mr-2'></i>Restore
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
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