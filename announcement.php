<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'connection.php'; // Include your database connection file

// Check connection
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $announcementTitle = $_POST['announcementTitle'];
  $announcementMessage = $_POST['announcementMessage'];
  $announcementScheduledAt = $_POST['announcementScheduledAt'];
  $announcementFor = $_POST['announcementFor']; // Get the announcement for value

  // Insert announcement into the database
  $sql = "INSERT INTO announcements (title, message, scheduled_at, announcement_for) VALUES ('$announcementTitle', '$announcementMessage', '$announcementScheduledAt', '$announcementFor')";

  if ($mysqli->query($sql) === TRUE) {
    echo "<script>alert('Record inserted successfully');</script>";

    // Send emails based on selection
    if ($announcementFor === 'staff') {
      sendEmailToStaff($announcementTitle, $announcementMessage);
    } elseif ($announcementFor === 'resident') {
      sendEmailToResidents($announcementTitle, $announcementMessage);
    }
  } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
  }
}

// Close connection
$mysqli->close();

function sendEmailToStaff($title, $message) {
  $mail = new PHPMailer(true);

  try {
    // SMTP settings for Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'rajashnushakya@gmail.com'; // Your Gmail email
    $mail->Password = 'chuejenrgapnicmg'; // Your Gmail password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Email content
    $mail->setFrom('rajashnushakya@gmail.com', 'Hostel Management System');
    // Fetch staff emails from the database
    $staffEmails = fetchStaffEmails(); // You need to implement this function
    foreach ($staffEmails as $email) {
      $mail->addAddress($email);
    }
    $mail->Subject = $title;
    $mail->Body = $message;

    // Send the email
    $mail->send();
    //echo 'Email sent successfully!';
  } catch (Exception $e) {
    echo "Error sending email: {$mail->ErrorInfo}";
  }
}

function sendEmailToResidents($title, $message) {
    $mail = new PHPMailer(true);

    try {
      // SMTP settings for Gmail
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'rajashnushakya@gmail.com'; // Your Gmail email
      $mail->Password = 'chuejenrgapnicmg'; // Your Gmail password
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
  
      // Email content
      $mail->setFrom('rajashnushakya@gmail.com', 'Hostel Management System');
      // Fetch residents' emails from the database
      $residentEmails = fetchResidentEmails(); // You need to implement this function
      foreach ($residentEmails as $email) {
        $mail->addAddress($email);
      }
      $mail->Subject = $title;
      $mail->Body = $message;
  
      // Send the email
      $mail->send();
      //echo 'Email sent successfully!';
    } catch (Exception $e) {
      echo "Error sending email: {$mail->ErrorInfo}";
    }
  }
  
  // Function to fetch residents' emails from the database
  function fetchResidentEmails() {
    global $mysqli;
    $emails = array();
  
    // Fetch residents' emails from the residents table (replace 'residents' with your actual table name)
    $result = $mysqli->query("SELECT email FROM resident");
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $emails[] = $row['email'];
      }
    }
  
    return $emails;
}

// Function to fetch staff emails from the database
function fetchStaffEmails() {
  global $mysqli;
  $emails = array();

  // Fetch staff emails from the staff table
  $result = $mysqli->query("SELECT email FROM staff");
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $emails[] = $row['email'];
    }
  }

  return $emails;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        h1 {
            color: #02080e;
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        input[type="datetime-local"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .submit-btn-container {
            text-align: center;
        }

        button[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Announcement</h1>
        
        <form id="announcementForm" class="announcement-form" method="post">
            <div class="mb-3">
                <label for="announcementTitle" class="form-label">Title:</label>
                <input type="text" class="form-control" id="announcementTitle" name="announcementTitle" required>
            </div>
            <div class="mb-3">
                <label for="announcementMessage" class="form-label">Message:</label>
                <textarea class="form-control" id="announcementMessage" name="announcementMessage" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="announcementScheduledAt" class="form-label">Scheduled Date and Time:</label>
                <input type="datetime-local" class="form-control" id="announcementScheduledAt" name="announcementScheduledAt" required>
            </div>
            <div class="mb-3">
                <label for="announcementFor" class="form-label">Announcement for:</label>
                <select name="announcementFor" class="form-control" required>
                    <option value="">Select</option>
                    <option value="staff">Only Staff</option>
                    <option value="resident">Only Resident</option>
                </select>
            </div>
            <div class="submit-btn-container">
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9Gkc"></script>
</body>
</html>