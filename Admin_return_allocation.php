<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Return and allocation</title>
<link rel="stylesheet" type="text/css" href="css/dash.css">
<link rel="stylesheet" type="text/css" href="css/manager_stock.css">
</head>

<body>
<div class="bodywrap">
<img src="source/black-background2.jpg" alt="no image"  width="1343" height="888">
<div class="header"><p>Admin Desk</p>

 
    
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

  <li><a href="Admin_stock.php">Factory Stock & Sales Stock</a></li>
  <li><a href="Admin_return_allocation.php">Allocation & Return Sweets</a></li>
  <li><a href="Admin_order.php">Orders</a></li>
  
</ul> 
</div>

<div class="content1">
<form>
  


</form>
<table>
	<tr><th>Order_id</th><th>Shop_id</th>
	<th>Approved Quantity</th>
	</tr>
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
         $sql = "SELECT os.order_id,od.Shop_id,os.Approved_qty FROM order_summary os,order_detail od where os.order_id=od.Order_id and os.Status='Approved'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>".$row['order_id']."</td>";
        echo "<td>".$row['Shop_id']."</td>";
        echo "<td>".$row['Approved_qty']."</td>";
        echo "</tr>";
      }
      


      ?>
</table>
</div>

<div class="content2">

<table>
	<tr>
		
    <form action="Admin_return_allocation.php" method="POST">
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
          $sql="select DISTINCT shop_id from shop_return";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) { 
           echo ' <option value="'.$row['shop_id'].'">'.$row['shop_id'].'</option>';
            
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
          $sql="select DISTINCT sweetname from shop_sales";
          $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) { 
           echo ' <option value="'.$row['sweetname'].'">'.$row['sweetname'].'</option>';
            
          }?>
      </select></td>
      <td><button name="filter2">Filter</button></td></tr>
      </table>
      </form>
<table>
  <tr>
    <th>Shop_ID</th><th>Sweet Name</th><th>Returned Qty</th><th>Date</th><th>Reason</th>
    <?php
                
if (isset($_POST['filter2'])) {
      $term=$_POST['shops_id'];
      $term2=$_POST['sweetnam'];
if ($term2==2 && $term!=1) {
          $sql="SELECT * FROM shop_return where shop_id='$term'";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) { 
             echo "<tr>";
              echo "<td>".$row['shop_id']."</td>";
              echo "<td>".$row['sweetname']."</td>";
               echo "<td>".$row['return_qty']."</td>";
             echo "<td>".$row['Date']."</td>";
             echo "<td>".$row['Reason']."</td>";
               echo "</tr>";
           }
      }
      elseif ($term==1 && $term2!=2) {
         $sql="SELECT * FROM shop_return where sweetname='$term2'";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) { 
             echo "<tr>";
              echo "<td>".$row['shop_id']."</td>";
              echo "<td>".$row['sweetname']."</td>";
               echo "<td>".$row['return_qty']."</td>";
             echo "<td>".$row['Date']."</td>";
             echo "<td>".$row['Reason']."</td>";
               echo "</tr>";
           }
      }
      elseif ($term==1 && $term2==1) {
        $sql="SELECT * FROM shop_return";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) { 
             echo "<tr>";
              echo "<td>".$row['shop_id']."</td>";
              echo "<td>".$row['sweetname']."</td>";
               echo "<td>".$row['return_qty']."</td>";
             echo "<td>".$row['Date']."</td>";
             echo "<td>".$row['Reason']."</td>";
               echo "</tr>";
        }
      }
      else {
        //header("Location:unauthorized.php");
         $sql="SELECT * FROM shop_return where sweetname='$term2' and shop_id='$term'";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) { 
             echo "<tr>";
              echo "<td>".$row['shop_id']."</td>";
              echo "<td>".$row['sweetname']."</td>";
               echo "<td>".$row['return_qty']."</td>";
             echo "<td>".$row['Date']."</td>";
             echo "<td>".$row['Reason']."</td>";
               echo "</tr>";
           }
        
      }
         
    }
    else {
         $sql = "SELECT * FROM shop_return";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>".$row['shop_id']."</td>";
        echo "<td>".$row['sweetname']."</td>";
        echo "<td>".$row['return_qty']."</td>";
        echo "<td>".$row['Date']."</td>";
        echo "<td>".$row['Reason']."</td>";
        echo "</tr>";
      }
    }
    $conn->close();
?>
	</tr>
</table>


</div>

<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn"><img src="bg_icon\avatar.png" alt="no image" id="user_photo" height="30px" width="30px">  User</button>

  <div id="myDropdown" class="dropdown-content">
    <a href="#change_password">Change Password</a>
    <a href="#log_out">Log Out</a>
    <a href="#help">Help</a></div>
  </div>

</div>
</body>
</html>
