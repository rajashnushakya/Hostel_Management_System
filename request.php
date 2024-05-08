<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "hms";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $requestType = $_POST["request_type"];
    $requestDescription = $_POST["request_description"];
    
    // Insert data into database
    $sql = "INSERT INTO maintenance_requests (request_type, request_description) VALUES ('$requestType', '$requestDescription')";
    
    if ($conn->query($sql) === TRUE) {
      echo "<script>alert('Record inserted successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hostel Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="container">
    <h1 class="mt-4 mb-5">Request done by Resident</h1>
    <h2 class="mt-4 mb-5">MAINTANANCE</h2>
    <ul class="list-group">
        <li class="list-group-item">
          <input class="form-check-input me-1" type="checkbox" value="AC not Working" id="acCheckbox_maintenance" name="request_type">
          <label class="form-check-label" for="acCheckbox_maintenance">AC not Working</label>
        </li>
        <li class="list-group-item">
          <input class="form-check-input me-1" type="checkbox" value="Bulb not working" id="bulbCheckbox_maintenance" name="request_type">
          <label class="form-check-label" for="bulbCheckbox_maintenance">Bulb not working</label>
        </li>
        <li class="list-group-item">
          <input class="form-check-input me-1" type="checkbox" value="Post issue" id="postCheckbox_maintenance" name="request_type">
          <label class="form-check-label" for="postCheckbox_maintenance">Post issue</label>
        </li>
        <li class="list-group-item">
          <input class="form-check-input me-1" type="checkbox" value="Windows glass broken" id="windowCheckbox_maintenance" name="request_type">
          <label class="form-check-label" for="windowCheckbox_maintenance">Windows glass broken</label>
        </li>
      </ul>
      
      <h2 class="mt-4 mb-5">Room</h2>
      <ul class="list-group">
          <li class="list-group-item">
            <input class="form-check-input me-1" type="checkbox" value="Room mate issue" id="acCheckbox_room" name="request_type">
            <label class="form-check-label" for="acCheckbox_room">Room mate issue</label>
          </li>
          <li class="list-group-item">
            <input class="form-check-input me-1" type="checkbox" value="Cold Room" id="bulbCheckbox_room" name="request_type">
            <label class="form-check-label" for="bulbCheckbox_room">Cold Room</label>
          </li>
          <li class="list-group-item">
            <input class="form-check-input me-1" type="checkbox" value="Room cleaning" id="postCheckbox_room" name="request_type">
            <label class="form-check-label" for="postCheckbox_room">Room cleaning</label>
          </li>
        </ul>

        <h2 class="mt-4 mb-5">Extra</h2>
        <ul class="list-group">
            <li class="list-group-item">
              <input class="form-check-input me-1" type="checkbox" value="Laundry" id="acCheckbox_extra" name="request_type">
              <label class="form-check-label" for="acCheckbox_extra">Laundry</label>
            </li>
            <li class="list-group-item">
              <input class="form-check-input me-1" type="checkbox" value="Bed Change" id="bulbCheckbox_extra" name="request_type">
              <label class="form-check-label" for="bulbCheckbox_extra">Bed Change</label>
            </li>
        
          </ul>

          <div class="mb-3">
            <label for="requestDescription" class="form-label">Request Description</label>
            <textarea class="form-control" id="requestDescription" name="request_description" rows="3"></textarea>
        </div>

      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
          <button type="submit" class="btn btn-primary btn-sm me-2">Submit</button>
          <button type="button" class="btn btn-secondary btn-sm">Back</button>
        </div>
      </div>

  </div>
</form>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
