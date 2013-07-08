<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <?php
  if(empty($_SESSION['name'])&&empty($_SESSION['groupid'])){
        $name = $_POST['name'];
        $groupid = $_POST['groupid'];
        $_SESSION['name'] = $name;
        $_SESSION['groupid'] = $groupid;
    }
  ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/alertify.core.css" rel="stylesheet">
    <link href="../css/alertify.default.css" rel="stylesheet">    
    <link type="text/css" rel="stylesheet" href="../css/main.css" />
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap-transition.js"></script>
    <script src="../js/bootstrap-modal.js"></script>
    <script type="text/javascript" src="../js/ajaxupload.js"></script>
    <script src="../js/alertify.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
    <script src="../js/jQuery.bMap.1.3.1.min.js" type="text/javascript"></script>
    
    <style type="text/css">
    <!--
-->
</style>
  <div id="changepic" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="joinBoxLabel" aria-hidden="true">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="changepicLabel">Change your profile picture</h3>
                </div>
                <div class="modal-body">
                  <form action="ajaxupload.php" method="post" name="sleeker" id="sleeker" enctype="multipart/form-data">
                            <input type="hidden" name="maxSize" value="9999999999" />
                            <input type="hidden" name="maxW" value="200" />
                            <input type="hidden" name="fullPath" value="http://localhost/Map-your-friend/res/usr_img/" />
                            <input type="hidden" name="relPath" value="../../res/usr_img/" />
                            <input type="hidden" name="colorR" value="255" />
                            <input type="hidden" name="colorG" value="255" />
                            <input type="hidden" name="colorB" value="255" />
                            <input type="hidden" name="maxH" value="300" />
                            <input type="hidden" name="filename" value="filename" />
                            
<p><input type="file" name="filename" onchange="ajaxUpload(this.form,'ajaxupload.php?filename=name&amp;maxSize=9999999999&amp;maxW=200&amp;fullPath=http://localhost/Map-your-friend/res/usr_img/&amp;relPath=../../res/usr_img/&amp;colorR=255&amp;colorG=255&amp;colorB=255&amp;maxH=300','upload_area','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;" /></p>
</form>

<div id="upload_area">
</div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
                    </form>
            </div>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2" id="usernavbar">
      <!--Sidebar content-->
          
      
        <img src="../../res/usr_img/<?php echo $_SESSION['groupid'].'/'.$_SESSION['name'].'_'.$_SESSION['groupid'].'.jpg'; ?> "></img>
        <ul class="nav nav-pills nav-stacked">
          <li><a href="#changepic" data-toggle="modal" data-target="#changepic">Change pic</a> </li>
          <li><a href="#">Second</a> </li>
          <li><a href="#">Third</a> </li>
        </ul>
      

    </div>
 <div class="span10">
      <!--Body content-->
    
<script type="text/javascript">
    //Basic bMap setup...
        navigator.geolocation.watchPosition(success,error);
        function success(position) {
    lat = position.coords.latitude;    //Get the Latitude and Longitude of the user
    lng = position.coords.longitude;
    console.log(''+lat+lng);

    $(document).ready(function(){ 
        $("#map").bMap({
            mapZoom: 2,
            mapCenter:[57.9, 14.6],
            mapSidebar:"sideBar",
        });
        //Here we get the markers from another page with AJAX
        $('#map').data('bMap').AJAXMarkers({    
            serviceURL: "db.php?name=<?php echo $_SESSION['name'];?>&groupid=<?php echo $_SESSION['groupid'];?>&lat="+lat+"&lng="+lng 
        });

        var interval = setInterval(function() {
        navigator.geolocation.getCurrentPosition(success,error);
        function success(position) {
        lat = position.coords.latitude;    //Get the Latitude and Longitude of the user
        lng = position.coords.longitude;
        console.log(''+lat+lng);

        $('#map').data('bMap').removeAllLayers()
        $('#map').data('bMap').AJAXMarkers({    
            serviceURL:  "db.php?name=<?php echo $_SESSION['name'];?>&groupid=<?php echo $_SESSION['groupid'];?>&lat="+lat+"&lng="+lng
        });

}
function error(error){
}

    }, 5000);

    });

}
function error(error){
}

</script>
<?php include('geodata.php');?>
<div style="width:700px;height:500px;">
    <div id="map"></div>
    <div id="sideBar"></div>
</div>

<div id="messages">
    
      </div><!-- Messages -->
      <div id="input">
          <div id="feedback"></div>
          <form action="#" method="post" id="form_input">
              <br /><lable>Enter Message:<br /><textarea id="message" cols="25" rows="4"></textarea></lable><br />
              <input type="submit" name="send" id="send" value="Send Message"/>
          </form>
      </div><!-- Input -->
      <script type="text/javascript" src="../js/auto_chat.js"></script>
      <script type="text/javascript" src="../js/send.js"></script>
</div>
  </div>
</div>
      
</html>
