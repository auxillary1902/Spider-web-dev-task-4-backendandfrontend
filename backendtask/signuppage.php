<!DOCTYPE html>
<html>
<head>
	<title>Signup to Maps Journal</title>
</head>
<body>
<script type='text/javascript'>
function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
<style type="text/css">
	h1{
		text-align: center;
		font-family: times;
		font-size: 170%;
		border:1px solid black;
	}
	p{
		text-align: center;
		font-size: 120%;
		font-family: georgia;
	}
</style>
<h1>Signup to use this Journal</h1>
<p>please fill all the credentials including the captcha to signup</p>
<br>
<form action="" method="POST">
<table align="center">
<tr>
<td>Enter First Name:</td>
<td align="center"><input type="text" name="fname"></td>
</tr>
<tr>
<td>Enter Last Name:</td>
<td align="center"><input type="text" name="lname"></td>
</tr>
<tr>
<td>Enter a username:</td>
<td align="center"><input type="text" name="usernamefill">
</td>
</tr>
<tr>
<td>Enter a password:</td>
<td align="center"><input type="password" name="passfill"></td>
</tr>
<tr>
<td><img src="captcha.php?rand=<?php echo rand();?>" id='captchaimg'><br>
        <label for='message'>Enter the code above here :</label>
        <br>
        <input id="captcha_code" name="captcha_code" type="text">
        <br>
        Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh.</td>
        </tr>
        <tr>
<td colspan="3"><input name="submitbutton" type="submit" value="Submit"> </td>
</tr>
</table>
</form>
<?php
session_start();
if(isset($_POST['submitbutton']))
{$fname=$_POST['fname'];
$lname=$_POST['lname'];
$usr=$_POST['usernamefill'];
$pass=$_POST['passfill'];
$captcha=$_POST['captcha_code'];
$hash=md5($pass);
echo 2;
if($fname&&$lname&&$usr&&$pass&&$captcha)
{
	$con=mysqli_connect("localhost","root","","weatherjournal");
	if(!$con)
	{
		echo "error in connecting to the database";
	}
$query="SELECT * FROM peoplelist";
$result=mysqli_query($con,$query);
$num=mysqli_num_rows($result);
$k=0;
if($num!=0)
{
	while($row=mysqli_fetch_assoc($result))
	{
		$dbusername=$row['Username'];
		if($dbusername==$usr)
		{
			echo "<script>alert('username already exists. try again.');</script>";
				header("Refresh:0; url=signuppage.php");
		}
$k++;
	}
	if($k==$num)
	{   if(strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) == 0){
		$queryadd="INSERT INTO peoplelist VALUES('$fname','$lname','$usr','$hash')";
		$result=mysqli_query($con,$queryadd);
		if($result)
		{
			echo "<script>alert('Successfully added to the database. Click ok to login with your new credentials');</script>";
				header("Refresh:0; url=loginpage.php");
		}
		else
		{
			echo "<script>alert('error in adding to database');</script>";
				header("Refresh:0; url=signuppage.php");
		}}
		else
		{
echo "<script>alert('Wrong captcha.try again');</script>";
				header("Refresh:0; url=signuppage.php");
		}
	
}
}
else{if(strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) == 0)
{echo 1;
	$queryadd="INSERT INTO peoplelist VALUES('$fname','$lname','$usr','$hash')";
		$result=mysqli_query($con,$queryadd);
		if($result)
		{
			echo "<script>alert('Successfully added to the database. Click ok to login with your new credentials');</script>";
				header("Refresh:0; url=loginpage.php");
		}
		else
		{
			echo "<script>alert('error in adding to database');</script>";
				header("Refresh:0; url=signuppage.php");
		}
	}
	else
	{echo "<script>alert('Wrong captcha.try again');</script>";
				header("Refresh:0; url=signuppage.php");

	}
}
}
else
{
	echo "<script>alert('Please fill in all the credentials before signing up.');</script>";

				header("Refresh:0; url=signuppage.php");
}	

}



?>

</body>
</html>