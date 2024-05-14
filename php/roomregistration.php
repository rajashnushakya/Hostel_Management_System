<?php
include('connection.php'); 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $rmno = $_POST['rmno'];
    $mname = $_POST['mname'];
    $category = $_POST['Category'];
    $seater = $_POST['seater'];
    $fee = $_POST['fee'];

    // SQL query to insert data into database
    $query = "INSERT INTO rooms (room_number, room_name, category, seater, fee) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);

    // Bind parameters
    $stmt->bind_param('sssss', $rmno, $mname, $category, $seater, $fee);

    // Execute the statement
    $stmt->execute();
    
    if($stmt->error) {
        echo "Error: " . $stmt->error;
    } else {
        echo "<script>alert('Room added successfully');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title>Room Registration</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="js/validation.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript">
    function validateForm() {
           // Check room number for alphabetic characters
            var roomNumber = document.getElementById("rmno").value;
            if (!/^\d+$/.test(roomNumber)) {
                document.getElementById("roomNumberError").innerText = "Room number must contain only numeric digits.";
                return false;
            } else {
                document.getElementById("roomNumberError").innerText = ""; // Clear the error message if valid
            }
            
        var rmno = document.getElementById("rmno").value;
        var mname = document.getElementById("mname").value;
        var category = document.getElementById("Category").value;
        var seater = document.getElementById("seater").value;
        var fee = document.getElementById("fee").value;

        if (rmno == "" || mname == "" || category == "" || seater == "" || fee == "") {
            alert("All fields must be filled out");
            return false;
        }
        // If all validations pass, return true to allow form submission
    return true;

    }
</script>
</head>
<body>
    <div class="content-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                
                    <h2 class="page-title">Room Registration </h2>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">HMS</div>
                                <div class="panel-body">
            <form method="post" action="" name="registration" class="form-horizontal" onsubmit="return validateForm();">
            <div class="form-group">
    <label class="col-sm-2 control-label">Room No.</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="rmno" id="rmno" value="" required="required">
        <span id="roomNumberError" style="color: red;"></span> <!-- Error message will appear here -->
    </div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Name of the room : </label>
<div class="col-sm-8">
<input type="text" name="mname" id="mname"  class="form-control">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Category : </label>
<div class="col-sm-8">
<select name="Category" class="form-control" required="required">
<option value="">Select Category</option>
<option value="male">Girls hostel</option>
<option value="female">Boys hostel</option>
</select>
</div>
</div>


        
        <div class="form-group">
        <label class="col-sm-2 control-label">Select Seater : </label>
        <div class="col-sm-8">
        <Select name="seater" class="form-control" required>
<option value="">Select Seater</option>
<option value="1">Single Seater</option>
<option value="2">Two Seater</option>
<option value="3">Three Seater</option>
<option value="4">Four Seater</option>
<option value="5">Five Seater</option>
</Select>
</div>
</div>

</div>
<div class="form-group">
<label class="col-sm-2 control-label">Fee(Per Student)</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="fee" id="fee" value="" required="required">
</div>
</div>
            
            <div class="col-sm-6 col-sm-offset-4">
                <button class="btn btn-default" type="submit">Cancel</button>
                <input type="submit" name="submit" Value="Add" class="btn btn-primary">
                </div>
                </form>

                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
