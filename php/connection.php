<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "11shakyaraj";
$dbname = "hms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the students table already exists
$tableExistsQuery = "SHOW TABLES LIKE 'students'";
$tableExistsResult = $conn->query($tableExistsQuery);

if ($tableExistsResult->num_rows == 0) {
    // Table doesn't exist, so create it
    $createTableSql = "CREATE TABLE students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        contact_number VARCHAR(20) NOT NULL,
        Temporary_Address VARCHAR(255),
        Permanent_Address VARCHAR(255)
    )";

    // Execute the SQL query to create the table
    if ($conn->query($createTableSql) === TRUE) {
        echo "Table 'students' created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
} else {
    echo "Table 'students' already exists";
}

// Close the table creation query result
$tableExistsResult->close();
?>
