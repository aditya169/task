<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">!
<!--
//============================================================+
// File name   : map.php
//
// Description : Outputs Google map on the screen
//
// Author:  Aditya Mathur
//
// (c) Copyright:
//               Aditya Mathur
//               eztasker.com
//
// License:
//    Copyright (C) 2014 Aditya Mathur - eztasker.com
//============================================================+
-->
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>Map</title>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key="" type="text/javascript"></script>
<link href="./css/geometry.css" rel="stylesheet" />
<script type="text/javascript">
 //<![CDATA[
 
 var map = null;
 var geocoder = null;
 
 function load() {
 
	if (GBrowserIsCompatible()) {
		map = new GMap2(document.getElementById("map"));
		map.addControl(new GSmallMapControl());
		geocoder = new GClientGeocoder();
		// Here enter your url of ashx/php file
		GDownloadUrl("./xml.php", function(data) {
		
			var xml = GXml.parse(data);
			var markers = xml.documentElement.getElementsByTagName("marker");
			
			for (var i = 0; i < markers.length; i++) 
			{
				//gather data from php file xml.php
				var tid = markers[i].getAttribute("tid");
				var title = markers[i].getAttribute("title");
				var description = markers[i].getAttribute("description");
				var deadline = markers[i].getAttribute("deadline");
				var name = markers[i].getAttribute("name");
				var payment = markers[i].getAttribute("payment");
				var address = markers[i].getAttribute("address");
				//call to function showAddress with paramerters to show on the map
				showAddress(tid,title,description,deadline,payment,address,name);
			}
		});
	}
}


function showAddress(tid,title,description,deadline,payment,address,name) {
	if (geocoder) {
		geocoder.getLatLng(name+","+address,function(point) {
			if (!point) {
				//alert(address + " not found");
			} 
			else {
				map.setCenter(point, 12);  //set Zoom level
				var marker = createMarker(point,tid,title,description,deadline,payment,address,name);
				map.addOverlay(marker);
			}
		});
	}
}


function createMarker(point,tid,title,description,deadline,payment,address,name) {
	var marker = new GMarker(point);
	var html =
	'<table  class="popinfo">' +
	'<tr>'+
		'<td><h2>' + title  +'</h2>' +
		'<p>'+ description  + '<a href=job_apply1.php?t='+tid+' target=1>...Read more</a>'+ '</p>'+
		'<b>Deadline: </b>' + deadline + '<br/>'+
		'<b>Location: </b>' + name     + '<br/>'+
		'<b>Address: </b>'  + address  + '<br/>'+
		'</td>'+
		'<td bgcolor="lightyellow" align="center"><h2>' + payment + '</h2>' +
		'<a href=job_apply1.php?t='+tid+' target=1 class="but_pink">Make offer</a>' +
		'</td>'+
	'</tr>'+
	
	'<tr>'+
		'<td colspan=2 style="border-top: 1px solid  @e5e5e5">' + 'Share this task ' + 
		'<a href=job_apply1.php?t='+tid+' target=1><img src=images/facebook-icon.png></a>&nbsp;' +
		'<a href=job_apply1.php?t='+tid+' target=1><img src=images/twittericon.png></a>&nbsp;'+ 
		'<a href=job_apply1.php?t='+tid+' target=1><img src=images/mailicon.png></a>' +
		'</td>'+
	'</tr>'+
	'</table>';

	GEvent.addListener(marker, 'click', function() {
		//open info window on marker click event
		marker.openInfoWindowHtml(html);
	});
		return marker;
}

//]]>
</script>
</head>


<body onload="load()" onunload="GUnload()">
<div>
<div id="map" style="width: 100%; height:743px"></div>
</div>
</body>
</html>