<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>

<div class="forgot-password-wrapper">
    <div class="forgot-password">
        <form method="post" autocomplete="off" class="animated-form">
            <h1 class="text-center">Inventory Management System</h1><br>
            <h5 class="text-center">Forgot Password</h5>
            <div class="form-group">
                <label class="control-label">Verification</label>
                <input id="verification" style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" type="text" name="verification" class="form-control input-sm" placeholder="verification" required>
            </div>
            <div class="form-group">
                <label class="control-label">New Password</label>
                <input id="NewPassword" style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" type="password" name="new" class="form-control input-sm" placeholder="New Password" required>
            </div>
            <div class="form-group">
                <label class="control-label">Confirm Password</label>
                <input id="ConfirmPassword" style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" type="password" name="confirm" class="form-control input-sm" placeholder="Confirm Password" required>
            </div>
            <div style="text-align: right;">
                 <button style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); border-radius: 50% 10% 50% 10% / 10% 50% 10% 50%;" name="submit" type="submit" class="btn btn-md btn-danger">Submit</button>
             </div>
             <a href="L-Login.php?access=allowed" style="font-size: 14px; text-decoration: none;
                 text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);">Back to Login</a>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $verification = trim($_POST['verification']);
            $new = $_POST['new'];
            $confirm = $_POST['confirm'];

            $q = $db->query("SELECT * FROM users WHERE verification = '$verification' LIMIT 1 ");
            $count = $q->rowCount();

            if ($count > 0) {
                if (strlen($new) < 8) {
                    $error = 'Password must be equal or greater than 8 characters';
                } else if ($new !== $confirm) {
                    $error = 'Password don\'t match';
                } else {
                    $md5 = sha1($new);
                    $update = $db->query("UPDATE users SET password = '$md5' WHERE verification = '$verification'");
                    if ($update) {
                        $message = "Password changed successfully, Redirecting in 3 seconds...";
                        ?>
                        <script>
                            setTimeout(() => {
                                window.location.href = "L-Login.php?access=allowed"
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
<script>
  let password = document.querySelector("input[name='password']")
  let showPass = document.getElementById("showPass")

  showPass.onclick = () =>{
    if (password.getAttribute("type") == 'password') {
      password.setAttribute("type", "text")
      showPass.classList.replace("fa-eye", "fa-eye-slash")
    }else{
      password.setAttribute("type", "password")
      showPass.classList.replace("fa-eye-slash","fa-eye")
    }
  }
</script>
<?php
if (!isset($_GET['access']) || $_GET['access'] !== 'allowed') {
    // Redirect to index.php if the access parameter is not set correctly
    header("Location: index.php");
    exit();
}
?>
<script>
    // Disable right-click
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });

    // Disable F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U, and other developer shortcuts
    document.addEventListener('keydown', function (e) {
        if (
            e.key === 'F12' || // F12 Developer Tools
            (e.ctrlKey && (e.key === 'i' || e.key === 'I')) || // Ctrl+I
            (e.ctrlKey && (e.key === 'u' || e.key === 'U')) || // Ctrl+U
            (e.ctrlKey && e.shiftKey && (e.key === 'j' || e.key === 'J')) || // Ctrl+Shift+J
            (e.ctrlKey && e.shiftKey && (e.key === 'i' || e.key === 'I')) || // Ctrl+Shift+I
            (e.ctrlKey && (e.key === 'j' || e.key === 'J')) || // Ctrl+J
            (e.ctrlKey && (e.key === 's' || e.key === 'S')) || // Ctrl+S
            (e.ctrlKey && (e.key === 'p' || e.key === 'P')) || // Ctrl+P
            (e.ctrlKey && (e.key === 'c' || e.key === 'C')) || // Ctrl+C
            (e.ctrlKey && (e.key === 'r' || e.key === 'R')) || // Ctrl+R
            (e.ctrlKey && (e.key === 'f' || e.key === 'F'))    // Ctrl+F
        ) {
            e.preventDefault();
        }
    });

    // Disable developer tools check every 100ms
    setInterval(function () {
        if (window.devtools && window.devtools.isOpen) {
            window.location.href = "about:blank";
        }
    }, 100);

    // Disable text selection
    document.addEventListener('selectstart', function (e) {
        e.preventDefault();
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