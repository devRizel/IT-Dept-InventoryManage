<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php
if (!isset($_GET['access']) || $_GET['access'] !== 'allowed') {
    // Redirect to index.php if the access parameter is not set correctly
    header("Location: index.php");
    exit();
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<?php
date_default_timezone_set('Asia/Manila');
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page-wrapper card-primary">
  <div class="login-page">
    <div class="text-center">
       <img src="uploads/users/rizel.png" alt="IT Department Logo" style="width: 120px; height: auto; margin-bottom: 20px;">
       <h1>Welcome to IT Department</h1>
       <h4>Inventory Management System</h4>
    </div>
    <br>
    <center><?php echo display_msg($msg); ?></center>
    <form method="post" action="auth.php" class="clearfix">
      <div class="wrap-input100 validate-input">
        <input id="email" class="input100" type="text" name="username" placeholder="Enter Your Email" required>
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-envelope" aria-hidden="true"></i>
        </span>
      </div>

      <div class="wrap-input100 validate-input">
        <input id="password"  pattern="^[a-zA-Z0-9]+$" class="input100" type="password" name="password" placeholder="Enter Your Password">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </span>
        <i id="togglePassword" class="fa fa-eye" style="position: absolute; right: 25px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
      </div>

      <div class="container-login100-form-btn">
        <button class="login100-form-btn" name="login">
          Login
        </button>
      </div>

      <div class="text-center p-t-12">
        <a class="txt2" href="index.php">
          Back To Home
        </a>
        <span class="txt1">
          |
        </span>
        <a class="txt2" href="forgot.php?access=allowed">
          Forgot Password?
        </a>
      </div>

      <div class="text-center p-t-136"></div>
    </form>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>

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
</style>
<script src="sweetalert.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const successParam = urlParams.get('success');
    let successMessage = "";

    if (successParam === 'true') {
        if (urlParams.get('')) {
            successMessage = "";
        }

        swal("", successMessage, "success")
            .then((value) => {
                window.location.href = 'login.php?access=allowed';
            });
    }

    // Function to check if fields are empty before form submission
    const loginForm = document.querySelector('form');
    loginForm.addEventListener('submit', function(event) {
        const username = loginForm.elements['username'].value.trim();
        const password = loginForm.elements['password'].value.trim();

        if (username === '') {
            event.preventDefault(); // Prevent form submission

            swal({
                title: "Username can't be blank!",
                icon: "error",
                button: "OK"
            });
        } else if (password === '') {
            event.preventDefault(); // Prevent form submission

            swal({
                title: "Password can't be blank!",
                icon: "error",
                button: "OK"
            });
        }
    });
});
</script>

<script src="css/jj.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<script>
  // Initially hide the togglePassword icon
  document.getElementById('togglePassword').style.display = 'none';

  // Show/hide the togglePassword icon based on input
  document.getElementById('password').addEventListener('input', function() {
    var togglePassword = document.getElementById('togglePassword');
    togglePassword.style.display = this.value.length > 0 ? 'block' : 'none';
  });

  // Toggle password visibility
  document.getElementById('togglePassword').addEventListener('click', function() {
    var passwordInput = document.getElementById('password');
    var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
  });
</script>
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
