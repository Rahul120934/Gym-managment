<?php
$host = "localhost";
$user = "root";
$pass = ""; // Empty password for XAMPP default
$dbname = "gym_management";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
