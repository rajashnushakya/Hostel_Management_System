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
$name = $_POST['name'];
$email = $_POST['mail'];
$contact = $_POST['contact'];
$password = $_POST['pass'];
$userType = $_POST['user-type'];



$sql = "INSERT INTO Users (Name, Email, ContactNumber, Password, UserType) VALUES ('$name', '$email', '$contact', '$password', '$userType')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>