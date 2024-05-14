<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $room_name = $_POST['room_name'];
    $category = $_POST['category'];
    $seater = $_POST['seater'];
    $fee = $_POST['fee'];

    $query = "UPDATE rooms SET room_name='$room_name', category='$category', seater='$seater', fee='$fee' WHERE id=$id";
    if ($mysqli->query($query) === TRUE) {
        echo "Room details updated successfully";
    } else {
        echo "Error updating room details: " . $mysqli->error;
    }
}
?>
