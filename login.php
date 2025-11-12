<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT * FROM trainees WHERE email='$email' AND password='$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    session_start();
    $_SESSION['email'] = $email;
    header("Location: dashboard.php");
  } else {
    echo "Invalid email or password.";
  }
}
?>
