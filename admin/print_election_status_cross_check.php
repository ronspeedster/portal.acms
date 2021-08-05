<?php

include('sidebar.php');

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['getURI'] = $getURI;


#Get Election Liquidation
$getElectionLiquidation = mysqli_query($mysqli, "SELECT u.first_name AS v_first_name, u.last_name AS v_last_name, c.first_name AS c_first_name, c.last_name AS c_last_name
                                                        FROM tally t
                                                        JOIN users u
                                                        ON u.id = t.voter_id
                                                        JOIN candidates c
                                                        ON c.id = t.candidate_id");
?>
<title>Print Voters Liquidation</title>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php require('topbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <?php
            if(isset($_SESSION['message'])){?>
                <div class="alert alert-<?=$_SESSION['msg_type']?> alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php } ?>

            <div class="row">

                <!-- User List Here  -->
                <div class="col-md-12" style="/* width: 70%;height:500px;background-color:green; */">
                    <!-- Feed Container -->
                    <div class="card shadow row mb-2" style="/*height:150px ; background-color: red;*/">
                        <div class="card shadow">
                            <div class="card-header" style="background-color: #1b5b3a;  ">
                                <h6 class="m-0 font-weight-bold" style="color: white;">Candidates Liquidation</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="liquidationTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Voter's Name</th>
                                            <th>Candidate's Name (Voted)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $counter=0;
                                        while($newElectionLiquidation = $getElectionLiquidation->fetch_assoc()){ ?>
                                            <tr>
                                                <td><?php echo ++$counter; ?></td>
                                                <td><?php echo strtoupper($newElectionLiquidation['v_first_name'].' '.$newElectionLiquidation['v_last_name']); ?></td>
                                                <td><?php echo strtoupper($newElectionLiquidation['c_first_name'].' '.$newElectionLiquidation['c_last_name']); ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End User List Here  -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
<style>
.navbar-nav{
    display: none;
}
.navbar {
    display: none;
}
</style>
