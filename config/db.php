<?php

$host = 'localhost';
$dbname = 'branch_directory';
$username = 'root';
$password = '';

try {
   
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enable exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Default fetch mode
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Use native prepares
    ]);
} catch (PDOException $e) {
    // Handle connection error
    exit('Database connection failed: ' . $e->getMessage());
}
?>
