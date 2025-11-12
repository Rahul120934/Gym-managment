<?php
include 'config.php';

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $sql = "SELECT * FROM Trainer";
        $result = $conn->query($sql);
        $trainers = [];
        while ($row = $result->fetch_assoc()) {
            $trainers[] = $row;
        }
        echo json_encode($trainers);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $sql = "INSERT INTO Trainer (Name, Email_id, Password, Contact_Number, Manager_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $data['Name'], $data['Email_id'], $data['Password'], $data['Contact_Number'], $data['Manager_id']);
        if ($stmt->execute()) {
            echo json_encode(["message" => "Trainer added successfully"]);
        } else {
            echo json_encode(["error" => "Error: " . $conn->error]);
        }
        $stmt->close();
        break;
}

$conn->close();
?>
