<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $query = "DELETE FROM resident WHERE id=$id";
    if ($mysqli->query($query) === TRUE) {
        echo "Resident details deleted successfully";
    } else {
        echo "Error deleting resident details: " . $mysqli->error;
    }
}
?>
