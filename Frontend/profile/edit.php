<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {

// Get the username, password, and additional user information from the form
    

// Connect to the database
    $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $dochtml = new DOMDocument();
    $dochtml->loadHTMLFile('index.php');

    // Prepare a SQL statement to insert the new user
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $name = $dochtml->getElementById('edit-name');
        echo $name;
        $email = $dochtml->getElementById('edit-email');
        $phone = $dochtml->getElementById('edit-phone');
        $country = $dochtml->getElementById('edit-country');
        $chessRating = $dochtml->getElementById('edit-rating');
        $favoriteOpening = $dochtml->getElementById('edit-opening');
        $title = $dochtml->getElementById('edit-title');

        $stmt = $conn->prepare("UPDATE contacts WHERE id = ?");
        $stmt->bind_param("issssiss", $id,$email,$phone,$country,$chessRating,$favoriteOpening,$title);  // Assuming 'id' is an integer
        $stmt->execute();
        
        

    }
    

    // Execute the statement
   

    // Close the connection
    $stmt->close();
    $conn->close();
   header("Location: https://chessconnect.xyz/profile/");
    }
?>
