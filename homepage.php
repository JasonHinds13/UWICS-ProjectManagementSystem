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
            <a href="createproject.html"><button id = "projects">Create Projects</button></a>
            <a href="createtask.html"><button id = "tasks">Create Tasks</button></a>
            <a href="viewprojects.php"><button id = "projects">View Projects</button></a>
            <a href="viewtasks.php"><button id = "tasks">View Tasks</button></a>
        </div>
        
        <div id="myproj">
            <h1>Your Projects and Tasks</h1>
            
            <?php
                include 'scripts/main.php';
                
                $stmt = $conn->query("SELECT * FROM tasks;");
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                foreach($res as $r){
                    
                    if ($_SESSION["email"] == $r["member"]){
                        
                        $i = $r["project_id"];
                        $n = $conn->query("select projects.name from projects JOIN tasks ON projects.id = '$i';");
                        $m = $n->fetchAll(PDO::FETCH_ASSOC);
                
                        echo "<h2>" . $r["name"] . "</h2>";
                        echo "<ul>";
                        echo "<li>" . "Project: " . $m[0]["name"] . "</li>";
                        echo "<li>" . "Description: " . $r["description"] . "</li>";
                        echo "<li>" . "Progress: " . $r["progress"] . "%". "</li>";
                        echo "</ul>";
                    }
                }
            ?>
        </div>
        
    </body>
</html>