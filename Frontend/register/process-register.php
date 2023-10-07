<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header('Content-Type: application/json');
error_reporting(E_ALL); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");


$data=getRequestInfo();
$conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");

// Check the connection
if ($conn->connect_error) {
    returnWithError($conn->connect_error);
}
$stmt = $conn->prepare("INSERT INTO users (username, password, first_name, last_name, email, phone, country, chess_rating, favorite_opening, title) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssiss", $username, $hashed_password, $firstName, $lastName, $email, $phone, $country, $chessRating, $favoriteOpening, $title);

$select = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$data['username']."'");
   // Check if the form is submitted
           

                // Get the username, password, and additional user information from the form
                $username = $data["username"];
                $password = $data["password"];
                $firstName =  $data["firstName"];
                $lastName =  $data["lastName"];
                $email =  $data["email"];
                $phone =  $data["phone"];
                $country =  $data["country"];
                $chessRating =  $data["chessRating"];
                $favoriteOpening = $data["favoriteOpening"];
                $title =  $data["title"];

                // Connect to the database


                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Prepare a SQL statement to insert the new user


                // Execute the statement
                if (!mysqli_num_rows($select)&&$stmt->execute()&&$username!=""&&$password!="") {
                    // Registration successful, redirect to the login page
                    returnWithError("");
                   
                }else {
                    // Registration failed, redirect back to the registration page with an error
                    

                echo('Sorry, the Username '.$_POST['username'].' has already been used to register.');
                returnWithError($conn->error);
                }

                // Close the connection
               
                $stmt->close();
                $conn->close();
        function getRequestInfo()
                {
                return json_decode(file_get_contents('php://input'), true);
                }
                
                // send json
        function sendResultInfoAsJson( $obj )
                {
                header('Content-type: text/html');
                echo $obj;
                }
                
                // return json with error message
        function returnWithError( $err )
                {
                $retValue = '{"error":"' . $err . '"}';
                sendResultInfoAsJson( $retValue );
                }


        ?>


