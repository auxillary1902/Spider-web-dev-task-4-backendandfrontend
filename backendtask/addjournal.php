<!DOCTYPE html>
<html>
<head>
	<title>Add a journal entry</title>
		<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<style type="text/css">
	h1{
		text-align: center;
		font-family: Times;
		color:white;
		border:1px solid black;
		background-image: url("https://dncache-mauganscorp.netdna-ssl.com/thumbseg/1321/1321044-bigthumbnail.jpg");
		font-size: 170%;
	}
	p{
		text-align: center;
		font-family: cursive;
		font-size: 120%;
	}
	#map{
		height:400px;
		width: 600px;
		margin-left:auto; margin-right:auto;
	}
div.loc{
	text-align: center;
	align-items: center;
}
#location{
	font-size: 180%;
text-align: center;
}
button{
	font-size: 130%;
}
label{
	font-family: cursive;
	font-size: 140%;
}
</style>
<h1>Add A journal Entry Based on Marker's Location</h1>
<p>Click on any location on the map, once a marker has been placed on the map, fill the journal details below and click on 'submit' to add a journal into the database</p>
<br>
<div id="map"></div>
<script type="text/javascript">
	function initMap()
	{var latlng;
		var options={
			zoom:13,
			center:{lat:13.0826802,lng:80.2707184}
		}

		var map=new google.maps.Map(document.getElementById("map"),options);
		google.maps.event.addListener(map,"click",function(e){
			    latlng=e.latLng;
			   addmarker(latlng.lat(),latlng.lng());
             updatelocationbylatandlng(latlng.lat(),latlng.lng());
             setlatandlng(latlng.lat(),latlng.lng());
		});
		var marker;
		function addmarker(latitude,longitude)
	{ 
		if(marker)
			marker.setPosition({lat:latitude,lng:longitude});
		else
		  {marker=new google.maps.Marker({
			    	position:{lat:latitude,lng:longitude},
			    	map:map
			    });}
		var info=new google.maps.InfoWindow({
			content:'<h1>latitude: '+latitude+' longitude: '+longitude+'</h1>'
		});
		marker.addListener('click',function(){
			info.open(map,marker);
		});
	}

	}
	
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDremU7RAUTZxFmtaCZL8fUpXMv3g-p1gM&callback=initMap"
    async defer></script>
    <br>
    <div class="loc">

<label for="location">Location marked:</label><input id="location" disabled="disabled" value="Chennai">
<br>
</div>

<p>Once you have selected the location, fill in the journal below</p>
<br>
<form action="" method="POST">
<table align="center">
<tr>
<td align="center"><input type="text" name="locationadd" hidden="true" id="locfrommap" value="Chennai"></td>
</tr>
<tr>
<td align="center"><input type="text" name="latitudeadd" hidden="true" id="latitude" value="13.0826802"></td>
</tr>
<tr>
<td align="center"><input type="text" name="longitudeadd" hidden="true" id="longitude" value="80.2707184"></td>
<tr>
<td>Enter the Journal :</td>
<td align="center"><input type="text" name="journal"></td>
</tr>
<tr>
<td>Enter the Status of the entry:</td>
<td align="center"><select name="status">
	<option>Public</option>
	<option>Private</option>
</select>	</td>
</tr>
<tr>
<td>Enter the date of the post:</td>
<td align="center"><input type="date" name="dateadd" placeholder="yyyy-mm-dd"></td>
</tr>

<tr>
<td colspan="4" align="center"><input type="submit" name="submitlocation"></td>
</tr>
</table>
</form>
<br>
<a href="dashboard.php"><button>Go Back to dashboard</button></a>
<br>
<script type="text/javascript">
	var APPID="d5109db637b130e6dbd2bbe1c2b1a7c9";
	var loc;
	function sendrequest(urlll)
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
					var data=JSON.parse(xmlhttp.responseText);
                    loc=data.name;
                    document.getElementById("location").value=loc;
                    document.getElementById("locfrommap").value=loc;
	}
};
xmlhttp.open("GET",urlll,true);
		xmlhttp.send();
		}
function updatelocationbylatandlng(lat,lng)
{
	var urlll="http://api.openweathermap.org/data/2.5/weather?lat="+lat+"&lon="+lng+"&APPID="+APPID;
		sendrequest(urlll);
}
function setlatandlng(latitude,longitude)
{
document.getElementById("latitude").value=latitude;
document.getElementById("longitude").value=longitude;
}
</script>
<?php
if(isset($_POST['submitlocation']))
{
	$loc=$_POST['locationadd'];

	$journal=$_POST['journal'];
	$status=$_POST['status'];
	$date=$_POST['dateadd'];
	$lat=$_POST['latitudeadd'];
	$lng=$_POST['longitudeadd'];

	if($journal&&$status&&$date)
	{

$con=mysqli_connect("localhost","root","","weatherjournal");
if(!$con)
{
	echo "Error in connecting to the database";
}
$query="INSERT INTO journal VALUES('$loc','$journal','$status','$date','$lat','$lng')";
$result=mysqli_query($con,$query);
if($result)
{
echo "<script>alert('Successfully added journal to the database. Go back to the dashboard and click the other link to view the journal.Or you can add more journals by staying on this page itself.');</script>";

}
else
{
	echo "<script>alert('Error in adding the journal to the database. try again');</script>";

}

}
else
{
	echo "<script>alert('Please enter all details about the journal before submitting it');</script>";
	
}
}





?>
</body>
</html>