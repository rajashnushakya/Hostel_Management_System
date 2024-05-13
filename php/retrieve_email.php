<?php

session_start();
include('connection.php');

// Check if email is stored in session
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Debugging output
    echo "Session Email: $email<br>";

    // Fetch resident name based on email from the resident table
    $stmt = $mysqli->prepare("SELECT firstname FROM resident WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($residentName);
    $stmt->fetch();
    $stmt->close();

    // Debugging output
    echo "Resident Name: $residentName";

    // Send JSON response with resident name
    echo json_encode(array(
        'status' => 'success',
        'residentName' => $residentName
    ));
} else {
    // Send JSON response for error
    echo json_encode(array(
        'status' => 'error',
        'message' => 'Email not found in session.'
    ));
}
?>