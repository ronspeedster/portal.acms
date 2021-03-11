<?php
  require_once('process_post.php');

  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  $_SESSION['getURI'] = $getURI;

  $getUsersSuggestion = mysqli_query($mysqli, "SELECT * FROM users
    WHERE (id NOT IN (SELECT from_user_id FROM user_links WHERE from_user_id = '$user_id')
    AND id NOT IN (SELECT to_user_id FROM user_links WHERE from_user_id = '$user_id'))
    AND
    (id NOT IN (SELECT from_user_id FROM user_links WHERE to_user_id = '$user_id')
    AND id NOT IN (SELECT to_user_id FROM user_links WHERE to_user_id = '$user_id'))
    AND id <> '$user_id'
    LIMIT 10");

$requested = false;
$requester = false;
  if(isset($_GET['linkid'])){

    #Check if link is self;
    if($_GET['linkid']==$user_id){
      header("location: profile.php");
    }

    #Get Link Information
    $linkID = $_GET['linkid'];
    $getLink = mysqli_query($mysqli, " SELECT * FROM users WHERE id = '$linkID' ");
    if(mysqli_num_rows($getLink)==0){
      header("location: index.php");
    }
    else{
      $newLink = $getLink->fetch_array();
    }

    #Get Request Information
    $getRequest = mysqli_query($mysqli, "SELECT *
      FROM user_links
      WHERE (from_user_id = '$linkID'
      AND to_user_id = '$user_id')
      OR (from_user_id = '$user_id'
      AND to_user_id = '$linkID')");
    if(mysqli_num_rows($getRequest)>0){
      $requested = true;

      #Check if requester current session
      $checkRequester =  mysqli_query($mysqli, "SELECT *
        FROM user_links
        WHERE from_user_id = '$user_id'
        AND to_user_id = '$linkID' ");
       if(mysqli_num_rows($checkRequester)>0){
        $requester = true;
       }
       else{
        $requester = false;
       }
    }
    else{
      $requested = false;
    }
  }
  else{
    header("location: index.php");
  }

#Check if Confirmed
  $confirmed = false;
  $getConfirmRequest = mysqli_query($mysqli, "SELECT * FROM user_links
    WHERE ((from_user_id = '$linkID'
    AND to_user_id = '$user_id')
    OR (from_user_id = '$user_id'
    AND to_user_id = '$linkID'))
    AND linked = 'true' ");
  if(mysqli_num_rows($getConfirmRequest)>0){
     $confirmed = true;
  }



//Cheat the header files
include('sidebar.php');
?>
<title><?php echo $newLink['firstname'].' '.$newLink['lastname']; ?></title>
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
            <div class="align-items-center mb-4">
              <center><img style="width: 10rem; height: 10rem; border-radius: 50%; border: 3px solid #17A673;" src="<?php echo  $newLink['profile_image']; ?>"></center>
            </div>
          <div class="row">
            <div class="col-md-8" style="/* width: 70%;height:500px;background-color:green; */">
              <!-- Feed Container -->
              <div class="card shadow row mb-2" style="/*height:150px ; background-color: red;*/">
                <div class="card shadow">
                  <div class="card-header text-center" style="width: 100%;">
                    <h3 class="m-0 font-weight-bold" style="color: #1b5b3a;"><?php echo $linkFullname = $newLink['firstname'].' '.$newLink['lastname']; ?></h3>
                  </div>                   
                 <div class="card-body text-center">
<?php
if(!$confirmed){
  if($requested){ ?>                  
                  <table width="100%">
                    <tr>
                      <td><button class="btn btn-sm float-right" id="dropdownMenuButtonConfirm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: green; color: white;" <?php if($requester){echo "disabled";} ?> ><i class="far fa-check-circle"></i><?php if($requester){echo " Pending Request";} else{echo " Confirm Request";} ?></button>
                        <!-- Start Drop down Confirm here -->
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonConfirm">Confirm Request? You can't undo the changes
                          <br/>
                          <a href="process_post.php?confirmfromlink=<?php echo $linkID;?>&tolink=<?php echo $user_id; ?>" class='btn btn-primary btn-sm'><i class="far fa-check-circle"></i> Confirm</a>
                          <a href="#" class='btn btn-secondary btn-sm'><i class="far fa-window-close"></i> Cancel</a>
                        </div>
                      </td>
                      <td><button class="btn btn-sm btn-danger float-left" id="dropdownMenuButtonDelete" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-trash-alt"></i> Delete Request</button>
                        <!-- Start Drop down Delete here -->
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonDelete">Delete Request? You can't undo the changes
                          <br/>
                          <a href="#" class='btn btn-danger btn-sm'><i class="far fa-trash-alt"></i> Confirm Delete</a>
                          <a href="#" class='btn btn-secondary btn-sm'><i class="far fa-window-close"></i> Cancel</a>
                        </div>
                      </td>
                    </tr>
                  </table>
<?php } else{ ?>
               <a href="process_post.php?addlink=<?php echo $linkID; ?>" class="btn btn-sm btn-success">+ Send Link Request</a>   
<?php }
} /* If not Confirmed */
else{ 
  echo "<button class='btn text-center font-weight-bold disabled' style='background-color: #1b5b3a; color: white;'><i class='far fa-check-circle'></i> Link Confirmed</button>";
}
?>
                </div>
                </div>
              </div>
<?php
  $getPosts = mysqli_query($mysqli, " SELECT * FROM user_posts WHERE user_id = '$linkID' ");
  #print_r($getPosts);
  if($confirmed){
  while($newPosts=$getPosts->fetch_assoc()){
    $getDateAdded = date_create($newPosts['date_added']);
    $date_added = date_format($getDateAdded, 'F j, Y');
    $time_added = date_format($getDateAdded, 'h:i A');
    $newDateAdded = $date_added.' at '.$time_added;
    $status = $newPosts['user_status'];
?>
              <div class="card shadow row mb-2">
                <div class="card shadow">
                  <div class="card-header">
                    <h6 class="m-0 font-weight-bold" style="color: #1b5b3a;" ><?php echo $linkFullname;  ?>
                    <button class="btn btn-sm <?php if($status=='danger'){echo 'btn-danger';}else{echo 'btn-success';} ?>" style="font-size: 10px; padding: 1px;"><?php echo strtoupper($status); ?>
                    </button>
                    <span class="float-right font-weight-normal" style="font-size: 12px;"><?php echo $newDateAdded; ?>
                    </span>
                    </h6>
                  </div>
                  <div class="card-body">
                    <p> <?php echo $newPosts['user_post'];?> </p>
                    <span style="font-size: 10px;" class="float-right">
                    <i class="far fa-compass"></i> <?php echo $newPosts['user_location'];?>
                  </span>
                  </div>
                </div>
              </div>
            <?php }
          }else { ?>
            <div class="card shadow row mb-2 alert alert-warning">Status posts are hidden to strangers</div>
<?php } ?>

              <!-- End Feed Container -->
            </div>

            <div class="col-md-4">
                <div class="card shadow">
                <div class="card-header">
                  <h6 class="m-0 font-weight-bold" style="color: green;">Suggestions</h6>
                </div>
                <div class="card-body">
<?php while($newUsersSuggestion=$getUsersSuggestion->fetch_assoc()){ ?>                  
                  <!-- Content Suggestions -->
                    <?php include("suggestions.php"); ?>                                      
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