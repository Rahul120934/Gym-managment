<?php
session_start();
include '../db.php';

if (!isset($_SESSION['manager_id'])) {
  header("Location: login.html");
  exit();
}

if (isset($_GET['id'])) {
  $trainer_id = $_GET['id'];
  
  $sql = "DELETE FROM trainer WHERE trainer_id = $trainer_id";
  
  if (mysqli_query($conn, $sql)) {
    header("Location: dashboard.php?success=trainer_deleted");
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>
