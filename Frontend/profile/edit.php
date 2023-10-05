<?php
// Connect to the database
 
session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failure");
        }
        
        // Prepare a SQL statement to insert the new user
        if(isset($_SESSION['user_id'])) {
            $id = $_POST['id'];
            $name = $_POST['newName'];
            $email = $_POST['newEmail'];
            $phone = $_POST['newPhone'];
            $country = $_POST['newCountry'];
            $chessRating = $_POST['newRating'];
            $favoriteOpening = $_POST['newOpening'];
            $title = $_POST['newTitle'];
            $address = $_POST['newAddress'];
            $notes=$_POST['newNotes']  ;

        $stmt = $conn->prepare("UPDATE contacts SET name =?, email =?, phone=?, country=?, chess_rating=?, favorite_opening=?, title=?, address=?, notes=? WHERE id =? LIMIT 1");
       $stmt->bind_param("ssssissssi",$name,$email,$phone,$country,$chessRating,$favoriteOpening,$title,$address,$notes,$id);  // Assuming 'id' is an integer
        $stmt->execute();
            
            

        
        

        // Execute the statement
    

        // Close the connection
        $stmt->close();
        $conn->close();
        header("Location: ../profile/");
        }
    }
?>
