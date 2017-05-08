<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";
session_start();
$shop_id=$_SESSION["id"];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	if (isset($_GET['name'])) {
		$name=$_GET['name'];
		$date = date('Y-m-d');
		$exp;
		$qty;
		$sql="select * from shop_stock where sweeet_name='$name'";
		$result = $conn->query($sql);
		$numrow=mysqli_num_rows($result);
		while ($row=$result->fetch_assoc()) {
			$exp=$row['exp_date'];
			$qty=$row['qty'];
		}
		if ($exp<$date) {
			$res="expired";
			$ret="INSERT INTO `shop_return`(`shop_id`, `sweetname`, `return_qty`, `Date`,`Reason`) values('$shop_id','$name','$qty','$date','$res' )";
			
				if($conn->query($ret)===TRUE)
				{
					$sql="DELETE FROM shop_stock where sweeet_name='$name'";
					if ($conn->query($sql) === TRUE) {
						$s= "success";
						header("Location:Shops _sweet_return.php?suc=$s");
					}
					else
					{
						$e= "error deleting sweet";
						header("Location:Shops _sweet_return.php?suc=$e");
					}
				}
				else
				{
					$e= "not inserted in return";
					header("Location:Shops _sweet_return.php?suc=$e");
				}
		}
		else {
			$e="It is not expired";
			header("Location:Shops _sweet_return.php?suc=$e");
		}
		
	}
	



?>