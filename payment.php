<?php
// start session
session_start();

// connect to server and database
$conn = mysqli_connect("localhost", "root", "", "gym_management");

// check connection
if(!$conn) {
  echo "connection failed";
} else {
  // get logged in user email from session
  $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

  // find trainee id using email
  $trainee_id = 0;
  if($email != '') {
    $q0 = "SELECT trainee_id FROM trainees WHERE email='$email'";
    $r0 = mysqli_query($conn, $q0);
    $user = mysqli_fetch_assoc($r0);
    if($user) {
      $trainee_id = $user['trainee_id'];
    }
  }

  // check if form submitted
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    // fetch form data
    $method = $_POST['method'];
    $amount = $_POST['amount'];

    // optional: file handling - log payments
    $fp = fopen("log.txt","a");
    fwrite($fp, "payment_submitted_by_trainee_id: " . $trainee_id . "\n");
    fclose($fp);

    // execute query
    $q1 = "INSERT INTO payment (trainee_id, method, amount) VALUES ('$trainee_id', '$method', '$amount')";
    $r1 = mysqli_query($conn, $q1);

    // display output
    if($r1)
      echo "record inserted";
    else
      echo "error in insertion";
  }

  // close connection
  mysqli_close($conn);
}
?>
