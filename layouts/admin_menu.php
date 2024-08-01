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
      <a href="#" class="submenu-toggle" id="add-new">
        <i class="glyphicon glyphicon-th-large"></i>
        <span>Add New</span>
      </a>
      <ul class="nav submenu">
        <li><a href="add_product.php" id="add-product">Add New Computer</a></li>
        <li><a href="add_product7.php" id="add-other-devices">Add New Other Devices</a></li>
      </ul>
    </li>
    <li>
      <a href="#" class="submenu-toggle" id="manage">
        <i class="glyphicon glyphicon-th-large"></i>
        <span>Manage</span>
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
        'add_product.php': 'add-product',
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