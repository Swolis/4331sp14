<?php

//if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];
     $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
     $email=$_POST['email'];
    $phone=$_POST['phone'];
     $country=$_POST['country'];
    $chessRating=$_POST['chessRating'];
     $favoriteOpening=$_POST['favoriteOpening'];
    $title=$_POST['title'];
    $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

               
               
$select = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$_POST['username']."'");
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
   $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$_POST['username']."'");

    if(mysqli_num_rows($result)>0){
        header("Location:../register/register.php");
        exit();
    }
    $stmt = $conn->prepare("INSERT INTO users (username, password, first_name, last_name, email, phone, country, chess_rating, favorite_opening, title) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    echo "hi";
    $stmt->bind_param("sssssssiss", $username, $hashed_password, $firstName, $lastName, $email, $phone, $country, $chessRating, $favoriteOpening, $title);
echo $_POST['username'];
 $stmt->close();
   $conn->close();
//}
    
?>
