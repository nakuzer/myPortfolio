<?php
require_once 'db-connect.php';

try {
    $stmt = $pdo->query('SELECT 1');
    if ($stmt) {
        echo "Connection successful!\n";
        print_r($pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS));
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
?>