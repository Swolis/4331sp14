<?php
$data=getRequestInfo();
    $contacts_query = "SELECT * FROM contacts WHERE user_id = ?";
    $stmt = $conn->prepare($contacts_query);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $contacts = $result->fetch_all(MYSQLI_ASSOC);


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
