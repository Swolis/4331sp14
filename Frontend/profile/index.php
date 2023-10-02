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
    <link href = "../css/main.css" rel="stylesheet">
    <style>
        .background-color {
            background-color: rgba(128, 128, 128, 0.5);
            border-radius: 10px;
            padding: 15px;
        }
    </style>
    <!--script code for live editing of sql database-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.birds.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                VANTA.BIRDS({
                    el: "#vanta-canvas",
                    mouseControls: true,
                    touchControls: true,
                    gyroControls: false,
                    minHeight: 200.00,
                    minWidth: 200.00,
                    scale: 1.00,
                    scaleMobile: 1.00,
                    backgroundColor: 0xfae7e7,
                    color1: 0x221d1d,
                    color2: 0x131416
                    
                })
            });
        </script>

        
</head>
    <body>
    <div id="vanta-canvas">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Chess Connect</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../login/login.php">Sign Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        <!--end of nav-->
    <!--beginning of the users profile info -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 offset-md-2 background-color">
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
        <div class="container mt-5">
            <h3>Your Contacts</h3>
            <div class="background-color p-3">
            
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
                <tbody >
                    <?php
                        $index = 0;
                        $contArray = array();
                        foreach ($contacts as $cont):
                            $contArray[$index] = $cont;
                            $index++;
                        endforeach; 
                    ?>
                    <?php foreach ($contArray as $contact): 
                        $cid = $contact['id']?>
                    <tr>
                        <td id ="edit-name"><?php echo htmlspecialchars($contact["name"]??''); ?></td>
                        <td id = "edit-email"><?php echo htmlspecialchars($contact["email"]??''); ?></td>
                        <td id = "edit-phone"><?php echo htmlspecialchars($contact["phone"]??''); ?></td>
                        <td id = "edit-country"><?php echo htmlspecialchars($contact["country"]??''); ?></td>
                        <td id = "edit-rating"><?php echo htmlspecialchars($contact["chess_rating"]??''); ?></td>
                        <td id = "edit-opening"><?php echo htmlspecialchars($contact["favorite_opening"]??''); ?></td>
                        <td id = "edit-title"><?php echo htmlspecialchars($contact["title"]??''); ?></td>
                        <td id = "edit-address"><?php echo htmlspecialchars($contact["address"]??''); ?></td>
                        <td id = "edit-notes"><?php echo htmlspecialchars($contact["notes"]??''); ?></td>
                        <!-- Output other fields as necessary -->
                        <td>
                            <!-- Here you can provide an Edit link to another PHP script to handle editing. -->
                            <script>
                                function saveText(sid){
                                    console.log('saveText called correctly', sid);
                                    var xr = new XMLHttpRequest();
                                    var url = "edit.php";
                                    var hid = sid;
                                    var vid = "id=" + hid;
                                    var hname = document.getElementById("edit-name").innerHTML;
                                    var vname = "newName=" + hname;
                                    var hemail = document.getElementById("edit-email").innerHTML;
                                    var vemail = "newEmail=" + hemail;
                                    var hphone = document.getElementById("edit-phone").innerHTML;
                                    var vphone = "newPhone=" + hphone;
                                    var hcountry = document.getElementById("edit-country").innerHTML;
                                    var vcountry = "newCountry=" + hcountry;
                                    var hrating = document.getElementById("edit-rating").innerHTML;
                                    var vrating = "newRating=" + hrating;
                                    var hopening = document.getElementById("edit-opening").innerHTML;
                                    var vopening = "newOpening=" + hopening;
                                    var htitle = document.getElementById("edit-title").innerHTML;
                                    var vtitle = "newTitle=" + htitle;
                                    var haddress = document.getElementById("edit-address").innerHTML;
                                    var vaddress = "newAddress=" + haddress;
                                    var hnotes = document.getElementById("edit-notes").innerHTML;
                                    var vnotes = "newNotes=" + hnotes;
                                    var vars = vid + "&" + vname + "&" + vemail + "&" + vphone + "&" + vcountry + "&" + vrating + "&" + vopening + "&" + vtitle + "&" + vaddress + "&" + vnotes;
                                    xr.open ("POST", url, true);
                                    xr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                    console.log('vars is ', vars);
                                    xr.send(vars);
                                    }
                            </script>
                            <button type = "submit" id = "edit-button">Edit</button>
                            <button type = "submit" id = "end-editing">Done</button>
                            <script>
                                var ename = document.getElementById("edit-name");
                                var eemail = document.getElementById("edit-email");
                                var ephone = document.getElementById("edit-phone");
                                var ecountry = document.getElementById("edit-country");
                                var erating = document.getElementById("edit-rating");
                                var eopening = document.getElementById("edit-opening");
                                var etitle = document.getElementById("edit-title");
                                var eaddress = document.getElementById("edit-address");
                                var enotes = document.getElementById("edit-notes");

                                const edit_button = document.getElementById("edit-button");
                                const end_button = document.getElementById("end-editing");

                                edit_button.addEventListener("click", function() {
                                    ename.contentEditable = true;
                                    eemail.contentEditable = true;
                                    ephone.contentEditable = true;
                                    ecountry.contentEditable = true;
                                    erating.contentEditable = true;
                                    eopening.contentEditable = true;
                                    etitle.contentEditable = true;
                                    eaddress.contentEditable = true;
                                    enotes.contentEditable = true;
                                    //paragraph.style.backgroundColor = "#dddbdb";
                                } );

                                end_button.addEventListener("click", function() {
                                    ename.contentEditable = false;
                                    eemail.contentEditable = false;
                                    ephone.contentEditable = false;
                                    ecountry.contentEditable = false;
                                    erating.contentEditable = false;
                                    eopening.contentEditable = false;
                                    etitle.contentEditable = false;
                                    eaddress.contentEditable = false;
                                    enotes.contentEditable = false;
                                    
                                    saveText(<?php echo $contact['id']; ?>);
                                    //paragraph.style.backgroundColor = "#ffe44d";
                                } );
                            </script>

                            <!-- Add delete button -->
                            <a href="delete.php?id=<?php echo $contact["id"]; ?>" onclick="return confirm('Are you sure you want to delete this contact?');"><button>Delete</button></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
            </div>
        </div>
        
        <div class="container mt-5">
            <h3>Create a new contact</h3>
            <form action="create.php" method="POST" class="background-color p-3">
               
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email">
                <input type="text" name="phone" placeholder="Phone">
                <input type="text" name="country" placeholder="Country">
                <input type="number" name="chessRating" placeholder="Chess Rating">
                <input type="text" name="favoriteOpening" placeholder="Favorite Opening">
                <input type="text" name="title" placeholder="Title (e.g. IM, GM)">
                <button type="submit" class="btn btn-danger m-1">Create</button>
            </form>
        </div>
        



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        </div>
    </body>
</html>
