<!DOCTYPE html>
<html>
    <head>
        <title>Forum</title>
    </head>
    
    <body>
        <div id="navbar">
            <a href="homepage.php"><button id = "home">Home</button></a>
            <a href="createproject.html"><button id = "projects">Create Projects</button></a>
            <a href="createtask.html"><button id = "tasks">Create Tasks</button></a>
            <a href="viewprojects.php"><button id = "projects">View Projects</button></a>
            <a href="viewtasks.php"><button id = "tasks">View Tasks</button></a>
            <a href="forum.php"><button id = "forum">Forum</button></a>
        </div>
        
        <h1>Messages: </h1>
        <?php
            include 'scripts/main.php';
            
            $stmt = $conn->query("SELECT * FROM messages;");
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($res as $r){
                echo "<h2>" . $r["title"] . "</h2>";
                echo "<ul>";
                echo "<li>" . "Author: " . $r["author"] . "</li>";
                echo "<li> Message: ". $r["message"] . "</li>";
                echo "<li>" . "TimeStamp: " . $r["time"] . "</li>";
                echo "</ul>";
            }
        ?>
        
        <hr />
        
        <form action="scripts/main.php" method="post">
            Author: <input type="text" name ="m_author" required/> <br />
            Title: <input type="text" name ="m_title" required/> <br />
	        Message: <input type ="text" name="m_message" required/> <br />
	        <input type="submit" value="Post Message"/>
        </form>
    </body>
</html>