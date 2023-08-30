<?php
$servername = "localhost";
$username = "root";
$passwords = "";
$db = "crudDB";

// Create connection
$conn = mysqli_connect($servername, $username, $passwords, $db);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";


?>
