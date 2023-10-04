<?php
// Start session
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
var_dump($_POST);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username, password, and additional user information from the form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $country = $_POST["country"];
    $chessRating = $_POST["chessRating"];
    $favoriteOpening = $_POST["favoriteOpening"];
    $title = $_POST["title"];

    // Connect to the database
    $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare a SQL statement to insert the new user
    $stmt = $conn->prepare("INSERT INTO users (username, password, first_name, last_name, email, phone, country, chess_rating, favorite_opening, title) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $username, $hashed_password, $firstName, $lastName, $email, $phone, $country, $chessRating, $favoriteOpening, $title);
   
     $select = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$_POST['username']."'");
  
    // Execute the statement
    if (!mysqli_num_rows($select)&&$stmt->execute()) {
        // Registration successful, redirect to the login page
        header("Location: ../profile/");
        exit();
    }else {
        // Registration failed, redirect back to the registration page with an error
       
        header("Location: ../register/register.php?username=".$username);
        $username = ($_POST["username"]);
       die('Sorry, the Username '.$_POST['username'].' has already been used to register.');
        echo "Error: " . $stmt->error;

        exit();
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
