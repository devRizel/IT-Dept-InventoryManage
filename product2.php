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
<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <h1 class="text-center">Server Room</h1>
        <div class="search-container" style="display: inline-block; margin-left: 10px;">
      <input type="text" id="search-bar" class="form-control" placeholder="Search...">
    </div>
  <div class="pull-right">
    <a href="add_product2.php" class="btn btn-primary" style="border-radius: 50% 10% 50% 10% / 10% 50% 10% 50%;">Add New</a>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchBar = document.getElementById('search-bar');
    const table = document.getElementById('product-table');
    const rows = table.querySelectorAll('tbody > tr:not(.dropdown-row)'); // Exclude dropdown rows
    const dropdownRows = table.querySelectorAll('tbody > .dropdown-row'); // Dropdown rows

    searchBar.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        rows.forEach(row => {
            const motherCell = row.querySelector('td:nth-child(9)'); // Assuming 'Motherboard|Serial Num' is the 9th column
            const mother = motherCell ? motherCell.textContent.toLowerCase() : '';

            if (mother.includes(searchTerm)) {
                row.style.display = '';
                // Also show the related dropdown row
                const rowId = row.querySelector('.product-checkbox').getAttribute('data-row');
                const dropdownRow = document.getElementById('dropdown-row-' + rowId);
                if (dropdownRow) {
                    dropdownRow.style.display = 'table-row';
                }
            } else {
                row.style.display = 'none';
                // Hide the related dropdown row if the main row is hidden
                const rowId = row.querySelector('.product-checkbox').getAttribute('data-row');
                const dropdownRow = document.getElementById('dropdown-row-' + rowId);
                if (dropdownRow) {
                    dropdownRow.style.display = 'none';
                }
            }
        });

        // Hide all dropdown rows for hidden rows
        dropdownRows.forEach(dropdownRow => {
            if (dropdownRow.style.display !== 'none') {
                dropdownRow.style.display = 'none';
            }
        });
    });

    // Initial setup to ensure dropdown rows are in sync with visible rows
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
<style>
.search-container {
  display: inline-block;
  margin-left: 10px;
}

#search-bar {
  width: 200px;
  display: inline-block;
}
</style>