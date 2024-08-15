<?php
require_once('includes/load.php');
// Check What level user has permission to view this page
page_require_level(2);

$find_cable = find_by_id('cable', (int)$_GET['id']);
$photo = new cable();

if ($photo->cable_destroy($find_cable['id'], $find_cable['file_name'])) {
    $session->msg("s", "Photo has been deleted.");
    redirect('bar20.php?success=true&delete_photo=true'); // Add success parameter
} else {
    $session->msg("d", "Photo deletion failed Or Missing Prm.");
    redirect('bar20.php');
}
?>
