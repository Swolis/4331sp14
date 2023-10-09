<?php
  // Establish the database connection
  session_start();   
  $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");

  // Check the connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if (!isset($_SESSION['user_id'])) {
    returnWithError("User ID not found in session. Please log in again.");
  }
                              
  $contacts_query = "SELECT * FROM contacts WHERE user_id = ?";
  $stmt = $conn->prepare($contacts_query);
  $stmt->bind_param("i", $_SESSION["user_id"]);
  $stmt->execute();
  $result = $stmt->get_result();
  $contacts = $result->fetch_all(MYSQLI_ASSOC);
return contacts;
    function getRequestInfo(){
        return json_decode(file_get_contents('php://input'), true);
    }
        
    // send json
    function sendResultInfoAsJson($obj){
        header('Content-type: text/html');
        echo $obj;
    }
        
    // return json with error message
    function returnWithError($err){
        $retValue = '{"error":"' . $err . '"}';
        sendResultInfoAsJson( $retValue );
    }
?>
