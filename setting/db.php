<?php
try {
	$db = new PDO('mysql:host=127.0.0.1;dbname=u510162695_inventory','u510162695_inventory','1Inventory_system');
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die('<h4 style="color:red">Incorrect Connection Details</h4>');
}