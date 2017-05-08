<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome to KDA Sweets and Savouries - Online Sweets Shopping</title>
<link rel="stylesheet" type="text/css" href="css\sweetstyle_css.css">
<link rel="icon" type="image/png" href="bg_icon\shop-52.png">
</head>

<body>
<?php 
  $msg="Invalid Username password!";
 ?>
<div class="header"><img src="bg_icon\head.jpg" alt="no image" width="100%" height="48">
  <div></div>
</div>

<div id="navigation">
  <ul class="icon">
	<li><a title ="Home" class="active" href="KDA Sweet Shop.php"><img src="bg_icon\home.png"></a></li>
	<li><a title ="Corporate" href="Corporate.html"><img src="bg_icon\star.png"></a></li>
	<li><a title ="Location" href="locations.html"><img src="bg_icon\placeholder.png"></a></li>
    <li><a title ="Our Brand" href="our_brands.html"><img src="bg_icon\three-buildings.png"></a></li>
    <li><a title ="contact Us" href="about.php"><img src="bg_icon\contacts.png"></a></li>
</ul>
</div>
 

<div class="slides">


<?php

if (isset($_GET['msg'])) {
  echo "<div class='alert'>
  <span class='closebtn' onclick=this.parentElement.style.display='none';>&times;</span>
  <strong> ";
  echo $msg;
  echo "</strong> Please enter Correctly. </div>";
}
else {
  
}
?>


<div class="login">

<button style="color:white" onclick="myFunction2()" class="dropbtn2" href=".">Corporate Login</button>
<div id="myDropdown1" class="login-corp">
  <form name="myform" method="POST" action="login.php">
    <lable>User ID</lable><input type="text" name="user_name" id="user_name" required>
    <label>Password</label><input type="password" name="password" id="password" required><br>
    <button style="background-color: #D82424;color: white;">Login</button>
  </form>
</div>
</div>
<script type="text/javascript">
function myFunction2() {
    document.getElementById("myDropdown1").classList.toggle("show1");
}

// Close the dropdown menu if the user clicks outside of it
/*window.onclick = function(event) {
  if (!event.target.matches('.dropbtn2')) {

    var dropdowns = document.getElementsByClassName("login-corp");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show1')) {
        openDropdown.classList.remove('show1');
      }
    }
  }
}*/
</script>
<div class="transbox"><img src="source\full-logo.jpg" alt="" width="239" height="422">
 <h2>Welcome to KDA Sweets and Savouries</h2></div>
<img class="mySlides" src="source\assorted.jpg" width="1050px" height="576">
<img class="mySlides" src="source\Rasmalai.jpg" width="1050px" height="576">
<img class="mySlides" src="source\jalebi.jpg" width="1050px" height="576px">
<img class="mySlides" src="source\GulabJamun.jpg" width="1050px" height="576px">
<img class="mySlides" src="source\Peda.jpg" width="1050px" height="576px">
<img class="mySlides" src="source\Badam-Halwa.jpg" width="1050px" height="576px">
<img class="mySlides" src="source\walnut.jpg" width="1050px" height="576px">
</div>

<script type="text/javascript">
var slideIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none"; 
    }
    slideIndex++;
    if (slideIndex > x.length) {slideIndex = 1} 
    x[slideIndex-1].style.display = "block"; 
    setTimeout(carousel, 3000); 
}
</script>

<div class="about1">No matter where you are in the world, your beloved KDA sweets is now just a click away. Order your favorite sweets online by simply choosing from a wide variety of our products. In keeping with our reputation of being the best, we assure you that KDA Sweets’ high quality standards will be adhered to, even when you order with us online. Fresh, mouth-watering products, prepared with the legendary KDA craftsmanship is now delivered to your doorstep. Order today!</div>
    <div class="mid"><img src="bg_icon\design.png"></div>
    <div class="catagory">  <table align = center>
   
    <tr>
        <th colspan = 7>Sweets Gift</th>
        <th colspan = 7>Sweets</th>
        <th colspan = 7>Namkeen</th>
        <th colspan = 7>Dryfruits</th>
        <th colspan = 7>KDA Products</th>
    </tr>
    <tr>
        <td colspan = 7><a href="#"><img src="source\giftbox2.jpg"height=100px width=100px></img></a></th>
        <td colspan = 7><a href="#"><img src="source\badam-basket.jpg"  height=100 width=100></img></a></th>
        <td colspan = 7><a href="#"><img src="source\dry-fruit-samosa.jpg"  height=100 width=100></img></a></td>
        <td colspan = 7><a href="#"><img src="source\assorted-dry-fruits.jpg"  height=100 width=100></img></a></th>
        <td colspan = 7><a href="#"><img src="source\luxury-choco.jpg"  height=100 width=100></img></a></th>
    </tr>
          </table>
</div>
<footer class="footer-wrap">
    <div class="foot-contain">
    <table width="964"  cellspacing="5" cellpadding="5">
  <tbody>
    <tr>
      <td width="135"><img src="bg_icon\cupcake.png" alt=""></td>
      <td width="120"><img src="bg_icon\like.png" alt=""></td>
      <td width="149"><img src="bg_icon\block.png" alt=""></td>
      <td width="147"><img src="bg_icon\d-truck.png" alt=""></td>
    </tr>
    <tr>
      <td>300+</td>
      <td>100%</td>
      <td>500+</td>
      <td>30Ton</td>
    </tr>
    <tr>
      <td>Different Varities</td>
      <td>Hygenic</td>
      <td>Corporate Clients</td>
      <td>Production Everyday</td>
    </tr>
  </tbody>
</table>
</div>
  <div class="support"><table width="371" cellspacing="7" cellpadding="7">
  <tbody>
    <tr>
      <td width="83" height="56"><h3>Social</h3></td>
      <td width="76"><h3>Store Timings</h3></td>
      <td width="140"><h3>Support</h3></td>
    </tr>
    <tr>
      <td><img src="bg_icon\facebook.png" alt="">
      <img src="bg_icon\twitter.png" alt="">
      <img src="bg_icon\google.png" alt=""></td>
      <td>Everyday 9am to 9pm</td>
      <td>info@KDAsweets.net
			+91 80 2559 8915</td>
    </tr>
  </tbody>
</table>
</div>
</footer>
</body>
</html>
