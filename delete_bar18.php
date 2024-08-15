<?php
require_once('includes/load.php');
// Check What level user has permission to view this page
page_require_level(2);

$find_cctv = find_by_id('cctv', (int)$_GET['id']);
$photo = new cctv();

if ($photo->cctv_destroy($find_cctv['id'], $find_cctv['file_name'])) {
    $session->msg("s", "Photo has been deleted.");
    redirect('bar18.php?success=true&delete_photo=true'); // Add success parameter
} else {
    $session->msg("d", "Photo deletion failed Or Missing Prm.");
    redirect('bar18.php');
}
?>
