<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php
date_default_timezone_set('Asia/Manila');
$page_title = 'Edit Computer';
require_once('includes/load.php');
// Check user permission
page_require_level(2);

$product = find_by_id('other', (int)$_GET['id']);
$all_other_images = find_all('other_images');

$errors = array();
if (isset($_POST['add_product'])) {
    $field_messages = array(
        'other_images' => 'Other Device Barcode'
    );

    $req_fields = array('other_images');

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
    if ($selected_date && $selected_date > $today) {
        $errors[] = "Date Received cannot be a future date.";
    }

    if (empty($errors)) {
        $other_images = is_null($_POST['other_images']) || $_POST['other_images'] === "" ? '0' : (int)$db->escape($_POST['other_images']);
        $date = make_date();

        $query = "UPDATE other SET ";
        $query .= "other_images = '{$other_images}', ";
        $query .= "date = '{$date}' ";
        $query .= "WHERE id = '{$product['id']}'";

        $result = $db->query($query);

        if ($result && $db->affected_rows() === 1) {
            redirect('product7.php?success=true&update_success=true', false);
        } else {
            $session->msg('d', 'Failed to update Other Device.');
            redirect('product7main.php?id=' . (int)$product['id'], false);
        }
    }
}



include_once('layouts/header.php');
?>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>

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
        <form method="post" action="product7main.php?id=<?php echo (int)$product['id'] ?>">
        <div class="form-group col-md-8 col-md-offset-2">
    <label for="Room-Title">Other Device Barcode</label>
    <select style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" class="form-control" name="other_images">
    <?php foreach ($all_other_images as $photo): ?>
        <option value="<?php echo (int)$photo['id']; ?>" <?php echo (!empty($form_data['other_images']) && (int)$form_data['other_images'] === (int)$photo['id']) ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($photo['file_name'], ENT_QUOTES, 'UTF-8'); ?>
        </option>
        <?php endforeach; ?>
        <option>Maintenance</option>
    </select>
</div>


          <center>
            <div class="form-group">
              <button style="border-radius: 50% 10% 50% 10% / 10% 50% 10% 50%; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="submit" name="add_product" class="btn btn-primary">Update Computer</button>
              <a style="border-radius: 50% 10% 50% 10% / 10% 50% 10% 50%; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" href="product7.php" class="btn btn-danger">Cancel</a>
            </div>
          </center>
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