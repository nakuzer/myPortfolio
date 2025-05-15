<?php
require_once 'db-connect.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Get all messages
        try {
            $stmt = $pdo->query('SELECT * FROM contact ORDER BY created_at DESC');
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error fetching messages: ' . $e->getMessage()]);
        }
        break;

    case 'DELETE':
        // Delete a message
        if (isset($_GET['id'])) {
            try {
                $stmt = $pdo->prepare('DELETE FROM contact WHERE id = ?');
                $stmt->execute([$_GET['id']]);
                echo json_encode(['success' => true, 'message' => 'Message deleted successfully']);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error deleting message: ' . $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Message ID required']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        break;
}
