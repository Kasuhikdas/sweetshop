<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$stock_qty="";
$tot_quantity="";
$sweetname=$_POST["sweetname"];
$base_material=$_POST["Basematerial"];
$qty=$_POST["qty"];
$ingrediants=$_POST["Ingredient"];
$man_date=$_POST["mandate"];
$exp_date=$_POST["expdate"];
$availability_qty=$_POST["qty"];
$tday=date('Y-m-d');
echo $tday;

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
 	 			header('Location: Admin_add_stock.php?error2='.$error);
	}
	elseif ($exp_date<$tday) {
		$error= "Expiry date can not be less than current date";
 	 			header('Location: Admin_add_stock.php?error2='.$error);
	}
	else
	{
		if ($numrow==0) {
	
	

	$sql = "INSERT INTO stock_in_factory 
	(Sweetname,Base_material,Available_qty,Ingredients,Man_date,exp_date)
	VALUES ('$sweetname','$base_material','$qty','$ingrediants','$man_date','$exp_date')";

	if ($conn->query($sql) === TRUE) {
		$sql3="INSERT INTO `stock_record`(`Sweetname`, `Qty`, `Date`) VALUES ('$sweetname',$qty,'$tday')";
		if ($conn->query($sql3) === TRUE) {
	    		$succ="Sweet Updated Successfully";
	    		header('Location: Admin_add_stock.php?suc2='.$succ);
	    	}
	    	else
	    	{
	    		$error= "Some erroe has occured in stock record";
 	 			header('Location: Admin_add_stock.php?error2='.$error);
	    	}

	} else {
 	   			$error= "Some erroe has occured";
 	 			header('Location: Admin_add_stock.php?error2='.$error);
	}

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
	    		header('Location: Admin_add_stock.php?suc2='.$succ);
	    	}
	    	else
	    	{
	    		$error= "Some erroe has occured in stock record";
 	 			header('Location: Admin_add_stock.php?error2='.$error);
	    	}
	} else {
 	   		$error= "Some erroe has occured";
 	 			header('Location: Admin_add_stock.php?error2='.$error);
	}
	
}

}


$conn->close();

}
?>
