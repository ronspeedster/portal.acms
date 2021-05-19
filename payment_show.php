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
                <!--Upload Proof Of Payment Form--> 
                <div class="col-md-5">
                    <div class="card shadow overflow-auto">
                        <div class="card-header bg-gradient-primary text-white text-center font-weight-bold">
                            Proof Of Payment
                        </div>
                        <div class="card-body">
                        </div>
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
                                        100.00
                                    </span>
                                </div>
                            </div>
                            <div class="row border-bottom py-3">
                                <div class="col-md-6 text-center">
                                    Payment
                                </div>
                                <div class="col-md-6 text-center">
                                    <span class="bg-success text-white rounded px-2 py-1">
                                        0.00
                                    </span>
                                </div>
                            </div>
                            <div class="row py-3">
                                <div class="col-md-6 text-center">
                                    Balance
                                </div>
                                <div class="col-md-6 text-center">
                                    <span class="bg-success text-white rounded px-2 py-1">
                                        100.00
                                    </span>
                                </div>
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
    $(document).ready(function() {
        $('#candidateTable').DataTable( {
            "pageLength": 50,
            "order": [[ 1, "asc" ]]
        } );

        $("input:checkbox").click(function() {
            var bol = $("input:checkbox:checked").length >= 16;
            $("input:checkbox").not(":checked").attr("disabled",bol);
        });
    } );


</script>