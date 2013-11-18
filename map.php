<?php require_once('Connections/jnu_seat_plan.php'); ?>


<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$roll_no = $_POST['roll'];

mysql_select_db($database_jnu_seat_plan, $jnu_seat_plan);
$query_informetion_all = "SELECT roll_start, roll_end, room_no, room_loc, center.center_id, center_location.center_loc_id, center.center_name, center_location.center_loc, center_location.latitude, center_location.longitude 
						  FROM information, center, center_location
						  WHERE roll_start <= $roll_no and roll_end >= $roll_no
						  AND information.center_id = center.center_id
						  AND information.center_loc_id = center_location.center_loc_id";
						  
$informetion_all = mysql_query($query_informetion_all, $jnu_seat_plan) or die(mysql_error());
$row_informetion_all = mysql_fetch_assoc($informetion_all);
$totalRows_informetion_all = mysql_num_rows($informetion_all);
if($totalRows_informetion_all==0){
  ob_clean();
  header("Location: index.php?error=Roll not found.Please check your roll again."); 
}
?>

<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

        <title>Seat Plan Of JNU</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="css/demo.css" media="all" />
        <link href="css/main.css" rel="stylesheet"/>

        <!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
        <script type="text/javascript">
        function initialize() {
            var mapOptions = {
              center: new google.maps.LatLng(<?php echo $row_informetion_all['latitude']; ?>, <?php echo $row_informetion_all['longitude']; ?>),
              zoom: 8,
              mapTypeId: google.maps.MapTypeId.ROADMAP
          };
            var map = new google.maps.Map(document.getElementById("map-1"),
            mapOptions);
        }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script> -->

        <script type="text/javascript"   src="http://maps.google.com/maps/api/js?sensor=false"></script> 
        <script type="text/javascript">
        window.onload = function() { 
          var mapDiv = document.getElementById('map-1'); 
          var latlng = new google.maps.LatLng(<?php echo $row_informetion_all['latitude']; ?>, <?php echo $row_informetion_all['longitude']; ?>);  
          var options = {   
            center: latlng,   
            zoom: 16,   
            mapTypeId: google.maps.MapTypeId.ROADMAP 
          }; 
          var map = new google.maps.Map(mapDiv, options); 
          var marker = new google.maps.Marker({
            position: new google.maps.LatLng(<?php echo $row_informetion_all['latitude']; ?>, <?php echo $row_informetion_all['longitude']; ?>),
            map: map,
            title: 'Details'
          });
           google.maps.event.addListener(marker, 'click', function() {
    
      // Check to see if an InfoWindow already exists
      
        infoWindow = new google.maps.InfoWindow();
      
      
      // Creating the content  
      var content = "Roll From : <?php echo $row_informetion_all['roll_start'].' - '.$row_informetion_all['roll_end']; ?>";
      
      // Setting the content of the InfoWindow
      infoWindow.setContent(content);
      
      // Opening the InfoWindow
      infoWindow.open(map, marker);
    
    });
    
   
        };
        </script>

    </head>

    <body class="listing">
        <?php include('_include/menu.php'); ?>
        

        <div class="container">

            <div class="styles">
                <div class="style row">
                    <div class="col-md-7 map-container" style="padding-left: 0">
                        <div id="map-1" class="pull-left map col-md-8"></div>
                    </div>

                    <div class="info col-md-5">
                        <span class="style-name">
                            <p><b>Roll No</b> : <?php echo $roll_no; ?></p>
                        </span>

                        <span class="style-para">
                        <p>
                                <b>Center</b> : <?php echo $row_informetion_all['center_name']; ?>
                            </p>
                        </span>

                        <span class="style-para">
                            <p><b>Room No</b> : <?php echo $row_informetion_all['room_no']; ?></p>
                        </span>
                        
                        <span class="style-para">
                            <p><b>Room Location</b> : <?php echo $row_informetion_all['room_loc']; ?></p>
                        </span>

                        <span class="style-para">
                            <p><b>Location</b> : <?php echo $row_informetion_all['center_loc']; ?></p>
                        </span>

                        <!-- <div class="created">
                            Adam Krogh on October 24, 2013
                        </div>
                        
                        <div class="style-desc">
                            Inspired by CloudMade&#39;s style of the same name. Use of subdued colours results in an excellent style for sites with a pastel colour scheme.
                        </div> 

                        <div class="more-info">
                            <a href="/style/1/pale-dawn"><small>More info...</small></a>
                        </div>-->

                        <!-- <p>
                            <a href="/tag/subtle" class="tag-link">
                                <span class="label">subtle</span>
                            </a>
                        
                            <a href="/tag/light" class="tag-link">
                                <span class="label">light</span>
                            </a>
                        
                            <a href="/tag/pastel" class="tag-link">
                                <span class="label">pastel</span>
                            </a>
                            <a href="/tag/cloudmade" class="tag-link">
                                <span class="label">cloudmade</span>
                            </a>
                        </p> -->
                    </div>
                </div>
            </div>
        </div>
        
<?php include('_include/footer.php'); ?>
    </body>
</html>
<?php
mysql_free_result($informetion_all);
?>
