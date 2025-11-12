<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT * FROM manager WHERE email_id='$email' AND password='$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    session_start();
    $manager = mysqli_fetch_assoc($result);
    $_SESSION['manager_id'] = $manager['manager_id'];
    $_SESSION['manager_name'] = $manager['name'];
    $_SESSION['manager_email'] = $email;
    header("Location: dashboard.php");
  } else {
    echo "<p style='color: #ff0000; text-align: center;'>Invalid email or password. <a href='login.html'>Try again</a></p>";
  }
}
?>
