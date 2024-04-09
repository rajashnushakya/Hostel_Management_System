<?php
$servername = "localhost";
$username = "root";
$passowrd="";
$dbname = "hms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}


// Retrieve form data
$email = $_POST['mail'];
$password = $_POST['pass'];
$contact = $_POST['contact'];
$userType = $_POST['user-type'];

$sql = "SELECT * FROM Users WHERE Email='$email' AND Password='$password' AND ContactNumber='$contact' AND UserType='$userType'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, do something (e.g., set session, redirect, etc.)
    echo "Login successful";
} else {
    // User not found, handle accordingly
    echo "Login failed";
}

// Close the database connection
$conn->close();
?>