<?php
include 'session_maintain_admin.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Order</title>
<link rel="stylesheet" href="css\dash.css">
<link rel="stylesheet" href="css\admin_order.css">
</head>

<body>
<div class="bodywrap">
<img src="source/black-background2.jpg" alt="no image"  width="1343" height="888">
<div class="header"><p>Warehouse Admin</p>

  <div class="dropdown">
<button onclick="myFunction()" class="dropbtn"><img src="bg_icon\avatar.png" alt="no image" id="user_photo" height="30px" width="30px">  User</button>

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
  <li><a href="Admin_dash.php">Dashboard</a></li>
  <li><a href="Admin_add_stock.php">Add Stock</a></li>
  <li><a href="Admin_return.php">Sweet Returns</a></li>
  <li><a href="Admin_stock.php">Factory Stock</a></li>
  <li><a href="Admin_order.php">Orders</a></li>
</ul> 
</div>
<div class="content1">
<h2>New Orders</h2>
 	<form>
 	<table border="1px">
 		<tr><th>Order Id</th><th>Sweet Name</th><th>Requested Quantity</th><th>
     Approved</th><th>Shop_ID</th><th>Date</th></tr>
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
    $sql = "SELECT s.order_id,s.sweetname,s.req_qty,s.Approved_qty,s.date,d.Shop_ID FROM order_summary s,order_detail d where s.order_id=d.Order_id and s.Status='Approved'";
    $result = $conn->query($sql);
    $status='Out For Delivery';
    while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>".$row['order_id']."</td>";
        echo "<td>".$row['sweetname']."</td>";
        echo "<td>".$row['req_qty']."</td>";
        echo "<td>".$row['Approved_qty']."</td>";
        echo "<td>".$row['Shop_ID']."</td>";
        echo "<td>".$row['date']."</td>";
        echo "<td><a href='changestatus.php?id=$row[order_id]&status=$status'>Dispathc</a></td>";
        echo "</tr>";
      }$conn->close();
 		 ?>
 	</table>
 	</form>
</div>
<div class="content2">
<form method="POST" action="Admin_order.php">
      <table border="1px">    <tr><td>
      <select name="shops_id">
      <option value="1"> </option>
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
          $sql="SELECT DISTINCT d.Shop_ID FROM order_summary s,order_detail d where s.order_id=d.Order_id and s.Status='Completed'";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) { 
           echo ' <option value="'.$row['Shop_ID'].'">'.$row['Shop_ID'].'</option>';
            
          }

      ?>
      
    
      </select></td><td>
      <select name="sweetnam">
        <option value="2"> </option>
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
          $sql="SELECT DISTINCT s.sweetname FROM order_summary s,order_detail d where s.order_id=d.Order_id and s.Status='Completed'";
          $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) { 
           echo ' <option value="'.$row['sweetname'].'">'.$row['sweetname'].'</option>';
            
          }?>
      </select></td>
      <td><button name="filter2">Filter</button></td></tr>
      </table>
</form>

<h2>Completed Orders</h2>
 	<table width="395" height="74" border="1px">
 		<tr><th>Order Id</th><th>Sweet Name</th><th>Requested Quantity</th><th>Approved</th><th>Shop_ID</th><th>Date</th></tr>
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
    if (isset($_POST['filter2'])) {
      $term=$_POST['shops_id'];
      $term2=$_POST['sweetnam'];
      if ($term2==2 && $term!=1) {
          $sql = "SELECT s.order_id,s.sweetname,s.req_qty,s.Approved_qty,s.date,d.Shop_ID FROM order_summary s,order_detail d where s.order_id=d.Order_id and s.Status='Completed' and d.Shop_ID='$term'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>".$row['order_id']."</td>";
        echo "<td>".$row['sweetname']."</td>";
        echo "<td>".$row['req_qty']."</td>";
        echo "<td>".$row['Approved_qty']."</td>";
        echo "<td>".$row['Shop_ID']."</td>";
        echo "<td>".$row['date']."</td>";
        echo "</tr>";
           }
      }
      elseif ($term==1 && $term2!=2) {
         $sql = "SELECT s.order_id,s.sweetname,s.req_qty,s.Approved_qty,s.date,d.Shop_ID FROM order_summary s,order_detail d where s.order_id=d.Order_id and s.Status='Completed' and s.sweetname='$term2'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>".$row['order_id']."</td>";
        echo "<td>".$row['sweetname']."</td>";
        echo "<td>".$row['req_qty']."</td>";
        echo "<td>".$row['Approved_qty']."</td>";
        echo "<td>".$row['Shop_ID']."</td>";
        echo "<td>".$row['date']."</td>";
        echo "</tr>";
           }
      }
      elseif ($term==1 && $term2==2) {
        $sql = "SELECT s.order_id,s.sweetname,s.req_qty,s.Approved_qty,s.date,d.Shop_ID FROM order_summary s,order_detail d where s.order_id=d.Order_id and s.Status='Completed' ";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>".$row['order_id']."</td>";
        echo "<td>".$row['sweetname']."</td>";
        echo "<td>".$row['req_qty']."</td>";
        echo "<td>".$row['Approved_qty']."</td>";
        echo "<td>".$row['Shop_ID']."</td>";
        echo "<td>".$row['date']."</td>";
        echo "</tr>";
        }
      }
      else {
        $sql = "SELECT s.order_id,s.sweetname,s.req_qty,s.Approved_qty,s.date,d.Shop_ID FROM order_summary s,order_detail d where s.order_id=d.Order_id and s.Status='Completed' and s.sweetname='$term2' and d.Shop_ID='$term'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>".$row['order_id']."</td>";
        echo "<td>".$row['sweetname']."</td>";
        echo "<td>".$row['req_qty']."</td>";
        echo "<td>".$row['Approved_qty']."</td>";
        echo "<td>".$row['Shop_ID']."</td>";
        echo "<td>".$row['date']."</td>";
        echo "</tr>";
           }
        
      }
         
    }
    else {
        $sql = "SELECT s.order_id,s.sweetname,s.req_qty,s.Approved_qty,s.date,d.Shop_ID FROM order_summary s,order_detail d where s.order_id=d.Order_id and s.Status='Completed'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>".$row['order_id']."</td>";
        echo "<td>".$row['sweetname']."</td>";
        echo "<td>".$row['req_qty']."</td>";
        echo "<td>".$row['Approved_qty']."</td>";
        echo "<td>".$row['Shop_ID']."</td>";
        echo "<td>".$row['date']."</td>";
        echo "</tr>";
           }
    }
     ?>

 		
 	</table>
</div>

</div>

</body>
</html>
