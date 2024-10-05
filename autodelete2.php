<?php
require_once('includes/load.php');

if (isset($_POST['delete_selected'])) {
    // Handle bulk deletion
    if (isset($_POST['rooms']) && !empty($_POST['rooms'])) {
        foreach ($_POST['rooms'] as $room_id) {
            $room_id = (int)$room_id;
            delete_by_id('chat', $room_id);
        }
        $session->msg("s", "Selected chats deleted successfully.");
        redirect('autodelete.php?success=true&delete_room=true'); // Add success parameter
    } else {
        $session->msg("d", "No rooms selected for deletion.");
        redirect('autodelete.php');
    }
} else {
    // Handle individual deletion via GET
    if (isset($_GET['id'])) {
        $product = find_by_id('chat', (int)$_GET['id']);
        if (!$product) {
            $session->msg("d", "Missing chat id.");
            redirect('autodelete.php');
        }
        $delete_id = delete_by_id('chat', (int)$product['id']);
        if ($delete_id) {
            $session->msg("s", "Chat deleted successfully.");
            redirect('autodelete.php?success=true&delete_room=true');
        } else {
            $session->msg("d", "Chat deletion failed.");
            redirect('autodelete.php');
        }
    }
}
?>
