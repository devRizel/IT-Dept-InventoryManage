<?php
$page_title = 'All Product';
require_once('includes/load.php');
// Checking what level user has permission to view this page
page_require_level(2);
$products = join_product_table();
$filtered_products = []; // Initialize an empty array for filtered products

// Filter products where the name is 'Server Room'
foreach ($products as $product) {
    if ($product['name'] === 'Server Room') {
        $filtered_products[] = $product;
    }
}

$filtered_products = array_reverse($filtered_products); // Reverse the array of filtered products
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <h1 class="text-center">Server Room</h1>
        <div class="pull-right">
          <a href="add_product2.php" class="btn btn-primary">Add New</a>
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
              foreach ($filtered_products as $product):
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
                    <a href="edit_product2.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product2.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
              <tr class="dropdown-row" id="dropdown-row-<?php echo $counter; ?>" style="display:none;">
                <td colspan="10">
                  <strong>Additional Information:</strong>
                  <br><br><br>
                  <p>Title Room: <?php echo remove_junk($product['name']); ?></p>
                  <p>Device Categories: <?php echo remove_junk($product['categorie']); ?></p>
                  <p>Donated By: <?php echo remove_junk($product['donate']); ?></p>
                  <p>Date Received: <?php echo remove_junk($product['dreceived']); ?></p>
                  <p>Monitor: <?php echo remove_junk($product['monitor']); ?></p>
                  <p>Keyboard: <?php echo remove_junk($product['keyboard']); ?></p>
                  <p>Mouse: <?php echo remove_junk($product['mouse']); ?></p>
                  <p>VGA|HDMI: <?php echo remove_junk($product['v1']); ?></p>
                  <p>Power Chord 1: <?php echo remove_junk($product['p1']); ?></p>
                  <p>Power Chord 2: <?php echo remove_junk($product['p2']); ?></p>
                  <p>Power Supply|AVR: <?php echo remove_junk($product['power1']); ?></p>
                  <p>System Unit Model: <?php echo remove_junk($product['system']); ?></p>
                  <p>Motherboard|Serial Num: <?php echo remove_junk($product['mother']); ?></p>
                  <p>CPU|Processor: <?php echo remove_junk($product['cpu']); ?></p>
                  <p>RAM Quantity|Model: <?php echo remove_junk($product['ram']); ?></p>
                  <p>Power Supply 2: <?php echo remove_junk($product['power2']); ?></p>
                  <p>Video Card|GPU: <?php echo remove_junk($product['video']); ?></p>
                  <p>HDD|SSD|GB: <?php echo remove_junk($product['h']); ?></p>
                  <p>Date: <?php echo remove_junk($product['date']); ?></p>
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
        }   else if (urlParams.get('update_success')) {
          successMessage = "Computer updated successfully.";
        }

        swal("", successMessage, "success")
            .then((value) => {
                window.location.href = 'product2.php';
            });
    }
});
</script>
<script>
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
</script>