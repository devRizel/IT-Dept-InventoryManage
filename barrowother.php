<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<?php
$page_title = 'All Product';
require_once('includes/load.php');

// Checking what level user has permission to view this page
page_require_level(2);

$filtered_other = [];



function fetch_other() {
    global $db;
  
    $sql = "SELECT 
              p.id, 
              p.name, 
              p.categorie_id, 
              p.donate, 
              p.dreceived, 
              p.media_id, 
              p.date,
              p.serial, 
              c.name AS categorie, 
              m.file_name AS image,
              p.other_images
            FROM 
              other p 
            LEFT JOIN 
              categories c ON c.id = p.categorie_id 
            LEFT JOIN 
              media m ON m.id = p.media_id 
            WHERE 
              p.other_images NOT LIKE '%Maintenance%' 
              AND (p.barrow IS NULL OR p.barrow = '') 
            ORDER BY 
              p.id ASC";
  
    return find_by_sql($sql);
}
  

// Fetch the products and assign them to $products
$products = fetch_other();

// Ensure $products is an array before sorting
if (is_array($products)) {
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
}

// Fetch categories
$all_categories = find_all('categories');


include_once('layouts/header.php');
?>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <h1 class="text-center">Other Devices To Barrowed</h1>
        <div class="select-wrapper">
          <select id="category-select"  style=" border-radius: 50% 10% 50% 10% / 10% 50% 10% 50%;"  class="form-control" name="Device-Category">
            <option value="">Overall Other Devices</option>
            <?php foreach ($all_categories as $cat): ?>
              <?php if ($cat['name'] != 'Computer'): ?>
                <option value="<?php echo htmlspecialchars($cat['name']); ?>">
                  <?php echo htmlspecialchars($cat['name']); ?>
                </option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="pull-right">
          <div class="search-container" style="display: inline-block; margin-left: 10px;">
            <input type="text" id="search-bar" class="form-control" placeholder="Search...">
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="product-table">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 150px;">Photo</th>
                <th class="text-center" style="width: 10%;">Title Room</th>
                <th class="text-center" style="width: 10%;">Device Categories</th>
                <th class="text-center" style="width: 10%;">Serial Num.</th>
                <th class="text-center" style="width: 100px;">Action</th>
                <th class="text-center" style="width: 100px;">Action</th>
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
                  <?php if ($product['media_id'] === '0'): ?>
                      <img class="img-thumbnail" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                      <img class="img-thumbnail" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                  <?php endif; ?>
                </td>
                <td><?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['serial']); ?></td>
    <td class="text-center">
    <form action="barrowotherview.php" method="get" style="display:inline;">
  <input type="hidden" name="id" value="<?php echo (int)$product['id']; ?>">
  <button type="submit" class="btn-custom" data-toggle="tooltip">
      <span class="glyphicon"></span> View
  </button>
</form>
    </td>
    <td class="text-center">
    <form action="barrowotherbarrowedit.php" method="get" style="display:inline;">
    <input type="hidden" name="id" value="<?php echo (int)$product['id']; ?>">
    <button style="border-radius: 50% 10% 50% 10% / 10% 50% 10% 50%;" type="submit" class="btn-light-green" data-toggle="tooltip">
        <span class="glyphicon"></span> Barrow
    </button>
</form>
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
            successMessage = "Other Device Deleted Successfully.";
        } else if (urlParams.get('update_success')) {
            successMessage = "Other Device updated successfully.";
        }

        swal("", successMessage, "success")
            .then(() => {
                window.location.href = 'barrowother.php';
            });
    }

    // Select box filter functionality
    const categorySelect = document.getElementById('category-select');
    const searchBar = document.getElementById('search-bar');
    const table = document.getElementById('product-table');
    const rows = table.querySelectorAll('tbody > tr');

    function filterTable() {
        const selectedCategory = categorySelect.value.toLowerCase();
        const searchTerm = searchBar.value.toLowerCase();

        rows.forEach(row => {
            const categoryCell = row.querySelector('td:nth-child(4)');
            const serialCell = row.querySelector('td:nth-child(5)');
            const titleCell = row.querySelector('td:nth-child(3)');
            const category = categoryCell ? categoryCell.textContent.toLowerCase() : '';
            const serialNum = serialCell ? serialCell.textContent.toLowerCase() : '';
            const title = titleCell ? titleCell.textContent.toLowerCase() : '';

            const categoryMatch = selectedCategory === '' || category === selectedCategory;
            const searchMatch = serialNum.includes(searchTerm) || title.includes(searchTerm);

            if (categoryMatch && searchMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    categorySelect.addEventListener('change', filterTable);
    searchBar.addEventListener('input', filterTable);
});

</script>
<style>
.select-wrapper {
    margin-right: 20px;
}

.select-wrapper .form-control {
    width: 200px;
    text-align: left;
}

.search-container {
    display: inline-block;
    margin-left: 10px;
}

#search-bar {
    width: 180px;
    display: inline-block;
}
</style>
<style>
.search-container {
  display: inline-block;
  margin-left: 10px;
}

#search-bar {
  width: 200px;
  display: inline-block;
}
/* Add this to your existing CSS file or within a <style> tag in your HTML */
.btn-light-green {
  background-color: red;
  border: none;
  color: #fff; /* White text */
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 5px; /* Rounded corners */
  box-shadow: 0 4px #999; /* Shadow effect */
}

.btn-light-green:hover {
  background-color: red; /* Slightly darker green on hover */
}

.btn-light-green:active {
  background-color: red; /* Even darker green when clicked */
  box-shadow: 0 2px #666;
  transform: translateY(2px);
}
/* Style for buttons similar to the "Add New" button */
.btn-custom {
  background-color: #007bff; /* Primary blue color */
  border: none;
  color: #fff; /* White text */
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 50% 10% 50% 10% / 10% 50% 10% 50%; /* Same border-radius as "Add New" button */
  box-shadow: 0 4px #999; /* Shadow effect */
}

.btn-custom:hover {
  background-color: #0056b3; /* Slightly darker blue on hover */
}

.btn-custom:active {
  background-color: #004080; /* Even darker blue when clicked */
  box-shadow: 0 2px #666;
  transform: translateY(2px);
}
/* Ensure buttons in the btn-group have a width of 30px */
.btn-group a.btn {
  width: 30px;
  padding: 5px; /* Adjust padding to fit the smaller width */
  text-align: center;
  font-size: 14px; /* Adjust font size if needed */
}

.btn-group a.btn .glyphicon {
  font-size: 16px; /* Adjust glyphicon size if needed */
}

</style>