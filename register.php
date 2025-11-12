<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $height = $_POST['height'];
  $weight = $_POST['weight'];
  $password = $_POST['password'];

  $sql = "INSERT INTO trainees (name, email, contact_number, age, gender, height, weight, password)
          VALUES ('$name', '$email', '$contact', '$age', '$gender', '$height', '$weight', '$password')";

  if (mysqli_query($conn, $sql)) {
    echo "Registration successful! <a href='login.html'>Login here</a>";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>
