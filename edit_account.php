<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php
date_default_timezone_set('Asia/Manila');
$page_title = 'Edit Account';
require_once('includes/load.php');
page_require_level(3);

if(isset($_POST['submit'])) {
  if(empty($_FILES['file_upload']['name'])) {
      $js_error_msgs[] = "No file was uploaded";
  } else {
    
      $photo = new Media();
      $user_id = (int)$_POST['user_id'];
      $photo->upload($_FILES['file_upload']);
      if($photo->process_user($user_id)){
          $session->msg('s','Photo has been uploaded.');
          redirect('edit_account.php?success=true'); // Add success parameter to URL
      } else {
          $session->msg('d',join($photo->errors));
          redirect('edit_account.php');
      }
  }
}

// Update user account details
if(isset($_POST['update'])){
  $req_fields = array('name', 'username');
  validate_fields($req_fields);
  
  if(empty($errors)){
      $id = (int)$_SESSION['user_id'];
      $name = remove_junk($db->escape($_POST['name']));
      $username = remove_junk($db->escape($_POST['username']));
      
      // Check if either name or username is empty
      if(empty($name) || empty($username)) {
          $js_error_msgs[] = "Name and Username can't be blank.";
      } else {
          // Always attempt to update, regardless of changes
          $sql = "UPDATE users SET name ='{$name}', username ='{$username}' WHERE id='{$id}'";
          $result = $db->query($sql);
          
          if($result && $db->affected_rows() >= 0){ // Check for any rows affected
              $session->msg('s',"Account updated");
              redirect('edit_account.php?update_success=true'); // Add update_success parameter to URL
          } else {
              $session->msg('d','Sorry failed to update!');
              redirect('edit_account.php');
          }
      }
  } else {
      // If validation errors exist, add to $js_error_msgs
      if(empty($_POST['name'])) {
          $js_error_msgs[] = "Name can't be blank.";
      }
      if(empty($_POST['username'])) {
          $js_error_msgs[] = "Username can't be blank.";
      }
  }
}

?>
<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="col-md-6">
      <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel panel-default">
        <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel-heading">
          <div class="panel-heading clearfix">
            <span class="glyphicon glyphicon-camera"></span>
            <span>Change My photo</span>
          </div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
                <img class="img-circle img-size-2" src="uploads/users/<?php echo $user['image'];?>" alt="">
            </div>
            <div class="col-md-8">
              <form class="form" action="edit_account.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="file" name="file_upload" multiple="multiple" class="btn btn-default btn-file"/>
              </div>
              <div class="form-group">
                <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="hidden" name="user_id" value="<?php echo $user['id'];?>">
                 <button style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="submit" name="submit" class="btn btn-warning">Change</button>
              </div>
             </form>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="col-md-6">
    <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel panel-default">
      <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel-heading clearfix">
        <span class="glyphicon glyphicon-edit"></span>
        <span>Edit My Account</span>
      </div>
      <div class="panel-body">
          <form method="post" action="edit_account.php?id=<?php echo (int)$user['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="name" class="control-label">Name</label>
                  <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="name" class="form-control" name="name" value="<?php echo remove_junk(ucwords($user['name'])); ?>">
            </div>
            <div class="form-group">
                  <label for="username" class="control-label">Username</label>
                  <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="text" class="form-control" name="username" value="<?php echo remove_junk(ucwords($user['username'])); ?>">
            </div>
            <div class="form-group clearfix">
                    <a href="change_password.php" title="change password" class="btn btn-danger pull-right">Change Password</a>
                    <button style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="submit" name="update" class="btn btn-info">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include_once('layouts/footer.php'); ?>


<script src="sweetalert.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to handle success messages
    function handleSuccessMessage(message) {
        swal("", message, "success");
    }

    // Check for photo upload success
    const urlParams = new URLSearchParams(window.location.search);
    const successParam = urlParams.get('success');
    if (successParam === 'true') {
        handleSuccessMessage("Photo has been uploaded.");
    }

    // Check for account update success
    const updateSuccessParam = urlParams.get('update_success');
    if (updateSuccessParam === 'true') {
        handleSuccessMessage("Account updated.");
    }
});
</script>

<?php if (!empty($js_error_msgs)): ?>
  <script src="sweetalert.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            swal({
                title: "",
                text: "<?php echo $js_error_msgs[0]; ?>",
                icon: "warning",
                dangerMode: true
            });
        });
    </script>
<?php endif; ?>
<?php if (!empty($js_error_msgs)): ?>
  <script src="sweetalert.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            swal({
                title: "",
                text: "<?php echo implode("\n", $js_error_msgs); ?>",
                icon: "warning",
                dangerMode: true
            });
        });
    </script>
<?php endif; ?>
