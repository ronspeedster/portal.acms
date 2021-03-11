<?php
  require_once('process_post.php');
  include('sidebar.php');

  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  $_SESSION['getURI'] = $getURI;

  $getOwnStatus = mysqli_query($mysqli, "SELECT u.id, u.firstname, u.lastname, up.user_post, up.user_location, up.date_added
    FROM user_posts up
    JOIN users u
    ON u.id = up.user_id
    WHERE up.user_id='$user_id'
    ORDER BY date_added DESC
    LIMIT 1");
  //Get user suggestions
  $getUsersSuggestion = mysqli_query($mysqli, "SELECT * FROM users
    WHERE (id NOT IN (SELECT from_user_id FROM user_links WHERE from_user_id = '$user_id')
    AND id NOT IN (SELECT to_user_id FROM user_links WHERE from_user_id = '$user_id'))
    AND
    (id NOT IN (SELECT from_user_id FROM user_links WHERE to_user_id = '$user_id')
    AND id NOT IN (SELECT to_user_id FROM user_links WHERE to_user_id = '$user_id'))
    AND id <> '$user_id'
    LIMIT 10");
  //Get Friends Posts
  $getFriendsPost = mysqli_query($mysqli, "SELECT * 
    FROM user_posts up
    JOIN users u
    ON u.id = up.user_id
    WHERE (up.user_id IN
           (SELECT from_user_id FROM user_links WHERE to_user_id = '$user_id' AND linked = 'true')
    OR up.user_id IN
           (SELECT to_user_id FROM user_links WHERE from_user_id = '$user_id' AND linked = 'true'))
    ORDER BY up.date_added DESC
    LIMIT 10");
  #print_r($getFriendsPost);

?>
<title>View Pending Request</title>
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
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">All Sent Request<p style="font-size: 1rem;">(Waiting for their confirmation)</p></h1>

          </div>

          <div class="row">
            <div class="col-md-8" style="/* width: 70%;height:500px;background-color:green; */">
              <!-- Feed Container -->
              <div class="card shadow row mb-2" style="/*height:150px ; background-color: red;*/">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #1b5b3a;  ">
                    <h6 class="m-0 font-weight-bold" style="color: white;">Search Profile</h6>
                  </div>                   
                 <div class="card-body">
                  <div class="text-center">
                  </div>
                    <form class="" style="width: 100%;">
                      <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                      </div>
                    </form>
                </div>
                </div>
              </div>
<!-- Get All Relatives -->
          <div class="row">
          <?php  $getAllFriends = mysqli_query($mysqli, " SELECT *
                  FROM users
                 WHERE id IN (SELECT to_user_id FROM user_links WHERE from_user_id = '$user_id' AND linked = 'false') ");
                 while($newAllFriends=$getAllFriends->fetch_assoc()){ 
                  ?>
            <div class="card shadow col-xl-3 col-md-6 mb-2 mx-auto">
              <div class="card-body">
                <p>
                  <a href="<?php echo 'link.php?linkid='.$newAllFriends['id']; ?>" style="color: #1b5b3a;" target="_blank"><img style="height: 2rem; width: 2rem; border-radius: 50%;" src="<?php echo $newAllFriends['profile_image']; ?>">
                <?php echo  $newAllFriends['firstname'].' '.$newAllFriends['lastname'];?></a></p>
                <span style="font-size: 10px;" class="float-right">
                    <i class="far fa-compass"></i>
                    <!-- ADD LOCATION HERE -->Libya</span>
              </div>
            </div>
          <?php } ?>
          </div>       
<!-- End Relatives -->
            </div>

            <div class="col-md-4">
                <div class="card shadow">
                <div class="card-header">
                  <h6 class="m-0 font-weight-bold" style="color: green;">Suggestions</h6>
                </div>
                <div class="card-body">
<?php while($newUsersSuggestion=$getUsersSuggestion->fetch_assoc()){ ?>                  
                  <!-- Content Suggestions -->
                  <?php include('suggestions.php'); ?>                                
                  <!-- End Content Suggestions -->
<?php } ?>
                 <center style="font-size: 11px;">--- NOTHING FOLLOWS ---</center>                   
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