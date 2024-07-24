<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

<?php
$page_title = 'Add User';
require_once('includes/load.php');
// Checking what level user has permission to view this page
page_require_level(1);
$groups = find_all('user_groups');

if (isset($_POST['add_user'])) {
    $req_fields = array('password', 'username', 'full-name', 'level');
    validate_fields($req_fields);

    // Check for empty fields
    $error_msgs = array();
    foreach ($req_fields as $field) {
        if (empty($_POST[$field])) {
            $error_msgs[] = ucfirst($field) . " can't be blank.";
        }
    }

    // Only proceed to username check if no other errors so far
    if (empty($error_msgs)) {
        // Check if username already exists
        $existing_username = find_by_username($_POST['username']);
        if ($existing_username) {
            $error_msgs[] = "Username '{$_POST['username']}' already exists.";
        }
    }

    // If there are still no errors, proceed with inserting the user
    if (empty($error_msgs)) {
        $name       = remove_junk($db->escape($_POST['full-name']));
        $username   = remove_junk($db->escape($_POST['username']));
        $password   = remove_junk($db->escape($_POST['password']));
        $user_level = (int)$db->escape($_POST['level']);
        $password   = sha1($password);

        $query  = "INSERT INTO users (name, username, password, user_level, status) ";
        $query .= "VALUES ('{$name}', '{$username}', '{$password}', '{$user_level}', '1')";

        if ($db->query($query)) {
            // Success
            redirect('add_user.php?success=true', false);
        } else {
            // Failed
            $session->msg('d', 'Sorry failed to create account!');
            redirect('add_user.php', false);
        }
    } else {
        // Prepare the array for JavaScript
        $js_error_msgs = json_encode($error_msgs);
    }
}

// Function to find username in database
function find_by_username($username) {
    global $db;
    $escaped_username = $db->escape($username);
    $query = "SELECT id FROM users WHERE username = '{$escaped_username}' LIMIT 1";
    $result_set = $db->query($query);
    return $db->fetch_assoc($result_set);
}
?>

<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">

<?php include_once('layouts/header.php'); ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Add New User</strong>
            </div>
            <div class="panel-body">
                <form method="post" action="add_user.php">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" class="form-control" name="full-name" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="email" style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" class="form-control" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div style="position: relative;">
                          <input id="password" style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" type="password" name="password" class="form-control" placeholder="Password">
                            <i id="togglePassword" class="fa fa-eye" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none;"></i>
                       </div>
                    </div>
                    <div class="form-group">
                        <label for="level">User Role</label>
                        <select style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" class="form-control" name="level">
                            <?php foreach ($groups as $group ):?>
                            <option value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group clearfix">
                        <button  style=" border-radius: 50% 10% 50% 10% / 10% 50% 10% 50%; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="submit" name="add_user" class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/footer.php'); ?>

<?php if (isset($js_error_msgs)): ?>
<script src="sweetalert.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var errorMessages = <?php echo $js_error_msgs; ?>;
        errorMessages.forEach(function(msg) {
            swal({
                title: "",
                text: msg,
                icon: "warning",
                dangerMode: true
            });
        });
    });
</script>
<?php endif; ?>


<script src="sweetalert.min.js"></script>
<script>
    // Check if success query parameter is present in URL
    const urlParams = new URLSearchParams(window.location.search);
    const successParam = urlParams.get('success');
    if (successParam === 'true') {
        swal("", "User account has been created!", "success")
            .then((value) => {
                window.location.href = 'add_user.php'; // Redirect to clear query parameter
            });
    }
</script>

<script>
  document.getElementById('password').addEventListener('input', function() {
    var togglePassword = document.getElementById('togglePassword');
    togglePassword.style.display = this.value ? 'block' : 'none';
  });

  document.getElementById('togglePassword').addEventListener('click', function() {
    var passwordInput = document.getElementById('password');
    var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
  });
</script>