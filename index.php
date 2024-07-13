<?php
date_default_timezone_set('Asia/Manila');
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<link rel="icon" type="image/x-icon" href="assets/img/rizel1.jpg">
<?php include_once('layouts/header.php'); ?>
<div class="login-page-wrapper">
  <div class="login-page">
    <div class="text-center">
       <img src="uploads\users/rizel.png" alt="IT Department Logo" style="width: 120px; height: auto; margin-bottom: 20px;">
       <h1 style="text-shadow: 4px 4px 5px rgba(0, 0, 0, 0.5);">Welcome to IT Department</h1>
       <h4 style="text-shadow: 4px 4px 5px rgba(0, 0, 0, 0.5);">Inventory Management System</h4>
    </div>
    <?php echo display_msg($msg); ?>
    <form method="post" action="auth.php" class="clearfix">
      <div class="form-group">
        <label style="text-shadow: 4px 4px 5px rgba(0, 0, 0, 0.5);" for="username" class="control-label">Username</label>
        <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" type="name" class="form-control" name="username" placeholder="Username">
      </div>
      <div class="form-group">
        <label style="text-shadow: 4px 4px 5px rgba(0, 0, 0, 0.5);" for="Password" class="control-label">Password</label>
        <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" type="password" name="password" class="form-control" placeholder="Password">
      </div>
      <center><div class="form-group">
        <button  style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" type="submit" class="btn btn-danger" style="border-radius:0%">Login</button>
      </div></center>
    </form>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>

<style>
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
    animation: borderAnimation 5s infinite;
    box-sizing: border-box;
  }

  .text-center {
    margin-bottom: 20px;
  }

  @media (max-width: 600px) {
    .login-page {
      padding: 15px;
    }
    .text-center h1, .text-center h4 {
      font-size: 18px;
    }
  }

  @keyframes borderAnimation {
    0% { box-shadow: 0 0 30px blue; }
    33% { box-shadow: 0 0 30px red; }
    66% { box-shadow: 0 0 30px green; }
    100% { box-shadow: 0 0 30px pink; }
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
                window.location.href = 'index.php';
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