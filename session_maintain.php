<?php
	session_start();
	if (empty($_SESSION["id"]) && empty($_SESSION["name"])) {
		
		header("Location:logout.php");
	}
	else {
			if ($_SESSION["Login_type"]!="Shopowner") {
			header("Location:unauthorized.php");
		}
	}

?>