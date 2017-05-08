<?php
$success="";
$error="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";
$sweetname=$_POST['sweet_list'];

$price=$_POST['price'];
$qty=$_POST['qty'];
$remainderqty="";
$currentqty="";
$swetforsaleqty="";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$date = date('Y-m-d');
$sql1="select * from stock_in_factory where sweetname='$sweetname' and exp_date>'$date'";
$result = $conn->query($sql1);
$numrow=mysqli_num_rows($result);
$sql4="select * from sweer_for_sale where Sweetname='$sweetname'";
$result2 = $conn->query($sql4);
$numrow2=mysqli_num_rows($result2);

while($row = $result->fetch_assoc()) {
    			$currentqty=$row['Available_qty'];
                echo $currentqty;
}
while($row2 = $result2->fetch_assoc()) {
    			$swetforsaleqty=$row2['Qty'];
    			echo $swetforsaleqty;
}
if ($numrow2<=0) {
	$sql2 = "INSERT INTO sweer_for_sale (Sweetname,Qty,Price)
	VALUES ('$sweetname','$qty','$price')";
}
else
	{
		$quantity=$swetforsaleqty+$qty;
		$sql2="UPDATE sweer_for_sale SET Qty='$quantity' ,price=$price WHERE Sweetname='$sweetname'";
	}
if ($numrow>0) {
    

    if ($currentqty>=$qty ) {
	   
	   if ($conn->query($sql2) === TRUE) {
    	   
    		  	   $remainderqty=$currentqty-$qty;
    		      	$sql3="UPDATE stock_in_factory SET Available_qty='$remainderqty' WHERE Sweetname='$sweetname'";
    			     if ($conn->query($sql3) === TRUE) {
                    $success="Sweet Uploaded Successfully";
    			     }
    	


	   } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
	   }
    }
    else
    {
        $error="quantity is not available";
    	
    }

}
else
{
    $error= "Please select sweetname from dropdown";
}
$conn->close();

}
?>