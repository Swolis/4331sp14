<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

error_reporting(E_ALL); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $inData=getRequestInfo();
    $username=$inData['username'];
    
    $password=$inData['password'];
     $firstName=$inData['firstName'];
    $lastName=$_inData['lastName'];
     $email=$_inData['email'];
    $phone=$_inData['phone'];
     $country=$_inData['country'];
    $chessRating=$_inData['chessRating'];
     $favoriteOpening=$_inData['favoriteOpening'];
    $title=$_inData['title'];
    $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

               
               

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
   $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$_inData['username']."'");

    if(mysqli_num_rows($result)>0){
        die();
    }
    
    $stmt = $conn->prepare("INSERT INTO users (username, password, first_name, last_name, email, phone, country, chess_rating, favorite_opening, title) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  
    $stmt->bind_param("ssssssssss", $username, $hashed_password, $firstName, $lastName, $email, $phone, $country, $chessRating, $favoriteOpening, $title);
 if($stmt->execute()){
    
       header("Location:https://chessconnect.xyz/login/login.php");
        exit();
 }
 $stmt->close();
   $conn->close();
}
    
?>
