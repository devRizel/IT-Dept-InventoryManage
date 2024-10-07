<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php
if (!isset($_GET['access']) || $_GET['access'] !== 'allowed') {
    // Redirect to index.php if the access parameter is not set correctly
    header("Location: index.php");
    exit();
}
?>
<?php
date_default_timezone_set('Asia/Manila');
$page_title_room = 'User Password ';
require_once('includes/load.php');

$all_rooms = find_all_desc('users');

// Function to fetch all records from a table in descending order of 'id'
function find_all_desc($table) {
  global $db;
  $sql = "SELECT * FROM {$table} ORDER BY id DESC";
  return find_by_sql($sql);
}

?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-10 col-md-offset-1"> <!-- This adds space on left and right -->
    <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel panel-default">
      <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel-heading">
        <center><strong>User and Password</strong></center>
      </div>
      <div class="panel-body">
        <form method="POST" action="autodelete2.php">
          <table style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th class="text-center">Email</th>
                <th class="text-center" style="width: 100px;">Password</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($all_rooms as $room): ?>
                <tr>
                  <td><?php echo remove_junk(ucfirst($room['username'])); ?></td>
                  <td><?php echo remove_junk(ucfirst($room['password'])); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
