<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $role = $_POST['role'];

    $query = "UPDATE staff SET first_name='$first_name', last_name='$last_name', email='$email', contact='$contact', role='$role' WHERE id=$id";
    if ($mysqli->query($query) === TRUE) {
        echo "Staff details updated successfully";
    } else {
        echo "Error updating staff details: " . $mysqli->error;
    }
}
?>
