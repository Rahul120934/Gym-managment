<?php
session_start();
include 'db.php';
if (!isset($_SESSION['email'])) {
  header("Location: login.html");
  exit();
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM trainees WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

$bmi = 0;
if ($user['height'] > 0) {
  $height_m = $user['height'] / 100;
  $bmi = round($user['weight'] / ($height_m * $height_m), 2);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Welcome, <?php echo $user['name']; ?>!</h2>
  <p>Email: <?php echo $user['email']; ?></p>
  <p>Age: <?php echo $user['age']; ?></p>
  <p>Gender: <?php echo $user['gender']; ?></p>
  <p>Height: <?php echo $user['height']; ?> cm</p>
  <p>Weight: <?php echo $user['weight']; ?> kg</p>
  <p><b>Your BMI:</b> <?php echo $bmi; ?></p>

  <form action="payment.php" method="POST">
    <h3>Make a Payment</h3>
    <input type="text" name="method" placeholder="Payment Method" required><br>
    <input type="number" name="amount" placeholder="Amount" required><br>
    <button type="submit">Submit Payment</button>
  </form>

  <br><a href="logout.php">Logout</a>
</body>
</html>
