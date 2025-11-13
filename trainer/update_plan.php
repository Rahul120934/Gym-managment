<?php
// start session
session_start();

// connect to server and database
$conn = mysqli_connect("localhost", "root", "", "gym_management");

// check session
if (!isset($_SESSION['trainer_id'])) {
  header("Location: login.html");
  exit();
}

// check connection
if(!$conn) {
  echo "connection failed";
  exit();
}

// get trainee id from query string
$trainee_id = isset($_GET['id']) ? $_GET['id'] : null;

// if id not provided, go back to dashboard
if(!$trainee_id) {
  header("Location: dashboard.php");
  exit();
}

// get trainee details
$query = "SELECT * FROM trainees WHERE trainee_id = $trainee_id";
$result = mysqli_query($conn, $query);
$trainee = mysqli_fetch_assoc($result);

// handle form submit
if($_SERVER["REQUEST_METHOD"] == "POST") {
  // fetch form data
  $training_plan = $_POST['training_plan'];

  // execute update query
  $sql = "UPDATE trainees SET training_plan = '$training_plan' WHERE trainee_id = $trainee_id";
  $r = mysqli_query($conn, $sql);

  // optional: log update
  $fp = fopen("../log.txt","a");
  fwrite($fp, "plan_updated_for_trainee_id: " . $trainee_id . "\n");
  fclose($fp);

  // display output / redirect
  if($r) {
    header("Location: dashboard.php?success=plan_updated");
    exit();
  } else {
    $error = "Error: update failed";
  }
}

// close connection (HTML uses $trainee)
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Training Plan</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    .container {
      max-width: 600px;
      margin: 50px auto;
      padding: 30px;
      background: #222;
      border-radius: 10px;
    }
    textarea {
      width: 100%;
      min-height: 200px;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #00ff88;
      background: #333;
      color: #fff;
      font-family: Arial, sans-serif;
    }
    .btn {
      padding: 10px 20px;
      background: #00ff88;
      color: #111;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Update Training Plan for <?php echo $trainee['name']; ?></h2>
    
    <?php if (isset($error)): ?>
      <p style="color: #ff4444;">&nbsp;<?php echo $error; ?></p>
    <?php endif; ?>
    
    <form method="POST">
      <label>Training Plan:</label><br>
      <textarea name="training_plan" placeholder="Enter training plan details..."><?php echo $trainee['training_plan']; ?></textarea><br>
      <button type="submit" class="btn">Update Plan</button>
      <a href="dashboard.php"><button type="button" class="btn" style="background: #666;">Cancel</button></a>
    </form>
  </div>
</body>
</html>
