<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php
include_once('includes/load.php');

date_default_timezone_set('Asia/Manila');

$req_fields = array('username', 'password');
validate_fields($req_fields);

$username = remove_junk($_POST['username']);
$password = remove_junk($_POST['password']);

if (empty($errors)) {
    $user_id = authenticate($username, $password);
    if ($user_id) {
        //create session with id
        $session->login($user_id);
        //Update Sign in time
        updateLastLogIn($user_id);
        $session->msg("s", "Welcome to IT Department Inventory Management System");

        // Redirect to admin.php with success parameter
        redirect('admin.php?success=true', false);

    } else {
        $session->msg("d", "Sorry Username/Password incorrect.");
        redirect('login.php?access=allowed', false);
    }

} else {
    $session->msg("d", $errors);
    redirect('login.php?access=allowed', false);
}
?>
