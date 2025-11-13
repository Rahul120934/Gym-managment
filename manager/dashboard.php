<?php
// start session
session_start();

// connect to server and database
$conn = mysqli_connect("localhost", "root", "", "gym_management");

// check session
if (!isset($_SESSION['manager_id'])) {
  header("Location: login.html");
  exit();
}

// check connection
if(!$conn) {
  echo "connection failed";
  exit();
}

// get manager name
$manager_name = $_SESSION['manager_name'];

// get counts
$q_trainer_count = "SELECT COUNT(*) as count FROM trainer";
$r_trainer_count = mysqli_query($conn, $q_trainer_count);
$trainers_count_row = mysqli_fetch_assoc($r_trainer_count);
$trainers_count = $trainers_count_row ? $trainers_count_row['count'] : 0;

$q_trainee_count = "SELECT COUNT(*) as count FROM trainees";
$r_trainee_count = mysqli_query($conn, $q_trainee_count);
$trainees_count_row = mysqli_fetch_assoc($r_trainee_count);
$trainees_count = $trainees_count_row ? $trainees_count_row['count'] : 0;

$q_pay_total = "SELECT SUM(amount) as total FROM payment";
$r_pay_total = mysqli_query($conn, $q_pay_total);
$payments_total_row = mysqli_fetch_assoc($r_pay_total);
$payments_total = $payments_total_row && $payments_total_row['total'] ? $payments_total_row['total'] : 0;

// get all trainers
$trainers_query = "SELECT * FROM trainer";
$trainers_result = mysqli_query($conn, $trainers_query);

// get all trainees
$trainees_query = "SELECT * FROM trainees";
$trainees_result = mysqli_query($conn, $trainees_query);

// get recent payments with trainee names
$payments_query = "SELECT p.*, t.name FROM payment p JOIN trainees t ON p.trainee_id = t.trainee_id ORDER BY p.payment_id DESC LIMIT 10";
$payments_result = mysqli_query($conn, $payments_query);

// close connection (results will still be available)
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manager Dashboard</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    .dashboard-container {
      max-width: 1200px;
      margin: 20px auto;
      padding: 20px;
    }
    .stats {
      display: flex;
      gap: 20px;
      margin-bottom: 30px;
      flex-wrap: wrap;
    }
    .stat-card {
      flex: 1;
      min-width: 200px;
      background: #222;
      padding: 20px;
      border-radius: 10px;
      border: 2px solid #00ff88;
    }
    .stat-card h3 { color: #00ff88; margin: 0; }
    .stat-card p { font-size: 32px; margin: 10px 0 0 0; }
    .section {
      background: #222;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #444;
    }
    th {
      background: #00ff88;
      color: #111;
    }
    .btn {
      padding: 8px 15px;
      background: #00ff88;
      color: #111;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
    }
    .btn-danger {
      background: #ff4444;
      color: #fff;
    }
    .add-form {
      display: none;
      margin-top: 15px;
      padding: 15px;
      background: #333;
      border-radius: 5px;
    }
    .add-form input {
      margin: 5px 0;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <h1>Manager Dashboard</h1>
    <p>Welcome, <strong><?php echo $manager_name; ?></strong>!</p>
    
    <div class="stats">
      <div class="stat-card">
        <h3>Total Trainers</h3>
        <p><?php echo $trainers_count; ?></p>
      </div>
      <div class="stat-card">
        <h3>Total Trainees</h3>
        <p><?php echo $trainees_count; ?></p>
      </div>
      <div class="stat-card">
        <h3>Total Revenue</h3>
        <p>Rs. <?php echo number_format($payments_total, 2); ?></p>
      </div>
    </div>

    <!-- Trainers Section -->
    <div class="section">
      <h2>Manage Trainers</h2>
      <button class="btn" onclick="toggleForm('addTrainerForm')">+ Add New Trainer</button>
      
      <div id="addTrainerForm" class="add-form">
        <h3>Add New Trainer</h3>
        <form action="add_trainer.php" method="POST">
          <input type="text" name="name" placeholder="Full Name" required><br>
          <input type="email" name="email" placeholder="Email" required><br>
          <input type="text" name="contact" placeholder="Contact Number" required><br>
          <input type="password" name="password" placeholder="Password" required><br>
          <button type="submit" class="btn">Add Trainer</button>
        </form>
      </div>

      <table>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Contact</th>
          <th>Actions</th>
        </tr>
        <?php while($trainer = mysqli_fetch_assoc($trainers_result)): ?>
        <tr>
          <td><?php echo $trainer['trainer_id']; ?></td>
          <td><?php echo $trainer['name']; ?></td>
          <td><?php echo $trainer['email_id']; ?></td>
          <td><?php echo $trainer['contact_number']; ?></td>
          <td>
            <a href="delete_trainer.php?id=<?php echo $trainer['trainer_id']; ?>" 
               class="btn btn-danger" 
               onclick="return confirm('Are you sure you want to delete this trainer?')">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>

    <!-- Trainees Section -->
    <div class="section">
      <h2>All Trainees</h2>
      <table>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Contact</th>
          <th>Age</th>
          <th>Gender</th>
          <th>Actions</th>
        </tr>
        <?php while($trainee = mysqli_fetch_assoc($trainees_result)): ?>
        <tr>
          <td><?php echo $trainee['trainee_id']; ?></td>
          <td><?php echo $trainee['name']; ?></td>
          <td><?php echo $trainee['email']; ?></td>
          <td><?php echo $trainee['contact_number']; ?></td>
          <td><?php echo $trainee['age']; ?></td>
          <td><?php echo $trainee['gender']; ?></td>
          <td>
            <a href="delete_trainee.php?id=<?php echo $trainee['trainee_id']; ?>" 
               class="btn btn-danger" 
               onclick="return confirm('Are you sure you want to delete this trainee?')">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>

    <!-- Payments Section -->
    <div class="section">
      <h2>Recent Payments</h2>
      <table>
        <tr>
          <th>Payment ID</th>
          <th>Trainee Name</th>
          <th>Method</th>
          <th>Amount</th>
        </tr>
        <?php while($payment = mysqli_fetch_assoc($payments_result)): ?>
        <tr>
          <td><?php echo $payment['payment_id']; ?></td>
          <td><?php echo $payment['name']; ?></td>
          <td><?php echo $payment['method']; ?></td>
          <td>Rs. <?php echo number_format($payment['amount'], 2); ?></td>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>

    <br>
    <a href="logout.php" class="btn btn-danger">Logout</a>
  </div>

  <script>
    function toggleForm(formId) {
      var form = document.getElementById(formId);
      if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
      } else {
        form.style.display = "none";
      }
    }
  </script>
</body>
</html>
