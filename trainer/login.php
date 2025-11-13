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
    fwrite($fp, "trainer_login_attempt: " . $email . "\n");
    fclose($fp);

    // execute query
    $q = "SELECT * FROM trainer WHERE email_id='$email' AND password='$password'";
    $r = mysqli_query($conn, $q);

    // check result
    if($r && mysqli_num_rows($r) == 1) {
      $trainer = mysqli_fetch_assoc($r);
      $_SESSION['trainer_id'] = $trainer['trainer_id'];
      $_SESSION['trainer_name'] = $trainer['name'];
      $_SESSION['trainer_email'] = $email;
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
