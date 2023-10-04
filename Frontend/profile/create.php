<?php
session_start();

if($_SERVER['REQUEST_METHOD']=="POST"){
   $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");
   if ($conn->connect_error) {
            die("Connection failure");
    }

  if(!isset($_SESSION['user_id'])){
    header("https://chessconnect.xyz/");
  }
   
   
    $userid=$_SESSION['user_id'];
  $name=$_GET['name'];
  $email=$_GET['email']??null;
  $phone=$_GET['phone']??null;
  $country=$_GET['country']??null;
  $chessRating=$_GET['chessRating']??null;
  $favoriteOpening=$_GET['favoriteOpening']??null;
  $title=$_GET['title']??null;
  
$stmt = $conn->prepare("INSERT INTO contacts (user_id,name, email, phone, country, chess_rating, favorite_opening, title) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)");
 $stmt->bind_param("issssiss", $userId, $name, $email, $phone, $country, $chessRating, $favoriteOpening, $title);
 $stmt->execute();
 header("https://chessconnect.xyz/");
   
}
?>
