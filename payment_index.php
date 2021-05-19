<?php
    include('dbh.php');
    include('sidebar.php');

    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['getURI'] = $getURI;

?>
<title>Home</title>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

<?php require('topbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow overflow-auto">
                        <div class="card-header bg-gradient-primary text-white font-weight-bold">
                            My Payments                        
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>TITLE</th>
                                        <th>CATEGORY</th>
                                        <th>AMOUNT DUE</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="cursor-pointer">
                                        <td>1</td>
                                        <td>
                                            <a href="payment_show.php" class="cursor-pointer">
                                                ACMS MEMBERSHIP
                                            </a>
                                        </td>
                                        <td>MEMBERSHIP FEE</td>
                                        <td>100</td>
                                        <td>TO BE PAYED</td>
                                    </tr>
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
   /*      
        $('#candidateTable').DataTable( {
            "pageLength": 50,
            "order": [[ 1, "asc" ]]
        } );

        $("input:checkbox").click(function() {
            var bol = $("input:checkbox:checked").length >= 16;
            $("input:checkbox").not(":checked").attr("disabled",bol);
        }); 
    */
    } );


</script>