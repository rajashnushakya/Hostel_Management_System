<?php
include('connection.php'); 

if(isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];
    $gender = $_POST['gender'];
    $guardian_name = $_POST['guardian_name'];
    $guardian_email = $_POST['guardian_email'];
    $guardian_mobile = $_POST['guardian_mobile'];
    $password = $_POST['password'];

    // SQL query to insert data into database using prepared statement
    $query = "INSERT INTO resident (firstname, middlename, lastname, city, state, zip, email, mobile_number, gender, guardian_name, guardian_email, guardian_mobile, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);

    // Bind parameters
    $stmt->bind_param('sssssssssssss', $firstname, $middlename, $lastname, $city, $state, $zip, $email, $mobile_number, $gender, $guardian_name, $guardian_email, $guardian_mobile, $password);

    // Execute the statement
    $stmt->execute();
    
    if($stmt->error) {
        echo "Error: " . $stmt->error;
    } else {
        echo "<script>alert('Record inserted successfully');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hostel Stays</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .close-container {
      position: absolute;
      top: 10px;
      right: 10px;
      z-index: 9999; 
    }

    .close-button {
      background: none;
      border: none;
      padding: 0;
      cursor: pointer;
    }

    .close {
      width: 30px; 
      height: 30px; 
    }

    .cross-button {
      position: absolute;
      top: 10px;
      right: 10px;
      cursor: pointer;
      text-decoration: none;
      color: rgb(17, 15, 15);
    }
  </style>
</head>
<body>
  <div class="close-container">
      <a href="../html/index.html" class="cross-button">&#10006;</a>
  </div>
  <div class="container">
    <h1 class="mt-4 mb-5">Resident Signup</h1>

    <form class="row g-3" action="" method="POST" onsubmit="return valid()" name="registration">
        <div class="col-md-4">
          <label for="firstname" class="form-label">First name</label>
          <input type="text" class="form-control" id="firstname" name="firstname" required>
        </div>
        <div class="col-md-4">
          <label for="middlename" class="form-label">Middle name</label>
          <input type="text" class="form-control" id="middlename" name="middlename" required>
        </div>
        <div class="col-md-4">
          <label for="lastname" class="form-label">Last name</label>
          <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>
        <div class="col-md-6">
          <label for="city" class="form-label">City</label>
          <input type="text" class="form-control" id="city" name="city" required>
        </div>
        <div class="col-md-3">
          <label for="state" class="form-label">State</label>
          <select class="form-select" id="state" name="state" required>
            <option selected disabled value="">Choose...</option>
            <option>State1</option>
            <option>State2</option>
            <option>State3</option>
            <option>State4</option>
            <option>State5</option>
            <option>State6</option>
            <option>State7</option>
          </select>
        </div>
        
        <div class="col-md-3">
          <label for="zip" class="form-label">Zip</label>
          <input type="text" class="form-control" id="zip" name="zip" required>
        </div>

        <div class="row mb-3" style="margin-top: 20px;">
          <label for="mobile_number" class="col-sm-2 col-form-label">Mobile Number</label>
          <div class="col-sm-10">
            <input type="tel" class="form-control" id="mobile_number" name="mobile_number" required>
          </div>
        </div>
        
        <div class="input-group mb-4 d-flex align-items-center">
          <label for="gender" class="col-form-label me-3">Gender</label>
          <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="male" required>
              <label class="form-check-label me-2" for="maleRadio">Male</label>
          </div>
          <div class="form-check form-check-inline ms-3">
              <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="female" required>
              <label class="form-check-label me-2" for="femaleRadio">Female</label>
          </div>
      </div>
      
        <div class="row mb-3">
          <label for="guardian_name" class="col-sm-2 col-form-label">Guardian Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="guardian_name" name="guardian_name" required>
          </div>
        </div>
        
        <div class="row mb-3">
          <label for="guardian_email" class="col-sm-2 col-form-label">Guardian Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="guardian_email" name="guardian_email" required>
          </div>
        </div>

        <div class="row mb-3">
          <label for="guardian_mobile" class="col-sm-2 col-form-label">Guardian Mobile Number</label>
          <div class="col-sm-10">
            <input type="tel" class="form-control" id="guardian_mobile" name="guardian_mobile" required>
          </div>
        </div>

        <div class="row mb-3">
          <label for="email" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
        </div>
        
        <div class="row mb-3">
          <label for="password" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
        </div>

        <div class="row mb-3">
          <label for="cpassword" class="col-sm-2 col-form-label">Confirm Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="cpassword" name="cpassword" required>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-6 text-center">
            <button type="submit" class="btn btn-primary btn-sm me-2" name="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9Gkc"></script>
  </body>
  </html>
<script type="text/javascript">
    function valid() {
        var form = document.forms['registration'];
        var password = form['password'].value;
        var cpassword = form['cpassword'].value;
        var email = form['email'].value;
        var mobile_number = form['mobile_number'].value;
        var guardian_mobile = form['guardian_mobile'].value;

        // Check if password and confirm password match
        if (password !== cpassword) {
            alert("Password and Re-Type Password Field do not match!");
            form['cpassword'].focus();
            return false;
        }

        // Validate email format
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address.");
            form['email'].focus();
            return false;
        }

        // Validate mobile number format (exactly 10 digits)
        if (mobile_number.length < 10 || isNaN(mobile_number)) {
            alert("Contact number must be at least 10 digits.");
            form['mobile_number'].focus();
            return false;
        }

        // Validate guardian mobile number format (exactly 10 digits)
        if (guardian_mobile.length < 10 || isNaN(guardian_mobile)) {
            alert("Guardian contact number must be at least 10 digits.");
            form['guardian_mobile'].focus();
            return false;
        }

        return true;
    }
</script>
