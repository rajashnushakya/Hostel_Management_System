<?php

// Set your connection variables
$servername = "localhost";
$username = "username";
$password = "11shakyaraj";
$dbname = "hms";

// Create connection
$conn = new mysqli($servername,
    $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}else {
    echo "Connection successful!"; 
}
?>