<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {

// Get the username, password, and additional user information from the form
    

// Connect to the database
    $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a SQL statement to insert the new user
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $name = $_GET['name];
        $email = $_GET['email'];
        $phone = $_GET['phone'];
        $country = $_GET['country'];
        $chessRating = $_GET['chessRating'];
        $favoriteOpening = $_GET['favoriteOpening'];
        $title = $_GET['title'];

        $stmt = $conn->prepare("UPDATE contacts WHERE id = ?");
        $stmt->bind_param("issssiss", $id,$email,$phone,$country,$chessRating,$favoriteOpening,$title);  // Assuming 'id' is an integer
        $stmt->execute();
        
        

    }
    

    // Execute the statement
   

    // Close the connection
    $stmt->close();
    $conn->close();
   header("Location: ../profile/");
    }
?>