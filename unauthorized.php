<?php
session_start();
if (isset($_SESSION['Login_type'])) {
		
	session_destroy();
	
}
?>
<p>You Are not authorized to visit the page</p>
