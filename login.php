
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";

  $id=$_POST["user_name"];
  $passw=$_POST["password"];
 

$name="";

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


$name=$pass['Name'];
$paskey=$pass['Password'];


$lt=$pass['Login_type'];
if ($numrow<=0) {
    header("Location:KDA Sweet Shop.php?msg=1");
}
else{
  if ($passw==$paskey) {
  		session_start();
  		$_SESSION["id"] = $id;

  		$_SESSION["name"]=$name;
      $_SESSION["Login_type"]=$lt;
    	$type=$pass['Login_type'];
    	if ($type=="Manager") {
    		header('Location:Manager_dash.php');
    		echo $_SESSION["name"];
    	}
    	else if ($type=="Admin") {
    		header('Location:Admin_dash.php');
    	}
    	else if ($type=="Shopowner")
    	{
    		header('Location:Shops_dash.php');	
    	}
   
  }
  else
  {
    header("Location:KDA Sweet Shop.php?msg=1");
   
  }

}



?>
