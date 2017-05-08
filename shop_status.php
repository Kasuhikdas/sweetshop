<?php
include 'session_maintain.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";
$st="";
$id="";
$status="";
$sweetname="";
$qty="";
$price="";
$shop=$_SESSION['id'];
$man_date;
$exp_date;
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$id=$_GET['id'];
$status=$_GET['status'];
$tot_quantity;
$Available_qty;
		if ($status=='Completed') {
					$order="select * from order_summary where order_id='$id'";
					$order_result = $conn->query($order);
					while($row = $order_result->fetch_assoc()) {
						$sweetname=$row['sweetname'];
						$qty=$row['Approved_qty'];
						$sweetfind="select * from sweer_for_sale where Sweetname='$sweetname'";
						$sweet_result = $conn->query($sweetfind);
						while($row1 = $sweet_result->fetch_assoc()) {
							$price=$row1['Price'];
						}
					}
					$swdate="select * from stock_in_factory where Sweetname='$sweetname'";
					$swdate_result=$conn->query($swdate);
					while($row = $swdate_result->fetch_assoc()) {
							$exp_date=$row['exp_date'];
					}
					$sql2="select * from shop_stock where sweeet_name='$sweetname' and shop_id='$shop'";
   					 		$result1 = $conn->query($sql2);
							$numrow=mysqli_num_rows($result1); 
							while($row = $result1->fetch_assoc()) {
								$Available_qty=$row['qty'];
							}
							if ($numrow<=0) {
								$sql = "INSERT INTO shop_stock (shop_id,sweeet_name,qty, selling_price,exp_date)
								VALUES ('$shop','$sweetname',$qty,$price,'$exp_date')";
								if ($conn->query($sql) === TRUE) {
									$sqlup="UPDATE order_summary SET Status='$status' WHERE order_id='$id'";
									if ($conn->query($sqlup) === TRUE) {
										$success= "Order Recieved";
										header("Location:Shops_request_order.php?suc='$success'");
									}
								}
								else {
   					 					$error="some error occured1";
   					 						header("Location:Shops_request_order.php?err='$error'");

										}

							}
							else
							{
								$tot_quantity=$qty+$Available_qty;

								
								$update="UPDATE shop_stock SET qty=$tot_quantity  WHERE sweeet_name='$sweetname' and shop_id='$shop'";
								$update2="UPDATE shop_stock SET exp_date='$exp_date' WHERE sweeet_name='$sweetname' and shop_id='$shop'";
								if ($conn->query($update) === TRUE) {
									if ($conn->query($update2) === TRUE) {
										$sqlup="UPDATE order_summary SET Status='$status' WHERE order_id='$id'";
										if ($conn->query($sqlup) === TRUE) {
										$success= "Order Recieved";
										header("Location:Shops_request_order.php?suc='$success'");
									}
									}
									
								}
									else {
   					 						$error="some error occured2";
   					 						echo "Error: " . $sql . "<br>" . $conn->error;
   					 						header("Location:Shops_request_order.php?err='$error'");
										}

							}
				
			}
						
		
	