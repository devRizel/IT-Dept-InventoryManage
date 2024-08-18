<?php
date_default_timezone_set('Asia/Manila');
$page_title = 'Edit Computer';
require_once('includes/load.php');
page_require_level(2);

$product = find_by_id('products', (int)$_GET['id']);
$all_computer = find_all('computer');
$all_monitor = find_all('monitor');
$all_keyboard = find_all('keyboard');
$all_mouse = find_all('mouse');
$all_system = find_all('system');
$all_vgahdmi = find_all('vgahdmi');
$all_power1 = find_all('power1');
$all_power2 = find_all('power2');
$all_chord1 = find_all('chord1');
$all_chord2 = find_all('chord2');
$all_mother = find_all('mother');
$all_cpu = find_all('cpu');
$all_ram = find_all('ram');
$all_video = find_all('video');
$all_hddssdgb = find_all('hddssdgb');

// Handle image selection
if (isset($_POST['submit'])) {
    $fields = [
        'computer_images' => $all_computer,
        'monitor_images' => $all_monitor,
        'keyboard_images' => $all_keyboard,
        'mouse_images' => $all_mouse,
        'system_images' => $all_system,
        'vgahdmi_images' => $all_vgahdmi,
        'power1_images' => $all_power1,
        'power2_images' => $all_power2,
        'chord1_images' => $all_chord1,
        'chord2_images' => $all_chord2,
        'mother_images' => $all_mother,
        'cpu_images' => $all_cpu,
        'ram_images' => $all_ram,
        'video_images' => $all_video,
        'hddssdgb_images' => $all_hddssdgb
    ];

    foreach ($fields as $field => $images) {
        if (isset($_POST[$field])) {
            $selected_image_id = (int)$_POST[$field];
            $query = "UPDATE products SET {$field} = '{$selected_image_id}' WHERE id = '{$product['id']}'";
            $db->query($query);
        }
    }
    redirect('product.php?success=true&update_success=true', false);
}

include_once('layouts/header.php');

// Get IDs of images already saved in the database for this product
$saved_images = [
    'computer_images' => $product['computer_images'],
    'monitor_images' => $product['monitor_images'],
    'keyboard_images' => $product['keyboard_images'],
    'mouse_images' => $product['mouse_images'],
    'system_images' => $product['system_images'],
    'vgahdmi_images' => $product['vgahdmi_images'],
    'power1_images' => $product['power1_images'],
    'power2_images' => $product['power2_images'],
    'chord1_images' => $product['chord1_images'],
    'chord2_images' => $product['chord2_images'],
    'mother_images' => $product['mother_images'],
    'cpu_images' => $product['cpu_images'],
    'ram_images' => $product['ram_images'],
    'video_images' => $product['video_images'],
    'hddssdgb_images' => $product['hddssdgb_images'],
    // Add other image fields as needed
];
?>
<center><h1>Overall Views</h1></center>
<div class="panel-body">
    <form method="post" action="overallmain.php?id=<?php echo (int)$product['id'] ?>">
        <div class="container">
            <div class="row custom-gutter">
                <div class="col-md-2 col-6 mb-3">
                    <label for="computer_images" class="d-block">Computer Barcode</label>
                    <div class="img-container">
                        <?php
                        if (isset($saved_images['computer_images'])) {
                            $saved_image_id = $saved_images['computer_images'];
                            foreach ($all_computer as $photo) {
                                if ($photo['id'] == $saved_image_id) {
                                    echo '<img class="img-thumbnail selected" 
                                          src="uploads/products/' . $photo['file_name'] . '" 
                                          alt="' . $photo['file_name'] . '" 
                                          onclick="selectImage(\'' . $photo['id'] . '\', \'computer_images\')">';
                                }
                            }
                        }
                        if (empty($saved_images['computer_images']) || $saved_images['computer_images'] === '0') {
                            echo '<img class="img-thumbnail" src="uploads/products/no_image.png" alt="No Image Available">';
                        }
                        ?>
                    </div>
                    <input type="hidden" id="computer_images" name="computer_images" value="<?php echo (int)$saved_images['computer_images']; ?>">
                </div>

                <div class="col-md-2 col-6 mb-3">
                    <label for="monitor_images" class="d-block">Monitor Barcode</label>
                    <div class="img-container">
                        <?php
                        if (isset($saved_images['monitor_images'])) {
                            $saved_image_id = $saved_images['monitor_images'];
                            foreach ($all_monitor as $photo) {
                                if ($photo['id'] == $saved_image_id) {
                                    echo '<img class="img-thumbnail selected" 
                                          src="uploads/products/' . $photo['file_name'] . '" 
                                          alt="' . $photo['file_name'] . '" 
                                          onclick="selectImage(\'' . $photo['id'] . '\', \'monitor_images\')">';
                                }
                            }
                        }
                        if (empty($saved_images['monitor_images']) || $saved_images['monitor_images'] === '0') {
                            echo '<img class="img-thumbnail" src="uploads/products/no_image.png" alt="No Image Available">';
                        }
                        ?>
                    </div>
                    <input type="hidden" id="monitor_images" name="monitor_images" value="<?php echo (int)$saved_images['monitor_images']; ?>">
                </div>


                <div class="col-md-2 col-6 mb-3">
    <label for="keyboard_images" class="d-block">Keyboard Barcode</label>
    <div class="img-container">
        <?php
        if (isset($saved_images['keyboard_images'])) {
            $saved_image_id = $saved_images['keyboard_images'];
            foreach ($all_keyboard as $photo) {
                if ($photo['id'] == $saved_image_id) {
                    echo '<img class="img-thumbnail selected" 
                          src="uploads/products/' . $photo['file_name'] . '" 
                          alt="' . $photo['file_name'] . '" 
                          onclick="selectImage(\'' . $photo['id'] . '\', \'keyboard_images\')">';
                }
            }
        }
        if (empty($saved_images['keyboard_images']) || $saved_images['keyboard_images'] === '0') {
            echo '<img class="img-thumbnail" src="uploads/products/no_image.png" alt="No Image Available">';
        }
        ?>
    </div>
    <input type="hidden" id="keyboard_images" name="keyboard_images" value="<?php echo (int)$saved_images['keyboard_images']; ?>">
</div>

<div class="col-md-2 col-6 mb-3">
    <label for="mouse_images" class="d-block">Mouse Barcode</label>
    <div class="img-container">
        <?php
        if (isset($saved_images['mouse_images'])) {
            $saved_image_id = $saved_images['mouse_images'];
            foreach ($all_mouse as $photo) {
                if ($photo['id'] == $saved_image_id) {
                    echo '<img class="img-thumbnail selected" 
                          src="uploads/products/' . $photo['file_name'] . '" 
                          alt="' . $photo['file_name'] . '" 
                          onclick="selectImage(\'' . $photo['id'] . '\', \'mouse_images\')">';
                }
            }
        }
        if (empty($saved_images['mouse_images']) || $saved_images['mouse_images'] === '0') {
            echo '<img class="img-thumbnail" src="uploads/products/no_image.png" alt="No Image Available">';
        }
        ?>
    </div>
    <input type="hidden" id="mouse_images" name="mouse_images" value="<?php echo (int)$saved_images['mouse_images']; ?>">
</div>

<div class="col-md-2 col-6 mb-3">
    <label for="system_images" class="d-block">System Unit Barcode</label>
    <div class="img-container">
        <?php
        if (isset($saved_images['system_images'])) {
            $saved_image_id = $saved_images['system_images'];
            foreach ($all_system as $photo) {
                if ($photo['id'] == $saved_image_id) {
                    echo '<img class="img-thumbnail selected" 
                          src="uploads/products/' . $photo['file_name'] . '" 
                          alt="' . $photo['file_name'] . '" 
                          onclick="selectImage(\'' . $photo['id'] . '\', \'system_images\')">';
                }
            }
        }
        if (empty($saved_images['system_images']) || $saved_images['system_images'] === '0') {
            echo '<img class="img-thumbnail" src="uploads/products/no_image.png" alt="No Image Available">';
        }
        ?>
    </div>
    <input type="hidden" id="system_images" name="system_images" value="<?php echo (int)$saved_images['system_images']; ?>">
</div>

<div class="col-md-2 col-6 mb-3">
    <label for="vgahdmi_images" class="d-block">VGA|HDMI Barcode</label>
    <div class="img-container">
        <?php
        if (isset($saved_images['vgahdmi_images'])) {
            $saved_image_id = $saved_images['vgahdmi_images'];
            foreach ($all_vgahdmi as $photo) {
                if ($photo['id'] == $saved_image_id) {
                    echo '<img class="img-thumbnail selected" 
                          src="uploads/products/' . $photo['file_name'] . '" 
                          alt="' . $photo['file_name'] . '" 
                          onclick="selectImage(\'' . $photo['id'] . '\', \'vgahdmi_images\')">';
                }
            }
        }
        if (empty($saved_images['vgahdmi_images']) || $saved_images['vgahdmi_images'] === '0') {
            echo '<img class="img-thumbnail" src="uploads/products/no_image.png" alt="No Image Available">';
        }
        ?>
    </div>
    <input type="hidden" id="vgahdmi_images" name="vgahdmi_images" value="<?php echo (int)$saved_images['vgahdmi_images']; ?>">
</div>

<div class="col-md-2 col-6 mb-3">
    <label for="power1_images" class="d-block">Power Supply1 Barcode</label>
    <div class="img-container">
        <?php
        if (isset($saved_images['power1_images'])) {
            $saved_image_id = $saved_images['power1_images'];
            foreach ($all_power1 as $photo) {
                if ($photo['id'] == $saved_image_id) {
                    echo '<img class="img-thumbnail selected" 
                          src="uploads/products/' . $photo['file_name'] . '" 
                          alt="' . $photo['file_name'] . '" 
                          onclick="selectImage(\'' . $photo['id'] . '\', \'power1_images\')">';
                }
            }
        }
        if (empty($saved_images['power1_images']) || $saved_images['power1_images'] === '0') {
            echo '<img class="img-thumbnail" src="uploads/products/no_image.png" alt="No Image Available">';
        }
        ?>
    </div>
    <input type="hidden" id="power1_images" name="power1_images" value="<?php echo (int)$saved_images['power1_images']; ?>">
</div>

<div class="col-md-2 col-6 mb-3">
    <label for="power2_images" class="d-block">Power Supply2 Barcode</label>
    <div class="img-container">
        <?php
        if (isset($saved_images['power2_images'])) {
            $saved_image_id = $saved_images['power2_images'];
            foreach ($all_power2 as $photo) {
                if ($photo['id'] == $saved_image_id) {
                    echo '<img class="img-thumbnail selected" 
                          src="uploads/products/' . $photo['file_name'] . '" 
                          alt="' . $photo['file_name'] . '" 
                          onclick="selectImage(\'' . $photo['id'] . '\', \'power2_images\')">';
                }
            }
        }
        if (empty($saved_images['power2_images']) || $saved_images['power2_images'] === '0') {
            echo '<img class="img-thumbnail" src="uploads/products/no_image.png" alt="No Image Available">';
        }
        ?>
    </div>
    <input type="hidden" id="power2_images" name="power2_images" value="<?php echo (int)$saved_images['power2_images']; ?>">
</div>

<div class="col-md-2 col-6 mb-3">
    <label for="chord1_images" class="d-block">Power Chord1 Barcode</label>
    <div class="img-container">
        <?php
        if (isset($saved_images['chord1_images'])) {
            $saved_image_id = $saved_images['chord1_images'];
            foreach ($all_chord1 as $photo) {
                if ($photo['id'] == $saved_image_id) {
                    echo '<img class="img-thumbnail selected" 
                          src="uploads/products/' . $photo['file_name'] . '" 
                          alt="' . $photo['file_name'] . '" 
                          onclick="selectImage(\'' . $photo['id'] . '\', \'chord1_images\')">';
                }
            }
        }
        if (empty($saved_images['chord1_images']) || $saved_images['chord1_images'] === '0') {
            echo '<img class="img-thumbnail" src="uploads/products/no_image.png" alt="No Image Available">';
        }
        ?>
    </div>
    <input type="hidden" id="chord1_images" name="chord1_images" value="<?php echo (int)$saved_images['chord1_images']; ?>">
</div>

<div class="col-md-2 col-6 mb-3">
    <label for="chord2_images" class="d-block">Power Chord2 Barcode</label>
    <div class="img-container">
        <?php
        if (isset($saved_images['chord2_images'])) {
            $saved_image_id = $saved_images['chord2_images'];
            foreach ($all_chord2 as $photo) {
                if ($photo['id'] == $saved_image_id) {
                    echo '<img class="img-thumbnail selected" 
                          src="uploads/products/' . $photo['file_name'] . '" 
                          alt="' . $photo['file_name'] . '" 
                          onclick="selectImage(\'' . $photo['id'] . '\', \'chord2_images\')">';
                }
            }
        }
        if (empty($saved_images['chord2_images']) || $saved_images['chord2_images'] === '0') {
            echo '<img class="img-thumbnail" src="uploads/products/no_image.png" alt="No Image Available">';
        }
        ?>
    </div>
    <input type="hidden" id="chord2_images" name="chord2_images" value="<?php echo (int)$saved_images['chord2_images']; ?>">
</div>

<div class="col-md-2 col-6 mb-3">
    <label for="mother_images" class="d-block">Motherboard Barcode</label>
    <div class="img-container">
        <?php
        if (isset($saved_images['mother_images'])) {
            $saved_image_id = $saved_images['mother_images'];
            foreach ($all_mother as $photo) {
                if ($photo['id'] == $saved_image_id) {
                    echo '<img class="img-thumbnail selected" 
                          src="uploads/products/' . $photo['file_name'] . '" 
                          alt="' . $photo['file_name'] . '" 
                          onclick="selectImage(\'' . $photo['id'] . '\', \'mother_images\')">';
                }
            }
        }
        if (empty($saved_images['mother_images']) || $saved_images['mother_images'] === '0') {
            echo '<img class="img-thumbnail" src="uploads/products/no_image.png" alt="No Image Available">';
        }
        ?>
    </div>
    <input type="hidden" id="mother_images" name="mother_images" value="<?php echo (int)$saved_images['mother_images']; ?>">
</div>

<div class="col-md-2 col-6 mb-3">
    <label for="cpu_images" class="d-block">Motherboard Barcode</label>
    <div class="img-container">
        <?php
        if (isset($saved_images['cpu_images'])) {
            $saved_image_id = $saved_images['cpu_images'];
            foreach ($all_cpu as $photo) {
                if ($photo['id'] == $saved_image_id) {
                    echo '<img class="img-thumbnail selected" 
                          src="uploads/products/' . $photo['file_name'] . '" 
                          alt="' . $photo['file_name'] . '" 
                          onclick="selectImage(\'' . $photo['id'] . '\', \'cpu_images\')">';
                }
            }
        }
        if (empty($saved_images['cpu_images']) || $saved_images['cpu_images'] === '0') {
            echo '<img class="img-thumbnail" src="uploads/products/no_image.png" alt="No Image Available">';
        }
        ?>
    </div>
    <input type="hidden" id="cpu_images" name="cpu_images" value="<?php echo (int)$saved_images['cpu_images']; ?>">
</div>

<div class="col-md-2 col-6 mb-3">
    <label for="ram_images" class="d-block">Motherboard Barcode</label>
    <div class="img-container">
        <?php
        if (isset($saved_images['ram_images'])) {
            $saved_image_id = $saved_images['ram_images'];
            foreach ($all_ram as $photo) {
                if ($photo['id'] == $saved_image_id) {
                    echo '<img class="img-thumbnail selected" 
                          src="uploads/products/' . $photo['file_name'] . '" 
                          alt="' . $photo['file_name'] . '" 
                          onclick="selectImage(\'' . $photo['id'] . '\', \'ram_images\')">';
                }
            }
        }
        if (empty($saved_images['ram_images']) || $saved_images['ram_images'] === '0') {
            echo '<img class="img-thumbnail" src="uploads/products/no_image.png" alt="No Image Available">';
        }
        ?>
    </div>
    <input type="hidden" id="ram_images" name="ram_images" value="<?php echo (int)$saved_images['ram_images']; ?>">
</div>

<div class="col-md-2 col-6 mb-3">
    <label for="video_images" class="d-block">Motherboard Barcode</label>
    <div class="img-container">
        <?php
        if (isset($saved_images['video_images'])) {
            $saved_image_id = $saved_images['video_images'];
            foreach ($all_video as $photo) {
                if ($photo['id'] == $saved_image_id) {
                    echo '<img class="img-thumbnail selected" 
                          src="uploads/products/' . $photo['file_name'] . '" 
                          alt="' . $photo['file_name'] . '" 
                          onclick="selectImage(\'' . $photo['id'] . '\', \'video_images\')">';
                }
            }
        }
        if (empty($saved_images['video_images']) || $saved_images['video_images'] === '0') {
            echo '<img class="img-thumbnail" src="uploads/products/no_image.png" alt="No Image Available">';
        }
        ?>
    </div>
    <input type="hidden" id="video_images" name="video_images" value="<?php echo (int)$saved_images['video_images']; ?>">
</div>

<div class="col-md-2 col-6 mb-3">
    <label for="hddssdgb_images" class="d-block">Motherboard Barcode</label>
    <div class="img-container">
        <?php
        if (isset($saved_images['hddssdgb_images'])) {
            $saved_image_id = $saved_images['hddssdgb_images'];
            foreach ($all_hddssdgb as $photo) {
                if ($photo['id'] == $saved_image_id) {
                    echo '<img class="img-thumbnail selected" 
                          src="uploads/products/' . $photo['file_name'] . '" 
                          alt="' . $photo['file_name'] . '" 
                          onclick="selectImage(\'' . $photo['id'] . '\', \'hddssdgb_images\')">';
                }
            }
        }
        if (empty($saved_images['hddssdgb_images']) || $saved_images['hddssdgb_images'] === '0') {
            echo '<img class="img-thumbnail" src="uploads/products/no_image.png" alt="No Image Available">';
        }
        ?>
    </div>
    <input type="hidden" id="hddssdgb_images" name="hddssdgb_images" value="<?php echo (int)$saved_images['hddssdgb_images']; ?>">
</div>

            </div>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>
<style>
  .img-container {
    width: 100%;
    height: 150px; /* Adjust the height as needed */
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #ddd; /* Optional border */
    overflow: hidden;
    background-color: #f9f9f9; /* Optional background color */
}

.img-container img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover; /* Ensures the image covers the container without distortion */
}

</style>