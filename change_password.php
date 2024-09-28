<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php
date_default_timezone_set('Asia/Manila');
$page_title = 'Change Password';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
?>

<?php $user = current_user(); ?>
<?php
if(isset($_POST['update'])) {

    $req_fields = array('new-password', 'confirm-password', 'old-password', 'id');
    validate_fields($req_fields);

    if(empty($errors)) {
        $new_password = remove_junk($db->escape($_POST['new-password']));
        $confirm_password = remove_junk($db->escape($_POST['confirm-password']));

        if($new_password !== $confirm_password) {
            $session->msg('d', "New password and confirmation password do not match");
            redirect('change_password.php', false);
        }

        
        if(sha1($_POST['old-password']) !== $user['password']) {
            $session->msg('d', "Your old password does not match");
            redirect('change_password.php', false);
        }

        $id = (int)$_POST['id'];
        $new = remove_junk($db->escape(sha1($_POST['new-password'])));
        $sql = "UPDATE users SET password ='{$new}' WHERE id='{$db->escape($id)}'";
        $result = $db->query($sql);

        if($result && $db->affected_rows() === 1) {
            $session->logout();
            $session->msg('s', "Password updated successfully. Login with your new password.");
            redirect('L-Login.php?access=allowed', false);
        } else {
            $session->msg('d', 'Failed to update password');
            redirect('change_password.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('change_password.php', false);
    }
}
?>
<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php include_once('layouts/header.php'); ?>
<div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="login-page">
    <div class="text-center">
       <h3>Change your password</h3>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="change_password.php" class="clearfix">
        <div class="form-group">
              <label for="oldPassword" class="control-label">Old password</label>
              <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="password" class="form-control" name="old-password" placeholder="Old password">
        </div>
        <div class="form-group">
              <label for="newPassword" class="control-label">New password</label>
              <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="password" class="form-control" name="new-password" id="new-password" placeholder="New password">
        </div>
        <div class="form-group">
              <label for="confirmPassword" class="control-label">Confirm password</label>
              <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Confirm password">
        </div>
        <div class="form-group clearfix">
               <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="hidden" name="id" value="<?php echo (int)$user['id'];?>">
                <center><button style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="submit" name="update" class="btn btn-info">Change</button></center>
        </div>
    </form>
</div>
<?php include_once('layouts/footer.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('#confirm-password').addEventListener('input', function() {
        let newPassword = document.querySelector('#new-password').value;
        let confirmPassword = this.value;
        if(newPassword !== confirmPassword) {
            this.style.borderColor = 'red';
        } else {
            this.style.borderColor = ''; // Reset border color
        }
    });
});
</script>
