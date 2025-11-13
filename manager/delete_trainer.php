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
    $trainer_id = $_GET['id'];

    // execute query
    $q = "DELETE FROM trainer WHERE trainer_id = $trainer_id";
    $r = mysqli_query($conn, $q);

    // display output
    if($r)
      echo "record deleted";
    else
      echo "error in deletion";
  }

  // close connection
  mysqli_close($conn);
}
?>
