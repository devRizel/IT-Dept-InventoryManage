
<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>

<div class="forgot-password-wrapper">
  <div class="forgot-password">
    <form method="post" autocomplete="off" class="animated-form">
      <h1 class="text-center">Inventory Management System</h1><br>
      <h5 class="text-center">Forgot Password</h5>
      <div class="form-group">
        <label class="control-label">Email Account</label>
        <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" type="email" name="email" class="form-control input-sm" placeholder="Email Account" required>
      </div>
      <div style="display: flex; gap: 20px; justify-content: space-between; align-items: center;">
        <button style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); border-radius: 50% 10% 50% 10% / 10% 50% 10% 50%;" name="submit" type="submit" class="btn btn-md btn-danger ">Submit</button>
      </div>
      <div style="text-align: right;">
         <a href="reset.php?access=allowed" style="font-size: 14px; text-decoration: 
         none; text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);">Reset Password</a>
     </div>
      <a href="login.php?access=allowed" style="font-size: 14px; text-decoration: none;
      text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);">Back to Login</a>
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
          $mail->Username = 'itinventorymanagement@gmail.com';
          $mail->Password = 'okfkncvsjvmysglc';
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
  body{
    background-color: whitesmoke;
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