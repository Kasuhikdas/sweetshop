<?php 
include 'session_maintain.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";
$shop_id=$_SESSION['id'];
$sweetname=$_POST['sweet_list'];
$quantity=$_POST['Quantity'];
$date = date('Y-m-d');
$status="New";
$id="OD00";
$approvedqty="0";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT * FROM order_summary";
$result = $conn->query($sql);
$numrow=mysqli_num_rows($result);
$od_num="";
$i=0;
echo "$numrow";
if ($numrow==0) {
  $od_num=1;
  $id=$id.$od_num;
}
else {
    $od_num=$numrow;
    $id=$id.$od_num;
    if ($result->num_rows > 0) {
      
       while($row = $result->fetch_assoc()) {
        if ($id==$row["order_id"]) {
          $od_num++;
          $id=$id.$od_num;
        }
        else{
          $i=1;
        }
       }
  }
}

$sql1 = "INSERT INTO order_summary (order_id, Sweetname,Req_qty,Approved_qty,Status,Date)VALUES ('$id','$sweetname',$quantity,$approvedqty,'$status','$date')";
$sql5="select * from sweer_for_sale where Sweetname='$sweetname'";
 $result5 = $conn->query($sql5);
$numrow5=mysqli_num_rows($result5);
 if ($numrow5<=0) {
    $error="Select Sweetname from drop down" ;
     header('Location:Shops_request_order.php?error='.$error);
   }
   else
   {
 

  $sql2="INSERT INTO order_detail (Order_id, Date,Shop_Id)VALUES ('$id','$date','$shop_id')";
  if ($conn->query($sql1) === TRUE) {
      $success="Order Submited";
       header('Location:Shops_request_order.php?succs='.$success);
  } else {
      $error="some error has occured " ;
      header('Location:Shops_request_order.php?error='.$error);
  }
  if ($conn->query($sql2) === TRUE) {
     echo "New record created successfully";
  } else {
      $error="some error has occured " ;
     header('Location:Shops_request_order.php?error='.$error);
  }
}

   

$conn->close();

 ?>