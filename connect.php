<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "crowdfunding_project";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// check connection
if(!$conn) {
  die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}

?>
