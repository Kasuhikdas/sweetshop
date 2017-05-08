<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Shop Request</title>
<link rel="stylesheet" href="css\dash.css">
<link rel="stylesheet" href="css\shop_request.css">
</head>

<body>
<?php
include 'session_maintain.php';
$error1="";
$success1="";
$error="";
$success="";

if (!empty($_GET['error'])) {
      $error1=$_GET['error'];
  }
  if (!empty($_GET['succs'])) {
      $success1=$_GET['succs'];
    }
    if (!empty($_GET['errr'])) {
      $error=$_GET['errr'];
  }
  if (!empty($_GET['succ'])) {
      $success=$_GET['succ'];
    }
if (!empty($_GET['msg'])) {
      $msg=$_GET['msg'];
  }
?>
<div class="bodywrap">
<img src="source/black-background2.jpg" alt="no image"  width="1342" height="887">
<div class="header"><p>Shop Owner</p>

  <div class="dropdown">
<button onclick="myFunction()" class="dropbtn"><img src="bg_icon\avatar.png" id="user_photo" height="30px" width="30px">  User</button>

  <div id="myDropdown" class="dropdown-content">
    <a href="#change_password">Change Password</a>
    <a href="logout.php">Log Out</a>
    <a href="#help">Help</a></div>
    </div>
    
  <script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>


</div>
<div class="sidebar">
<ul>
  <li><a href="Shops_dash.php">Dashboard</a></li>
  <li><a href="Shops_request_order.php">Request Sweets</a></li>
  <li><a href="Shops _sweet_return.php">Return Sweets</a></li>
  <li><a href="Shops_stock.php">Shop Stock</a></li>
</ul> 
</div>

<div class="content1">
<form method="post" action="order.php">
			<p>Order Sweet</p>
	  <datalist id="sweet">
               
                 <?php
                
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT Sweetname FROM sweer_for_sale";
$result = $conn->query($sql);
  while($row = $result->fetch_assoc()) {
             echo ' <option value="'.$row['Sweetname'].'"</option>';
            }

         
     ?>
          </datalist>
        <?php echo  $success1;
?>
		<table border="1">
			<tr><td><label>Sweet Name</label></td><td><input type="list" list="sweet" name="sweet_list" required></td></tr>
			<tr><td><label>Quantity</label></td><td><input type="text" name="Quantity" pattern="\d*" required></td></tr>
			<tr><td><?php echo $error1; ?></td><td><button>Order</button></td></tr>
		</table>
	</form>
</div>
<div class="content2">
<p>Current Orders
</p>
	<form method="POST" action="Shops_request_order.php">
    <select name="status_select">
  <option value=''>Select</option>
  <option value='New'>New</option>
  <option value='Approved'>Approved</option>
  <option value='Completed'>Completed</option>
  <option value='Out For Delivery'>Out For Delivery</option>
  <option value='Canceled'>Cancelled</option>
  <input type="Submit" name="filter" value="Filter">
    </select>

  </form>
   <?php echo $error;?><?php echo $success;?>
  <table border="1">
 
		<tr><th>Order Number</th><th>Sweet Name</th><th>Requested QTY</th><th>Apporved QTY</th><th>Date</th></tr>
  <?php 
      
      $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sweet";
    $shop="";
    $shop=$_SESSION["id"];
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    } 
    if (isset($_POST['filter'])) {
         $term=$_POST['status_select'];
         echo $term;

         if ($term=='New') {
        $sql = "SELECT s.order_id,s.sweetname,s.req_qty,s.Approved_qty,s.date FROM order_summary s,order_detail d where s.order_id=d.Order_id and d.Shop_ID='$shop' and s.Status='New'";
          $result = $conn->query($sql);
          $status='Canceled';
           $status2='Completed';
           while($row = $result->fetch_assoc()) { 
               echo "<tr>";
               echo "<td>".$row['order_id']."</td>";
               echo "<td>".$row['sweetname']."</td>";
               echo "<td>".$row['req_qty']."</td>";
               echo "<td>".$row['Approved_qty']."</td>";
               echo "<td>".$row['date']."</td>";
               echo "<td><a href='changestatus.php?id=$row[order_id]&status=$status'>Cancel</a></td>";
              echo "</tr>";
            }
      
          }
          elseif ($term=='Completed') {
          $sql = "SELECT s.order_id,s.sweetname,s.req_qty,s.Approved_qty,s.date FROM order_summary s,order_detail d where s.order_id=d.Order_id and d.Shop_ID='$shop' and s.Status='Completed'";
          $result = $conn->query($sql);
           while($row = $result->fetch_assoc()) { 
               echo "<tr>";
               echo "<td>".$row['order_id']."</td>";
               echo "<td>".$row['sweetname']."</td>";
               echo "<td>".$row['req_qty']."</td>";
               echo "<td>".$row['Approved_qty']."</td>";
               echo "<td>".$row['date']."</td>";
              echo "</tr>";
          }

      }
       elseif ($term=='Approved') {
        
      $sql = "SELECT s.order_id,s.sweetname,s.req_qty,s.Approved_qty,s.date FROM order_summary s,order_detail d where s.order_id=d.Order_id and d.Shop_ID='$shop' and s.Status='Approved'";
          $result = $conn->query($sql);
          $status='Canceled';
           $status2='Completed';
           while($row = $result->fetch_assoc()) { 
               echo "<tr>";
               echo "<td>".$row['order_id']."</td>";
               echo "<td>".$row['sweetname']."</td>";
               echo "<td>".$row['req_qty']."</td>";
               echo "<td>".$row['Approved_qty']."</td>";
               echo "<td>".$row['date']."</td>";
               echo "<td><a href='changestatus.ph
               p?id=$row[order_id]&status=$status'>Cancel</a></td>";
              echo "</tr>";
        }
    }
    elseif ($term=='Canceled') {
        $sql = "SELECT s.order_id,s.sweetname,s.req_qty,s.Approved_qty,s.date FROM order_summary s,order_detail d where s.order_id=d.Order_id and d.Shop_ID='$shop' and s.Status='Canceled'";
          $result = $conn->query($sql);
          $status='Canceled';
           
           while($row = $result->fetch_assoc()) { 
               echo "<tr>";
               echo "<td>".$row['order_id']."</td>";
               echo "<td>".$row['sweetname']."</td>";
               echo "<td>".$row['req_qty']."</td>";
               echo "<td>".$row['Approved_qty']."</td>";
               echo "<td>".$row['date']."</td>";
               echo "</tr>";
    }
  }
  else if ($term=='Out For Delivery') {
  
  
    $sql = "SELECT s.order_id,s.sweetname,s.req_qty,s.Approved_qty,s.date FROM order_summary s,order_detail d where s.order_id=d.Order_id and d.Shop_ID='$shop' and s.Status='Out For Delivery'";
          $result = $conn->query($sql);
          
           $status='Completed';
           while($row = $result->fetch_assoc()) { 
               echo "<tr>";
               echo "<td>".$row['order_id']."</td>";
               echo "<td>".$row['sweetname']."</td>";
               echo "<td>".$row['req_qty']."</td>";
               echo "<td>".$row['Approved_qty']."</td>";
               echo "<td>".$row['date']."</td>";
               echo "<td><a href='shop_status.php?id=$row[order_id]&status=$status'>Recieve</a></td>";
              echo "</tr>";
       }
    }
  }
else
{
  $sql = "SELECT s.order_id,s.sweetname,s.req_qty,s.Approved_qty,s.date FROM order_summary s,order_detail d where s.order_id=d.Order_id and d.Shop_ID='$shop' and s.Status='Out For Delivery'";
          $result = $conn->query($sql);
          
           $status='Completed';
           while($row = $result->fetch_assoc()) { 
               echo "<tr>";
               echo "<td>".$row['order_id']."</td>";
               echo "<td>".$row['sweetname']."</td>";
               echo "<td>".$row['req_qty']."</td>";
               echo "<td>".$row['Approved_qty']."</td>";
               echo "<td>".$row['date']."</td>";
               echo "<td><a href='shop_status.php?id=$row[order_id]&status=$status'>Recieve</a></td>";
              echo "</tr>";
}

}


$conn->close();


  ?>		





    
		
	</table>
  <?php //echo $msg;?>
</div>

</div>
</body>
</html>
