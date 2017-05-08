<?php

	$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";
$app_qty="";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if( isset($_GET['id']) )
	{
		$id = $_GET['id'];
		$status=$_GET['status'];
		$sql="select Approved_qty from order_summary where order_id='$id'";
		$result=$conn->query($sql);
		while ($row = $result->fetch_assoc()) {
			$app_qty=$row['Approved_qty'];
			if($app_qty==0	) 
			{
				$error="First Update approve qty";
				header("Location:Manager_sale_info.php?er='$error'");
			}
			elseif ($app_qty>0) {
							$sql1="UPDATE order_summary SET Status='$status' WHERE order_id='$id'";
							if ($conn->query($sql1) === TRUE) {
   								 
   								 $success="Order Approved";
   								 header("Location:Manager_sale_info.php?su=$success");
							}
							else {
   									echo "Error: " . $sql . "<br>" . $conn->error;
								}
			}
		}
	}

?>