<?php
session_start();
include '../db.php';

if (!isset($_SESSION['trainer_id'])) {
  header("Location: login.html");
  exit();
}

$trainer_id = $_SESSION['trainer_id'];
$trainer_name = $_SESSION['trainer_name'];

// Get all trainees
$trainees_query = "SELECT * FROM trainees ORDER BY trainee_id DESC";
$trainees_result = mysqli_query($conn, $trainees_query);

// Count total trainees
$total_trainees = mysqli_num_rows($trainees_result);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Trainer Dashboard</title>
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
    .btn-info {
      background: #4488ff;
      color: #fff;
    }
    .btn-danger {
      background: #ff4444;
      color: #fff;
    }
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.8);
    }
    .modal-content {
      background-color: #222;
      margin: 5% auto;
      padding: 20px;
      border: 2px solid #00ff88;
      width: 80%;
      max-width: 600px;
      border-radius: 10px;
    }
    .close {
      color: #00ff88;
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <h1>Trainer Dashboard</h1>
    <p>Welcome, <strong><?php echo $trainer_name; ?></strong>!</p>
    
    <div class="stats">
      <div class="stat-card">
        <h3>Total Trainees</h3>
        <p><?php echo $total_trainees; ?></p>
      </div>
    </div>

    <!-- Trainees Section -->
    <div class="section">
      <h2>My Trainees</h2>
      <table>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Contact</th>
          <th>Age</th>
          <th>Gender</th>
          <th>BMI</th>
          <th>Actions</th>
        </tr>
        <?php 
        mysqli_data_seek($trainees_result, 0);
        while($trainee = mysqli_fetch_assoc($trainees_result)): 
          $bmi = 0;
          if ($trainee['height'] > 0) {
            $height_m = $trainee['height'] / 100;
            $bmi = round($trainee['weight'] / ($height_m * $height_m), 2);
          }
        ?>
        <tr>
          <td><?php echo $trainee['trainee_id']; ?></td>
          <td><?php echo $trainee['name']; ?></td>
          <td><?php echo $trainee['email']; ?></td>
          <td><?php echo $trainee['contact_number']; ?></td>
          <td><?php echo $trainee['age']; ?></td>
          <td><?php echo $trainee['gender']; ?></td>
          <td><?php echo $bmi; ?></td>
          <td>
            <button class="btn btn-info" onclick="viewDetails(<?php echo htmlspecialchars(json_encode($trainee)); ?>, <?php echo $bmi; ?>)">View Details</button>
            <a href="update_plan.php?id=<?php echo $trainee['trainee_id']; ?>" class="btn">Update Plan</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>

    <br>
    <a href="logout.php" class="btn btn-danger">Logout</a>
  </div>

  <!-- Modal for trainee details -->
  <div id="detailsModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h2 id="modalName"></h2>
      <div id="modalDetails"></div>
    </div>
  </div>

  <script>
    function viewDetails(trainee, bmi) {
      document.getElementById('modalName').textContent = trainee.name + "'s Details";
      document.getElementById('modalDetails').innerHTML = `
        <p><strong>Email:</strong> ${trainee.email}</p>
        <p><strong>Contact:</strong> ${trainee.contact_number}</p>
        <p><strong>Age:</strong> ${trainee.age}</p>
        <p><strong>Gender:</strong> ${trainee.gender}</p>
        <p><strong>Height:</strong> ${trainee.height} cm</p>
        <p><strong>Weight:</strong> ${trainee.weight} kg</p>
        <p><strong>BMI:</strong> ${bmi}</p>
        <p><strong>Training Plan:</strong></p>
        <p>${trainee.training_plan || 'No training plan assigned yet.'}</p>
      `;
      document.getElementById('detailsModal').style.display = 'block';
    }

    function closeModal() {
      document.getElementById('detailsModal').style.display = 'none';
    }

    window.onclick = function(event) {
      var modal = document.getElementById('detailsModal');
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    }
  </script>
</body>
</html>
