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

  // check if form submitted
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    // fetch form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];

    // optional file handling - log trainer add
    $fp = fopen("../log.txt","a");
    fwrite($fp, "trainer_added_by_manager_id: " . $_SESSION['manager_id'] . "\n");
    fclose($fp);

    // execute query
    $q1 = "INSERT INTO trainer (name, email_id, contact_number, password) VALUES ('$name', '$email', '$contact', '$password')";
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
