<!DOCTYPE html>
<html>
<head>
	<title> List Of Added Journals</title>
</head>
<body>
<style type="text/css">
	h1{
		text-align: center;
		font-family: cursive;
		font-size: 170%;
		border-radius: 5px;
		border:1px solid black;
		background-color: blue;
		color: white
	}
	p{
		text-align: center;
		font-size: 120%;
		font-family: georgia;
	}
	#map{
		height:400px;
		width: 600px;
		margin-left:auto; margin-right:auto;
	}
	#cityshow{
		font-size: 130%;
		text-align: center;
	}
	div.loc{
		align-items: center;
		text-align: center;
	}
	button{
	font-size: 130%;
}
#viewlist{
	font-size: 140%;

}
#journalview{
	max-width: 800px;
	overflow: scroll;

}
td{
	padding: 15px;
}
</style>
<h1>List of Added existing Journals</h1>
<p>Click on any place and click on 'submit' to see the list of journals available near that locality</p>
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
           setcityfromlatandlong(latlng.lat(),latlng.lng());
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
			content:'<h2>latitude: '+latitude+' longitude: '+longitude+'</h2>'
		});
		marker.addListener('click',function(){
			info.open(map,marker);
		});
	}

	}
	

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDremU7RAUTZxFmtaCZL8fUpXMv3g-p1gM&callback=initMap"
    async defer></script>
  <div class="loc">  <br>
    <input type="text" disabled="disabled" id="cityshow" value="Chennai">
    <br>
    <br></div>
<form action="" method="POST">
<input type="text" name="city" id="cityid" hidden="true">
<table align="center">
<tr>
<td colspan="4" align="center"><input type="submit" name="submitbutton" value="submit" id="buttonshow"></td>
</tr>
</table>
</form>
<br>
<br>
<br>
<a href="dashboard.php"><button>Go Back to dashboard</button></a>
<br>
<p>List of existing journals are:</p>
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
                    document.getElementById("cityid").value=loc;
                     document.getElementById("cityshow").value=loc;
               
	}
};
xmlhttp.open("GET",urlll,true);
		xmlhttp.send();
		}
	function setcityfromlatandlong(latitude,longitude)
	{
		var urlll="http://api.openweathermap.org/data/2.5/weather?lat="+latitude+"&lon="+longitude+"&APPID="+APPID;
		sendrequest(urlll);
	}
</script>
<table align="center" border="2" style= "background-color: #DEE4AE; color: #1B10B8; margin: 0 auto;" id="viewlist">
<thead>
	<th>Location</th>
	<th>Date Of Post</th>
	<th>Journal</th>
	<th>Latitude</th>
	<th>Longitude</th>
</thead>
	<tbody>
<?php
if(isset($_POST['submitbutton']))
{
	$locationgot=$_POST['city'];
	$con=mysqli_connect("localhost","root","","weatherjournal");
if(!$con)
{
	echo "Error in connecting to the databse";
}	
$query="SELECT * FROM journal WHERE Location='$locationgot' AND Status='Public'";
$result=mysqli_query($con,$query);
$numrows=mysqli_num_rows($result);
if($numrows!=0)
{
  while($row=mysqli_fetch_assoc($result))
  {
  	echo "<tr>
  	      <td>{$row['Location']}</td>
  	      <td>{$row['Date']}</td>
  	      <td id='journalview'>{$row['Journal']}</td>
  	      <td>{$row['Latitude']}</td>
  	      <td>{$row['Longitude']}</td>
  	      <tr>\n";
     
  }
  ?>
  </tbody>
  </table>
 <?php

}
else
{
	echo "<p>No public journals as of now exist for this location. Try adding it from the given link in the dashboard</p>";
}
}	

?>
</body>
</html>