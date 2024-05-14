<?php
session_start();
header('Content-Type: application/json');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['UserRole'];

    $conn = new mysqli("localhost", "root", "", "hms");

    if ($conn->connect_error) {
        $response['error'] = "Connection failed: " . $conn->connect_error;
    } else {
        // Escape inputs to prevent SQL injection
        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);

        // Query based on the selected role
        switch ($role) {
            case 'admin':
                if ($email == 'rajashnushakya@gmail.com' && $password == '11shakyaraj') {
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['role'] = $role;
                    $response['redirect'] = "../php/admindashboard.php";
                    $response['user'] = array(
                        'email' => $email,
                        'role' => $role
                    );
                } else {
                    $response['error'] = "Invalid Credentials";
                }
                break;
            case 'Staff':
                $query = "SELECT * FROM staff WHERE email='$email' AND cpassword='$password'";
                $result = $conn->query($query);

                if ($result && $result->num_rows == 1) {
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['role'] = $role;
                    $response['redirect'] = "../php/staffDashboard.php";
                    $row = $result->fetch_assoc();
                    $response['user'] = array(
                        'email' => $row['email'],
                        'role' => $role,
                    );
                } else {
                    $response['error'] = "Invalid Credentials";
                }
                break;
            case 'user':
                $query = "SELECT * FROM resident WHERE email='$email' AND password='$password'";
                $result = $conn->query($query);

                if ($result && $result->num_rows == 1) {
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['role'] = $role;
                    $response['redirect'] = "../php/roombooking.php";
                    $row = $result->fetch_assoc();
                    $response['user'] = array(
                        'email' => $row['email'],
                        'role' => $role,
                    );
                } else {
                    $response['error'] = "Invalid Credentials";
                }
                break;
            default:
                $response['error'] = "Invalid role";
                break;
        }

        $conn->close();
    }
} else {
    $response['error'] = "Invalid request method";
}

echo json_encode($response);
?>
