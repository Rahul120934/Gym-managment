<?php
session_start();
include '../db.php';

if (!isset($_SESSION['manager_id'])) {
  header("Location: login.html");
  exit();
}

if (isset($_GET['id'])) {
  $trainee_id = $_GET['id'];
  
  // Delete related payments first
  mysqli_query($conn, "DELETE FROM payment WHERE trainee_id = $trainee_id");
  
  // Delete trainee
  $sql = "DELETE FROM trainees WHERE trainee_id = $trainee_id";
  
  if (mysqli_query($conn, $sql)) {
    header("Location: dashboard.php?success=trainee_deleted");
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>
