<?php
  require_once('process_post.php');
  include('sidebar.php');

  // $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  // $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  // $_SESSION['getURI'] = $getURI;

  // $getOwnStatus = mysqli_query($mysqli, "SELECT u.id, u.firstname, u.lastname, up.user_post, up.user_location, up.date_added
  //   FROM user_posts up
  //   JOIN users u
  //   ON u.id = up.user_id
  //   WHERE up.user_id='$user_id'
  //   ORDER BY date_added DESC
  //   LIMIT 1");

  // //Get user suggestions
  // $getUsersSuggestion = mysqli_query($mysqli, "SELECT * FROM users
  //   WHERE (id NOT IN (SELECT from_user_id FROM user_links WHERE from_user_id = '$user_id')
  //   AND id NOT IN (SELECT to_user_id FROM user_links WHERE from_user_id = '$user_id'))
  //   AND  
  //   (id NOT IN (SELECT from_user_id FROM user_links WHERE to_user_id = '$user_id')
  //   AND id NOT IN (SELECT to_user_id FROM user_links WHERE to_user_id = '$user_id'))
  //   AND id <> '$user_id'
  //   LIMIT 10");
  
  // //Get Friends Posts
  // $getFriendsPost = mysqli_query($mysqli, "SELECT * 
  //   FROM user_posts up
  //   JOIN users u
  //   ON u.id = up.user_id
  //   WHERE (up.user_id IN
  //          (SELECT from_user_id FROM user_links WHERE to_user_id = '$user_id' AND linked = 'true')
  //   OR up.user_id IN
  //          (SELECT to_user_id FROM user_links WHERE from_user_id = '$user_id' AND linked = 'true'))
  //   ORDER BY up.date_added DESC
  //   LIMIT 10");
  // #print_r($getFriendsPost);
  $user_post_locations = mysqli_query($mysqli, 
  "SELECT distinct user_status, user_long, user_lat
   FROM user_posts
   WHERE user_status is not null AND
          user_long is not null AND
          user_lat is not null");

?>
<title>Safe Locations - Map</title>
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
            <h1 class="h3 mb-0 text-gray-800">Safe Location</h1>
          </div>

        <div class="row">
            <div class="col-md-10" style="/* width: 70%;height:500px;background-color:green; */">
                <!-- Feed Container -->
                
                <div id="map" style="width:100%;height:500px;"></div>                
            </div>
            <div class="col-md-2">
                <div style="display:flex;height:30px;width:100%;box-sizing:border-box;">
                    <img src="img/safe_location.png" height="30" width="30" />
                    <span style="line-height:30px;font-weight:bold;margin:0px 10px"> Safe </span>
                </div>
                <div style="display:flex;height:30px;width:100%;box-sizing:border-box;">
                    <img src="img/danger_location.png" height="30" width="30" />
                    <span style="line-height:30px;font-weight:bold;margin:0px 10px"> Danger </span>
                </div>
                <div style="display:flex;height:30px;width:100%;box-sizing:border-box;">
                    <img src="img/suggested_location.png" height="30" width="30" />
                    <span style="line-height:30px;font-weight:bold;margin:0px 10px"> Suggested  </span>
                </div>
                <div style="display:flex;height:30px;width:100%;box-sizing:border-box;">
                    <img src="img/user_location.png" height="30" width="30" />
                    <span id="label-userlocation" style="line-height:30px;font-weight:bold;margin:0px 10px">Your location (Location permission is blocked)</span>
                </div>
                <!-- <button id="btntest" style="margin-top:30px;">test</button> -->
            </div>
        </div>
<!-- Own Status always on on top -->

<?php
  include('footer.php');
?>

<script>
var user_lat = undefined;
var user_lng = undefined;
var safe_coordinates = undefined;
var map;
$(document).ready(function(){
    $("#nav-item-home").removeClass("active");
    $("#nav-item-safelocation").addClass("active");

    navigator.geolocation.getCurrentPosition(function(position){
      $("#label-userlocation").html("Your location");
        user_lat = position.coords.latitude;
      user_lng = position.coords.longitude;
      });
    
});


function initMap() {
       
  var safe_image = {
    url: 'img/safe_location.png',
    size: new google.maps.Size(50, 50),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(25, 25)
  };
  var danger_image = {
    url: 'img/danger_location.png',
    size: new google.maps.Size(50, 50),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(25, 25)
  };    
  var suggested_image = {
    url: 'img/suggested_location.png',
    size: new google.maps.Size(50, 50),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(25, 25)
  }; 
  var user_location_image = {
    url: 'img/user_location.png',
    size: new google.maps.Size(50, 50),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(25, 25  )
  };

  //var libya = {lat: 26.0773223, lng: 16.1605419};
  var libya = {lat: 15.4130117, lng: 121.3646784};
    
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 9,  
      mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP]
      },
      streetViewControl: false,center: libya});      


  <?php 

    $safe_locations = [];
    while($row = $user_post_locations->fetch_assoc()){
      
      $status_images = ["safe" => "safe_image",
      "danger"=>"danger_image"];
      $status_image = $status_images[$row["user_status"]];
      $lat = $row["user_lat"];
      $lng = $row["user_long"];

      if($status_image == "safe_image"){
        array_push($safe_locations, ["lat"=>$lat, "lng"=>$lng]);
      }
    

    echo "
    new google.maps.Marker({position: {lat: $lat, lng: $lng}, map: map , icon:$status_image});
    ";

    
    }

    $json_safe_locations = json_encode($safe_locations);
    echo "safe_coordinates = JSON.parse('$json_safe_locations');";
    // echo "alert(safe_coordinates.length);";
   

  ?>
  google.maps.event.addListenerOnce(map, 'idle', function(){
    if(user_lat != undefined && 
        user_lng != undefined){
        new google.maps.Marker({position: {lat:user_lat , lng: user_lng}, map: map, icon:user_location_image });



        
          var suggested_location = {lat : -1, lng : -1};
          if(safe_coordinates.length > 0){

            suggested_location.lat = parseFloat(safe_coordinates[0].lat);
            suggested_location.lng = parseFloat(safe_coordinates[0].lng);

            for(var i = 0; i < safe_coordinates.length-1; i++){

              if(distance(user_lat,user_lng, safe_coordinates[i].lat, safe_coordinates[i].lng, "K")          > 
                 distance(user_lat,user_lng, safe_coordinates[i + 1].lat, safe_coordinates[i + 1].lng, "K")  ){
                  
                  suggested_location.lat = parseFloat(safe_coordinates[i + 1].lat);
                  suggested_location.lng = parseFloat(safe_coordinates[i + 1].lng);
                }

              }

              //alert(JSON.stringify(suggested_location));
              new google.maps.Marker({position: suggested_location, map: map, icon:suggested_image });
          }


        }


  });

  
  
}

function distance(lat1, lon1, lat2, lon2, unit) {
	if ((lat1 == lat2) && (lon1 == lon2)) {
		return 0;
	}
	else {
		var radlat1 = Math.PI * lat1/180;
		var radlat2 = Math.PI * lat2/180;
		var theta = lon1-lon2;
		var radtheta = Math.PI * theta/180;
		var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
		if (dist > 1) {
			dist = 1;
		}
		dist = Math.acos(dist);
		dist = dist * 180/Math.PI;
		dist = dist * 60 * 1.1515;
		if (unit=="K") { dist = dist * 1.609344 }
		if (unit=="N") { dist = dist * 0.8684 }
		return dist;
	}
}

</script>
 <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyArrxFTbz_rmzdZg68nNyMmWkTARS_hfrY&callback=initMap' async defer></script>
