<?php
include('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM staff WHERE id = $id"; // Fetch staff details from the staff table
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "No staff member found with the given ID"]);
    }
}
?>
