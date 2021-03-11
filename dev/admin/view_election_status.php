<?php

include('sidebar.php');

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['getURI'] = $getURI;


#Get Candidates
$getElectionStatus = mysqli_query($mysqli, "SELECT * FROM candidates");
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
                                <h6 class="m-0 font-weight-bold" style="color: white;">Candidates</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="userTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th># of Votes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($newCandidate = $getElectionStatus->fetch_assoc()){ ?>
                                            <tr>
                                                <td><?php echo $newCandidate['id']; ?></td>
                                                <td><?php echo $newCandidate['first_name'].' '.$newCandidate['last_name']; ?></td>
                                                <td>
                                                    <?php
                                                        $candidate_id = $newCandidate['id'];
                                                        $getScore = mysqli_query($mysqli, "SELECT COUNT(candidate_id) AS score FROM tally WHERE candidate_id = '$candidate_id' ");
                                                        $newScore = $getScore->fetch_array();

                                                        echo $newScore['score'];
                                                    ?>
                                                </td>
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
        <?php
        include('footer.php');
        ?>
        <script>
            $(document).ready(function() {
                $('#userTable').DataTable( {
                    "pageLength": 50,
                    "order": [[ 2, "desc" ]]
                } );
            } );
        </script>
