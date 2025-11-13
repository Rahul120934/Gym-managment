<?php
// start session
session_start();

// connect to server and database
$conn = mysqli_connect("localhost", "root", "", "gym_management");

// check connection
if(!$conn) {
  echo "connection failed";
} else {
  // only allow if manager logged in
  if (!isset($_SESSION['manager_id'])) {
    header("Location: login.html");
    exit();
  }

  // get id from query string
  if (isset($_GET['id'])) {
    $trainee_id = $_GET['id'];

    // delete related payments
    $q1 = "DELETE FROM payment WHERE trainee_id = $trainee_id";
    $r1 = mysqli_query($conn, $q1);

    // delete trainee
    $q2 = "DELETE FROM trainees WHERE trainee_id = $trainee_id";
    $r2 = mysqli_query($conn, $q2);

    // display output
    if($r1 && $r2)
      echo "record deleted";
    else
      echo "error in deletion";
  }

  // close connection
  mysqli_close($conn);
}
?>
