<?php
require_once('includes/load.php');
// Check What level user has permission to view this page
page_require_level(2);

$find_extension = find_by_id('extension', (int)$_GET['id']);
$photo = new extension();

if ($photo->extension_destroy($find_extension['id'], $find_extension['file_name'])) {
    $session->msg("s", "Photo has been deleted.");
    redirect('bar22.php?success=true&delete_photo=true'); // Add success parameter
} else {
    $session->msg("d", "Photo deletion failed Or Missing Prm.");
    redirect('bar22.php');
}
?>
