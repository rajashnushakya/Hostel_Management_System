<?php
session_start(); 
header('Content-Type: application/json'); // Set JSON header

$response = array(); // Initialize response array

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['UserRole'];

    // Connect to your database (replace DB_USERNAME, DB_PASSWORD, DB_NAME with your actual credentials)
    $conn = new mysqli("localhost", "root", "", "hms");

    if ($conn->connect_error) {
        $response['error'] = "Connection failed: " . $conn->connect_error;
    } else {
        // Escape inputs to prevent SQL injection
        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);

        // Hash the password (optional but recommended for security)
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Query based on the selected role
        switch ($role) {
            case 'admin':
                // Note: Hash the password in your database and compare hashed passwords for security
                if ($email == 'rajashnushakya@gmail.com' && $password == '11shakyaraj') {
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['role'] = $role;
                    $response['redirect'] = "../admin/adminDashboard.php";
                    $response['user'] = array(
                        'email' => $email,
                        'role' => $role
                        // Add other user details as needed
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
                    $response['redirect'] = "adminDashboard.php";
                    $row = $result->fetch_assoc();
                    $response['user'] = array(
                        'email' => $row['email'],
                        'role' => $role,
                        // Add other user details as needed
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
                    $response['redirect'] = "roombooking.php";
                    $row = $result->fetch_assoc();
                    $response['user'] = array(
                        'email' => $row['email'],
                        'role' => $role,
                        // Add other user details as needed
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

echo json_encode($response); // Output JSON response
?>