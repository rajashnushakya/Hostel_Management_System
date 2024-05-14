<?php
// Include connection
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "hms";

// Connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// If connection failed
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data sent from JavaScript
$data = json_decode(file_get_contents("php://input"));

$roomId = $data->roomId;
$residentId = $data->residentId;

// Insert data into the table
$sql = "INSERT INTO room_booking (roomid, residentid) VALUES ('$roomId', '$residentId')";

if ($conn->query($sql) === TRUE) {
    $response = array("success" => true);
    echo json_encode($response);
} else {
    $response = array("success" => false, "error" => "Error inserting data: " . $conn->error);
    echo json_encode($response);
}

$conn->close();
?>
