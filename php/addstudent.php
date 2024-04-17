<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Include your database connection file
  include 'connection.php';

  // Get form data and sanitize inputs
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);
  $temporaryAddress = mysqli_real_escape_string($conn, $_POST['temporary_address']);
  $permanentAddress = mysqli_real_escape_string($conn, $_POST['permanent_address']);

  // SQL query to insert data into the table
  $sql = "INSERT INTO students (name, contact_number, Temporary_Address, Permanent_Address) VALUES ('$name', '$contact', '$temporaryAddress', '$permanentAddress')";

  // Execute the SQL query
  if (mysqli_query($conn, $sql)) {
      echo "New Student inserted successfully";
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  // Close the database connection
  mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Add Student</h1>
    <div class="error-message">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate form inputs and display error messages
            $errors = array();

            // Name validation
            if (empty($_POST['name'])) {
                $errors[] = "Name is required.";
            }

            // Contact number validation
            $contactRegex = '/^[0-9]{10}$/';
            if (!preg_match($contactRegex, $_POST['contact'])) {
                $errors[] = "Contact number must be in the format +977XXXXXXXXX.";
            }

            // Display errors if any
            if (!empty($errors)) {
                echo "<div class='alert alert-danger'>";
                echo "<ul>";
                foreach ($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo "</ul>";
                echo "</div>";
            }
        }
        ?>
    </div>
    <form  method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name of Student</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
        </div>
        <div class="mb-3">
            <label for="contact" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter contact number">
        </div>
        <div class="mb-3">
            <label for="temporaryAddress" class="form-label">Temporary Address</label>
            <input type="text" class="form-control" id="temporaryAddress" name="temporary_address" placeholder="Enter temporary address">
        </div>
        <div class="mb-3">
            <label for="permanentAddress" class="form-label">Permanent Address</label>
            <input type="text" class="form-control" id="permanentAddress" name="permanent_address" placeholder="Enter permanent address">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary">Back</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
