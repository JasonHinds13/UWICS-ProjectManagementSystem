<?php
include 'scripts/main.php';

echo "Welcome Back, " . $_SESSION["firstname"];

?>

<!DOCTYPE html>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="scripts/homepage.js"></script>
        <script type="text/javascript" src="navbar.js"></script>
    </head>
    <body>
        <div id="navbar">
            <a href="homepage.php"><button id = "home">Home</button></a>
            <a href="createproject.html"><button id = "projects">Projects</button></a>
            <a href="createtask.html"><button id = "tasks">Tasks</button></a>
        </div>
        
        <div id="myproj">
            <h1>Your Projects</h1>
        </div>
        
        <div id="mytasks">
            <h1>Your Tasks</h1>
        </div>
        
    </body>
</html>