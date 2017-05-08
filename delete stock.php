<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";
$sweetname=$_POST["sweet_list_del"];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "DELETE FROM stock_in_factory WHERE Sweetname='$sweetname'";
if ($conn->query($sql) === TRUE) {
      $s="Sweet Deleted";
      header("Location:Admin_add_stock.php?scc=$s");
    } else {
         $error="some error has occured to set login" ;
        header("Location:Admin_add_stock.php?error=$error");
    }
?>