<?php
require_once 'db-connect.php'; // This must return a valid $pdo PDO connection

$username = 'admin1';
$password = 'password123'; // Plain password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash it securely

try {
    // Check if admin already exists
    $checkStmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
    $checkStmt->execute([$username]);
    if ($checkStmt->fetch()) {
        echo "Admin user already exists.";
        exit;
    }

    // Insert new admin
    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $stmt->execute([$username, $hashedPassword]);

    echo "Admin user inserted successfully.";
} catch (PDOException $e) {
    echo "Error inserting admin: " . $e->getMessage();
}
