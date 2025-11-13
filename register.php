<?php
// connect to server and database
$conn = mysqli_connect("localhost", "root", "", "gym_management");

// check connection
if(!$conn) {
  echo "connection failed";
} else {
  // check if form submitted
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    // fetch form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $password = $_POST['password'];

    // optional file handling - log registrations
    $fp = fopen("log.txt","a");
    fwrite($fp, "trainee_registered: " . $email . "\n");
    fclose($fp);

    // execute query
    $q1 = "INSERT INTO trainees (name, email, contact_number, age, gender, height, weight, password) VALUES ('$name', '$email', '$contact', '$age', '$gender', '$height', '$weight', '$password')";
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
