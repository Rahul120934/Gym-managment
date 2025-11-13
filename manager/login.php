<?php
// start session
session_start();

// connect to server and database
$conn = mysqli_connect("localhost", "root", "", "gym_management");

// check connection
if(!$conn) {
  echo "connection failed";
} else {
  // check if form submitted
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    // fetch form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // optional: file handling - log login attempts
    $fp = fopen("../log.txt","a");
    fwrite($fp, "manager_login_attempt: " . $email . "\n");
    fclose($fp);

    // execute query
    $q = "SELECT * FROM manager WHERE email_id='$email' AND password='$password'";
    $r = mysqli_query($conn, $q);

    // display output and set session
    if($r && mysqli_num_rows($r) == 1) {
      $manager = mysqli_fetch_assoc($r);
      $_SESSION['manager_id'] = $manager['manager_id'];
      $_SESSION['manager_name'] = $manager['name'];
      $_SESSION['manager_email'] = $email;
      header("Location: dashboard.php");
      exit();
    } else {
      echo "invalid email or password";
    }
  }

  // close connection
  mysqli_close($conn);
}
?>
