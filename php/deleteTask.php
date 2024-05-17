<?php
// Include database connection or any necessary files
include('connection.php');

// Check if the task ID is received via POST
if (isset($_POST['taskId'])) {
    $taskId = $_POST['taskId'];

    // Prepare and execute the SQL query to delete the task
    $deleteQuery = "DELETE FROM request WHERE id = ?";
    $stmt = $mysqli->prepare($deleteQuery);
    
    // Bind the task ID parameter and execute the statement
    $stmt->bind_param('i', $taskId);
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        echo "Task deleted successfully.";
    } else {
        echo "Error deleting task.";
    }

    // Close the statement and database connection
    $stmt->close();
    $mysqli->close();
} else {
    // If task ID is not received, show an error message
    echo "Task ID not provided.";
}
?>
