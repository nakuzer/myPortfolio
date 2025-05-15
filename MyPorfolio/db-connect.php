<?php
header('Content-Type: application/json');

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=portfolio_db',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}
?>