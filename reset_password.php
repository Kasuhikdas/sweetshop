<?php
$msg="";
	session_start();
	$id=$_SESSION['id'];
	if (isset($_POST['ResetPasswordForm'])) {
		$currentpass=$_POST['cupassword'];
		$newpass=$_POST['password'];
		$rppass=$_POST['confirmpassword'];
		$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT * FROM login where Login_id='$id'";
$result = $conn->query($sql);
$numrow=mysqli_num_rows($result);
$pass=$result->fetch_assoc();
$paskey=$pass['Password'];

if ($currentpass==$paskey) {
	if ($newpass==$rppass) {
		$sql="UPDATE login SET Password='$newpass' where Login_id='$id'";
		if ($conn->query($sql)===TRUE) {
			$msg="Password Changed Succesfully";
		}
		else
		{
			$msg="Password not changed";
		}
	}

	else{

		$msg="New and Confirm password should match";
	}
}
else{
	$msg="Wrong password";
}


}
?>	
	<!DOCTYPE html>
	<html>
	<head>
		<title>Change Password</title>
	</head>
	<body>
	

	<form action="reset_password.php" method="POST">
<table>
<tr><td>	<lable>Id:</lable> </td><td><input type="text" name="userid" size="20" value="<?php echo $id;?>" disabled /></td></tr>

<tr><td>	<lable>Current password:</lable> </td><td><input type="password" name="cupassword" size="20" /></td></tr>

<tr><td>	<lable>New Password:</lable></td><td> <input type="password" name="password" size="20" /></td></tr>

<tr><td>	<lable>Confirm Password:</lable> </td><td><input type="password" name="confirmpassword" size="20" /></td></tr>

<tr><td>	 <input type="submit" name="ResetPasswordForm" value=" Reset Password " /></td></tr>
</table>
<?php  echo $msg; ?>
	</form>

	</body>
	</html>

	 

	