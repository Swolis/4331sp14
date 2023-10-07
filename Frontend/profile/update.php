  <?php

 if (!isset($_SESSION['user_id'])) {
            returnWithError("User ID not found in session. Please log in again.");
        }
  session_start();                              
$contacts_query = "SELECT * FROM contacts WHERE user_id = ?";
$stmt = $conn->prepare($contacts_query);
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();
 $result = $stmt->get_result();
$contacts = $result->fetch_all(MYSQLI_ASSOC);
?>
