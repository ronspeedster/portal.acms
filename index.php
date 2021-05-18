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
        <?php if(isset($_SESSION['message'])): ?> 
            <div class="alert alert-<?=$_SESSION['msg_type']?> alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?=$_SESSION['message']?> 
                <?php unset($_SESSION['message']);?>
            </div>
        <?php endif ?> 
          <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <div class="row">

                <div class="col-md-8">
                    <?php if($_SESSION['level_access'] !== "temporary"): ?> 
                    <!-- Feed Container -->
                    <div class="card shadow row mb-2">
                        <div class="card shadow">
                            <div class="card-header" style="background-color: #1b5b3a;">
                                <h6 class="m-0 font-weight-bold" style="color: white;">ACMS Local Elections</h6>
                            </div>
                            <div class="card-body">
                                <div style="text-align: center;">
                                    ACMS Local Elections 2021 is now close. Thank you
                                </div>
                                <!-- Election Day 2021 Form Here -->
                                <?php
                                    $user_id = $_SESSION['user_id'];
                                    $getTally = mysqli_query($mysqli, "SELECT * FROM tally WHERE voter_id = '$user_id' ");
                                    $voteRecord = mysqli_num_rows($getTally);

                                    $getCandidates = mysqli_query($mysqli, "SELECT * FROM candidates");
                                ?>
                                <!-- Get Summary of Votes -->
                                <?php if($voteRecord>=1): ?> 
                                    <?php 
                                        $getYourVotes = mysqli_query($mysqli, "SELECT * FROM tally t JOIN candidates c ON c.id = t.candidate_id WHERE t.voter_id = '$user_id' ");
                                    ?>
                                    <div style="text-align: center;" style="display: none;">
                                        Your vote has been uploaded. Here is the summary of your ballot.
                                    </div>
                                    <table class="table" style="display: none;">
                                        <thead>
                                            <th style="text-align: center;">Candidate's Name</th>
                                        </thead>
                                        <tbody>
                                        <?php while($newYourVotes = $getYourVotes->fetch_assoc()):?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <?php echo strtoupper($newYourVotes['first_name'].' '.$newYourVotes['last_name']); ?>
                                                </td>
                                            </tr>
                                        <?php endwhile ?>
                                        </tbody>
                                    </table>
                                <?php else: ?> 
        <!--                         <div style="text-align: center;">-->
        <!--                             ACMS Local Elections 2021 is now close. Thank you-->
        <!--                         </div>-->
                                <?php endif ?>
                                <!-- End Get Summary of Votes-->
                                <form method="post" action="process_election.php" style="<?php if($voteRecord>=1){echo 'display: none;';} ?> display: none;" >
                                    <center>
                                        <h4>Local Elections<br>March 14, 2021</h4>
                                        <h6>Please cast your votes</h6>
                                    </center>
                                    <table class="table table-bordered" id="candidateTable" width="100%" cellspacing="0">
                                        <thead>
                                            <th>Tick checkbox to include the names in the ballot</th>
                                            <th width="75%">Full Name</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $candidateNum = 1;
                                        ?> 
                                        <?php while($newCandidate=$getCandidates->fetch_assoc()): ?>
                                            <tr>
                                                <td>
                                                    <div class="text-right">
                                                    <input type="checkbox" name="candidate[]" value="<?php echo $newCandidate['id']; ?>" <?php if($_SESSION['is_update']==0){echo 'disabled';} ?>>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo strtoupper($newCandidate['first_name'].' '.$newCandidate['last_name']); ?>
                                                </td>
                                            </tr>
                                        <?php
                                            $candidateNum++;
                                        ?> 
                                        <?php endwhile ?>
                                        </tbody>
                                    </table>

                                    <br>
                                    <?php if($_SESSION['is_update'] == 1):?>
                                        <!-- Start Drop down Delete here -->
                                        <button class="float-right btn btn-warning dropdown-toggle mb-1 text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled>
                                            <i class="fas fa-upload"></i> Cast Votes
                                        </button>
                                        <div class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton btn-sm">
                                            Are you sure you want to upload the votes? You cannot undo the changes<br/>
                                            <button type="submit" class="btn btn-primary btn-sm" name="cast_vote">
                                            <i class="fas fa-upload"></i> Confirm Cast Vote
                                            </button>
                                            <a href="#" class='btn btn-warning btn-sm text-dark'><i class="far fa-window-close"></i> Cancel</a>
                                        </div>
                                        <!-- End Dropdown here -->
                                    <?php else:  ?>
                                        <center>Please update your <a href="profile.php">Profile</a> first to cast your vote(s).</center>
                                    <?php endif ?>
                                </form>
                                <!-- End Election Day Form here -->
                            <div class="text-center">
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="card shadow row mb-2">
                    <div class="card shadow">
                        <div class="card-header bg-warning">
                            <h6 class="m-0 font-weight-bold" style="color: white;">Notice</h6>
                        </div>                   
                        <div class="card-body">
                            <div class="text-center">
                                You are currently using a temporary account. Please pay your membership fees to access the other system features. 
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?> 
            </div>

          <div class="col-md-4">
              <div class="card shadow">
                  <div class="card-header">
                      <h6 class="m-0 font-weight-bold" style="color: green;">Suggestions</h6>
                  </div>
                  <div class="card-body">
                      <div>Please update your profile <a href="profile.php">here. Link to profile page. </a> </div>
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