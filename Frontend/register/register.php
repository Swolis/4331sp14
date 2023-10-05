<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <title>Register</title>
</head>
<body>
            <!-- Navigation Bar should be placed at the top so have it be the first thing in the body -->
            <div class="container">
            <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
                <a class="navbar-brand" href="../#">Chess Connect</a>
                <div class="navbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="login/login.php">Login</a>
                    </li>
                </ul>
                </div>
            </nav>
        </div>
        <!--end of nav-->

    <div class="container">
         
                 
           

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
                    header("Location: ../login/login.php");
                    exit();
                }else {
                    // Registration failed, redirect back to the registration page with an error


                echo('Sorry, the Username '.$_POST['username'].' has already been used to register.');
                $password = $_POST["password"];
                $firstName = $_POST["firstName"];
                $lastName = $_POST["lastName"];
                $email = $_POST["email"];
                $phone = $_POST["phone"];
                $country = $_POST["country"];
                $chessRating = $_POST["chessRating"];
                $favoriteOpening = $_POST["favoriteOpening"];
                $title = $_POST["title"];


                }

                // Close the connection
                $stmt->close();
                $conn->close();
            }
               
        ?>
       
            
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value=""required>
                            </div>
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName"value="firstName">
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName"value="">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"value="">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="">
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="">
                            </div>
                            <div class="mb-3">
                                <label for="chessRating" class="form-label">Chess Rating</label>
                                <input type="number" class="form-control" id="chessRating" name="chessRating"value="">
                            </div>
                            <div class="mb-3">
                                <label for="favoriteOpening" class="form-label">Favorite Opening</label>
                                <input type="text" class="form-control" id="favoriteOpening" name="favoriteOpening"value="">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"value="">
                            </div>
                            <!-- Add fields for other user information (email, country, etc.) -->
                            <button type="submit" id="formSubmission" class="btn btn-primary">Register</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
