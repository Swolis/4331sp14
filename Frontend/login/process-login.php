<?php
// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connect to the database
    $conn = new mysqli("localhost", "newuser", "StrongerPassword123!", "chesscont");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a SQL statement to find the user with the given username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a user is found and the password is correct
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            // Password is correct, start the session
            $_SESSION["username"] = $username;
            $_SESSION["email"] = $user["email"]; // Store email in the session
            $_SESSION["country"] = $user["country"];
            $_SESSION["first_name"] = $user["first_name"];
            $_SESSION["last_name"] = $user["last_name"];
            $_SESSION["phone"] = $user["phone"];
            $_SESSION["chess_rating"] = $user["chess_rating"];
            $_SESSION["favorite_opening"] = $user["favorite_opening"];
            $_SESSION["title"] = $user["title"];
            $_SESSION["user_id"] = $user["id"];
            // echo "User ID set in session is: " . $_SESSION["user_id"];
            // exit; // Temporary exit to see the debug message.

            header("Location: ../profile/"); // Redirect to the profile page
            exit();
        } else {
            // Password is incorrect
            alert("Incorrect Username or Password");
            header("Location: login.php");
            echo "Wrong Password";
            exit();
        }
    } else {
        // No user found
        alert("Incorrect Username or Password");
        header("Location: login.php");
        echo "Username not found";
        exit();
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
