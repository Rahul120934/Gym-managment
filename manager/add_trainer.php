<?php
session_start();
include '../db.php';

if (!isset($_SESSION['manager_id'])) {
  header("Location: login.html");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $password = $_POST['password'];

  $sql = "INSERT INTO trainer (name, email_id, contact_number, password)
          VALUES ('$name', '$email', '$contact', '$password')";

  if (mysqli_query($conn, $sql)) {
    header("Location: dashboard.php?success=trainer_added");
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>
