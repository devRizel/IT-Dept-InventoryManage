<?php
// Start of PHP code

date_default_timezone_set('Asia/Manila');
$page_title = 'Add Product';
require_once('includes/load.php');

// Checking user permission to view page
page_require_level(2);

$all_printer = find_all('printer');
$all_categories = find_all('categories');

$form_data = array(
    'media' => isset($_POST['media']) ? $_POST['media'] : '',
    'categorie_id' => isset($_POST['categorie_id']) ? $_POST['categorie_id'] : ''
);

if (isset($_POST['add_product'])) {
    $errors = array();
    $req_fields = array(
        'media' => 'VGA|HDMI Barcode Photo',
        'categorie_id' => 'Device Category'
    );

    foreach ($req_fields as $field => $placeholder) {
        if (empty($_POST[$field])) {
            $errors[$field] = "{$placeholder} can't be blank.";
        }
    }

    if (empty($errors)) {
        $media = is_null($_POST['media']) || $_POST['media'] === "" ? '0' : (int)$db->escape($_POST['media']);
        $categorie_id = (int)$db->escape($_POST['categorie_id']);

        // Check if category ID exists
        $category_check_query = "SELECT id FROM categories WHERE id = '{$categorie_id}'";
        $result = $db->query($category_check_query);

        if ($result->num_rows == 0) {
            $session->msg('d', 'Invalid category ID!');
            header("Location: add2.php");
            exit();
        }

        // Insert query
        $query = "INSERT INTO other (media, categorie_id) VALUES ";
        $query .= "('{$media}','{$categorie_id}')";

        if ($db->query($query)) {
            header("Location: add2.php?success=true");
            exit();
        } else {
            $session->msg('d', 'Failed to add product!');
            header("Location: add2.php");
            exit();
        }
    } else {
        $js_error_msgs = json_encode($errors);
    }
}

// Get already used image IDs
$saved_image_ids = [];
$query = "SELECT DISTINCT media FROM other";
$result = $db->query($query);
while ($row = $result->fetch_assoc()) {
    if ($row['media'] != 0) {
        $saved_image_ids[] = $row['media'];
    }
}

// Function to filter options
function filter_options($options, $saved_image_ids) {
    return array_filter($options, function($option) use ($saved_image_ids) {
        return !in_array($option['id'], $saved_image_ids);
    });
}

$all_printer = filter_options($all_printer, $saved_image_ids);
?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-offset-2 col-md-8">
    <div style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span style="text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);">Add New Computer Barcode</span>
        </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-12">
        <form method="post" action="add2.php" class="clearfix">
             <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                 <select style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" class="form-control" name="categorie_id">
                    <option value="">Select Device Category</option>
                    <?php foreach ($all_categories as $cat): ?>
                      <?php if ($cat['name'] != 'Computer'): ?>
                        <option value="<?php echo (int)$cat['id']; ?>" <?php echo ($form_data['categorie_id'] == (int)$cat['id']) ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($cat['name']) ?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                  </div>
                  <div class="col-md-6">
                  <select style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);" class="form-control" name="media">
                    <option value="">Select VGA|HDMI Barcode Photo</option>
                    <?php foreach ($all_printer as $photo): ?>
                    <option value="<?php echo (int)$photo['id']; ?>" <?php echo ($form_data['media'] == (int)$photo['id']) ? 'selected' : ''; ?>>
                        <?php echo $photo['file_name']; ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
                 </div>
                </div>
             </div>

            <center><div class="form-group">
              <button style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);" type="submit" name="add_product" class="btn btn-primary">Add Computer</button>
            </div></center>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>

<script src="sweetalert.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize datepicker
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        endDate: new Date(),
        todayHighlight: true
    });

    // Disable typing in datepicker field
    $('.datepicker').keydown(function(e) {
        e.preventDefault();
        return false;
    });

    const urlParams = new URLSearchParams(window.location.search);
    const successParam = urlParams.get('success');
    if (successParam === 'true') {
        swal("", "Other Device added successfully", "success")
            .then((value) => {
                window.location.href = 'add2.php';
            });
    }

    <?php if (!empty($js_error_msgs)): ?>
        const errors = <?php echo $js_error_msgs; ?>;
        Object.keys(errors).forEach(function(key) {
            swal("", errors[key], "error");
        });
    <?php endif; ?>
});
</script>
