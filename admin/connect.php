<?php
// Show all errors (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connection credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "golden_city";

try {
    // Connect using PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Optional: Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Database golden_city is connected successfully";
} catch (PDOException $e) {
    echo "Fail to Connect: " . $e->getMessage();
}
?>