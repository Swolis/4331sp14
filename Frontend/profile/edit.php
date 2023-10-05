<?php
session_start();

header('Content-Type: application/json'); // Specify response type as JSON

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    
    $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");
    
    if ($conn->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'Connection failure']);
        exit();
    }

    // Check if all expected POST data is provided
    $required_fields = ['id', 'name', 'email', 'phone', 'country', 'chess_rating', 'favorite_opening', 'title', 'address', 'notes'];
    foreach($required_fields as $field) {
        if (!isset($_POST[$field])) {
            echo json_encode(['status' => 'error', 'message' => "Missing field: $field"]);
            exit();
        }
    }
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    // Add these lines
    if ($country === null || $country === '') {
        $country = null;
    }
    $chessRating = $_POST['chess_rating'];
    $favoriteOpening = $_POST['favorite_opening'];
    $title = $_POST['title'];
    $address = $_POST['address'];
    $notes = $_POST['notes'];
    
    try {
        $stmt = $conn->prepare("UPDATE contacts SET name =?, email =?, phone=?, country=?, chess_rating=?, favorite_opening=?, title=?, address=?, notes=? WHERE id =? LIMIT 1");
        $stmt->bind_param("ssssissssi", $name, $email, $phone, $country, $chessRating, $favoriteOpening, $title, $address, $notes, $id);
        $stmt->execute();
        
        if ($stmt->error) {
            echo json_encode(['status' => 'error', 'message' => 'Query Error: ' . $stmt->error]);
            exit();
        }
        
        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Record updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No records updated']);
        }
        
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'A server error occurred.']);
        error_log('Error in /path/to/file/edit.php: ' . $e->getMessage());
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request or session']);
    exit();
}
?>
