<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";
$sname="";
$totqty="";
$order_qty="";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if (isset($_POST['order'])) {
	$id=$_POST['order'];
	$qty=$_POST['qty'];
	$sweetsql="select * from order_summary where order_id='$id'";
	$result=$conn->query($sweetsql);
		while ($row = $result->fetch_assoc()) {
			$sname=$row['sweetname'];
			$order_qty=$row['Approved_qty'];
		}
	$qtysql="select Qty from sweer_for_sale where Sweetname='$sname'";
	$result2=$conn->query($qtysql);
		while ($row = $result2->fetch_assoc()) {
			$totqty=$row['Qty'];
			echo $totqty."<br>";
		}
	if ($order_qty>0) {
		$totqty=$totqty+$order_qty;
		$update="UPDATE sweer_for_sale SET Qty='$totqty' WHERE Sweetname='$sname'";
		if ($conn->query($update) === TRUE) {}

	}
		if ($totqty>=$qty) {
			
		
			$sql="UPDATE order_summary SET Approved_qty='$qty' WHERE order_id='$id'";
			if ($conn->query($sql) === TRUE) {
				$remqty=$totqty-$qty;
				
				echo $remqty;
				$updateqty="UPDATE sweer_for_sale SET Qty='$remqty' WHERE Sweetname='$sname'";
   							
						if ($conn->query($updateqty) === TRUE) {

   							 	$success="Quantity updated";
   							 	echo $remqty;
   								header("location:Manager_sale_info.php?success=$success");
   							}
   							else {
									$error="Some error has occured";
   									header("location:Manager_sale_info.php?success=$error");
							}
   					 
			}
			else {
					$error="Some error has occured";
   					header("location:Manager_sale_info.php?success=$error");
			}
		}
		else{
			$error= "Uploaded sweet quantity is less than aprroved!";
			header("location:Manager_sale_info.php?success=$error");
		}
}


?>