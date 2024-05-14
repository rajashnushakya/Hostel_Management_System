<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];
    $gender = $_POST['gender'];

    $query = "UPDATE resident SET firstname='$firstname', lastname='$lastname', city='$city', email='$email', mobile_number='$mobile_number', gender='$gender' WHERE id=$id";
    if ($mysqli->query($query) === TRUE) {
        echo "Resident details updated successfully";
    } else {
        echo "Error updating resident details: " . $mysqli->error;
    }
}
?>
