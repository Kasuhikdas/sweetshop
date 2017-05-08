<?php  include 'session_maintain.php';?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Shop Sweet Returns</title>
<link rel="stylesheet" href="css\dash.css">
<link rel="stylesheet" href="css\shop_return.css">
</head>

<body>
<div class="bodywrap">
<img src="source/black-background2.jpg" alt="no image"  width="1342" height="902">
<div class="header"><p>Shop Owner</p>

  <div class="dropdown">
<button onclick="myFunction()" class="dropbtn"><img src="bg_icon\avatar.png" id="user_photo" height="30px" width="30px"><?php  echo  $_SESSION["name"]?></button>

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
<p>Current Stock Update</p>
<table width="367" height="40" border="1">
		<tr><th width="121">Sweet Name</th><th width="68">Stock</th><th width="110">Selling Price</th></tr>
     <?php
     $suc="a";
     $err="";
     if (isset($_GET['suc'])) {
        $suc=$_GET['suc'];
     }
     
      $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sweet";
    $shop_id=$_SESSION["id"];
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT * FROM shop_stock where  shop_id='$shop_id'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>".$row['shop_id']."</td>";
        echo "<td>".$row['sweeet_name']."</td>";
        echo "<td>".$row['qty']."</td>";
        echo "<td>".$row['selling_price']."</td>";
        echo "<td>".$row['exp_date']."</td>";
        echo "<td><a href='flush.php?name=$row[sweeet_name]'>Flush</a></td>";
        echo "</tr>";
        }

    ?>
	</table>
  <p>
  <?php
     echo $err;echo $suc;
  ?>
  </p>
</div>
<div class="content2">
<form action="shopowner_returnsweet_insert.php" method="post">
		<p>Return Sweet</p>
	<datalist id="sweet">
                <?php
              $succ="";
              $err="";
               if(isset($_GET['success']))
               {
                  $succ=$_GET['success'];
               }
             if(isset($_GET['error']))
               {
                  $err=$_GET['error'];
               }

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";
$shop_id=$_SESSION["id"];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT sweeet_name FROM shop_stock where  shop_id='$shop_id'";
$result = $conn->query($sql);
  while($row = $result->fetch_assoc()) {
             echo ' <option value="'.$row['sweeet_name'].'"</option>';
            }

         
     ?>
          </datalist>
<p><?php echo $succ; ?></p>
		<table border="1">
			<tr><td><label>Sweet Name</label></td><td><input type="list" list="sweet" name="sweet_list" required></td></tr>
			<tr><td><label>Quantity</label></td><td><input type="text" name="Quantity" pattern="\d*" required></td></tr>
      <tr><td><label>Reason</label></td><td><select name="reason">
          <option value="expired">Expired</option>
          <option value="other">Other</option>
       </select></td></tr>
			<tr><td><p><?php echo $err; ?></p></td><td><button>Order</button></td></tr>
		</table>
	</form>
</div>
</div>
</body>
</html>
