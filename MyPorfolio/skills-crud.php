<?php
require_once 'db-connect.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare('SELECT * FROM skills WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
        } else {
            $stmt = $pdo->query('SELECT * FROM skills');
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare('INSERT INTO skills (name, category, progress) VALUES (?, ?, ?)');
        $stmt->execute([$data['name'], $data['category'], $data['progress']]);
        echo json_encode(['message' => 'Skill added successfully']);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare('UPDATE skills SET name = ?, category = ?, progress = ? WHERE id = ?');
        $stmt->execute([$data['name'], $data['category'], $data['progress'], $data['id']]);
        echo json_encode(['message' => 'Skill updated successfully']);
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare('DELETE FROM skills WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            echo json_encode(['message' => 'Skill deleted successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Skill ID required']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['message' => 'Method not allowed']);
        break;
}
?>