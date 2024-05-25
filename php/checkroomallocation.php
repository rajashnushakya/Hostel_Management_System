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

// Check if a room is allocated to the resident
$email = $_POST['email'];

$sql = "SELECT roomname FROM roomallocated WHERE residentname = (SELECT firstname FROM resident WHERE email = '$email')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = "Room not allocated to resident";
}

$conn->close();

echo json_encode($response);
?>
