
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Add Stock</title>
<link rel="stylesheet" href="css\dash.css">
<link rel="stylesheet" href="css\admin_add_stock.css">
</head>

<body>
<?php
include 'session_maintain_admin.php';
$error2="";
$error1="";
$success1="";
$success="";
$msg1="";
  if (!empty($_GET['error1'])) {
      $error2=$_GET['error1'];
  }
  if (!empty($_GET['suc'])) {
      $success1=$_GET['suc'];
  }
  if (!empty($_GET['error2'])) {
      $error1=$_GET['error2'];
    }
    if (!empty($_GET['suc2'])) {
      $success=$_GET['suc2'];
  }
  if (!empty($_GET['scc'])) {
    $msg1=$_GET['scc'];
  }
  ?>
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

  <li><a href="Admin_stock.php">Factory Stock & Sales Stock</a></li>
  <li><a href="Admin_return_allocation.php">Allocation & Return Sweets</a></li>
  <li><a href="Admin_order.php">Orders</a></li>
</ul> 
</div>
<div class="content1">

<form action="stock_in _factory_insert.php" method="POST">
<h2><center> New Sweet Entry</center></h2>
<?php echo $success;  ?>
<table>
	<tr><td width="133"><label>Sweet Name</label></td><td width="163"><input type="text" name="sweetname" pattern="[A-Z][a-z]{*}" required></td></tr>
	<tr><td><label>Base Materia</label></td><td><input type="text" name="Basematerial" required></td></tr>
	<tr><td><label>Quantity</label></td><td><input type="text" name="qty" pattern="\d*" required ></td></tr>
	<tr><td><label>Ingredient</label></td><td><input type="text" name="Ingredient" ></td></tr>
	<tr><td><label>Manufacture date</label></td><td><input type="Date" name="mandate" required></td></tr>
	<tr><td><label>Expiry Date</label></td><td><input type="Date" name="expdate" required></td></tr>
	<tr><td height="26"><p id="check"><?php echo  $error1;  ?></p></td><td><button onclick ="">Add</button></td></tr>
</table>
</form>
</div>
<div class="content2">

<h2><center>Existing Sweet stock Entry</center></h2>
<?php echo $success1;  ?>
	<form action="stock_in_factory_update.php" method="POST">





	<datalist id="sweet">
	<option value="Select option"></option>
                
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
$sql = "SELECT Sweetname FROM stock_in_factory";
$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
             echo ' <option value="'.$row['Sweetname'].'"</option>';
            }

         
     ?>
 </datalist>




	<table width="373" height="261">
	<tr><td><label>Sweet Name</label></td><td><input type="list" list="sweet" name="sweet_list" required></td></tr>
	<tr><td><label>Quantity</label></td><td><input type="text" name="Quantity" pattern="\d*" required></td></tr>
	<tr><td><label>Manufacture date</label></td><td><input type="Date" name="mandate" required></td></tr>
	<tr><td><label>Expiry Date</label></td><td><input type="Date" name="expdate" required></td></tr>
	<tr><td><label id="check_id"><?php echo $error2; ?></label></td><td><button>Add</button></td></tr>
</table>
</form>
</div>
<div class="content3">
  <p>Delete From Stock</p>
  <form action="delete stock.php" method="POST">
  

  <table>
  <tr><td><label>Sweet Name</label></td><td><input type="list" list="sweet" name="sweet_list_del" required></tr>
  <tr><td><label id="check"></label></td><td><button>Remove</button></td></tr>
  </table>
  <?php echo $msg1; ?>
</form>
</div>


</div>

</body>
</html>
