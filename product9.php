<?php
$page_title = 'All Product';
require_once('includes/load.php');

// Checking what level user has permission to view this page
page_require_level(2);

// Fetch products and other items
$products = join_product_table();
$other = join_other_table();

// Define the desired order of names
$desired_order = array(
    "Faculty",
    "Server Room",
    "Com lab 1",
    "Com lab 2",
    "Com lab 3",
    "Com lab 4"
);

// Function to determine position in desired order array
function custom_sort_by_name($item) {
    global $desired_order;
    $name = $item['name'];
    $position = array_search($name, $desired_order);
    return ($position === false) ? count($desired_order) : $position;
}

// Sort products based on custom sort function
usort($products, function($a, $b) {
    return custom_sort_by_name($a) - custom_sort_by_name($b);
});

// Sort other items based on custom sort function
usort($other, function($a, $b) {
    return custom_sort_by_name($a) - custom_sort_by_name($b);
});





include_once('layouts/header.php');
?>
<style>
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px; /* Adjust as needed */
    }

    .select-wrapper {
        margin-right: 20px;
    }

    .select-wrapper .form-control {
        width: 250px;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
        text-align: left;
    }

    .report-section {
        display: none; /* Initially hide all report sections */
    }
    @media print {
    body * {
        visibility: hidden;
    }
    .header-container,
    h1.text-center {
        display: none !important;
    }
    .report-image {
        display: block !important;
        margin: auto;
        margin-bottom: 10px;
    }
    .table img {
        display: block;
        margin: 0 auto;
        max-width: 100%;
        height: auto;
    }
    #computer-report-table, #other-device-table, #computer-report-table * {
        visibility: visible !important;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }
    .table th, .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    .table th {
        background-color: #f2f2f2;
    }
    .text-center {
        text-align: center;
    }
    @page {
        size: landscape;
    }
}

</style>

<div class="header-container">
    <h2></h2>
    <div class="select-wrapper">
        <select class="form-control" name="Option" id="reportSelector">
            <option value="">Select Option Report</option>
            <option value="computer">Computer Report</option>
            <option value="other_device">Other Device Report</option>
        </select>
    </div>
</div>

<h1 class="text-center">Select an Option Report to View</h1>

<!-- Display messages if needed -->
<div class="col-md-12">
    <?php echo display_msg($msg); ?>
</div>

<!-- Computer Report Section -->
<div class="row computer-report report-section">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h1 class="text-center">Computer Report</h1>
                <div class="select-wrapper">
                    <select class="form-control" name="Room-Title">
                        <option value="Overall Computer">Overall Computer</option>
                        <option value="Server Room">Server Room</option>
                        <option value="Com lab 1">IT Comlab 1</option>
                        <option value="Com lab 2">IT Comlab 2</option>
                        <option value="Com lab 3">IT Comlab 3</option>
                        <option value="Com lab 4">IT Comlab 4</option>
                    </select>
                </div>
                <div class="btn-group" style="float: right;">
                    <button id="generate-report-btn" class="btn btn-danger" onclick="printTable('computer-report-table')">Print</button>
                </div>
            </div>
            <div class="panel-body">
            <center><img src="uploads/users/print.png" class="report-image"></center>
                <div class="table-responsive">
                    <table id="computer-report-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Photo</th>
                                <th>Title Room</th>
                                <th class="text-center" style="width: 10%;">Device Name</th>
                                <th class="text-center" style="width: 10%;">Donated By</th>
                                <th class="text-center" style="width: 10%;">Date Received</th>
                                <th class="text-center" style="width: 10%;">Monitor</th>
                                <th class="text-center" style="width: 10%;">Keyboard</th>
                                <th class="text-center" style="width: 10%;">Mouse</th>
                                <th class="text-center" style="width: 10%;">System Unit Model</th>
                                <th class="text-center" style="width: 10%;">Motherboard|Serial Num</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1; // Initialize counter
                            foreach ($products as $product):
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $counter; ?></td>
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
                                    <td class="text-center"><?php echo remove_junk($product['keyboard']); ?></td>
                                    <td class="text-center"><?php echo remove_junk($product['mouse']); ?></td>
                                    <td class="text-center"><?php echo remove_junk($product['system']); ?></td>
                                    <td class="text-center"><?php echo remove_junk($product['ram']); ?></td>
                                </tr>
                                <?php
                                $counter++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Other Device Report Section -->
<div class="row other-device-report report-section">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h1 class="text-center">Other Devices</h1>
                <div class="select-wrapper">
                    <select class="form-control" name="Room-Title">
                        <option value="Overall Devices">Overall Devices</option>
                        <option value="Server Room">Server Room</option>
                        <option value="Com lab 1">IT Comlab 1</option>
                        <option value="Com lab 2">IT Comlab 2</option>
                        <option value="Com lab 3">IT Comlab 3</option>
                        <option value="Com lab 4">IT Comlab 4</option>
                    </select>
                </div>
                <div class="btn-group" style="float: right;">
                    <button class="btn btn-danger" onclick="printTable('other-device-table')">Print</button>
                </div>
            </div>
            <div class="panel-body">
            <center><img src="uploads/users/print.png" class="report-image"></center>
                <div class="table-responsive">
                    <table id="other-device-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Photo</th>
                                <th>Title Room</th>
                                <th class="text-center" style="width: 10%;">Device Name</th>
                                <th class="text-center" style="width: 10%;">Donated By</th>
                                <th class="text-center" style="width: 10%;">Date Received</th>
                                <!-- Include other columns as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1; // Initialize counter
                            foreach ($other as $item):
                            ?>
                                <tr class="other-device-item" data-room="<?php echo htmlspecialchars(remove_junk($item['name'])); ?>">
                                    <td class="text-center"><?php echo $counter; ?></td>
                                    <td>
                                        <?php if ($item['media_id'] === '0'): ?>
                                            <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                                        <?php else: ?>
                                            <img class="img-avatar img-circle" src="uploads/products/<?php echo $item['image']; ?>" alt="">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo remove_junk($item['name']); ?></td>
                                    <td class="text-center"><?php echo remove_junk($item['categorie']); ?></td>
                                    <td class="text-center"><?php echo remove_junk($item['donate']); ?></td>
                                    <td class="text-center"><?php echo remove_junk($item['dreceived']); ?></td>
                                    <!-- Include other columns as needed -->
                                </tr>
                                <?php
                                $counter++;
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var selector = document.getElementById('reportSelector');
    var counter = 1; // Initialize counter

    selector.addEventListener('change', function() {
        var selectedOption = this.value;

        if (selectedOption === 'computer') {
            showReport('computer-report');
            resetCounterDisplay('.computer-report'); // Reset counter for computer report
            hideMainHeading(true); // Hide the main heading
        } else if (selectedOption === 'other_device') {
            showReport('other-device-report');
            resetCounterDisplay('.other-device-report'); // Reset counter for other device report
            hideMainHeading(true); // Hide the main heading
        } else {
            hideAllReports();
            hideMainHeading(false); // Show the main heading
        }
    });

    function showReport(reportType) {
        hideAllReports(); // Hide all reports first
        document.querySelector('.' + reportType).style.display = 'block';
    }

    function hideAllReports() {
        document.querySelectorAll('.report-section').forEach(function(report) {
            report.style.display = 'none';
        });
    }

    function hideMainHeading(hidden) {
        var mainHeading = document.querySelector('h1.text-center');
        if (mainHeading) {
            mainHeading.style.display = hidden ? 'none' : 'block';
        }
    }

    function resetCounterDisplay(reportSelector) {
        var rows = document.querySelectorAll(reportSelector + ' tbody tr');
        counter = 1; // Reset counter to 1
        rows.forEach(function(row, index) {
            var counterCell = row.querySelector('td:first-child');
            counterCell.textContent = counter++;
        });
    }

    // Change event listener for Room Title dropdown in Computer Report section
    var computerRoomSelector = document.querySelector('.computer-report select[name="Room-Title"]');
    if (computerRoomSelector) {
        computerRoomSelector.addEventListener('change', function() {
            var selectedRoom = this.value.trim(); // Get selected room name

            // Show all rows initially
            var rows = document.querySelectorAll('.computer-report tbody tr');
            rows.forEach(function(row) {
                row.style.display = ''; // Reset to default display
            });

            // Filter rows based on selected room
            if (selectedRoom !== 'Overall Computer') {
                var filteredRows = document.querySelectorAll('.computer-report tbody tr');
                counter = 1; // Reset counter to 1 for specific room
                filteredRows.forEach(function(row, index) {
                    var roomTitleCell = row.querySelector('td:nth-child(3)'); // Assuming room title is in the third cell
                    if (roomTitleCell.textContent.trim() !== selectedRoom) {
                        row.style.display = 'none';
                    } else {
                        // Update the displayed counter for filtered rows
                        var counterCell = row.querySelector('td:first-child');
                        counterCell.textContent = counter++;
                    }
                });
            } else {
                // If "Overall Computer" is selected, reset all counters
                resetCounterDisplay('.computer-report');
            }
        });
    }

    // Change event listener for Room Title dropdown in Other Device Report section
    var otherDeviceRoomSelector = document.querySelector('.other-device-report select[name="Room-Title"]');
    if (otherDeviceRoomSelector) {
        otherDeviceRoomSelector.addEventListener('change', function() {
            var selectedRoom = this.value.trim(); // Get selected room name

            // Show all rows initially
            var rows = document.querySelectorAll('.other-device-report tbody tr');
            rows.forEach(function(row) {
                row.style.display = ''; // Reset to default display
            });

            // Filter rows based on selected room
            if (selectedRoom !== 'Overall Devices') {
                var filteredRows = document.querySelectorAll('.other-device-report tbody tr');
                counter = 1; // Reset counter to 1 for specific room
                filteredRows.forEach(function(row, index) {
                    var roomTitleCell = row.querySelector('td:nth-child(3)'); // Assuming room title is in the third cell
                    if (roomTitleCell.textContent.trim() !== selectedRoom) {
                        row.style.display = 'none';
                    } else {
                        // Update the displayed counter for filtered rows
                        var counterCell = row.querySelector('td:first-child');
                        counterCell.textContent = counter++;
                    }
                });
            } else {
                // If "Overall Devices" is selected, reset all counters
                resetCounterDisplay('.other-device-report');
            }
        });
    }
});
function printTable(tableId) {
    var printContents = document.getElementById(tableId).outerHTML;
    var imgTag = document.querySelector('.report-image');
    if (imgTag) {
        printContents = '<center>' + imgTag.outerHTML + '</center>' + printContents; 
    }
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload(); 
}
</script>
