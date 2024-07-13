<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php
date_default_timezone_set('Asia/Manila');
$page_title = 'Edit Computer';
require_once('includes/load.php');
// Checking what level user has permission to view this page
page_require_level(2);

$product = find_by_id('products', (int)$_GET['id']);
$all_categories = find_all('categories');
$all_room = find_all('room');
$all_photo = find_all('media');


// Filter categories to include only "Computer"
$filtered_cat = array_filter($all_categories, function($cat) {
  return $cat['name'] == 'Computer';
});
if (!$product) {
    $session->msg("d", "Missing product id.");
    redirect('product6.php');
}

$errors = array();
if (isset($_POST['add_product'])) {
    $field_messages = array(
        'Room-Title' => 'Room Title',
        'Device-Category' => 'Device Category',
        'Device-Photo' => 'Device Photo',
        'donate' => 'Donated By',
        'dreceived' => 'Date Received',
        'monitor' => 'Monitor',
        'Keyboard' => 'Keyboard',
        'mouse' => 'Mouse',
        'v1' => 'VGA|HDMI',
        'p1' => 'Power Chord 1',
        'p2' => 'Power Chord 2',
        'power1' => 'Power Supply|AVR',
        'system' => 'System Unit Model',
        'mother' => 'Motherboard Model',
        'cpu' => 'CPU|Processor',
        'ram' => 'RAM Quantity|Model',
        'power2' => 'Power Supply 2',
        'video' => 'Video Card|GPU',
        'h' => 'HDD|SSD|GB'
    );

    $req_fields = array('Room-Title', 'Device-Category', 'Device-Photo', 'donate', 'dreceived', 'monitor', 'Keyboard', 'mouse', 
    'v1', 'p1', 'p2', 'power1', 'system', 'mother', 'cpu', 'ram', 'power2', 'video', 'h');

    $js_error_msgs = array();

    foreach ($req_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = isset($field_messages[$field]) ? $field_messages[$field] . " can't be blank." : ucfirst(str_replace('-', ' ', $field)) . " is required.";
            // Add error message to the JavaScript array
            $js_error_msgs[$field] = $errors[$field];
        }
    }

// Validate Date Received not being a future date
$date_received = isset($_POST['dreceived']) ? (string)$_POST['dreceived'] : '';
$today = new DateTime();
$selected_date = DateTime::createFromFormat('Y-m-d', $date_received);
if ($selected_date > $today) {
    $errors[] = "Date Received cannot be a future date.";
}


    if (empty($errors)) {
        // If no errors, proceed with updating the product
        $p_name = remove_junk($db->escape($_POST['Room-Title']));
        $p_cat = (int)$db->escape($_POST['Device-Category']);
        $media_id = is_null($_POST['Device-Photo']) || $_POST['Device-Photo'] === "" ? '0' : (int)$db->escape($_POST['Device-Photo']);
        $p_donate = remove_junk($db->escape($_POST['donate']));
        $p_monitor = remove_junk($db->escape($_POST['monitor']));
        $p_keyboard = remove_junk($db->escape($_POST['Keyboard']));
        $p_mouse = remove_junk($db->escape($_POST['mouse']));
        $p_v1 = remove_junk($db->escape($_POST['v1']));
        $p_p1 = remove_junk($db->escape($_POST['p1']));
        $p_p2 = remove_junk($db->escape($_POST['p2']));
        $p_power1 = remove_junk($db->escape($_POST['power1']));
        $p_system = remove_junk($db->escape($_POST['system']));
        $p_mother = remove_junk($db->escape($_POST['mother']));
        $p_cpu = remove_junk($db->escape($_POST['cpu']));
        $p_ram = remove_junk($db->escape($_POST['ram']));
        $p_power2 = remove_junk($db->escape($_POST['power2']));
        $p_video = remove_junk($db->escape($_POST['video']));
        $p_h = remove_junk($db->escape($_POST['h']));
        $date = make_date();

        $query = "UPDATE products SET ";
        $query .= "name = '{$p_name}', ";
        $query .= "categorie_id = '{$p_cat}', ";
        $query .= "media_id = '{$media_id}', ";
        $query .= "donate = '{$p_donate}', ";
        $query .= "dreceived = '{$date_received}', ";
        $query .= "monitor = '{$p_monitor}', ";
        $query .= "Keyboard = '{$p_keyboard}', ";
        $query .= "mouse = '{$p_mouse}', ";
        $query .= "v1 = '{$p_v1}', ";
        $query .= "p1 = '{$p_p1}', ";
        $query .= "p2 = '{$p_p2}', ";
        $query .= "power1 = '{$p_power1}', ";
        $query .= "system = '{$p_system}', ";
        $query .= "mother = '{$p_mother}', ";
        $query .= "cpu = '{$p_cpu}', ";
        $query .= "ram = '{$p_ram}', ";
        $query .= "power2 = '{$p_power2}', ";
        $query .= "video = '{$p_video}', ";
        $query .= "date = '{$date}', ";
        $query .= "h = '{$p_h}' ";
        $query .= "WHERE id = '{$product['id']}'"; 

        $result = $db->query($query);

        if ($result && $db->affected_rows() === 1) {
            redirect('product6.php?success=true&update_success=true', false);
        } else {
            $session->msg('d', 'Failed to update Computer.');
            redirect('edit_product6.php?id=' . (int)$product['id'], false);
        }
    }
}


include_once('layouts/header.php');
?>

<div class="row">
  <div class="col-md-offset-2 col-md-8">
    <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel panel-default">
      <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Edit Computer</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="edit_product6.php?id=<?php echo (int)$product['id'] ?>">
          <div class="form-group col-md-8 col-md-offset-2">
            <label for="Room-Title">Room Title</label>
            <select style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" class="form-control" name="Room-Title">
              <option value="">Select a Room</option>
              <?php foreach ($all_room as $room): ?>
                <option value="<?php echo htmlspecialchars(remove_junk($room['name'])); ?>" <?php if (remove_junk($room['name']) === remove_junk($product['name'])) echo 'selected="selected"'; ?>>
                  <?php echo htmlspecialchars(remove_junk($room['name'])); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label for="Device-Category">Product Category</label>
                <select style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" class="form-control" name="Device-Category">
                  <option value="">Select a Category</option>
                  <?php foreach ($filtered_cat as $cat): ?>
                    <option value="<?php echo (int)$cat['id']; ?>" <?php if($product['categorie_id'] == $cat['id']) echo "selected"; ?>>
                    <?php echo htmlspecialchars($cat['name']) ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="Device-Photo">Product Photo</label>
                <select style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" class="form-control" name="Device-Photo">
                  <option value="">No image</option>
                  <?php foreach ($all_photo as $photo): ?>
                    <option value="<?php echo (int)$photo['id']; ?>" <?php if($product['media_id'] == $photo['id']) echo "selected"; ?>>
                      <?php echo $photo['file_name']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                     <label for="Device-Photo">Donated By</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="donate" value="<?php echo remove_junk($product['donate']);?>">
                 </div>
                 <div class="col-md-6">
                     <label for="Device-Photo">Date Received</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control datepicker" name="dreceived" required readonly value="<?php echo remove_junk($product['dreceived']);?>">
                  </div>
               </div>
          </div>
          
          <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                     <label for="Device-Photo">Monitor</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="monitor" value="<?php echo remove_junk($product['monitor']);?>">
                 </div>
                 <div class="col-md-6">
                     <label for="Device-Photo">Keyboard</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="Keyboard" value="<?php echo remove_junk($product['Keyboard']);?>">
                  </div>
               </div>
          </div>

          
          <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                     <label for="Device-Photo">Mouse</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="mouse" value="<?php echo remove_junk($product['mouse']);?>">
                 </div>
                 <div class="col-md-6">
                     <label for="Device-Photo">VGA|HDMI</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="v1" value="<?php echo remove_junk($product['v1']);?>">
                  </div>
               </div>
          </div>

          <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                     <label for="Device-Photo">Power Chord 1</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="p1" value="<?php echo remove_junk($product['p1']);?>">
                 </div>
                 <div class="col-md-6">
                     <label for="Device-Photo">Power Chord 2</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="p2" value="<?php echo remove_junk($product['p2']);?>">
                  </div>
               </div>
          </div>

          <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                     <label for="Device-Photo">Power Supply|AVR</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="power1" value="<?php echo remove_junk($product['power1']);?>">
                 </div>
                 <div class="col-md-6">
                     <label for="Device-Photo">System Unit Model</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="system" value="<?php echo remove_junk($product['system']);?>">
                  </div>
               </div>
          </div>

          <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                     <label for="Device-Photo">Motherboard Model</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="mother" value="<?php echo remove_junk($product['mother']);?>">
                 </div>
                 <div class="col-md-6">
                     <label for="Device-Photo">CPU|Processesor</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="cpu" value="<?php echo remove_junk($product['cpu']);?>">
                  </div>
               </div>
          </div>

          <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                     <label for="Device-Photo">RAM Quannty|Model</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="ram" value="<?php echo remove_junk($product['ram']);?>">
                 </div>
                 <div class="col-md-6">
                     <label for="Device-Photo">Power Supply 2</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="power2" value="<?php echo remove_junk($product['power2']);?>">
                  </div>
               </div>
          </div>

          <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                     <label for="Device-Photo">Video Card|GPU</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="video" value="<?php echo remove_junk($product['video']);?>">
                 </div>
                 <div class="col-md-6">
                     <label for="Device-Photo">HDD|SSD|GB</label>
                     <input style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" type="text" class="form-control" name="h" value="<?php echo remove_junk($product['h']);?>">
                  </div>
               </div>
          </div>
            

          <center><div class="form-group">
            <button style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="submit" name="add_product" class="btn btn-primary">Update Computer</button>
            <a style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" href="product6.php" class="btn btn-danger">Cancel</a>
          </div></center>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
<script>
$(document).ready(function() {
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',  // Format date as needed
        autoclose: true,
        endDate: new Date(),  // Disable dates after today
        todayHighlight: true,
        keyboardNavigation: false,
        forceParse: false,
        startDate: '-Infinity'
    });

    // Disable manual input
    $('.datepicker').keydown(function(e){
        e.preventDefault();
        return false;
    });
});
</script>

<script src="sweetalert.min.js"></script>
<?php if (!empty($js_error_msgs)): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Retrieve the first error message from the array
        var errorMessages = <?php echo json_encode(array_values($js_error_msgs)[0]); ?>;
        swal({
            title: "",
            text: errorMessages,
            icon: "warning",
            dangerMode: true
        });
    });
</script>
<?php endif; ?>
<?php if (!empty($errors)): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            swal({
                title: "",
                text: "<?php echo $errors[0]; ?>",
                icon: "warning",
                dangerMode: true
            });
        });
    </script>
<?php endif; ?>
