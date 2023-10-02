<?php
// Connect to the database
    $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a SQL statement to insert the new user
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $name = $_POST['newName'];
        $email = $_POST['newEmail'];
        $phone = $_POST['newPhone'];
        $country = $_POST['newCountry'];
        $chessRating = $_POST['newRating'];
        $favoriteOpening = $_POST['newOpening'];
        $title = $_POST['newTitle'];
        $address = $_POST['newAddress'];
        $notes = $_POST['newNotes'];

        $stmt = $conn->prepare("UPDATE contacts SET name = '".$name."', email = '".$email."', phone='".$phone."', country='".$country."', chess_rating='".$chessRating."', favorite_opening='".$favoriteOpening."', title='".$title."', address='".$address."', notes='".$notes."' WHERE id = ?");
        //$stmt->bind_param("issssiss", $id,$email,$phone,$country,$chessRating,$favoriteOpening,$title);  // Assuming 'id' is an integer
        $stmt->execute();
        
        

    }
    

    // Execute the statement
   

    // Close the connection
    $stmt->close();
    $conn->close();
    header("Location: https://chessconnect.xyz/profile/");
?>
