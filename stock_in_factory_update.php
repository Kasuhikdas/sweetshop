<?php
$success="";
$error="";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$stock_qty="";
$tot_quantity="";
$sweetname=$_POST["sweet_list"];
$qty=$_POST["Quantity"];
$man_date=$_POST["mandate"];
$exp_date=$_POST["expdate"];
$tday=date('Y-m-d');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql1="select * from stock_in_factory where Sweetname='$sweetname'";
$result = $conn->query($sql1);
$numrow=mysqli_num_rows($result);
	if ($man_date<$tday) {
		$error= "Manufacture date can not be less than current date";
 	 			header('Location: Admin_add_stock.php?error1='.$error);
	}
	elseif ($exp_date<$tday) {
		$error= "Expiry date can not be less than current date";
 	 			header('Location: Admin_add_stock.php?error1='.$error);
	}
	else
	{

		if ($numrow==0) {
		$error= "Please select sweetname from dropdown";
		header('Location: Admin_add_stock.php?error1='.$error);
		}
		else{
				while($row = $result->fetch_assoc()) {
    				$stock_qty=$row['Available_qty'];
					}
				$tot_quantity=$qty+$stock_qty;
				$sql2="UPDATE stock_in_factory SET Available_qty='$tot_quantity',Man_date='$man_date',exp_date='$exp_date'   WHERE Sweetname='$sweetname'";
				if ($conn->query($sql2) === TRUE) {
					$sql3="INSERT INTO `stock_record`(`Sweetname`, `Qty`, `Date`) VALUES ('$sweetname',$qty,'$tday')";
		if ($conn->query($sql3) === TRUE) {
	    		$succ="Sweet Updated Successfully";
	    		header('Location: Admin_add_stock.php?suc2='.$suc);
	    	}
	    	else
	    	{
	    		$error= "Some erroe has occured in stock record";
 	 			header('Location: Admin_add_stock.php?error2='.$error);
	    	}
	   			 }
	    		else {
	    			$error= "Some erroe has occured";
 	 				header('Location: Admin_add_stock.php?error1='.$error);
  				}
			}

		}


}
$conn->close();

?>
