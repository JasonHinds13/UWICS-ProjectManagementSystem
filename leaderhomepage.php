<!DOCTYPE html>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="scripts/homepage.js"></script>
        <script type="text/javascript" src="scripts/navbar.js"></script>
    </head>
    <body>
        <div id="navbar">
            
        </div>
        
        <div id="myproj">
            <h1>Your Projects</h1>
            
            <?php
                include 'scripts/main.php';
                
                $stmt = $conn->query("SELECT * FROM projects;");
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                foreach($res as $r){
                    
                    if ($_SESSION["email"] == $r["member"]){
                
                        echo "<h2>" . $r["name"] . "</h2>";
                        echo "<ul>";
                        echo "<li>" . "Description: " . $r["description"] . "</li>";
                        echo "<li>" . "SIG: " . $r["sig"] ."</li>";
                        echo "</ul>";
                    }
                }
            ?>
        </div>
        
        <hr />
        
        <div id="mytask">
            <h1>Your Tasks</h1>
            
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
                        echo "<li> Update Progress: ";
                        echo '<form action="scripts/main.php" method="post">';
                        echo '<input type="hidden" name="task_name" value="'.$r["name"]. '"' . '/>';
                        echo '<input type="text" name="newprog" /> ';
                        echo '<input type="submit" value="Update" />';
                        echo "</form>";
                        echo "</li>";
                        echo "</ul>";
                    }
                }
            ?>
        </div>
        
    </body>
</html>