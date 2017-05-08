<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";
$sweetname="";
$qty="";
$factory_qty="";
$remaining_qty="";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if( isset($_GET['id']) )
	{
		$id = $_GET['id'];
		$status=$_GET['status'];
		if ($status=='Out For Delivery') {
			
   				 			$sql="UPDATE order_summary SET Status='$status' WHERE order_id='$id'";
							if ($conn->query($sql) === TRUE) {
   								 $success="Order Dispatched";
   								 header("Location:Admin_order.php?succ=$success");
							} else {
   								 $error="Some error has occured";
   								 header("Location:Admin_order.php?error=$error");
							}
			}
			elseif ($status=='Canceled') {
			echo "Canceled";
				$sql1="select * from order_summary where order_id='$id'";
				$result = $conn->query($sql1);
				while($row = $result->fetch_assoc()) { 
					$qty=$row['Approved_qty'];
					$sweetname=$row['sweetname'];
					
				}
				$sql2="select * from sweer_for_sale where Sweetname='$sweetname'";
				$result = $conn->query($sql2);
				while($row = $result->fetch_assoc()) { 
					$Available_qty=$row['Qty'];
					
				}
				$remaining_qty=$Available_qty+$qty;
				$sql3="UPDATE sweer_for_sale SET Qty='$remaining_qty' WHERE  Sweetname='$sweetname'";
				if ($conn->query($sql3) === TRUE) {
   					 			$sql="UPDATE order_summary SET Status='$status' WHERE order_id='$id'";
								if ($conn->query($sql) === TRUE) {
   									 $success="Order Canceled";
   									 header("Location:Shops_request_order.php?succ=$success");
								} else {
   									 $error="Some error has occured";
   									 header("Location:Shops_request_order.php?errr=$error");	
								}
				} else {
   					 				$error="Some error has occured";
   									 header("Location:Shops_request_order.php?errr=$error");
				}

		} 
		}

		
	
