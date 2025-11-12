<?php
include 'db.php';
session_start();

$email = $_SESSION['email'];
$sql = "SELECT trainee_id FROM trainees WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
$trainee_id = $user['trainee_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $method = $_POST['method'];
  $amount = $_POST['amount'];

  $sql = "INSERT INTO payment (trainee_id, method, amount)
          VALUES ('$trainee_id', '$method', '$amount')";

  if (mysqli_query($conn, $sql)) {
    echo "Payment recorded successfully! <a href='dashboard.php'>Go Back</a>";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>
