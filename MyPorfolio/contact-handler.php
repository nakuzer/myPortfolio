<?php
require_once 'db-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'contact-name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'contact-email', FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, 'contact-subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'contact-message', FILTER_SANITIZE_STRING);    try {
        // Insert the message into contact table
        $stmt = $pdo->prepare("INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $result = $stmt->execute([$name, $email, $subject, $message]);

        if ($result) {
            $response = [
                'success' => true,
                'message' => 'Thank you for your message! I will get back to you soon.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Sorry, there was an error sending your message.'
            ];
        }
    } catch (PDOException $e) {
        $response = [
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ];
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
