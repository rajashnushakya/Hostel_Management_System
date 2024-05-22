<?php
// fetch_room_details.php
header('Content-Type: application/json');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jsonData = file_get_contents("php://input");
    if ($jsonData === false) {
        $response['error'] = "Error reading input data";
        echo json_encode($response);
        exit();
    }

    $data = json_decode($jsonData, true);
    if ($data === null || !isset($data['residentId'])) {
        $response['error'] = "Invalid JSON data or missing residentId";
        echo json_encode($response);
        exit();
    }

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hms";

    $conn = new mysqli($hostname, $username, $password, $dbname);
    if ($conn->connect_error) {
        $response['error'] = "Connection failed: " . $conn->connect_error;
        echo json_encode($response);
        exit();
    }

    $residentId = $conn->real_escape_string($data['residentId']);

    // Get the resident name from resident table using residentId
    $sql = "SELECT firstname FROM resident WHERE id = '$residentId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $residentName = $row['firstname'];

        // Debugging: Log the resident name
        error_log("Resident Name: " . $residentName);

        // Get the room name from roomallocated table using resident name
        $sql = "SELECT roomname FROM roomallocated WHERE residentname = '$residentName'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $roomName = $row['roomname'];

            // Debugging: Log the room name
            error_log("Room Name: " . $roomName);

            // Fetch the room details from rooms table using room name
            $sql = "SELECT id, seater FROM rooms WHERE room_name = '$roomName'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $response['success'] = true;
                $response['residentName'] = $residentName;
                $response['roomName'] = $roomName;
                $response['roomId'] = $row['id'];
                $response['roomSeater'] = $row['seater'];
            } else {
                $response['error'] = "Room details not found";
                error_log("Room details not found for room: " . $roomName);
            }
        } else {
            $response['error'] = "Room allocation not found";
            error_log("Room allocation not found for resident: " . $residentName);
        }
    } else {
        $response['error'] = "Resident not found";
        error_log("Resident not found for ID: " . $residentId);
    }

    $conn->close();
} else {
    http_response_code(405);
    $response['error'] = 'Only POST requests are allowed';
}

echo json_encode($response);
?>
