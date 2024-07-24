<?php
date_default_timezone_set('Asia/Manila');
$page_title = 'Categories | Rooms';
$page_title_cat = 'All categories';
$page_title_room = 'All rooms';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);

$all_categories = find_all_desc('categories');
$all_rooms = find_all_desc('room');

// Function to fetch all records from a table in descending order of 'id'
function find_all_desc($table) {
  global $db;
  $sql = "SELECT * FROM {$table} ORDER BY id DESC";
  return find_by_sql($sql);
}

// Function to check if category name exists
function category_exists($name) {
    global $db;
    $sql = "SELECT COUNT(id) AS count FROM categories WHERE name = '{$name}'";
    $result = $db->query($sql);
    $row = $db->fetch_assoc($result);
    return $row['count'] > 0;
}

// Function to check if room name exists
function room_exists($name) {
    global $db;
    $sql = "SELECT COUNT(id) AS count FROM room WHERE name = '{$name}'";
    $result = $db->query($sql);
    $row = $db->fetch_assoc($result);
    return $row['count'] > 0;
}

if(isset($_POST['add_cat'])){
  $req_field = array('categorie-name');
  $error_msgs = check_blank_and_exists($req_field, 'categorie-name');
  
  if (empty($error_msgs)) {
      $cat_name = remove_junk($db->escape($_POST['categorie-name']));
      
      if(category_exists($cat_name)) {
          $error_msgs[] = "Category '{$cat_name}' already exists.";
          $js_error_msgs = json_encode($error_msgs);
      } else {
          $sql  = "INSERT INTO categories (name) VALUES ('{$cat_name}')";
          if ($db->query($sql)) {
              redirect("categorie.php?success=true&add_cat=true", false);
          } else {
              $session->msg("d", "Sorry Failed to insert category.");
              redirect('categorie.php', false);
          }
      }
  } else {
      $js_error_msgs = json_encode($error_msgs);
  }
}

if(isset($_POST['add_room'])){
  $req_field = array('room-name');
  $error_msgs = check_blank_and_exists($req_field, 'room-name');
  
  if (empty($error_msgs)) {
      $room_name = remove_junk($db->escape($_POST['room-name']));
      
      if(room_exists($room_name)) {
          $error_msgs[] = "Room '{$room_name}' already exists.";
          $js_error_msgs = json_encode($error_msgs);
      } else {
          $sql  = "INSERT INTO room (name) VALUES ('{$room_name}')";
          if ($db->query($sql)) {
              redirect("categorie.php?success=true&add_room=true", false);
          } else {
              $session->msg("d", "Sorry Failed to insert room.");
              redirect('categorie.php', false);
          }
      }
  } else {
      $js_error_msgs = json_encode($error_msgs);
  }
}

// Function to check blank fields and existing records
function check_blank_and_exists($req_fields, $form_type) {
  global $db;
  $error_msgs = array();
  foreach ($req_fields as $field) {
      if (empty($_POST[$field])) {
          $error_msgs[] = ucfirst($field) . " can't be blank.";
      }
  }
  
  if ($form_type == 'categorie-name') {
      $cat_name = remove_junk($db->escape($_POST['categorie-name']));
      if (category_exists($cat_name)) {
          $error_msgs[] = "Category '{$cat_name}' already exists.";
      }
  } elseif ($form_type == 'room-name') {
      $room_name = remove_junk($db->escape($_POST['room-name']));
      if (room_exists($room_name)) {
          $error_msgs[] = "Room '{$room_name}' already exists.";
      }
  }
  
  return $error_msgs;
}


// Function to check blank fields
function check_blank_fields($req_fields) {
  $error_msgs = array();
  foreach ($req_fields as $field) {
      if (empty($_POST[$field])) {
          $error_msgs[] = ucfirst($field) . " can't be blank.";
      }
  }
  return $error_msgs;
}


$count = 1; // Initialize counter
foreach (array_reverse($all_categories) as $cat):
    // Display each category row
endforeach;
$count = 1; // Initialize counter
foreach (array_reverse($all_rooms) as $room):
    // Display each room row
endforeach;

?>
<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php include_once('layouts/header.php'); ?>


<div class="row">
 <div class="col-md-5">
   <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel panel-default">
     <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel-heading">
       <strong>Add New Category</strong>
     </div>
     <div class="panel-body">
       <form method="post" action="categorie.php">
         <div class="form-group">
             <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="categorie-name" placeholder="Category Name">
         </div>
         <button  style=" border-radius: 50% 10% 50% 10% / 10% 50% 10% 50%; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="submit" name="add_cat" class="btn btn-primary">Add Category</button>
     </form>
     </div>
   </div>
 </div>
 <div class="col-md-7">
   <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel panel-default">
     <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel-heading">
       <strong>All Categories</strong>
     </div>
     <div class="panel-body">
       <table style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="table table-bordered table-striped table-hover">
         <thead>
             <tr>
                 <th class="text-center" style="width: 50px;">#</th>
                 <th>Categories</th>
                 <th class="text-center" style="width: 100px;">Actions</th>
             </tr>
         </thead>
         <tbody>
           <?php
           $count = 1; // Initialize counter
           foreach ($all_categories as $cat):
           ?>
             <tr>
                 <td class="text-center"><?php echo $count;?></td>
                 <td><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                 <td class="text-center">
                   <div class="btn-group">
                     <a href="edit_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a href="delete_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                   </div>
                 </td>
             </tr>
             <?php
             $count++; // Increment counter
             endforeach;
             ?>
         </tbody>
       </table>
    </div>
 </div>
 </div>
</div>

<div class="row">
 <div class="col-md-5">
   <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel panel-default">
     <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel-heading">
       <strong>Add New Room</strong>
     </div>
     <div class="panel-body">
       <form method="post" action="categorie.php">
         <div class="form-group">
             <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="room-name" placeholder="Room Name">
         </div>
         <button  style=" border-radius: 50% 10% 50% 10% / 10% 50% 10% 50%; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="submit" name="add_room" class="btn btn-primary">Add Room</button>
     </form>
     </div>
   </div>
 </div>
 <div class="col-md-7">
   <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel panel-default">
     <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel-heading">
       <strong>All Rooms</strong>
     </div>
     <div class="panel-body">
       <table style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="table table-bordered table-striped table-hover">
         <thead>
             <tr>
                 <th class="text-center" style="width: 50px;">#</th>
                 <th>Room</th>
                 <th class="text-center" style="width: 100px;">Actions</th>
             </tr>
         </thead>
         <tbody>
           <?php
           $count = 1; // Reset counter for rooms
           foreach ($all_rooms as $room):
           ?>
             <tr>
                 <td class="text-center"><?php echo $count;?></td>
                 <td><?php echo remove_junk(ucfirst($room['name'])); ?></td>
                 <td class="text-center">
                   <div class="btn-group">
                     <a href="edit_categorie2.php?id=<?php echo (int)$room['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a href="delete_categorie2.php?id=<?php echo (int)$room['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                   </div>
                 </td>
             </tr>
             <?php
             $count++; // Increment counter
             endforeach;
             ?>
         </tbody>
       </table>
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
const urlParams = new URLSearchParams(window.location.search);
const successParam = urlParams.get('success');

if (successParam === 'true') {
    let successMessage = "";
    if (urlParams.get('add_cat')) {
        successMessage = "Successfully Added New Category.";
    } else if (urlParams.get('add_room')) {
        successMessage = "Successfully Added New Room.";
    } else if (urlParams.get('delete_cat')) {
        successMessage = "Category Deleted Successfully.";
    } else if (urlParams.get('delete_room')) { 
        successMessage = "Room Deleted Successfully.";
    } else if (urlParams.get('update_success')) { 
        successMessage = "Successfully Updated Categorie.";
    } else if (urlParams.get('update_successs')) { 
        successMessage = "Successfully Updated Room.";
    }
    
    swal("", successMessage, "success")
        .then((value) => {
            window.location.href = 'categorie.php'; 
        });
}
</script>



