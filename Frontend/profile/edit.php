<?php
// Connect to the database
    echo "pain";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");
echo "hi";
        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Prepare a SQL statement to insert the new user
        if(isset($_SESSION['user_id'])) {
        $id = $_POST['id'];
            echo $id;
        $name = $_POST['newName'];
            echo $name;
        $email = $_POST['newEmail'];
        $phone = $_POST['newPhone'];
        $country = $_POST['newCountry'];
        $chessRating = $_POST['newRating'];
        $favoriteOpening = $_POST['newOpening'];
        $title = $_POST['newTitle'];
        $address = $_POST['newAddress'];
          $notes=$_POST['newNotes']  ;

        $stmt = $conn->prepare("UPDATE contacts SET name = '$name', email = '$email', phone='$phone', country='$country', chess_rating='$chessRating', favorite_opening='$favoriteOpening', title='$title', address='$address', notes='$notes' WHERE id ='$id'");
       // $stmt->bind_param("ssssisss", $name,$email,$phone,$country,$chessRating,$favoriteOpening,$title,$address,$notes);  // Assuming 'id' is an integer
        $stmt->execute();
            
            

        
        

        // Execute the statement
    

        // Close the connection
        $stmt->close();
        $conn->close();
        header("Location: ../profile/");
        }
    }
?>
