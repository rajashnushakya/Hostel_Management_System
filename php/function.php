<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'registration.php'; 

// Instantiate PHPMailer
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
    $mail->addAddress($email);
    $mail->Subject = 'Login Credentials';
    $mail->Body = "
        Dear New User,

        We hope this email finds you well. As a user of our Hostel Management System (HMS), we are pleased to provide you with your login credentials to access the system:
        
        Username: $emailid
        Password: $cpasswordd
        
        Please keep your login credentials confidential and do not share them with anyone. If you have any questions or need assistance, feel free to reach out to our support team at [Your Support Email/Contact Information].
        
        Thank you for using our HMS platform. We look forward to serving you and ensuring a smooth experience.
        
        Best regards,
        Hostel Management System";

    // Send the email
    $mail->send();
    echo 'Email sent successfully!';
} catch (Exception $e) {
    echo "Error sending email: {$mail->ErrorInfo}";
}
?>
