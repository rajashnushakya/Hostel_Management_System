<?php
include('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM rooms WHERE id = $id"; // Fetch room details from the rooms table
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "No room found with the given ID"]);
    }
}
?>
