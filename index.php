<?php
date_default_timezone_set('Asia/Manila');
ob_start();
require_once('includes/load.php');

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
    $servername = "127.0.0.1";
    $username = "u510162695_inventory";
    $password = "1Inventory_system";
    $dbname = "u510162695_inventory";

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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
            body {
            font-family: Arial, sans-serif;
        }

        .chat-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: var(--accent-color);
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 30px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .chat-button:hover {
          background-color: var(--accent-color);
        }

        .chat-icon {
            margin-right: 8px;
        }

        .chat-window {
            display: none;
            position: fixed;
            bottom: 70px;
            right: 20px;
            width: 300px;
            max-width: 100%;
            border: 1px solid #ccc;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: white;
            z-index: 1000;
            box-sizing: border-box;
        }

        .chat-header {
          background-color: var(--accent-color);
            color: white;
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            box-sizing: border-box;
        }

        .chat-content {
            padding: 10px;
            box-sizing: border-box;
        }

        .chat-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .chat-submit {
          background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
        }

        @media (max-width: 600px) {
            .chat-button {
                bottom: 10px;
                right: 10px;
                padding: 10px 15px;
                border-radius: 20px;
            }

            .chat-window {
                bottom: 60px;
                right: 10px;
                width: calc(100% - 20px);
            }
        }
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 20px; /* Adjust font size for smaller screens */
      }
      .marquee-text {
    display: inline-block;
    white-space: nowrap;
    overflow: hidden;
    box-sizing: border-box;
    animation: marquee 10s linear infinite;
}

@keyframes marquee {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-100%);
    }
}
.marquee-text {
    display: inline-block;
    white-space: nowrap;
    overflow: hidden;
    box-sizing: border-box;
    animation: marquee 10s linear infinite;
}

@keyframes marquee {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-100%);
    }
}
    }
  </style>
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="#" class="logo d-flex align-items-center me-auto">
        <img src="assets/image/download.png" class="img-fluid animated"alt="">
        <h1 class="sitename">IT DEPARTMENT</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="L-Login.php?access=allowed">Login</a>

    </div>
  </header>

  <main class="main">
    <section id="hero" class="hero section">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <center><h1>INVENTORY MANAGEMENT</h1></center>
            <center><h1>SYSTEM</h1></center>
            <!-- <p>Please Select Portal to proceed.</p>
            <div class="d-flex">
              <a href="generate.php?access=allowed" class="btn-get-started">Portal</a>
            </div> -->
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img">
            <img src="assets/image/fontsize.jpg" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section>
    <section id="about" class="about section">
      <div class="container section-title" data-aos="fade-up">
        <h2>About Us</h2>
        <p>This system development is driven by the goal of enhancing the operational 
          efficiency of the IT Department, ensuring that all inventory is accounted for 
          and managed effectively. It will replace the time-consuming manual process with 
          an automated, reliable, 
          and scalable solution, leading to cost savings and improved resource management.</p>
      </div>
    </section>


  </main>

  <footer id="footer" class="footer">

    <div class="container">
    <div class="copyright text-center ">
        <p>© <span>Copyright 2024</span> <strong class="px-1 sitename">IT Team</strong> 
        <span>All Right Reserved</span></p>
      </div>
      <div class="social-links d-flex justify-content-center">
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
      </div>
    </div>

  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/js/main.js"></script>
  <button class="chat-button" onclick="toggleChatWindow()">
        <span class="chat-icon">Message with us!</span>💬
    </button>

    <div class="chat-window" id="chatWindow">
        <div class="chat-header">
            Message with us!
            <button onclick="toggleChatWindow()" style="float:right; background: none; border: none; color: white;">&times;</button>
        </div>
        <div class="chat-content">
        <form id="chatForm" method="POST">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" class="chat-input" placeholder="Your name" required>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" class="chat-input" placeholder="Your email" required>
    <label for="message">Message</label>
    <textarea id="message" name="message" class="chat-input" placeholder="Your message" required></textarea>
    <button type="submit" class="chat-submit">Submit</button>
</form>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script src="css/j.js"></script>

    <script>
        function toggleChatWindow() {
            var chatWindow = document.getElementById('chatWindow');
            var chatForm = document.getElementById('chatForm');
            if (chatWindow.style.display === 'none' || chatWindow.style.display === '') {
                chatWindow.style.display = 'block';
            } else {
                chatWindow.style.display = 'none';
                chatForm.reset(); // Clear the form fields
            }
        }
    </script>
    <script type="text/javascript">
var rev = "silent";
function titlebar(val)
{
    var msg  = "Inventory Management System";
    var res = " ";
    var speed = 70
    var pos = val;

    msg = ""+msg+"";
    var le = msg.length;
    if(rev == "silent"){
        if(pos < le){
        pos = pos+1;
        scroll = msg.substr(0,pos);
        document.title = scroll;
        timer = window.setTimeout("titlebar("+pos+")",speed);
        }
        else{
        rev = "silents";
        timer = window.setTimeout("titlebar("+pos+")",speed);
        }
    }
    else{
        if(pos > 0){
        pos = pos-1;
        var ale = le-pos;
        scrol = msg.substr(ale,le);
        document.title = scrol;
        timer = window.setTimeout("titlebar("+pos+")",speed);
        }
        else{
        rev = "silent";
        timer = window.setTimeout("titlebar("+pos+")",speed);
        }   
    }
}

titlebar(0);
</script>
<script>
    // Disable right-click
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });

    // Disable F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
    document.onkeydown = function (e) {
        if (
            e.key === 'F12' ||
            (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J')) ||
            (e.ctrlKey && e.key === 'U')
        ) {
            e.preventDefault();
        }
    };

    // Disable developer tools
    function disableDevTools() {
        if (window.devtools.isOpen) {
            window.location.href = "about:blank";
        }
    }

    // Check for developer tools every 100ms
    setInterval(disableDevTools, 100);

    // Disable selecting text
    document.onselectstart = function (e) {
        e.preventDefault();
    };
</script>
</body>

</html>
