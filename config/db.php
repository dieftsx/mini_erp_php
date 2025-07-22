<?php
// config/database.php
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');

function getDBConnection() {
    global $host, $dbname, $user, $pass;
    
    $conn = new mysqli($host, $user, $pass, $dbname);
    
    if ($conn->connect_error) {
        error_log("Connection failed: " . $conn->connect_error);
        die("Database connection error");
    }
    
    return $conn;
}