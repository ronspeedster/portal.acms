<?php

include('sidebar.php');

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['getURI'] = $getURI;

?>
<title>Add Users / Doctors</title>
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
                                <h6 class="m-0 font-weight-bold" style="color: white;">Users who casted their votes</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="votersTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th>Mailing Address</th>
                                            <th>Contact Number</th>
                                            <th>Email Address</th>
                                            <th>PMA Number</th>
                                            <th>PRC Number</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $getVotersVoted = $mysqli->query(" SELECT * FROM tally t
                                        JOIN users u
                                        ON u.id = t.voter_id
                                        GROUP BY u.id ") or die ($mysqli->error);
                                        while($newVoter = $getVotersVoted->fetch_assoc()){ ?>
                                            <tr>
                                                <td><?php echo strtoupper($newVoter['id']); ?></td>
                                                <td><?php echo strtoupper($newVoter['first_name'].' '.$newVoter['last_name']); ?></td>
                                                <td><?php echo strtoupper($newVoter['mailing_address']); ?></td>
                                                <td><?php echo strtoupper($newVoter['contact_num']); ?></td>
                                                <td><?php echo strtoupper($newVoter['email']); ?></td>
                                                <td><?php echo strtoupper($newVoter['pma_number']); ?></td>
                                                <td><?php echo strtoupper($newVoter['prc_number']); ?></td>
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

                <!-- Voters who did not Vote  -->
                <div class="col-md-12" style="/* width: 70%;height:500px;background-color:green; */">
                    <!-- Feed Container -->
                    <div class="card shadow row mb-2" style="/*height:150px ; background-color: red;*/">
                        <div class="card shadow">
                            <div class="card-header" style="background-color: #7f0707;  ">
                                <h6 class="m-0 font-weight-bold" style="color: white;">Users who have not casted their votes</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="votersNotTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th>Mailing Address</th>
                                            <th>Contact Number</th>
                                            <th>Email Address</th>
                                            <th>PMA Number</th>
                                            <th>PRC Number</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $getVotersVotedNot = $mysqli->query("SELECT * FROM users u
                                        LEFT JOIN tally t
                                        ON t.voter_id = u.id
                                        WHERE t.voter_id IS NULL ") or die ($mysqli->error);
                                        while($newVoter = $getVotersVotedNot->fetch_assoc()){ ?>
                                            <tr>
                                                <td><?php echo strtoupper($newVoter['id']); ?></td>
                                                <td><?php echo strtoupper($newVoter['first_name'].' '.$newVoter['last_name']); ?></td>
                                                <td><?php echo strtoupper($newVoter['mailing_address']); ?></td>
                                                <td><?php echo strtoupper($newVoter['contact_num']); ?></td>
                                                <td><?php echo strtoupper($newVoter['email']); ?></td>
                                                <td><?php echo strtoupper($newVoter['pma_number']); ?></td>
                                                <td><?php echo strtoupper($newVoter['prc_number']); ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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
                $('#votersTable').DataTable( {
                    "pageLength": 25
                } );
                $('#votersNotTable').DataTable( {
                    "pageLength": 25
                } );

            } );
        </script>
