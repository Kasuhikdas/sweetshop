<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";

if (isset($_POST['shop_list'])) {
	echo $_POST['shop_list'];


$id=$_POST['shop_list'];
echo $id;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "DELETE FROM shop WHERE Shop_Id='$id'";
if ($conn->query($sql) === TRUE) {
      $s="Sweet Deleted";
      header("Location:Manager_add_shop.php?scc=$s");
    
    } else {
         $error="some error has occured to set login" ;
        header("Location:Manager_add_shop.php?error=$error");
    }
}
?>