<?php
// Define constants for database connection details
define( 'DB_HOST', 'localhost' );          // Set database host
define( 'DB_USER', 'root' );             // Set database user
define( 'DB_PASS', '' );             // Set database password
define( 'DB_NAME', 'inventory_system' );        // Set database name
define('DB_PORT', '3306'); // Note: Changed to DB_PORT to align with typical naming conventions

// Attempt to connect to the database
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT;
    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('<h4 style="color:red">Incorrect Connection Details</h4>');
}
?>
