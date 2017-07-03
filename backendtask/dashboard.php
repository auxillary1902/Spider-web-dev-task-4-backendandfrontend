<!DOCTYPE html>
<html>
<head>
	<title>Welcome to your dashboard</title>
</head>
<body>
<script type = "text/javascript" >
   function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
</script>
<?php
session_start();
if($_SESSION['LOGGEDIN'])
{
?>
<style type="text/css">
	h1{
		text-align: center;
		font-size: 170%;
		font-family: cursive;
		border-radius: 5px;
		border:1px solid black;
		color: white;
		background-color: blue;
	}
	p{
		text-align: center;
		font-size: 120%;
		font-family: georgia;
	}
	a{
		font-family: cursive;
		font-size: 120%;
		border-radius: 5px;
		border:3px solid black;
		border-radius: 3px;
		margin-left: 3px;
		padding: 3px 3px 3px 3px;
	}
	#intro{
		text-align: center;
		font-size: 130%;
		font-family: cursive;
		border:1px solid black;
		background-color: #1762A9;
		color: white;
	}
	ol{
		font-size: 120%;
		font-family: georgia;

	}
	div.link{
		float:left;
	}
</style>
<h1>Welcome to your dashboard</h1>
<p>Here you can either add a journal entry to any location based on a marker or read all the journals available at a particular location. Both these options have separate links in this page.</p>
<marquee behavior="scroll" loop="100" scrolldelay="20" direction="right" bgcolor="#5C17A9">Logged in as : <b><i><?php echo $_SESSION['username'];?></i></b></marquee>
<br>
<br>
<div class="link">
<a href="addjournal.php">Click here to add a journal entry based on a marker</a>

<a href="reviewjournal.php">Click here to view the journals available at a given location</a>

</div>
<br>
<br>
<p id="intro">Your profile information:</p>

<ol>
<li>First Name: <b><i><?php echo $_SESSION['fname'];?></i></b></li>
<li>Last Name: <b><i><?php echo $_SESSION['lname'];?></i></b></li>
<li>Username: <b><i><?php echo $_SESSION['username'];?></i></b></li>
</ol>
<br>
<form action="" method="POST">
<input type="submit" value="Logout" name="logoutbutton">
</form>
<?php
if(isset($_POST['logoutbutton']))
{  $_SESSION['LOGGEDIN']=false;
	
	header("Refresh:0,url=loginpage.php");
}
?>


<?php
}
else
{
?>
<style type="text/css">
	h1{
		text-align: center;
		font-size: 170%;
		font-family: cursive;
		border:1px solid black;

	}
	p{
		text-align: center;
		font-size: 120%;
		font-family: georgia;
	}
</style>
<h1>Journal Map Application</h1>
<p>This application can be used to make diary journals of different places you visited in a simple method. Just click on the location on the map and enter the corresponding journal.You can also view all the journals recorded for one place within a few km radius. But this service can only used on logging in.</p>
<br>
<a href="loginpage.php"><p>Click here to login to your account</p></a>

<?php

}
?>
</body>
</html>