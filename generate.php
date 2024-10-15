<?php
if (!isset($_GET['access']) || $_GET['access'] !== 'allowed') {
    // Redirect to index.php if the access parameter is not set correctly
    header("Location: index.php");
    exit();
}
?>

<?php
date_default_timezone_set('Asia/Manila');
ob_start();
require_once('includes/load.php');
if($session->isUserLoggedIn(true)) { redirect('home.php', false); }
?>
<!DOCTYPE html>
<html lang="en">
<link rel="icon" type="image/x-icon" href="uploads/users/rizel.png">
<title>Inventory Management System</title>

<?php
include('header.php');
include('admin/db_connect.php');
?>

<style>
    body {
    background: url('uploads/users/riz.png');
    background-size: cover; 
    background-position: center; 
}
    header.masthead {
        background: url(assets/img/ss.png);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
    .iska {
        background: url(assets/image/fontsize.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        margin-right: 5px;
        padding: 25px 25px;
        border-radius: 50% 50%;
        float: left;
        display: flex;
    }
    .contact-link {
        color: black !important; /* Use !important to override any other styles */
    }

</style>

<body id="page-top">
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav" style="background-color: var(--accent-color);">
    <div class="container">
        <a class="iska"></a>
        <a class="navbar-brand js-scroll-trigger" href="index.php" style="color: black;">INVENTORY MANAGEMENT SYSTEM</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="login.php?access=allowed" style="font-size: 20px; color: black;">Login Now</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="page-section" id="menu">
    <div id="menu-field" class="card-deck">
        <?php
        // Fetch products and their images
        $qry = $conn->query("
        SELECT p.id, p.name, m.file_name AS mother_images
        FROM products p
        LEFT JOIN mother m ON p.mother_images = m.id
        WHERE (p.mother_images NOT LIKE '%Maintenance%' 
               AND p.monitor_images NOT LIKE '%Maintenance%' 
               AND p.mouse_images NOT LIKE '%Maintenance%' 
               AND p.system_images NOT LIKE '%Maintenance%' 
               AND p.vgahdmi_images NOT LIKE '%Maintenance%' 
               AND p.power1_images NOT LIKE '%Maintenance%' 
               AND p.power2_images NOT LIKE '%Maintenance%' 
               AND p.chord1_images NOT LIKE '%Maintenance%' 
               AND p.chord2_images NOT LIKE '%Maintenance%' 
               AND p.mother_images NOT LIKE '%Maintenance%' 
               AND p.cpu_images NOT LIKE '%Maintenance%' 
               AND p.ram_images NOT LIKE '%Maintenance%' 
               AND p.video_images NOT LIKE '%Maintenance%' 
               AND p.hddssdgb_images NOT LIKE '%Maintenance%')
        ORDER BY RAND()
    ");
    
        while($row = $qry->fetch_assoc()):
        ?>
        <div class="col-lg-3" style="padding-left: 20px;">
            <div class="card menu-item" style="border-color: gray; border-bottom-right-radius: 15px; border-bottom-left-radius: 15px; margin-bottom: 25px; margin-right: 5px;">
                <?php if ($row['mother_images']): ?>
                    <img src="uploads/products/<?php echo $row['mother_images']; ?>" class="card-img-top" width="100" height="300" alt="Mother Image">
                <?php else: ?>
                    <img src="uploads/products/default.jpg" class="card-img-top" width="100" height="300" alt="Default Image">
                <?php endif; ?>
                <div class="card-body">
                    <center><h5 class="card-title"><?php echo $row['name']; ?></h5></center>
                    <div class="text-center">
                        <form action="generateview.php" method="get" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">
                            <input type="hidden" name="access" value="allowed">
                            <button type="submit" class="btn btn-sm btn-outline-secondary view_prod btn-block" data-toggle="tooltip">
                                <span class="glyphicon"></span> View
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</section>

<script type="text/javascript">
var rev = "silent";
function titlebar(val)
{
    var msg  = "Inventory Management System";
    var res = " ";
    var speed = 70
    var pos = val;

    msg = ""+msg+"";
    var le = msg.length;
    if(rev == "silent"){
        if(pos < le){
        pos = pos+1;
        scroll = msg.substr(0,pos);
        document.title = scroll;
        timer = window.setTimeout("titlebar("+pos+")",speed);
        }
        else{
        rev = "silents";
        timer = window.setTimeout("titlebar("+pos+")",speed);
        }
    }
    else{
        if(pos > 0){
        pos = pos-1;
        var ale = le-pos;
        scrol = msg.substr(ale,le);
        document.title = scrol;
        timer = window.setTimeout("titlebar("+pos+")",speed);
        }
        else{
        rev = "silent";
        timer = window.setTimeout("titlebar("+pos+")",speed);
        }   
    }
}

titlebar(0);
</script>
<script>
    // Disable right-click
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });

    // Disable F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
    document.onkeydown = function (e) {
        if (
            e.key === 'F12' ||
            (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J')) ||
            (e.ctrlKey && e.key === 'U')
        ) {
            e.preventDefault();
        }
    };

    // Disable developer tools
    function disableDevTools() {
        if (window.devtools.isOpen) {
            window.location.href = "about:blank";
        }
    }

    // Check for developer tools every 100ms
    setInterval(disableDevTools, 100);

    // Disable selecting text
    document.onselectstart = function (e) {
        e.preventDefault();
    };
</script>
</body>
<?php $conn->close(); ?>
</html>
