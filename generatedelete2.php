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
        redirect('generatedelete.php?access=allowed&success=true&delete_room=true'); // Corrected URL
    } else {
        $session->msg("d", "No rooms selected for deletion.");
        redirect('generatedelete.php?access=allowed');
    }
} else {
    // Handle individual deletion via GET
    if (isset($_GET['id'])) {
        $product = find_by_id('chat', (int)$_GET['id']);
        if (!$product) {
            $session->msg("d", "Missing chat id.");
            redirect('generatedelete.php?access=allowed');
        }
        $delete_id = delete_by_id('chat', (int)$product['id']);
        if ($delete_id) {
            $session->msg("s", "Chat deleted successfully.");
            redirect('generatedelete.php?access=allowed&success=true&delete_room=true'); // Corrected URL
        } else {
            $session->msg("d", "Chat deletion failed.");
            redirect('generatedelete.php?access=allowed');
        }
    }
}
?>
