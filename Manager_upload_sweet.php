<?php 
include 'session_maintain_manager.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Manager Upload Sweet</title>
<link rel="stylesheet" href="css\dash.css">
<link rel="stylesheet" href="css\manager_upload_sweet.css">
</head>

<body>
<?php include 'upload_sweet.php';  ?>
<div class="bodywrap">
<img src="source/black-background2.jpg" alt="no image"  width="1343" height="888">
<div class="header"><p>Manager Desk</p>

  <div class="dropdown">
<button onclick="myFunction()" class="dropbtn"><img src="bg_icon\avatar.png" alt="no image" id="user_photo" height="30px" width="30px"><?php echo $_SESSION['name'];?></button>

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
 <li><a href="Manager_dash.php">Dashboard</a></li>
  <li><a href="Manager_add_shop.php">Add Shop</a></li>
  <li><a href="Manager_upload_sweet.php">Upload Product</a></li>
  <li><a href="Manager_stock.php">Inventory Stock</a></li>
  <li><a href="Manager_sale_info.php">Order and Sales Info</a></li>
</ul> 
</div>
  <div class="content1">
  <form class="form" action="<?php $_SERVER["PHP_SELF"];?>" method="post">



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
$sql = "SELECT Sweetname FROM stock_in_factory where exp_date>'$date'";
$result = $conn->query($sql);
  while($row = $result->fetch_assoc()) {
             echo ' <option value="'.$row['Sweetname'].'"</option>';
            }

         
     ?>
          </datalist>


      <?php echo $success;?>
      <table width="377" height="234" padding="5px">
          <tr><th colspan="2"><span>Upload Product for Order</span></th></tr>
          <tr><td width="100"><label>Sweet Name: </label></td><td width="178"><input type="list" placeholder="Select Sweet Name" list="sweet" name="sweet_list" required></td></tr>
          <tr><td><label>Price:</label></td><td><input type="text" placeholder="Enter Price" name="price" id="price" align="center" pattern="\d*" required>
          </td></tr>
          <tr><td height="59"><label>Quantity:</label></td><td><input type="text" placeholder="Enter Quantity" name="qty" id="qty" pattern="\d*" required></td></tr>
          <tr><td><?php
          if (empty($_POST['qty'])) {
             
           } 
           else{
         echo $error;}
         ?></td> <td><button class="sub">Submit</button></td></tr>
          </table>
          
        </form>
  </div>
  
 
  
  <div class="content3">
  <table width="490" border="1px" >
          <center>Sweets For Sale</center>
          <tr><th width="148">Sweet Name</th><th width="70">QTY</th><th width="132">Price</th></tr>
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
    $sql = "SELECT Sweetname,Qty,Price from sweer_for_sale";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<td>".$row['Sweetname']."</td>";
        echo "<td>".$row['Qty']."</td>";
        echo "<td>".$row['Price']."</td>";
        echo "</tr>";
      }$conn->close();
      ?>
        </table>
  
  </div>

</div>
</body>
</html>
