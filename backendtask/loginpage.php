<!DOCTYPE html>
<html>
<head>
	<title>Login To Your Account</title>
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
		color: white;
	}
	p{
		text-align: center;
		font-family: georgia;
		font-size: 120%;

	}
</style>
<h1>Login to your account</h1>
<p>Enter a valid username and password to login to your dashboard</p>
<br>
<form action="" method="POST">
<table align="center">
<tr>
<td>Username:</td>
<td align="center"><input type="text" name="username"></td>
</tr>
<tr>
<td>Password:</td>
<td align="center"><input type="password" name="pass">
</td>
</tr>
<tr>
<td colspan="3" align="center"><input type="submit" value="Submit" name="submitbutton">
</td>
</tr> 	

</table>	
</form>
<br>
<a href="signuppage.php"><p>New user?click here to sign up</p></a>
<br>
<?php
if(isset($_POST['submitbutton']))
{
	$usrtaken=$_POST['username'];
	$passtaken=$_POST['pass'];
	$hashtaken=md5($passtaken);
$con=mysqli_connect("localhost","root","","weatherjournal");
if(!$con)
{
	echo "Error in connecting to the database";
}
$query="SELECT * FROM peoplelist WHERE Username='$usrtaken'";
$result=mysqli_query($con,$query);
$num=mysqli_num_rows($result);
if($num==1)
{
	$row=mysqli_fetch_assoc($result);
	if(($row['Username']==$usrtaken)&&($row['Password']==$hashtaken))
	{
		session_start();
		echo "<script>alert('you are logged in as $usrtaken');location.href='dashboard.php'</script>";
		$_SESSION['username']=$usrtaken;
		$_SESSION['LOGGEDIN']=true;
		$_SESSION['fname']=$row['FirstName'];
		$_SESSION['lname']=$row['LastName'];
	}
	else
	{
		echo "<script>alert('Invalid password or username');</script>";
		header("Refresh:0,url=loginpage.php");
	}
}
else if($num==0)
{
	echo "<script>alert('No such registered user exists. please sign up with these credentials');</script>";
	header("Refresh:0,url=loginpage.php");
}
}


?>

</body>
</html>