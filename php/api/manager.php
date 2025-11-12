<?php
include 'config.php';

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $sql = "SELECT * FROM Manager";
        $result = $conn->query($sql);
        $managers = [];
        while ($row = $result->fetch_assoc()) {
            $managers[] = $row;
        }
        echo json_encode($managers);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $sql = "INSERT INTO Manager (Name, Contact_Number, Email_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $data['Name'], $data['Contact_Number'], $data['Email_id']);
        if ($stmt->execute()) {
            echo json_encode(["message" => "Manager added successfully"]);
        } else {
            echo json_encode(["error" => "Error: " . $conn->error]);
        }
        $stmt->close();
        break;
}

$conn->close();
?>
