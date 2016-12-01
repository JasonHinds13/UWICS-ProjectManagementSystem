<!DOCTYPE html>
<html>
    <head>
        <title>View Projects</title>
    </head>
    
    <body>
        <div id="navbar">
            <a href="homepage.php"><button id = "home">Home</button></a>
            <a href="createproject.html"><button id = "projects">Create Projects</button></a>
            <a href="createtask.html"><button id = "tasks">Create Tasks</button></a>
            <a href="viewprojects.php"><button id = "projects">View Projects</button></a>
            <a href="viewtasks.php"><button id = "tasks">View Tasks</button></a>
        </div>
        
        <h1>Projects: </h1>
        <?php
            include 'scripts/main.php';
            
            $stmt = $conn->query("SELECT * FROM projects;");
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($res as $r){
                echo "<h2>" . $r["name"] . "</h2>";
                echo "<ul>";
                echo "<li>" . "Description: " . $r["description"] . "</li>";
                echo "<li>" . "SIG: " . $r["sig"] . "</li>";
                echo "</ul>";
            }
        ?>
    </body>
</html>