<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
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
    $hashedPassword=password_hash($password,PASSWORD_DEFAULT);
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    $result = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");
    if(mysqli_num_rows($result)>0){
        die();
    }else{
     $stmt = $conn->prepare("INSERT INTO users (username,password, first_name, last_name,email, phone, country, chess_rating, favorite_opening, title) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)");
    $stmt->bind_param("sssssssiss",$username,$hashedPassword,$firstName,$lastName,$email,$phone,$country,$chessRating,$favoriteOpening,$title);
    
    $stmt->execute();
    }
   
}
    
?>
