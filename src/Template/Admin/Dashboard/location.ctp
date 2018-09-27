
<link href="http://vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/4.12/video.js"></script>
<!-- Main content -->

<section class="content">

    <video id="MY_VIDEO_1" class="video-js vjs-default-skin" controls preload="auto" width="1280" height="950" data-setup="{}">
 <source src="http://phpdev.co.in/location.mp4" type='video/mp4'>
 <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
</video>
    <!-- /.row -->
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA_xC-RVysb6OVwn6jHdbhrHNZv_ePgNos"></script>
<script type="text/javascript">
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (p) {
        var LatLng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);
        
        var mapOptions = {
            center: LatLng,
            zoom: 18,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
        var marker = new google.maps.Marker({
            position: LatLng,
            map: map,
            title: "<div style = 'height:60px;width:200px'><b>Your location:</b><br />Latitude: " + p.coords.latitude + "<br />Longitude: " + p.coords.longitude
        });
        google.maps.event.addListener(marker, "click", function (e) {
            var infoWindow = new google.maps.InfoWindow();
            infoWindow.setContent(marker.title);
            infoWindow.open(map, marker);
        });
    });
} else {
    alert('Geo Location feature is not supported in this browser.');
}
</script>
<div id="dvMap" style="width: 500px; height: 500px">
</div>

</section>
