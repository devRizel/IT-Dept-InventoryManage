<?php
// Set PHP timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');

// Assuming $user and $session are defined elsewhere in your code
$user = current_user();


// // Database configuration
// $servername = "127.0.0.1";
// $username = "u510162695_inventory";
// $password = "1Inventory_system";
// $dbname = "u510162695_inventory";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // SQL query to select data from the table, ordered by most recent first
// $sql = "SELECT id, name, email, message, created_at FROM chat ORDER BY created_at DESC";
// $result = $conn->query($sql);

// // Count total messages
// $count_sql = "SELECT COUNT(*) AS total FROM chat";
// $count_result = $conn->query($count_sql);
// $count_row = $count_result->fetch_assoc();
// $message_count = $count_row['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php if (!empty($page_title))
           echo remove_junk($page_title);
            elseif(!empty($user))
           echo ucfirst($user['name']);
            else echo "Inventory Management System";?>
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
    <style>
    .dropdown-content {
        display: none;
        padding: 8px;
        border: 1px solid #ddd;
        margin-top: 8px;
        background-color: #f9f9f9;
    }
    .name {
        cursor: pointer;
        color: black;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-left: 15px;
        padding-right: 15px;
    }
    .name:hover {
        color: gray;
    }
    .timestamp {
        color: #888;
        font-size: 0.85em;
    }
    .modal-body {
        max-height: 400px;
        overflow-y: auto;
    }
    .dropdown-content {
        display: none;
        padding: 8px;
        padding-left: 20px;
        padding-right: 20px;
        border: 1px solid #ddd;
        margin-top: 8px;
        background-color: #f9f9f9;
        border-color: var(--accent-color);
    }
    .modal-content {
        border-radius: 50% 10% 50% 10% / 10% 50% 10% 50%;
    }
    .notification-container {
        position: relative;
        display: inline-block;
    }
    .notification-container img {
        width: 50px;
        height: auto;
        margin-bottom: 0;
    }
    .badge {
        position: absolute;
        top: 0px;
        left: -10px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
        transform: translate(50%, 50%); /* Adjusts position slightly */
    }
    .delete-btn-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.delete-btn {
    margin-left: auto;
}

    </style>
    <script>
    function toggleDropdown(id) {
        var content = document.getElementById("content-" + id);
        if (content.style.display === "none" || content.style.display === "") {
            content.style.display = "block";
        } else {
            content.style.display = "none";
        }
    }
    </script>
</head>
<body>
<?php if ($session->isUserLoggedIn(true)): ?>
    <header id="header">
        <div class="logo pull-left"> IT Department</div>
        <div class="header-content">
            <div class="header-date pull-left">
                <strong><?php echo date("F j, Y, g:i a");?></strong>
            </div>
            <div class="pull-right clearfix">
                <ul class="info-menu list-inline list-unstyled">
                    <!-- <li class="notification-container">
                    <?php if (remove_junk(ucfirst($user['name'])) === 'Rizel Bracero'): ?>
                        <img src="uploads/users/icon.png" alt="IT Department Logo"
                             style="width: 50px; height: auto; margin-bottom: 0px;" data-toggle="modal" data-target="#myModal">
                        <?php if ($message_count > 0): ?>
                            <span class="badge"><?php echo $message_count; ?></span>
                        <?php endif; ?>
                        <?php endif; ?>
                    </li> -->
                    <li class="profile">
                        <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
                            <img src="uploads/users/<?php echo $user['image'];?>" alt="user-image" class="img-circle img-inline">
                            <span><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="profile.php?id=<?php echo (int)$user['id'];?>">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="edit_account.php" title="edit account">
                                    <i class="glyphicon glyphicon-cog"></i>
                                    Settings
                                </a>
                            </li>
                            <li class="last">
                                <a href="logout.php">
                                    <i class="glyphicon glyphicon-off"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="sidebar">
        <?php if($user['user_level'] === '1'): ?>
            <!-- admin menu -->
            <?php include_once('admin_menu.php');?>

        <?php elseif($user['user_level'] === '2'): ?>
            <!-- Special user -->
            <?php include_once('special_menu.php');?>

        <?php elseif($user['user_level'] === '3'): ?>
            <!-- User menu -->
            <?php include_once('user_menu.php');?>

        <?php endif;?>
    </div>
<?php endif;?>

<div class="page">
  <div class="container-fluid">
  <!-- <div class="page">
    <div class="container-fluid">
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <center><h4 class="modal-title"><strong>System Message</strong></h4></center>
                    </div>
                    <div class="modal-body">
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $created_at = date("F j, Y", strtotime($row["created_at"]));
            echo "<div>";
            echo "<p class='name' onclick='toggleDropdown(" . $row["id"] . ")'>";
            echo "<span>" . strtoupper($row["name"]) . "</span>";
            echo "<span class='timestamp'>" . $created_at . "</span>";
            echo "</p>";
            echo "<div id='content-" . $row["id"] . "' class='dropdown-content'>";
            echo "<div class='delete-btn-container'>";
            echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
            // SweetAlert delete button
            echo "<a href='#' class='btn btn-danger btn-xs delete-btn' title='Delete' onclick='confirmDelete(" . $row["id"] . ")'>";
            echo "<span class='glyphicon glyphicon-trash'></span> Delete</a>";
            echo "</div>"; // Close the delete-btn-container div
            echo "<p><strong>Message:</strong> " . $row["message"] . "</p>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No results found.</p>";
    }
    ?>
</div> -->

                </div>

            </div>
        </div>
    </div>
  </div>
  <script>
function confirmDelete(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this message!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            // If confirmed, redirect to the delete_message.php page
            window.location.href = "delete_message.php?id=" + id;
        }
    });
}
</script>
