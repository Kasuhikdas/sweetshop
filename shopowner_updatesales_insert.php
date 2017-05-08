<?php
include 'session_maintain.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";


$shop_id=$_SESSION["id"];
$sweet_name=$_POST["sweet_list"];
$qty=$_POST["Quantity"];
$date = date('Y-m-d');
$price="";
$tot_price="";
$shop_qty="";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql1="SELECT * FROM shop_stock where sweeet_name='$sweet_name' and shop_id='$shop_id'"; 
$result = $conn->query($sql1);
$numrow=mysqli_num_rows($result);
while($row = $result->fetch_assoc()) {
		$price=$row['selling_price'];
		$shop_qty=$row['qty'];
		$expdate=$row['exp_date'];
}
$tot_price=$price*$qty;

if ($exp_date>$date) {
	

if ($numrow>0) {
	
	if ($shop_qty>=$qty) {
		$rem_qty=$shop_qty-$qty;
		$swsql="UPDATE shop_stock SET qty='$rem_qty' where sweeet_name='$sweet_name'";
	
		if ($conn->query($swsql) === TRUE) {
  	 		 	$sql = "INSERT INTO shop_sales (shop_id,sweetname,sold_qty,Price,Date)
				VALUES ('$shop_id','$sweet_name',$qty,$tot_price,'$date')";

				if ($conn->query($sql) === TRUE) {	
  	 				 $success="Sales Updated";
  	 				 header("Location:Shops_stock.php?success=$success");
				} else {
   					 echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
	}
	else{
			$error="Quantity not available for sale";
  	 				 header("Location:Shops_stock.php?error=$error");
	}
}
elseif ($numrow<=o) {
					 $error="Sales Updated";
  	 				 header("Location:Shops_stock.php?error=$error");
}
}
else
{
					$error="This Sweet is expired can not sell";
  	 				 header("Location:Shops_stock.php?error=$error");
}
$conn->close();
?>
