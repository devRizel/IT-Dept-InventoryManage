<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>

<div class="forgot-password-wrapper">
    <div class="forgot-password">
        <form method="post" autocomplete="off" class="animated-form">
            <h1 class="text-center">Inventory Management System</h1><br>
            <h5 class="text-center">Forgot Password</h5>

            <div class="wrap-input100 validate-input">
        <input id="verification"   class="input100" type="text" name="verification" placeholder="Enter Your Verification">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
        </span>
      </div>

            <div class="wrap-input100 validate-input">
        <input id="NewPassword"  class="input100" type="password" name="new" placeholder="Enter Your New Password">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </span>
      </div>

            <div class="wrap-input100 validate-input">
        <input id="ConfirmPassword"   class="input100" type="password" name="confirm" placeholder="Enter Your Confirm Password">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </span>
      </div>

      <div class="container-login100-form-btn">
        <button class="login100-form-btn"  name="submit" type="submit">
        Submit
        </button>
      </div>

      <div class="text-center p-t-12">
        <a class="txt2" href="L-Login.php?access=allowed">
        Back to Login
        </a>
      </div>

        </form>

        <?php
        if (isset($_POST['submit'])) {
            $verification = trim($_POST['verification']);
            $new = $_POST['new'];
            $confirm = $_POST['confirm'];
        
            $q = $db->query("SELECT * FROM users WHERE verification = '$verification' LIMIT 1");
            $count = $q->rowCount();
        
            if ($count > 0) {
                if (strlen($new) < 8) {
                    $error = 'Password must be equal or greater than 8 characters';
                } else if ($new !== $confirm) {
                    $error = 'Passwords don\'t match';
                } else {
                    // Use password_hash for bcrypt hashing
                    $hashedPassword = password_hash($new, PASSWORD_BCRYPT);
                    $update = $db->query("UPDATE users SET password = '$hashedPassword' WHERE verification = '$verification'");
                    if ($update) {
                        $message = "Password changed successfully, Redirecting in 3 seconds...";
                        ?>
                        <script>
                            setTimeout(() => {
                                window.location.href = "login.php?access=allowed"
                            }, 3000);
                        </script>
                        <?php
                    }
                }
            } else {
                $error = 'Incorrect login details';
            }
        }
        

        if (isset($error)) { ?>
            <br><br>
            <div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?php echo $error; ?>.</strong>
            </div>
        <?php }
        ?>

        <?php if (isset($message)) { ?>
            <br><br>
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?php echo $message; ?>.</strong>
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
    function detectXSS(inputField, fieldName) {
        const xssPattern = /<script[\s\S]*?>[\s\S]*?<\/script>/i;
        inputField.addEventListener('input', function() {
            if (xssPattern.test(this.value)) {
                swal("Fuk u", `Lubton nuon tika`, "error");
                this.value = "";
            }
        });
    }
    const verificationInput = document.getElementById('verification');
    const NewPasswordInput = document.getElementById('NewPassword');
    const ConfirmPasswordInput = document.getElementById('ConfirmPassword');
    detectXSS(verificationInput, 'Verification');
    detectXSS(NewPasswordInput, 'New Password');
    detectXSS(ConfirmPasswordInput, 'Confirm Password');
</script>
    <!-- <script>
    function detectXSS(inputField, fieldName) {
        const xssPattern = /<script[\s\S]*?>[\s\S]*?<\/script>/i;
        inputField.addEventListener('input', function() {
            if (xssPattern.test(this.value)) {
                swal("XSS Detected", `Please avoid using script tags in your ${fieldName}.`, "error");
                this.value = "";
            }
        });
    }
    const verificationInput = document.getElementById('verification');
    const NewPasswordInput = document.getElementById('NewPassword');
    const ConfirmPasswordInput = document.getElementById('ConfirmPassword');
    detectXSS(verificationInput, 'Verification');
    detectXSS(NewPasswordInput, 'New Password');
    detectXSS(ConfirmPasswordInput, 'Confirm Password');
</script> -->