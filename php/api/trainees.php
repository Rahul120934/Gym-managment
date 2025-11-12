<?php
include 'config.php';

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $sql = "SELECT * FROM Trainees";
        $result = $conn->query($sql);
        $trainees = [];
        while ($row = $result->fetch_assoc()) {
            $trainees[] = $row;
        }
        echo json_encode($trainees);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $sql = "INSERT INTO Trainees (Name, Email, Password, Gender, Training_Plan, Contact_number, Age, Height, Weight, Trainer_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssiddi", $data['Name'], $data['Email'], $data['Password'], $data['Gender'], $data['Training_Plan'], $data['Contact_number'], $data['Age'], $data['Height'], $data['Weight'], $data['Trainer_id']);
        if ($stmt->execute()) {
            echo json_encode(["message" => "Trainee added successfully"]);
        } else {
            echo json_encode(["error" => "Error: " . $conn->error]);
        }
        $stmt->close();
        break;
}

$conn->close();
?>
