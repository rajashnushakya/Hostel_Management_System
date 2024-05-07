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
  <title>Hostel Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <!-- Needed: Firstname, Middlename, Lastname, address, contact(phone number), gender, 
  guardian name and number Email and Password with a submit button -->
  <div class="container">
    <h1 class="mt-4 mb-5">Hostel Management System - Registration</h1>

    <form class="row g-3" method="post" action="">
        <div class="col-md-4">
          <label for="validationDefault01" class="form-label">First name</label>
          <input type="text" class="form-control" id="validationDefault01" name="firstname" required>
        </div>
        <div class="col-md-4">
          <label for="validationDefault02" class="form-label">Middle name</label>
          <input type="text" class="form-control" id="validationDefault02" name="middlename" required>
        </div>
        <div class="col-md-4">
          <label for="validationDefault02" class="form-label">Last name</label>
          <input type="text" class="form-control" id="validationDefault02" name="lastname" required>
        </div>
        <div class="col-md-6">
          <label for="validationDefault03" class="form-label">City</label>
          <input type="text" class="form-control" id="validationDefault03" name="city" required>
        </div>
        <div class="col-md-3">
          <label for="validationDefault04" class="form-label">State</label>
          <select class="form-select" id="validationDefault04" name="state" required>
            <option selected disabled value="">Choose...</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
          </select>
        </div>
        
        <div class="col-md-3">
          <label for="validationDefault05" class="form-label">Zip</label>
          <input type="text" class="form-control" id="validationDefault05" name="zip" required>
        </div>

        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail3" name="email">
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputMobileNumber" class="col-sm-2 col-form-label">Mobile Number</label>
          <div class="col-sm-10">
            <input type="tel" class="form-control" id="inputMobileNumber" placeholder=" " name="mobile_number">
          </div>
        </div>

        <div class="input-group mb-4">
          <span class="input-group-text" id="basic-addon3">Gender</span>
          <div class="form-check align-items-center d-flex">
            <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="male" checked>
            <label class="form-check-label" for="maleRadio">Male</label>
          </div>
          <div class="form-check align-items-center d-flex">
            <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="female">
            <label class="form-check-label" for="femaleRadio">Female</label>
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputGuardianName" class="col-sm-2 col-form-label">Guardian Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputGuardianName" placeholder=" " name="guardian_name">
          </div>
        </div>
        
        <div class="row mb-3">
          <label for="inputGuardianEmail" class="col-sm-2 col-form-label">Guardian Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="inputGuardianEmail" placeholder=" " name="guardian_email">
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputGuardianMobile" class="col-sm-2 col-form-label">Guardian Mobile Number</label>
          <div class="col-sm-10">
            <input type="tel" class="form-control" id="inputGuardianMobile" placeholder=" " name="guardian_mobile">
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
          </div>
        </div>
        
        <div class="row mb-3">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
          </div>
        </div>
        
        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
            <label class="form-check-label" for="invalidCheck2">
              Agree to terms and conditions
            </label>
          </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
          <button type="submit" class="btn btn-primary btn-sm me-2" name="submit">Submit</button>
          <button type="button" class="btn btn-secondary btn-sm">Back</button>
        </div>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9Gkc"></script>
</body>
</html>
<script type="text/javascript">
    function valid() {
        // Check if password and confirm password match
        if (document.registration.password.value !== document.registration.cpassword.value) {
            alert("Password and Re-Type Password Field do not match!");
            document.registration.cpassword.focus();
            return false;
        }

        // Validate email format
        var email = document.registration.email.value;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address.");
            document.registration.email.focus();
            return false;
        }

        // Validate contact number format (exactly 10 digits)
        var contact = document.registration.contact.value;
        if (contact.length < 10) {
            alert("Contact number must be at least 10 digits.");
            document.registration.contact.focus();
            return false;
        }

        // Validate guardian mobile number format (exactly 10 digits)
        var guardianContact = document.registration.guardian_mobile.value;
        if (guardianContact.length < 10) {
            alert("Guardian contact number must be at least 10 digits.");
            document.registration.guardian_mobile.focus();
            return false;
        }

        return true;
    }

    // Real-time validation for contact number field
    document.getElementById("inputMobileNumber").addEventListener("input", function() {
        var contact = this.value;
        if (contact.length < 10) {
            alert("Contact number must be at least 10 digits.");
        }
    });

    // Real-time validation for guardian mobile number field
    document.getElementById("inputGuardianMobile").addEventListener("input", function() {
        var guardianContact = this.value;
        if (guardianContact.length < 10) {
            alert("Guardian contact number must be at least 10 digits.");
        }
    });
</script>
