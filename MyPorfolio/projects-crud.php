<?php
require_once 'db-connect.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare('SELECT * FROM projects WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
        } else {
            $stmt = $pdo->query('SELECT * FROM projects');
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        }
        break;

    case 'POST':
        $title = $_POST['project-title'] ?? '';
        $description = $_POST['project-description'] ?? '';
        $tags = $_POST['project-tags'] ?? '';
        $link = $_POST['project-link'] ?? '';
        $image = '';        if (isset($_FILES['project-image']) && $_FILES['project-image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            // Generate a unique filename to avoid overwriting
            $filename = uniqid() . '_' . basename($_FILES['project-image']['name']);
            $image = $uploadDir . $filename;
            
            // Move the uploaded file
            if (move_uploaded_file($_FILES['project-image']['tmp_name'], $image)) {
                // Store just the relative path
                $image = $filename;
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Failed to upload image']);
                exit;
            }
        } elseif (isset($_POST['project-id']) && $_POST['project-id']) {
            $stmt = $pdo->prepare('SELECT image FROM projects WHERE id = ?');
            $stmt->execute([$_POST['project-id']]);
            $image = $stmt->fetchColumn();
        }

        if (isset($_POST['project-id']) && $_POST['project-id']) {
            $stmt = $pdo->prepare('UPDATE projects SET title = ?, description = ?, image = ?, tags = ?, link = ? WHERE id = ?');
            $stmt->execute([$title, $description, $image, $tags, $link, $_POST['project-id']]);
            echo json_encode(['message' => 'Project updated successfully']);
        } else {
            $stmt = $pdo->prepare('INSERT INTO projects (title, description, image, tags, link) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$title, $description, $image, $tags, $link]);
            echo json_encode(['message' => 'Project added successfully']);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare('SELECT image FROM projects WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $image = $stmt->fetchColumn();
            if ($image && file_exists($image)) {
                unlink($image);
            }
            $stmt = $pdo->prepare('DELETE FROM projects WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            echo json_encode(['message' => 'Project deleted successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Project ID required']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['message' => 'Method not allowed']);
        break;
}
?>