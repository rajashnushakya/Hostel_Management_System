<?php
// Include your database connection file here
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from POST request
    $residentname = $_POST['residentname'];
    $roomname = $_POST['roomname'];

    // Check if resident name exists in the 'resident' table
    $residentCheckQuery = "SELECT id FROM resident WHERE firstname = '$residentname'";
    $residentCheckResult = $mysqli->query($residentCheckQuery);

    // Check if room name exists in the 'rooms' table
    $roomCheckQuery = "SELECT id FROM rooms WHERE room_name = '$roomname'";
    $roomCheckResult = $mysqli->query($roomCheckQuery);

    if ($residentCheckResult->num_rows > 0 && $roomCheckResult->num_rows > 0) {
        // Both resident name and room name exist, proceed with insertion
        $sql = "INSERT INTO roomallocated (roomname, residentname, allocated_date) VALUES ('$roomname', '$residentname', CURDATE())";
        
        // Execute the insertion query
        if ($mysqli->query($sql) === TRUE) {
            // Increment the 'residentno' column in 'rooms' table by 1 for the allocated room
            $updateQuery = "UPDATE rooms SET residentno = residentno + 1 WHERE room_name = '$roomname'";
            $mysqli->query($updateQuery);

            echo json_encode(['success' => 'Room successfully allocated']);
        } else {
            echo json_encode(['error' => 'Error allocating room']);
        }
    } else {
        // Check which name (resident or room) does not exist and provide a message to the user
        if ($residentCheckResult->num_rows == 0 && $roomCheckResult->num_rows == 0) {
            echo json_encode(['error' => 'Both resident name and room name do not exist. Please enter valid names.']);
        } elseif ($residentCheckResult->num_rows == 0) {
            echo json_encode(['error' => 'Resident name does not exist. Please enter a valid resident name.']);
        } else {
            echo json_encode(['error' => 'Room name does not exist. Please enter a valid room name.']);
        }
    }
}
?>
