<?php
// Include your database connection file here
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the JSON request body
    $data = json_decode(file_get_contents("php://input"));

    // Sanitize and escape the input data to prevent SQL injection
    $residentName = mysqli_real_escape_string($mysqli, $data->residentName);
    $roomName = mysqli_real_escape_string($mysqli, $data->roomName);

    // Check if resident name exists in the 'resident' table
    $residentCheckQuery = "SELECT id FROM resident WHERE firstname = '$residentName'";
    $residentCheckResult = $mysqli->query($residentCheckQuery);

    // Check if room name exists in the 'rooms' table
    $roomCheckQuery = "SELECT id FROM rooms WHERE room_name = '$roomName'";
    $roomCheckResult = $mysqli->query($roomCheckQuery);

    if ($residentCheckResult->num_rows > 0 && $roomCheckResult->num_rows > 0) {
        // Both resident name and room name exist
        echo json_encode(['exists' => true]);
    } else {
        // Names do not exist
        echo json_encode(['exists' => false]);
    }
}

// Close the database connection
$mysqli->close();
?>
