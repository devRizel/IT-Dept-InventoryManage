
<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>

<div class="forgot-password-wrapper">
  <div class="forgot-password">
    <form method="post" autocomplete="off" class="animated-form">
      <h1 class="text-center">Inventory Management System</h1><br>
      <h5 class="text-center">Forgot Password</h5>

      <div class="wrap-input100 validate-input">
        <input id="email" class="input100"  type="email" name="email" placeholder="Enter Your Email" required>
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-envelope" aria-hidden="true"></i>
        </span>
      </div>
      
      <div class="container-login100-form-btn">
        <button class="login100-form-btn" name="submit" type="submit"> Submit</button>
      </div>

      <div class="text-center p-t-12">
        <a class="txt2" href="L-Login.php?access=allowed">
        Back to Login
        </a>
        <span class="txt1">
          |
        </span>
        <a class="txt2" href="reset.php?access=allowed">
        Reset Password?
        </a>
      </div>

    </form>

    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    
    require "./phpmailer/src/Exception.php";
    require "./phpmailer/src/PHPMailer.php";
    require "./phpmailer/src/SMTP.php";

    if (isset($_POST['submit'])) {
      $username = trim($_POST['email']);
      $verification = uniqid();
      
      $q = $db->query("SELECT * FROM users WHERE username = '$username' LIMIT 1 ");
      $count = $q->rowCount();

      if($count > 0){
        $update = $db->query("UPDATE users SET verification = '$verification' WHERE username = '$username'");
        if ($update) {
          $mail = new PHPMailer(true);
          $mail->SMTPDebug = 0;
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'inventorym77@gmail.com';
          $mail->Password = 'ezvo nqde jzsf ouhl';
          $mail->Port = 587;

          $mail->SMTPOptions = array(
              'ssl' => array(
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => true
              )
          );

          $mail->setFrom('itinventorymanagement@gmail.com', 'InventoryManagement');

          $mail->addAddress($username);
          $mail->Subject = "Reset Password Verification Code";
          $mail->Body = "This is your verification code: " . $verification;

          $mail->send();
        }
      }else{
        $error = 'Incorrect Email Details';
      }
    }

    if(isset($error)){ ?>
      <br><br>
      <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $error; ?>.</strong>
      </div>
    <?php }
    ?>
  </div>
</div>

<style>
body {
    background: url('uploads/users/riz.png');
    background-size: cover; 
    background-position: center; 
}
  .login-page-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 70vh;
    padding: 15px;
    box-sizing: border-box;
  }

  .login-page {
    width: 100%;
    max-width: 400px;
    padding: 20px;
    border: 1px solid #ccc;
    background-color: #fff;
    box-sizing: border-box;
    text-align: center;
  }

  .wrap-input100 {
    position: relative;
    width: 100%;
    margin-bottom: 20px;
  }

  .input100 {
    font-family: Poppins-Regular;
    font-size: 16px;
    color: #333;
    line-height: 1.2;
    display: block;
    width: 100%;
    background: #e6e6e6;
    height: 55px;
    border-radius: 25px;
    padding: 0 30px 0 68px;
    box-sizing: border-box;
  }

  .symbol-input100 {
    position: absolute;
    font-size: 18px;
    color: #999999;
    top: 50%;
    left: 35px;
    transform: translateY(-50%);
    transition: all 0.4s;
  }

  .container-login100-form-btn {
    width: 100%;
    display: flex;
    justify-content: center;
  }

  .login100-form-btn {
    font-family: Poppins-Medium;
    font-size: 16px;
    color: white;
    background-color: #333;
    border: none;
    border-radius: 25px;
    width: 100%;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 25px;
    transition: all 0.4s;
    cursor: pointer;
  }

  .txt1 {
    font-size: 14px;
    color: #999999;
    line-height: 1.5;
  }

  .txt2 {
    font-size: 14px;
    color: #333;
    text-decoration: none;
  }
  .forgot-password-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 15px;
    box-sizing: border-box;
  }

  .forgot-password {
    width: 100%;
    max-width: 400px;
    padding: 20px;
    border: 1px solid #ccc;
    background-color: #fff;
    animation: borderAnimation 5s infinite;
    box-sizing: border-box;
  }

  /* .animated-form {
    padding: 20px;
    border: 1px solid #ccc;
    background-color: #fff;
    animation: borderAnimation 5s infinite;
    box-sizing: border-box;
  }

  @keyframes borderAnimation {
    0% { box-shadow: 0 0 30px blue; }
    33% { box-shadow: 0 0 30px red; }
    66% { box-shadow: 0 0 30px green; }
    100% { box-shadow: 0 0 30px pink; }
  } */
</style>
<?php
if (!isset($_GET['access']) || $_GET['access'] !== 'allowed') {
    // Redirect to index.php if the access parameter is not set correctly
    header("Location: index.php");
    exit();
}
?>
  <script>
      // Disable right-click
document.addEventListener('contextmenu', event => event.preventDefault());

// Disable F12, Ctrl+Shift+I, and other shortcuts
document.addEventListener('keydown', function(event) {
    if (event.keyCode === 123 || // F12
        (event.ctrlKey && event.shiftKey && event.keyCode === 73) || // Ctrl+Shift+I
        (event.ctrlKey && event.keyCode === 85)) { // Ctrl+U
        event.preventDefault();
    }
});

    </script>
    <script src="sweetalert.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function detectXSS(inputField, fieldName) {
            const xssPattern = /<script[\s\S]*?>[\s\S]*?<\/script>/i;
            inputField.addEventListener('input', function() {
                if (xssPattern.test(this.value)) {
                  swal("Fuk u", `Lubton nuon tika`, "error");
                    this.value = "";
                }
            });
        }
        
        const emailInput = document.getElementById('email');
        detectXSS(emailInput, 'Email');
    });
</script>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        function detectXSS(inputField, fieldName) {
            const xssPattern = /<script[\s\S]*?>[\s\S]*?<\/script>/i;
            inputField.addEventListener('input', function() {
                if (xssPattern.test(this.value)) {
                    swal("XSS Detected", `Please avoid using script tags in your ${fieldName}.`, "error");
                    this.value = "";
                }
            });
        }
        
        const emailInput = document.getElementById('email');
        detectXSS(emailInput, 'Email');
    });
</script> -->