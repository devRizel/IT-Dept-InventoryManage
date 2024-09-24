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
    // Sanitize the IP address to avoid RFI/LFI attacks
    $ip = filter_var($ip, FILTER_VALIDATE_IP);
    if ($ip) {
        $response = @file_get_contents('http://ip-api.com/json/' . $ip);
        return json_decode($response, true);
    }
    return null;
}

// Password hash verification function
function authenticate($username, $password) {
    global $db;
    $username = $db->escape($username);

    // Use a prepared statement to prevent SQL injection
    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Verify password with hash
        if (password_verify($password, $user['password'])) {
            return $user['id'];
        }
    }
    return false;
}

if (empty($errors)) {
    $user_id = authenticate($username, $password);
    if ($user_id) {
        // Reset login attempts after successful login
        $_SESSION['login_attempts'] = 0;

        // Regenerate session ID to prevent session fixation attacks
        session_regenerate_id(true);

        // Create session with id
        $session->login($user_id);
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
            $mail->Username = 'itinventorymanagement@gmail.com'; // Your Gmail address
            $mail->Password = 'okfkncvsjvmysglc'; // Your Gmail app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('itinventorymanagement@gmail.com', 'IT Inventory Management');
            $mail->addAddress('itinventorymanagement@gmail.com'); // Admin email (your email)

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'User Login Notification';
            $mail->Body    = 'A user has successfully logged in.<br>Email: ' . htmlspecialchars($username) . '<br>Login Time: ' . date("Y-m-d H:i:s");

            $mail->send();
        } catch (Exception $e) {
            error_log('Login notification could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        }

        // Redirect to admin.php with success parameter
        redirect('admin.php?success=true', false);

    } else {
        // Increment login attempts
        $_SESSION['login_attempts']++;

        // Check if login attempts have reached 3
        if ($_SESSION['login_attempts'] >= 3) {
            // Optionally get user's location
            $location = get_location($user_ip);

            // PHPMailer: Send notification email for failed login attempts
            try {
                $mail = new PHPMailer(true);
                $mail->SMTPDebug = 0; // Disable verbose debug output
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Set mailer to use SMTP
                $mail->SMTPAuth = true;
                $mail->Username = 'itinventorymanagement@gmail.com'; // Your Gmail address
                $mail->Password = 'okfkncvsjvmysglc'; // Your Gmail app password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('itinventorymanagement@gmail.com', 'IT Inventory Management');
                $mail->addAddress('itinventorymanagement@gmail.com'); // Admin email (your email)

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Failed Login Attempts Alert';
                $mail->Body    = 'There have been 3 failed login attempts.<br>'
                               . 'Username: ' . htmlspecialchars($username) . '<br>'
                               . 'IP Address: ' . htmlspecialchars($user_ip) . '<br>'
                               . 'Location: ' . ($location['city'] ?? 'Unknown') . ', ' . ($location['country'] ?? 'Unknown') . '<br>'
                               . 'Time: ' . date("Y-m-d H:i:s");

                $mail->send();
            } catch (Exception $e) {
                error_log('Failed login attempt notification could not be sent. Mailer Error: ' . $mail->ErrorInfo);
            }

            // Reset login attempts after notification
            $_SESSION['login_attempts'] = 0;
        }

        $session->msg("d", "Sorry, Username/Password incorrect.");
        redirect('login.php?access=allowed', false);
    }

} else {
    $session->msg("d", $errors);
    redirect('login.php?access=allowed', false);
}
?>
