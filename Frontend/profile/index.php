<?php
// Start the session
session_start();

// Check if the user is logged in, if not redirect to the login page
if (!isset($_SESSION["username"])) {
    header("Location: login/");
    exit();
}

// Establish the database connection
$conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
// Fetch user details from the session
$userDetails = [
    "username" => $_SESSION["username"],
    "email" => $_SESSION["email"],
    "country" => $_SESSION["country"],
    "first_name" => $_SESSION["first_name"],
    "last_name" => $_SESSION["last_name"],
    "phone" => $_SESSION["phone"],
    "chess_rating" => $_SESSION["chess_rating"],
    "favorite_opening" => $_SESSION["favorite_opening"],
    "title" => $_SESSION["title"]
];
// After displaying the user profile, retrieve the contacts
            
    $contacts_query = "SELECT * FROM contacts WHERE user_id = ?";
    $stmt = $conn->prepare($contacts_query);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $contacts = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    <body>
        <!-- Navigation Bar should be placed at the top so have it be the first thing in the body -->
        <div class="container">
            <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
                <a class="navbar-brand" href="#">Chess Connect</a>
                <div class="navbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="../login/login.php">Sign Out</a>
                    </li>
                </ul>
                </div>
            </nav>
        </div>
        <!--end of nav-->
    <!--beginning of the users profile info -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2>User Profile</h2>
                    <table class="table table-bordered">
                        <tr>
                            <th>Username</th>
                            <td><?php echo htmlspecialchars($userDetails["username"]); ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo htmlspecialchars($userDetails["email"]); ?></td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td><?php echo htmlspecialchars($userDetails["country"]); ?></td>
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td><?php echo htmlspecialchars($userDetails["first_name"]); ?></td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td><?php echo htmlspecialchars($userDetails["last_name"]); ?></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><?php echo htmlspecialchars($userDetails["phone"]); ?></td>
                        </tr>
                        <tr>
                            <th>Chess Rating</th>
                            <td><?php echo htmlspecialchars($userDetails["chess_rating"]); ?></td>
                        </tr>
                        <tr>
                            <th>Favorite Opening</th>
                            <td><?php echo htmlspecialchars($userDetails["favorite_opening"]); ?></td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td><?php echo htmlspecialchars($userDetails["title"]); ?></td>
                        </tr>
                    </table>
                    <a href="../login/login.php" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
        <!--end of the users profile info-->
        
        <h3>Your Contacts</h3>
        <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Country</th>
                <th>Chess Rating</th>
                <th>Favorite Opening</th>
                <th>Title</th>
                <th>Address</th>
                <!-- Add other fields as necessary -->
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?php echo htmlspecialchars($contact["name"]??''); ?></td>
                <td><?php echo htmlspecialchars($contact["email"]??''); ?></td>
                <td><?php echo htmlspecialchars($contact["phone"]??''); ?></td>
                <td><?php echo htmlspecialchars($contact["country"]??''); ?></td>
                <td><?php echo htmlspecialchars($contact["chess_rating"]??''); ?></td>
                <td><?php echo htmlspecialchars($contact["favorite_opening"]??''); ?></td>
                <td><?php echo htmlspecialchars($contact["title"]??''); ?></td>
                <td><?php echo htmlspecialchars($contact["address"]??''); ?></td>
                <td><?php echo htmlspecialchars($contact["notes"]??''); ?></td>
                <!-- Output other fields as necessary -->
                <td>
                    <!-- Here you can provide an Edit link to another PHP script to handle editing. -->
                    <a href="edit.php?id=<?php echo $contact["id"]; ?>">Edit</a>
                    <!-- Add delete button -->
                    <a href="delete.php?id=<?php echo $contact["id"]; ?>" onclick="return confirm('Are you sure you want to delete this contact?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>

        <h3>Create a new contact</h3>
        <form action="create.php" method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="phone" placeholder="Phone">
            <input type="text" name="country" placeholder="Country">
            <input type="number" name="chessRating" placeholder="Chess Rating">
            <input type="text" name="favoriteOpening" placeholder="Favorite Opening">
            <input type="text" name="title" placeholder="Title (e.g. IM, GM)">
            <button type="submit">Create</button>
        </form>

        <h3>Delete a contact</h3>
        <form action="delete.php" method="GET">
            <input type="text" name="id" placeholder="Enter Contact ID to Delete" required>
            <button type="submit">Delete</button>
        </form>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
