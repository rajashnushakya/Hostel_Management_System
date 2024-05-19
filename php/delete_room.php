<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $query = "DELETE FROM rooms WHERE id=$id";
    if ($mysqli->query($query) === TRUE) {
        echo "Room details deleted successfully";
    } else {
        echo "Error deleting room details: " . $mysqli->error;
    }
}
?>
