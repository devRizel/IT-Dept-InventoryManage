<ul>
    <li>
      <a href="admin.php" id="admin">
        <i class="glyphicon glyphicon-home"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li>
      <a href="#" class="submenu-toggle" id="add-user">
        <i class="glyphicon glyphicon-user"></i>
        <span>Add New User</span>
      </a>
      <ul class="nav submenu">
        <li><a href="users.php" id="manage-users">Manage Users</a></li>
      </ul>
    </li>
    <li>
      <a href="categorie.php" id="categories">
        <i class="glyphicon glyphicon-indent-left"></i>
        <span>Categories</span>
      </a>
    </li>
    <li>
      <a href="media.php" id="media-files">
        <i class="glyphicon glyphicon-picture"></i>
        <span>Media Files</span>
      </a>
    </li>
    <li>
        <a href="#" class="submenu-toggle" id="manage-barcode">
            <i class="glyphicon glyphicon-picture"></i>
            <span>Add Barcode</span>
        </a>
        <ul class="nav submenu">
            <li>
                <a href="#" class="submenu-toggle">
                    Add Computer Barcode
                </a>
                <ul class="nav submenu">
                    <li><a href="bar1.php" id="AddComputer">Add Computer</a></li>
                    <li><a href="bar2.php" id="AddMonitor">Add Monitor</a></li>
                    <li><a href="bar3.php" id="AddKeyboard">Add Keyboard</a></li>
                    <li><a href="bar4.php" id="AddMouse">Add Mouse</a></li>
                    <li><a href="bar5.php" id="AddSystem">Add System Unit</a></li>
                    <li><a href="bar6.php" id="AddVGA|HDMI">Add VGA|HDMI</a></li>
                    <li><a href="bar7.php" id="Addpower1">Add Power Supply1</a></li>
                    <li><a href="bar8.php" id="Addpower2">Add Power Supply2</a></li>
                    <li><a href="bar9.php" id="AddPower1">Add POWER CHORD1</a></li>
                    <li><a href="bar10.php" id="AddPower2">Add POWER CHORD2</a></li>
                    <li><a href="bar11.php" id="AddMotherboard">Add Motherboard Serial Num.</a></li>
                    <li><a href="bar12.php" id="AddCPU">Add CPU</a></li>
                    <li><a href="bar13.php" id="AddRAM">Add RAM</a></li>
                    <li><a href="bar14.php" id="AddVideoCard">Add Video Card</a></li>
                    <li><a href="bar15.php" id="AddHDD|SSD|GB">Add HDD|SSD|GB</a></li>
                </ul>
            </li>
            <li>
            <a href="bar16.php" class="nav submenu" id="Addprinter">Add Other Devices Barcode</a>
            </li>
        </ul>
    </li>
    <li>
      <a href="#" class="submenu-toggle" id="add-new">
        <i class="glyphicon glyphicon-th-large"></i>
        <span>Add New</span>
      </a>
      <ul class="nav submenu">
        <li><a href="add1.php" id="add">Add New Computer</a></li>
        <li><a href="add2.php" id="addother">Add New Other Devices</a></li>
      </ul>
    </li>
    <!-- <li>
      <a href="addproducts.php" id="sample">
        <i class="glyphicon glyphicon-th-large" ></i>
        <span>Sample</span>
      </a>
    </li> -->
    <li>
      <a href="#" class="submenu-toggle" id="manage">
        <i class="glyphicon glyphicon-th-large"></i>
        <span>Manage Room</span>
      </a>
      <ul class="nav submenu">
        <li><a href="product.php" id="overall-computer">Overall Computer</a></li>
        <li><a href="product1.php" id="faculty">Faculty</a></li>
        <li><a href="product2.php" id="server-room">Server Room</a></li>
        <li><a href="product3.php" id="it-comlab1">IT Comlab 1</a></li>
        <li><a href="product4.php" id="it-comlab2">IT Comlab 2</a></li>
        <li><a href="product5.php" id="it-comlab3">IT Comlab 3</a></li>
        <li><a href="product6.php" id="it-comlab4">IT Comlab 4</a></li>
        <li><a href="product7.php" id="other-devices">Other Devices</a></li>
      </ul>
    </li>
    <li>
      <a href="#" class="submenu-toggle" id="manage">
        <i class="glyphicon glyphicon-th-large"></i>
        <span>Maintenance</span>
      </a>
      <ul class="nav submenu">
        <li><a href="computer.php" id="overall-computer">Computer</a></li>
        <li><a href="otherdevices.php" id="faculty">Other Devices</a></li>
      </ul>
    </li>
    <li>
        <a href="#" class="submenu-toggle" id="manage-barcode">
            <i class="glyphicon glyphicon-th-large"></i>
            <span>Barrow</span>
        </a>
        <ul class="nav submenu">
            <li>
                <a href="#" class="submenu-toggle">
                    Barrow Computer
                </a>
                <ul class="nav submenu">
   		     <li><a href="barrowcomputer.php" id="overall-computer">Computer List</a></li>
     		     <li><a href="barrowedcomputer.php" id="overall-computer">Computer Barrowed</a></li>
       		     <li><a href="barrowedcomputerreturn.php" id="overall-computer">Computer Return</a></li>
                </ul>
            </li>
            <li>
            <a href="#" class="submenu-toggle">
                    Barrow Other Devices
                </a>
                <ul class="nav submenu">
                     <li><a href="barrowother.php" id="faculty">Other Devices</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li>
      <a href="product8.php" id="print-report">
        <i class="glyphicon glyphicon-th-large"></i>
        <span>Print Report</span>
      </a>
    </li>
  </ul>
  <style>
    .active-menu {
      background-color: blue;
      color: white;
    }
  </style>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Get the current URL
      var currentUrl = window.location.pathname.split('/').pop();
      
      // Create a map of URLs to element IDs
      var urlToIdMap = {
        'admin.php': 'admin',
        'users.php': 'manage-users',
        'categorie.php': 'categories',
        'media.php': 'media-files',
        'bar1.php': 'AddComputer',
        'bar2.php': 'AddMonitor',
        'bar3.php': 'AddKeyboard',
        'bar4.php': 'AddMouse',
        'bar5.php': 'AddSystem',
        'bar6.php': 'AddVGA|HDMI',
        'bar7.php': 'Addpower1',
        'bar8.php': 'Addpower2',
        'bar9.php': 'AddPower1',
        'bar10.php': 'AddPower2',
        'bar11.php': 'AddMotherboard',
        'bar12.php': 'AddCPU',
        'bar13.php': 'AddRAM',
        'bar14.php': 'AddVideoCard',
        'bar15.php': 'AddHDD|SSD|GB',
        'bar16.php': 'Addprinter',
        'bar17.php': 'AddPRINTER',
        'bar18.php': 'AddCctv',
        'bar19.php': 'AddElectricFan',
        'bar20.php': 'AddCable',
        'bar21.php': 'AddSwitchHub',
        'bar22.php': 'AddExtension',
        'addproducts.php': 'sample',
        'add1.php': 'add',
        'add2.php': 'addother',
        'add_product7.php': 'add-other-devices',
        'product.php': 'overall-computer',
        'product1.php': 'faculty',
        'product2.php': 'server-room',
        'product3.php': 'it-comlab1',
        'product4.php': 'it-comlab2',
        'product5.php': 'it-comlab3',
        'product6.php': 'it-comlab4',
        'product7.php': 'other-devices',
        'product8.php': 'print-report'
      };

      // Get the corresponding element ID for the current URL
      var activeElementId = urlToIdMap[currentUrl];

      // If an active element ID is found, add the active class
      if (activeElementId) {
        document.getElementById(activeElementId).classList.add('active-menu');
      }
    });
  </script>