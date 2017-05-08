<?php
include 'session_maintain.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";


$shop_id=$_SESSION['id'];
$sweet_name=$_POST["sweet_list"];
$qty=$_POST["Quantity"];
$date = date('Y-m-d');
$reason=$_POST["reason"];;

$shop_qty="";
$rem_qty="";


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
		
		$shop_qty=$row['qty'];
}
if ($numrow>0) {
	
	if ($shop_qty>=$qty) {
		$rem_qty=$shop_qty-$qty;
		$swsql="UPDATE shop_stock SET qty='$rem_qty' where sweeet_name='$sweet_name'";
	
		if ($conn->query($swsql) === TRUE) {
  	 		 		$sql = "INSERT INTO shop_return (shop_id,sweetname,return_qty,Date,Reason)
					VALUES ('$shop_id','$sweet_name','$qty','$date','$reason')";

					if ($conn->query($sql) === TRUE) {
						if ($reason=="expired") {




							$success="Sweet Returned";
  	 				 		header("Location:Shops _sweet_return.php?success=$success");
						}
						else
						{
							$swrqty="Select * from sweer_for_sale  where Sweetname='$sweet_name'";
							$result_qt=$conn->query($swrqty);
							while($row = $result_qt->fetch_assoc()) {
    							$currentqty=$row['Qty'];
                					
							}

							$remainderqty=$currentqty+$qty;
							
							$sql31="UPDATE sweer_for_sale SET Qty=$remainderqty WHERE Sweetname='$sweet_name'";
    			     		if ($conn->query($sql31) === TRUE) {
    			     				$success="Sweet Returned";
  	 				 				header("Location:Shops _sweet_return.php?success=$success");
    			     		}
    			     		else
    			     		{
    			     			$error="Error in updating sweet for sale";
  	 							 echo "Error: " . $sql . "<br>" . $conn->error;
  	 							 //header("Location:Shops _sweet_return.php?error=$error");
    			     		}


						}
				 		   
					} else {
   						$error="error in insertion if sweet table";
  	 				 header("Location:Shops _sweet_return.php?error=$error");
					}
			}
	}
	else{
			$error="Quantity not available ";
  	 				 header("Location:Shops _sweet_return.php?error=$error");
	}
}
elseif ($numrow<=o) {
					 $error="Select Sweetname from dropdown";
  	 				 header("Location:Shops _sweet_return.php?error=$error");
}


$conn->close();

?>
