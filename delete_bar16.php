<?php
require_once('includes/load.php');
// Check What level user has permission to view this page
page_require_level(2);

$find_tv = find_by_id('tv', (int)$_GET['id']);
$photo = new tv();

if ($photo->tv_destroy($find_tv['id'], $find_tv['file_name'])) {
    $session->msg("s", "Photo has been deleted.");
    redirect('bar16.php?success=true&delete_photo=true'); // Add success parameter
} else {
    $session->msg("d", "Photo deletion failed Or Missing Prm.");
    redirect('bar16.php');
}
?>
