<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");
    
        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if (!isset($_SESSION["user_id"])) {
            die("User ID not found in session. Please log in again.");
        }
        
        
        // Assuming you pass user_id from some other source like session
        $userId = $_SESSION["user_id"];
        $name = $_POST["name"];
        $email = $_POST["email"] ?? null;  // Uses null coalescing for optional fields
        $phone = $_POST["phone"] ?? null;
        $country = $_POST["country"] ?? null;
        $chessRating = $_POST["chessRating"] ?? null;
        $favoriteOpening = $_POST["favoriteOpening"] ?? null;
        $title = $_POST["title"] ?? null;
    
        $stmt = $conn->prepare("INSERT INTO contacts (user_id, name, email, phone, country, chess_rating, favorite_opening, title) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $userId, $name, $email, $phone, $country, $chessRating, $favoriteOpening, $title);
        $stmt->execute();
    }

?>
