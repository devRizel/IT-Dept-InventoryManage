<?php
include_once('includes/load.php');
date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

// Redirect if the user is logged in
if ($session->isUserLoggedIn(true)) {
    redirect('home.php', false);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fieldName = $_POST['fieldName'] ?? 'Successfully Sent!';
    $inputValue = $_POST['inputValue'] ?? 'Successfully Sent!';
    $ipAddress = $_SERVER['REMOTE_ADDR'];

    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inventory_system";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        logError("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and validate input
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $location = get_location($ipAddress);

    // Check for XSS attempt
    if (containsXSS($name) || containsXSS($email) || containsXSS($message)) {
        sendEmailNotification('XSS Attempt', 'Detected in form submission', $ipAddress);
        logError("XSS attempt detected from IP: $ipAddress");
        header("Location: ".$_SERVER['PHP_SELF']."?success=false");
        exit;
    }

    // SQL query using prepared statement
    $stmt = $conn->prepare("INSERT INTO chat (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
      // Proceed to send email
      sendEmailNotification($fieldName, $inputValue, $ipAddress, $location);
      header("Location: ".$_SERVER['PHP_SELF']."?success=true");
      exit;
  } else {
      logError("Error: " . $stmt->error);
  }


    // Close connection
    $stmt->close();
    $conn->close();
}

function get_location($ip) {
  $response = file_get_contents('http://ip-api.com/json/' . $ip);
  return json_decode($response, true);
}
function containsXSS($input) {
    $xssPattern = '/<script\b[^>]*>(.*?)<\/script>/is';
    return preg_match($xssPattern, $input);
}

function sendEmailNotification($fieldName, $inputValue, $ipAddress) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'itinventorymanagement@gmail.com'; // Use environment variable
        $mail->Password = 'okfkncvsjvmysglc'; // Use environment variable
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('itinventorymanagement@gmail.com', 'IT Inventory Management');
        $mail->addAddress('itinventorymanagement@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'XSS Attempt Detected';
        $mail->Body = "An XSS attempt was detected.<br>"
                     . "<strong>Field:</strong> {$fieldName}<br>"
                      . "<strong>Input:</strong> " . htmlspecialchars($inputValue, ENT_QUOTES, 'UTF-8') . "<br>"
                     . "<strong>IP Address:</strong> {$ipAddress}<br>"
                     . "<strong>Location:</strong> " . 
                     ($location['city'] ?? 'Unknown') . ', ' . 
                     ($location['country'] ?? 'Unknown') . '<br>'
                     . "<strong>Login Time:</strong> " . date("Y-m-d H:i:s");


        // Send the email
        $mail->send();
    } catch (Exception $e) {
        logError("Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
}

function logError($message) {
    // Implement your logging mechanism
    error_log($message); // Log to the server's error log
}
// Initialize visitor count session variable if not set
if (!isset($_SESSION['visitor_count'])) {
    $_SESSION['visitor_count'] = 0;
  }
  
  // Check if the user is visiting for the first time today
  if (!isset($_SESSION['last_visit_date']) || $_SESSION['last_visit_date'] != date('Y-m-d')) {
    $_SESSION['visitor_count'] = 1; // First visit of the day
    $_SESSION['last_visit_date'] = date('Y-m-d'); // Update last visit date
  } else {
    $_SESSION['visitor_count']++; // Increment visit count
  }
  
  // Send visitor count to Gmail
  sendVisitorCountEmail($_SESSION['visitor_count']);
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ... (rest of your existing form handling code)
  
    // Send email notification for form submission
    sendEmailNotification($fieldName, $inputValue, $ipAddress, $location);
  }
  
  // Function to send visitor count to email
  function sendVisitorCountEmail($count) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'itinventorymanagement@gmail.com'; // Use environment variable
        $mail->Password = 'okfkncvsjvmysglc'; // Use environment variable
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
  
        // Recipients
        $mail->setFrom('itinventorymanagement@gmail.com', 'IT Inventory Management');
        $mail->addAddress('itinventorymanagement@gmail.com');
  
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Visitor Count Update';
        $mail->Body = "Visitor Count today is: {$count}";
  
        // Send the email
        $mail->send();
    } catch (Exception $e) {
        logError("Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
  }
  ?>