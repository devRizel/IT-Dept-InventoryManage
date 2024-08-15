<?php
require_once('includes/load.php');
// Check What level user has permission to view this page
page_require_level(2);

$find_electric = find_by_id('electric', (int)$_GET['id']);
$photo = new electric();

if ($photo->electric_destroy($find_electric['id'], $find_electric['file_name'])) {
    $session->msg("s", "Photo has been deleted.");
    redirect('bar19.php?success=true&delete_photo=true'); // Add success parameter
} else {
    $session->msg("d", "Photo deletion failed Or Missing Prm.");
    redirect('bar19.php');
}
?>
