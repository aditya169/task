<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str; //save marker status
}

function updateMarkerPosition(latLng) {
  document.getElementById('info').innerHTML = [latLng.lat(),latLng.lng()].join(', ');
  document.getElementById('lat1').value = latLng.lat(); // save dragged lattitude
  document.getElementById('lang1').value =latLng.lng();  //save dragged longitude
}

function updateMarkerAddress(str) {
  //document.getElementById('autocomplete').innerHTML = str;
  document.getElementById('autocomplete').value=str;    // save dragged location
  
}

function initialize() {
  var latLng = new google.maps.LatLng(<?php echo $lat1;?>, <?php echo $lang1;?>);
  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom: 3,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var marker = new google.maps.Marker({
    position: latLng,
    title: 'Point A',
    map: map,
    draggable: true
  });

  // Update current position info.
  updateMarkerPosition(latLng);  
  geocodePosition(latLng);

  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('loading location...');
  });

  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
  });

  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });
}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);

</script>
<style>
  #mapCanvas {
    width: 650px;
    height: 400px;
    float: left;
  }
  #infoPanel {
    float: left;
    margin-left: 9px;
  }
  #infoPanel div {
  margin-bottom: 5px;
  }
</style>