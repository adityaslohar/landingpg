<?php
ignore_user_abort(true);
set_time_limit(0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json');
    
    // Instant response to user
    ob_start();
    echo json_encode(["status" => "success", "message" => "Your medical inquiry has been received."]);
    header("Connection: close");
    header("Content-Length: " . ob_get_length());
    ob_end_flush();
    flush();

    // Capture form data
   $name    = htmlspecialchars($_POST['name']);
$email   = htmlspecialchars($_POST['email']);
$phone   = htmlspecialchars($_POST['phone']);
$message = htmlspecialchars($_POST['message']);

$name    = htmlspecialchars($_POST['patient_name']);
$country = htmlspecialchars($_POST['country']);
$city    = htmlspecialchars($_POST['city']);
$phone   = htmlspecialchars($_POST['phone']);
$message = htmlspecialchars($_POST['message']);


    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'aditya.lohar@brightLinkinfotechnologies.com';
        $mail->Password   = 'Aditya@0000';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('aditya.lohar@brightLinkinfotechnologies.com', 'Medical Inquiry');
        $mail->addAddress('tejaspatil0582@gmail.com', 'Clinic Admin');

        $mail->isHTML(true);
        $mail->Subject = "New Medical Appointment Request from $name";

$mail->Body = "
    <div style='max-width: 600px; margin: auto; font-family: Arial, sans-serif;'>
        <div style='background-color: #2C7BE5; padding: 15px; color: white; text-align: center; border-radius: 8px 8px 0 0;'>
            <h1 style='margin: 0; font-size: 22px;'>🏥 New Medical Inquiry</h1>
        </div>
        <div style='padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd;'>
            <p><strong>Dear Doctor/Team,</strong></p>
            <p>A new patient has requested an appointment. Here are the details:</p>
            <table style='width: 100%; border-collapse: collapse; margin-top: 10px;'>
                <tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>Name:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>$name</td></tr>
                <tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>Email:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>$email</td></tr>
                <tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>Phone:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>$phone</td></tr>
                <tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>Medical Concern:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>$message</td></tr>
            </table>
            <p style='margin-top: 20px;'>Best regards,<br><strong>Medical Appointment System</strong></p>
        </div>
    </div>
";

$mail->Body = "
<div style='max-width:600px;margin:auto;font-family:Arial,sans-serif;'>
  <div style='background-color:#2C7BE5;padding:15px;color:white;text-align:center;border-radius:8px 8px 0 0;'>
    <h1 style='margin:0;font-size:22px;'>🏥 New Medical Inquiry</h1>
  </div>
  <div style='padding:20px;background-color:#f9f9f9;border:1px solid #ddd;'>
    <p><strong>Dear Doctor/Team,</strong></p>
    <p>A new patient has requested an appointment. Here are the details:</p>
    <table style='width:100%;border-collapse:collapse;margin-top:10px;'>
      <tr><td style='padding:8px;border:1px solid #ddd;'><strong>Name:</strong></td><td style='padding:8px;border:1px solid #ddd;'>$name</td></tr>
      <tr><td style='padding:8px;border:1px solid #ddd;'><strong>Country:</strong></td><td style='padding:8px;border:1px solid #ddd;'>$country</td></tr>
      <tr><td style='padding:8px;border:1px solid #ddd;'><strong>City:</strong></td><td style='padding:8px;border:1px solid #ddd;'>$city</td></tr>
      <tr><td style='padding:8px;border:1px solid #ddd;'><strong>Phone:</strong></td><td style='padding:8px;border:1px solid #ddd;'>$phone</td></tr>
      <tr><td style='padding:8px;border:1px solid #ddd;'><strong>Medical Concern:</strong></td><td style='padding:8px;border:1px solid #ddd;'>$message</td></tr>
    </table>
    <p style='margin-top:20px;'>Best regards,<br><strong>Medical Appointment System</strong></p>
  </div>
</div>
";



        $mail->send();
    } catch (Exception $e) {
        error_log("Mail Error: " . $mail->ErrorInfo);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request!"]);
}
?>
