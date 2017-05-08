<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweet";
$sweetname=$_POST['sweet_list'];


$remainderqty="";
$currentqty="";
$swetforsaleqty="";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 




?>