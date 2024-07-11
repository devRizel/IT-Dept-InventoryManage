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
        printContents = '<center>' + imgTag.outerHTML + '</center>' + printContents; // Center the image before the table
    }
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload(); // Reload the page to restore original contents
}