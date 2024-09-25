<?php
date_default_timezone_set('Asia/Manila');
  require_once('includes/load.php');
  if(!$session->logout()) {redirect("L-Login.php?access=allowed");}
?>

