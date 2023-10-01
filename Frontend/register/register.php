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
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form method="POST" action="process-register.php">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName">
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country">
                            </div>
                            <div class="mb-3">
                                <label for="chessRating" class="form-label">Chess Rating</label>
                                <input type="number" class="form-control" id="chessRating" name="chessRating">
                            </div>
                            <div class="mb-3">
                                <label for="favoriteOpening" class="form-label">Favorite Opening</label>
                                <input type="text" class="form-control" id="favoriteOpening" name="favoriteOpening">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <!-- Add fields for other user information (email, country, etc.) -->
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
