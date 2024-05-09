<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$gender = $_POST['gender'];
$contactno = $_POST['contact'];
$emailid = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$role = $_POST['Role'];



// Check if passwords match
if ($password != $cpassword) {
    echo "<script>alert('Password and Confirm Password do not match');</script>";
} else {
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Include the connection file
    include 'connection.php';

    // Construct the SQL query with values
    $query = "INSERT INTO staff (first_name, middle_name, last_name, gender, contact, email, password, role, cpassword) 
              VALUES ('$fname', '$mname', '$lname', '$gender', '$contactno', '$emailid', '$hashed_password', '$role', '$cpassword')";
    
    // Execute the query
    if ($mysqli->query($query) === TRUE) {
		echo "<script>alert('New record inserted successfully');</script>";
	} else {
		echo "<script>alert('Failed to insert new record');</script>";
	}
}
$mysqli->close();
sendEmail($emailid, $cpassword, $fname);
}

function sendEmail($emailid, $password, $fname) {
	$mail = new PHPMailer(true);

try {
    // SMTP settings for Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'rajashnushakya@gmail.com'; 
    $mail->Password = 'chuejenrgapnicmg'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587; 

    // Email content
    $mail->setFrom('rajashnushakya@gmail.com', 'Hostel Management System');
    $mail->addAddress($emailid);
    $mail->Subject = 'Login Credentials';
    $mail->Body = "
        Dear $fname,

        We hope this email finds you well. As a user of our Hostel Management System (HMS), we are pleased to provide you with your login credentials to access the system:
        
        Username: $emailid
        Password: $password
        
        Please keep your login credentials confidential and do not share them with anyone. If you have any questions or need assistance, feel free to reach out to our support team at [Your Support Email/Contact Information].
        
        Thank you for using our HMS platform. We look forward to serving you and ensuring a smooth experience.
        
        Best regards,
        Hostel Management System";

    // Send the email
    $mail->send();
    //echo 'Email sent successfully!';
} catch (Exception $e) {
    echo "Error sending email: {$mail->ErrorInfo}";
}
}
?>



<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<title>Staff Registration</title>
	<link rel="stylesheet" href="../css/less/font-awesome.min.css">
	<link rel="stylesheet" href="../css/less/bootstrap1.min.css">
	<link rel="stylesheet" href="../css/less/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="../css/less/bootstrap-social.css">
	<link rel="stylesheet" href="../css/less/bootstrap-select.css">
	<link rel="stylesheet" href="../css//fileinput.min.css">
	<link rel="stylesheet" href="../css/less/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="../css/less/style1.css">
<script type="text/javascript" src="/Hostel_Management_System/js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="/Hostel_Management_System/js/validation.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">
function valid()
{
if(document.registration.password.value!= document.registration.cpassword.value)
{
alert("Password and Re-Type Password Field do not match  !!");
document.registration.cpassword.focus();
return false;
}
return true;
}
</script>
</head>
<body>

		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Staff Registration </h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading">HMS</div>
									<div class="panel-body">
			<form method="post" action="" name="registration" class="form-horizontal" onSubmit="return valid();">
											
										


<div class="form-group">
<label class="col-sm-2 control-label">First Name : </label>
<div class="col-sm-8">
<input type="text" name="fname" id="fname"  class="form-control" required="required" >
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Middle Name : </label>
<div class="col-sm-8">
<input type="text" name="mname" id="mname"  class="form-control">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Last Name : </label>
<div class="col-sm-8">
<input type="text" name="lname" id="lname"  class="form-control" required="required">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Gender : </label>
<div class="col-sm-8">
<select name="gender" class="form-control" required="required">
<option value="">Select Gender</option>
<option value="male">Male</option>
<option value="female">Female</option>
<option value="others">Others</option>
</select>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Role : </label>
<div class="col-sm-8">
<select name="Role" class="form-control" required="required">
<option value="">Select Role</option>
<option value="Receptionist">Receptionist</option>
<option value="Maintenance">Maintenance Staff</option>
</select>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Contact No : </label>
<div class="col-sm-8">
<input type="text" name="contact" id="contact"  class="form-control" required="required">
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Email id: </label>
<div class="col-sm-8">
<input type="email" name="email" id="email"  class="form-control" onBlur="checkAvailability()" required="required">
<span id="user-availability-status" style="font-size:12px;"></span>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Password: </label>
<div class="col-sm-8">
<input type="password" name="password" id="password"  class="form-control" required="required">
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Confirm Password : </label>
<div class="col-sm-8">
<input type="password" name="cpassword" id="cpassword"  class="form-control" required="required">
</div>
</div>
						



<div class="col-sm-6 col-sm-offset-4">
    <button class="btn btn-default" type="button">Cancel</button>
    <input type="submit" formaction="" name="submit" value="Register" class="btn btn-primary">
</div>

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
	<script src="js/main1.js"></script>
</body>
	<script>
function checkAvailability() {

$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function ()
{
event.preventDefault();
alert('error');
}
});
}
</script>
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
    var contactRegex = /^\d{10}$/;
    if (!contactRegex.test(contact)) {
        alert("Please enter a 10-digit contact number.");
        document.registration.contact.focus();
        return false;
    }

    return true;
}
</script>

</html>