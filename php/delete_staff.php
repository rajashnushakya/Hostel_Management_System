<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $query = "DELETE FROM staff WHERE id=$id"; // Delete staff details from the staff table
    if ($mysqli->query($query) === TRUE) {
        echo "Staff member deleted successfully";
    } else {
        echo "Error deleting staff member: " . $mysqli->error;
    }
}
?>
