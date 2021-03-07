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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <div class="row">
          <div class="col-md-4">
              <div class="card shadow">
                  <div class="card-header">
                      <h6 class="m-0 font-weight-bold" style="color: green;">Suggestions</h6>
                  </div>
                  <div class="card-body">

                  </div>
              </div>
          </div>
            <div class="col-md-8" style="/* width: 70%;height:500px;background-color:green; */">
              <!-- Feed Container -->
              <div class="card shadow row mb-2" style="/*height:150px ; background-color: red;*/">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #1b5b3a;  ">
                    <h6 class="m-0 font-weight-bold" style="color: white;">Announcements</h6>
                  </div>                   
                 <div class="card-body">
                  <div class="text-center">
                  </div>

                </div>
                </div>
              </div>

              <!-- End Feed Container -->
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
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   

    $("#form-status").on("submit",()=>{


        var lat = $(this).find('input[name="client_lat"]');
        var lng = $(this).find('input[name="client_lng"]');

        if(lat.val().trim().length > 0 &&
           lng.val().trim().length > 0){
            return true;
        }
        
      $("#status-post-message").css({"display":"block"});
        return false; 
    });
});

function showPosition(position){
  
  var lat = $("#form-status").find('input[name="client_lat"]');
  var lng = $("#form-status").find('input[name="client_lng"]');
  var loc = $("#form-status").find('input[name="user_location"]');

  lat.val(position.coords.latitude);
  lng.val(position.coords.longitude);

  var geocoding_url="https://maps.googleapis.com/maps/api/geocode/json?";
  geocoding_url += "latlng=";
  geocoding_url += position.coords.latitude + ","
  geocoding_url += position.coords.longitude + "&"
  geocoding_url += "key=AIzaSyArrxFTbz_rmzdZg68nNyMmWkTARS_hfrY"

  loc.val("Unknown Location");
  $.get(geocoding_url,(data,status)=>{
    if(status == "success"){
      if(data.results.length > 0){
        loc.val(data.results[0].formatted_address);
      }
    }
  });
}

</script>