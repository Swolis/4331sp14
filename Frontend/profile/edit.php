<?php
// Connect to the database
    /*if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
echo "hi";
        // Prepare a SQL statement to insert the new user
        if(isset($_SESSION['user_id'])) {
        $id = $_GET['id'];
            echo $id;
        $name = $_GET['newName'];
            echo $name;
        $email = $_GET['newEmail'];
        $phone = $_GET['newPhone'];
        $country = $_GET['newCountry'];
        $chessRating = $_GET['newRating'];
        $favoriteOpening = $_GET['newOpening'];
        $title = $_GET['newTitle'];
        $address = $_GET['newAddress'];
        $notes = $_GET['newNotes'];

        $stmt = $conn->prepare("UPDATE contacts SET name = ".$name.", email = ".$email.", phone=".$phone.", country=".$country.", chess_rating=".$chessRating.", favorite_opening=".$favoriteOpening.", title=".$title.", address=".$address.", notes=".$notes." WHERE id =".$id.);
            //$stmt->bind_param("i", $id);  // Assuming 'id' is an integer
        $stmt->execute();
            
            

        
        

        // Execute the statement
    

        // Close the connection
        $stmt->close();
        $conn->close();
        header("Location: https://chessconnect.xyz/profile/");
        }
    }*/
?>
