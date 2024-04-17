<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
    echo("Cannot connect to db");
} else {
    echo "Connected successfully";
}

// If form is submitted for sign-up
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'], $_POST['mail'], $_POST['contact'], $_POST['pass'], $_POST['user-type'])) {
    // Retrieve form data for sign-up
    $name = $_POST['name'];
    $email = $_POST['mail'];
    $contact = $_POST['contact'];
    $userPassword = $_POST['pass']; // Changed variable name to avoid conflict
    $userType = $_POST['user-type'];

    // Check if the email already exists in the database
    $check_query = "SELECT * FROM users WHERE Email=?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $signup_message = "Email already exists. Please use a different email.";
    } else {
        // Prepare and bind statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO users (Name, Email, ContactNumber, Password, UserType) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $name, $email, $contact, $userPassword, $userType);

        if ($stmt->execute()) {
            $signup_message = "New record created successfully";
        } else {
            $signup_message = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// If form is submitted for login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mail'], $_POST['pass'], $_POST['contact'], $_POST['user-type'])) {
    // Retrieve form data for login
    $email = $_POST['mail'];
    $password = $_POST['pass'];
    $contact = $_POST['contact'];
    $userType = $_POST['user-type'];

    // Prepare and bind statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE Email=? AND Password=? AND ContactNumber=? AND UserType=?");
    $stmt->bind_param("ssss", $email, $password, $contact, $userType);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $login_message = "Login successful";
    } else {
        $login_message = "Login failed";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/login.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" />
  <title>Hostel Management System</title>
</head>
<body>
  <div class="container" id="container">
    <!-- Sign-up Form -->
    <div class="form-container sign-up-container">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1 id="vit">Hostel Management System</h1>
        <!-- Input fields for sign-up -->
        <input type="text" placeholder="Name" id="name" name="name" />
        <input type="email" placeholder="Email" id="mail" name="mail" />
        <input type="text" placeholder="Contact Number" id="contact" name="contact" /> <!-- Added contact number input and name attribute -->
        <input type="password" placeholder="Password" id="pass" name="pass" />
        <select id="user-type" name="user-type"> <!-- Added name attribute to select element -->
          <option value="admin">Admin</option>
          <option value="resident">Resident</option>
        </select>
        <button type="submit">Sign Up</button> <!-- Added type attribute to button -->
      </form>
      <!-- Display sign-up success/error message -->
      <!-- Display login success/error message -->
<?php if (isset($login_message)): ?>
    <p><?php echo $login_message; ?></p>
<?php endif; ?>

      <br /><br /><br /><br />
    </div>

    <!-- Login Form -->
    <div class="form-container sign-in-container">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Sign In</h1>
        <!-- Input fields for login -->
        <input type="email" placeholder="Email" id="mail" name="mail" />
        <input type="password" placeholder="Password" id="pass" name="pass" />
        <input type="text" placeholder="Contact Number" id="contact" name="contact" /> 
        <select id="user-type" name="user-type">
          <option value="admin">Admin</option>
          <option value="resident">Resident</option>
        </select>
        <button type="submit">Log In</button> 
      </form>
      <!-- Display login success/error message -->
      <?php if (isset($login_message)): ?>
        <p><?php echo $login_message; ?></p>
      <?php endif; ?>
      <br /><br /><br /><br /><br /><br />
    </div>

    <!-- Overlay for Sign-up/Login -->
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Welcome</h1>
          <p>Affordable stays, unforgettable experiences; Stay smart, stay at our hostel</p>
          <br />
          <p style="color: rgb(255, 255, 255)">Already have an account?</p>
          <button class="press" id="signIn">Sign In</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>Hostel Management System</h1>
          <p>Passion for excellence. Compassion for people.</p>
          <br />
          <p style="color: rgb(240, 241, 244)">Don't have an account?</p>
          <button class="press" id="signUp" style="color: rgb(57, 49, 5)">Sign Up</button>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/script.js"></script>
</body>
</html>