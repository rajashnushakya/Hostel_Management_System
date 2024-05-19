<?php
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
    if ($data === null) {
        $response['error'] = "Error decoding JSON data";
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

    $email = $conn->real_escape_string($data['email']);

    $sql = "SELECT id FROM resident WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response['success'] = true;
        $response['residentId'] = $row['id'];
    } else {
        $response['error'] = "Resident not found";
    }

    $conn->close();
} else {
    http_response_code(405);
    $response['error'] = 'Only POST requests are allowed';
}

echo json_encode($response);
?>
