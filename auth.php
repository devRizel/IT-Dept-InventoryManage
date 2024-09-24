<?php
include_once('includes/load.php');
date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

// Sanitize and validate inputs to prevent XSS
$username = htmlspecialchars(remove_junk($_POST['username']));
$password = htmlspecialchars(remove_junk($_POST['password']));

// Detect XSS pattern
$xss_pattern = '/<script[\s\S]*?>[\s\S]*?<\/script>/i';
$ip_address = $_SERVER['REMOTE_ADDR']; // Get user IP address

if (preg_match($xss_pattern, $username) || preg_match($xss_pattern, $password)) {
    // Send email notification on XSS detection
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'itinventorymanagement@gmail.com';
        $mail->Password = 'okfkncvsjvmysglc'; // Your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email content for XSS detection
        $mail->setFrom('itinventorymanagement@gmail.com', 'IT Inventory Management');
        $mail->addAddress('itinventorymanagement@gmail.com'); // Admin email
        $mail->isHTML(true);
        $mail->Subject = 'XSS Attempt Detected';
        $mail->Body = 'An XSS attempt has been detected.<br>Username: ' . $username . '<br>IP Address: ' . $ip_address . '<br>Time: ' . date("Y-m-d H:i:s");

        $mail->send();
    } catch (Exception $e) {
        error_log('XSS detection notification could not be sent. Mailer Error: ' . $mail->ErrorInfo);
    }

    // Trigger SweetAlert for XSS detection
    echo "<script>
        swal({
            title: 'XSS attempt detected!',
            text: 'An attempt to inject malicious code has been detected.',
            icon: 'warning',
            button: 'OK'
        }).then((value) => {
            window.location.href = 'login.php?access=allowed';
        });
    </script>";
    
    // Stop further execution
    exit();
}


// Initialize or update login attempts
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

if (empty($errors)) {
    $user_id = authenticate($username, $password);
    if ($user_id) {
        $_SESSION['login_attempts'] = 0;
        $session->login($user_id);
        updateLastLogIn($user_id);
        $session->msg("s", "Welcome to IT Department Inventory Management System");

        // Send email notification on successful login
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'itinventorymanagement@gmail.com';
            $mail->Password = 'okfkncvsjvmysglc'; // Your Gmail app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email content for successful login
            $mail->setFrom('itinventorymanagement@gmail.com', 'IT Inventory Management');
            $mail->addAddress('itinventorymanagement@gmail.com');
            $mail->isHTML(true);
            $mail->Subject = 'User Login Notification';
            $mail->Body = 'A user has successfully logged in.<br>Email: ' . $username . '<br>Login Time: ' . date("Y-m-d H:i:s") . '<br>IP Address: ' . $ip_address;

            $mail->send();
        } catch (Exception $e) {
            error_log('Login notification could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        }

        // Redirect to admin page
        redirect('admin.php?success=true', false);
    } else {
        $_SESSION['login_attempts']++;

        if ($_SESSION['login_attempts'] >= 3) {
            // Send email notification on failed login attempts
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'itinventorymanagement@gmail.com';
                $mail->Password = 'okfkncvsjvmysglc'; // Your Gmail app password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Email content for failed login attempts
                $mail->setFrom('itinventorymanagement@gmail.com', 'IT Inventory Management');
                $mail->addAddress('itinventorymanagement@gmail.com');
                $mail->isHTML(true);
                $mail->Subject = 'Failed Login Attempts Alert';
                $mail->Body = 'There have been 3 failed login attempts.<br>Username: ' . $username . '<br>Time: ' . date("Y-m-d H:i:s") . '<br>IP Address: ' . $ip_address;

                $mail->send();
            } catch (Exception $e) {
                error_log('Failed login attempt notification could not be sent. Mailer Error: ' . $mail->ErrorInfo);
            }

            $_SESSION['login_attempts'] = 0;
        }

        $session->msg("d", "Sorry Username/Password incorrect.");
        redirect('login.php?access=allowed', false);
    }
} else {
    $session->msg("d", $errors);
    redirect('login.php?access=allowed', false);
}
?>
<script src="sweetalert.min.js"></script>