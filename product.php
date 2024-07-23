<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php
$page_title = 'All Product';
require_once('includes/load.php');

// Checking what level user has permission to view this page
page_require_level(2);

// Fetch products from database
$products = join_product_table();

// Define an array with desired order of names
$desired_order = array(
  "Faculty",
  "Server Room",
  "Com lab 1",
  "Com lab 2",
  "Com lab 3",
  "Com lab 4"
);

// Function to determine position in desired order array
function custom_sort($product) {
    global $desired_order;
    $name = $product['name'];
    $position = array_search($name, $desired_order);
    return ($position === false) ? count($desired_order) : $position;
}

// Sort products based on custom sort function
usort($products, function($a, $b) {
    return custom_sort($a) - custom_sort($b);
});

include_once('layouts/header.php');
?>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <h1 class="text-center">Overall Computer</h1>
        <div class="pull-right">
          <a href="add_product1.php" class="btn btn-primary">Add New</a>
        </div>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th style="width: 50px;">Select</th>
                <th style="width: 90px;">Photo</th>
                <th>Title Room</th>
                <th class="text-center" style="width: 10%;">Device Categories</th>
                <th class="text-center" style="width: 10%;">Donated By</th>
                <th class="text-center" style="width: 10%;">Date Received</th>
                <th class="text-center" style="width: 10%;">Monitor</th>
                <th class="text-center" style="width: 20%;">Motherboard|Serial Num</th>
                <th class="text-center" style="width: 100px;">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $counter = 1; // Initialize counter
              foreach ($products as $product):
              ?>
              <tr>
                <td class="text-center"><?php echo $counter; ?></td>
                <td class="text-center">
                  <input type="checkbox" name="select_product[]" value="<?php echo $product['id']; ?>" class="product-checkbox" data-row="<?php echo $counter; ?>">
                </td>
                <td>
                  <?php if ($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                    <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                  <?php endif; ?>
                </td>
                <td><?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['donate']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['dreceived']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['monitor']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['mother']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
              <tr class="dropdown-row" id="dropdown-row-<?php echo $counter; ?>" style="display:none;">
                <td colspan="10">
                  <strong>Additional Information:</strong>
                  <br><br><br>
                  <p><strong>•Title Room:</strong> <?php echo remove_junk($product['name']); ?></p>
                  <p><strong>•Device Categories:</strong> <?php echo remove_junk($product['categorie']); ?></p>
                  <p><strong>•Donated By:</strong> <?php echo remove_junk($product['donate']); ?></p>
                  <p><strong>•Date Received:</strong> <?php echo remove_junk($product['dreceived']); ?></p>
                  <p><strong>•Monitor:</strong> <?php echo remove_junk($product['monitor']); ?></p>
                  <p><strong>•Keyboard:</strong> <?php echo remove_junk($product['keyboard']); ?></p>
                  <p><strong>•Mouse:</strong> <?php echo remove_junk($product['mouse']); ?></p>
                  <p><strong>•VGA|HDMI:</strong> <?php echo remove_junk($product['v1']); ?></p>
                  <p><strong>•Power Chord 1:</strong> <?php echo remove_junk($product['p1']); ?></p>
                  <p><strong>•Power Chord 2:</strong> <?php echo remove_junk($product['p2']); ?></p>
                  <p><strong>•Power Supply|AVR:</strong> <?php echo remove_junk($product['power1']); ?></p>
                  <p><strong>•System Unit Model:</strong> <?php echo remove_junk($product['system']); ?></p>
                  <p><strong>•Motherboard|Serial Num:</strong> <?php echo remove_junk($product['mother']); ?></p>
                  <p><strong>•CPU|Processor:</strong> <?php echo remove_junk($product['cpu']); ?></p>
                  <p><strong>•RAM Quantity|Model:</strong> <?php echo remove_junk($product['ram']); ?></p>
                  <p><strong>•Power Supply 2:</strong> <?php echo remove_junk($product['power2']); ?></p>
                  <p><strong>•Video Card|GPU:</strong> <?php echo remove_junk($product['video']); ?></p>
                  <p><strong>•HDD|SSD|GB:</strong> <?php echo remove_junk($product['h']); ?></p>
                  <p><strong>•Date:</strong> <?php echo remove_junk($product['date']); ?></p>
                </td>
              </tr>
              <?php
              $counter++; // Increment counter for next row
              endforeach;
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
<script src="sweetalert.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const successParam = urlParams.get('success');
    let successMessage = "";

    if (successParam === 'true') {
        if (urlParams.get('delete_photo')) {
            successMessage = "Computer Deleted Successfully.";
        } else if (urlParams.get('update_success')) {
            successMessage = "Computer updated successfully.";
        }

        swal("", successMessage, "success")
            .then((value) => {
                window.location.href = 'product.php';
            });
    }

    document.querySelectorAll('.product-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const rowId = this.getAttribute('data-row');
            const dropdownRow = document.getElementById('dropdown-row-' + rowId);
            if (this.checked) {
                dropdownRow.style.display = 'table-row';
            } else {
                dropdownRow.style.display = 'none';
            }
        });
    });
});
</script>
