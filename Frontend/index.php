<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="generator" content="HTML Tidy for HTML5 for Linux version 5.6.0">
  <meta charset="UTF-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="css/main.css">
     <title>Chess Connect</title>


  <style>
    .navbar {
            display: flex;
            justify-content: space-between;
            padding: 2% 5%;
            background: rgba(0, 0, 0, 0.6); /* Slight dark overlay */
        }

        .navbar-brand, .nav-link {
            font-size: 30px;
            text-decoration: none;
            color: white;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover, .nav-link:hover {
            color: red; 
        }

        .main-content {
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(128, 128, 128, 0.5);
          -webkit-backdrop-filter: blur(5px);
          backdrop-filter: blur(5px);
          padding:5px;
        }

        .main-content h1 {
            font-size: 45px;
        }

        .main-content p {
          font-size: 20px;
        }

        .main-content a {
            display: inline-block;
            padding: 10px 30px;
            font-size: 24px;
            background-color: red;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .main-content a:hover {
            background-color: darkred;
            transform: scale(1.05);
        }
        /* .card2 {
          background-color: rgba(121, 121, 121, 0.114);
          -webkit-backdrop-filter: blur(5px);
          backdrop-filter: blur(5px);
          padding: 50px;
          text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        } */
  </style>
</head>
<body class="background-image"> <!-- Apply background class to the body -->
<div class="navbar">
        <a class="navbar-brand" href="#">Chess Connect</a>
        <a class="nav-link" href="login/login.php">Login</a>
    </div>
    <!-- <div class="card1"> -->
      
      <div class="main-content">
          <h1>Welcome to Chess Connect!</h1>
          <p>Find your queen.</p>
          <a href="login/login.php">Login Now</a>
      </div>
  <!-- </div> -->
</body>
</html>
