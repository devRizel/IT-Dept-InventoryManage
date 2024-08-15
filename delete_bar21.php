<?php
require_once('includes/load.php');
// Check What level user has permission to view this page
page_require_level(2);

$find_switchs = find_by_id('switchs', (int)$_GET['id']);
$photo = new switchs();

if ($photo->switchs_destroy($find_switchs['id'], $find_switchs['file_name'])) {
    $session->msg("s", "Photo has been deleted.");
    redirect('bar21.php?success=true&delete_photo=true'); // Add success parameter
} else {
    $session->msg("d", "Photo deletion failed Or Missing Prm.");
    redirect('bar21.php');
}
?>
