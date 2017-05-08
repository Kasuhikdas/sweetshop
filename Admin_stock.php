
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin</title>
<link rel="stylesheet" href="css\dash.css">
<link rel="stylesheet" href="css\admin_stock.css">
</head>

<body>
<div class="bodywrap">
<img src="source/black-background2.jpg" alt="no image"  width="1343" height="888">
<div class="header"><p>Warehouse Admin</p>

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
<table>
	<tr><th>Sweet Name</th><th>Base Material</th>
	<th>Available Qty</th><th>Ingredent</th>
	<th>Man Date</th><th>Exp Date</th>
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
         $sql = "SELECT * FROM stock_in_factory";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>".$row['Sweetname']."</td>";
        echo "<td>".$row['Base_material']."</td>";
        echo "<td>".$row['Available_qty']."</td>";
        echo "<td>".$row['Ingredients']."</td>";
        echo "<td>".$row['Man_date']."</td>";
        echo "<td>".$row['exp_date']."</td>";
        echo "</tr>";
      }
      


      ?>
</table>
</div>
<div class="content2">

<table>
	<tr>
		<th>Shop_ID</th><th>Sweet Name</th><th>Returned Qty</th><th>Date</th>
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
         $sql = "SELECT * FROM sweer_for_sale";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>".$row['Sweetname']."</td>";
        echo "<td>".$row['Qty']."</td>";
        echo "<td>".$row['Price']."</td>";
        echo "</tr>";
      }
      


      ?>
</table>


</div>

<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn"><img src="bg_icon\avatar.png" alt="no image" id="user_photo" height="30px" width="30px">  User</button>

  <div id="myDropdown" class="dropdown-content">
    <a href="#change_password">Change Password</a>
    <a href="#log_out">Log Out</a>
    <a href="#help">Help</a></div>
</div>
  <script>
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

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

</body>
</html>
