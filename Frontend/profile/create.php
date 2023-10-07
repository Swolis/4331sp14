<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
    header('Content-Type: application/json');
    error_reporting(E_ALL); // reports all errors
    ini_set("display_errors", "1"); // shows all errors
    ini_set("log_errors", 1);
    ini_set("error_log", "/tmp/php-error.log");


    $data=getRequestInfo();
        $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");
    
        // Check the connection
        if ($conn->connect_error) {
            returnWithError($conn->connect_error);
        }
        if (!isset($_SESSION['user_id'])) {
            returnWithError("User ID not found in session. Please log in again.");
        }
        
        
        // Assuming you pass user_id from some other source like session
        $userId = $_SESSION['user_id'];
        $name = $data['name'];
        $email = $data['email'] ?? null;  // Uses null coalescing for optional fields
        $phone = $data['phone'] ?? null;
        $country = $data['country'] ?? null;
        $chess_rating = $data['chessRating'] ?? null;
        $favoriteOpening =$data['favoriteOpening'] ?? null;
        $title = $data['title'] ?? null;
        $address = $data['address'] ?? null;
        $notes = $data['notes'] ?? null;
    if($name!=""){
        $stmt = $conn->prepare("INSERT INTO contacts (user_id, name, email, phone, country, chess_rating, favorite_opening, title) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssiss", $userId, $name, $email, $phone, $country, $chessRating, $favoriteOpening, $title);
        $stmt->execute();
        sendResultInfoAsJson(1);
    }
        function getRequestInfo()
        {
        return json_decode(file_get_contents('php://input'), true);
        }
        
        // send json
function sendResultInfoAsJson( $obj )
        {
        header('Content-type: text/html');
        echo $obj;
        }
        
        // return json with error message
function returnWithError( $err )
        {
        $retValue = '{"error":"' . $err . '"}';
        sendResultInfoAsJson( $retValue );
        }

?>
