<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";
$shop_id="emp00";
$shopname=$_POST["shop_list"];
$owner=$_POST["Owner"];
$address=$_POST["address"];
$contact1=$_POST["Contact"];
$contact2=$_POST["Contact1"];
$shop_num=0;
$id="shop00";
$shopid="shop00";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT Shop_Id FROM shop";
$result = $conn->query($sql);
$numrow=mysqli_num_rows($result);

$i=0;
echo "$numrow";
if ($numrow==0) {
  $shop_num=1;
  $id=$id.$shop_num;
}

else {
    $shop_num=$numrow;
    $id=$id.$shop_num;
    if ($result->num_rows > 0) {
      
       while($row = $result->fetch_assoc()) {
        if ($id==$row["Shop_Id"]) {
          $shop_num++;
          $id=$shopid;
          $id=$id.$shop_num;
        }
        else{
          $i=1;
        }
       }
  }
}




$sql = "INSERT INTO shop (shop_id, Address,shop_name, phone1,phone2,Contact_person)
VALUES ('$id','$address','$shopname',$contact1,$contact2,'$owner')";

if ($conn->query($sql) === TRUE) {
     $success="Shop Insered successfully";
     header('Location:Manager_add_shop.php?succs='.$success);
    $sql = "INSERT INTO login (Login_id,Login_type,Name, Password)
  VALUES ('$id','Shopowner','$owner','abc123')";

    if ($conn->query($sql) === TRUE) {
       echo "New record created successfully";
    } else {
         $error="some error has occured to set login" ;
        header('Location:Manager_add_shop.php?error='.$error);
    }



} else {
    $error="some error has occured";
    header('Location:Manager_add_shop.php?error='.$error);  
}



$conn->close();

?>
