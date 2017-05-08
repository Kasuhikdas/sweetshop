<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Manager Add Shop</title>

<link rel="stylesheet"  href="css\manager_add_shop.css">
<link rel="stylesheet" href="css\dash.css">
</head>

<body>
<?php 
include 'session_maintain_manager.php';
      $error="";
      $error1="";
      $suc="";
      $success="";
      $msg1="";
  if (!empty($_GET['error'])) {
      $error=$_GET['error'];
  }
  if (!empty($_GET['succs'])) {
      $suc=$_GET['succs'];
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
<div class="header"><p>Manager Desk</p>
  <div class="dropdown">
<button onclick="myFunction()" class="dropbtn"><img src="bg_icon\avatar.png" id="user_photo" height=30px width=30px><?php echo $_SESSION['name'];?></button>

  <div id="myDropdown" class="dropdown-content">
    <a href="#change_password">Change Password</a>
    <a href="logout.php">Log Out</a>">Log Out</a>
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
<div class="sidebar">
<ul>
  <li><a href="Manager_dash.php">Dashboard</a></li>
  <li><a href="Manager_add_shop.php">Add Shop</a></li>
  <li><a href="Manager_upload_sweet.php">Upload Product</a></li>
  <li><a href="Manager_stock.php">Inventory Stock</a></li>
  <li><a href="Manager_sale_info.php">Order and Sales Info</a></li>
  
</ul> 
</div>
  <div class="content1">
  <form class="form" action="insertshop.php" method="post">
          
          
          <?php echo $suc; ?>
          <table padding="5px">
          <tr><th colspan="2"><span>Add New Shop</span></th></tr>
          <tr><td><label>Shop Name: </label></td><td><input type="text"   placeholder="Enter Shop Name"  name="shop_list" required ></td></tr>
          <tr><td><label>Address:</label></td><td><input type="text" placeholder="Enter Address" name="address" id="name" align="center" required></td></tr>
          <tr><td><label>Owner Name:</label></td><td><input type="text" placeholder="Enter Owner name" name="Owner" id="Owner" required></td></tr>
          <tr><td><label>Contact:</label></td><td><input type="text" placeholder="Enter Contact" name="Contact" pattern="\d{10}" required>
          </td></tr>
          <tr><td><label>Alternate Contact:</label></td><td><input type="text" placeholder="Enter Contact" name="Contact1" pattern="\d{10}" required></td></tr>
          <tr><td><?php echo $error; ?></td><td><button class="sub">ADD</button></td></tr>
          </table>
          
    </form>
</div>
  
  <div class="content2">
   <form class="form" method="post" action="deleteshop.php">
          <datalist id="shop">
                <option value="Select Shops"></option>
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
$sql = "SELECT Shop_id FROM Shop";
$result = $conn->query($sql);
  while($row = $result->fetch_assoc()) {
             echo ' <option value="'.$row['Shop_id'].'"</option>';
            }

         
     ?>
          </datalist><br>
          <table padding="5px">
          <tr><th colspan="2"><span>Remove Shop</span></th></tr>
          <tr><td><label>Shop Name: </label></td><td><input type="list" placeholder="Select Shop" list="shop" name="shop_list" required></td></tr>
          </table>
          <button class="sub">Remove</button>
        </form>
         <?php echo $msg1; ?>
  </div>
  
  <div class="content3">
  <table width="490"border="1px">
          
          <tr><th>Shop_id</th><th width="99">Shop Name</th><th width="113">Owner Name</th><th width="130">Address</th><th width="153">Contact</th></tr>
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
    $sql = "SELECT * from shop";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>".$row['Shop_Id']."</td>";
        echo "<td>".$row['Shop_name']."</td>";
        echo "<td>".$row['Address']."</td>";
        echo "<td>".$row['Contact_Person']."</td>";
        echo "<td>".$row['Phone1']."</td>";
        echo "<td>".$row['Phone2']."</td>";
        echo "</tr>";
      }$conn->close();
     ?>

    </table>

  
  </div>
</div>

</body>
</html>

