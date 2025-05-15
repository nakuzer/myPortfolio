<?php
session_start();
require_once 'db-connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';

    if (empty($username) || empty($password)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Username and password are required']);
        exit;
    }

    try {
        $stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE username = ?');
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            http_response_code(200);
            echo json_encode(['success' => true, 'message' => 'Login successful']);
            exit;
        }

        // If no match or password incorrect
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
        exit;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        exit;
    }
}

// Method not allowed (non-POST)
http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Method not allowed']);
exit;
?>