<?php
header('Content-Type: application/json'); // Set the content type to JSON
$response = []; // Initialize an array to hold your response data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Get the username, password, and additional user information from the form
    

// Connect to the database
    $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a SQL statement to insert the new user
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
        $stmt->bind_param("i", $id);  
        $stmt->execute();
        
        if($stmt->affected_rows > 0) {
            $response['status'] = 'success';
            $response['message'] = 'Record deleted successfully';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Record not found or not deleted';
        }

    } else {
        $response['status'] = 'error';
        $response['message'] = 'ID not provided';
    }

    // Close the connection
    $stmt->close();
    $conn->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response); // Echo the response as a JSON string
?>
