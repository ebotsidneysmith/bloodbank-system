<?php
// Define database connection variables
$db_host = 'hostname_rds_endpoint'; 
$db_username = 'admin';
$db_password = 'yourpassword';
$db_name = 'yourdbname';

// Create a connection using object-oriented approach
try {
    // Using MySQLi with Object-Oriented approach
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Check if connection was successful
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    } 

} catch (Exception $e) {
    // Catch any exceptions and display error
    echo 'Error: ' . $e->getMessage();
} 
?>

