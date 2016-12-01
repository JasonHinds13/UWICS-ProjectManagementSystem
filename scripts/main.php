<?php

include_once('resourses.php');

$host = getenv('IP');
$username = getenv('C9_USER');
$password = '';
$dbname = 'ProjectDB';

session_start();

try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e;
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    //handle logins
    $logmail = $_POST["logmail"];
    $logpass = $_POST["logpass"];
    
    if(isset($logmail) && isset($logpass)){
        $sql = "SELECT * FROM members WHERE uwi_id='$logmail';";
        $q = $conn->query($sql);
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        
        if(count($result) > 0 && password_verify ($logpass , $result[0]["password"])){
            echo "Login Successful";
            
            $_SESSION["uwi_id"] = $result[0]["uwi_id"];
            $_SESSION["firstname"] = $result[0]["firstname"];
            $_SESSION["lastname"] = $result[0]["lastname"];
            $_SESSION["email"] = $result[0]["email"];
            $_SESSION["acctype"] = $result[0]["acctype"];
            setcookie("acctype", $result[0]["acctype"], time()+3600, '/', null, null, false);
            $_SESSION["sig"] = $result[0]["sig"];
            
            if ($_SESSION["acctype"] == "leader") {
                header('Location: /leaderhomepage.php');
            } else if ($_SESSION["acctype"] == "member") {
                header('Location: /memberhomepage.php');
            }
        }   
        else{
            $message = "Incorrect Login Information";
            echo "<script type='text/javascript'>alert('". $message ."');</script>";
            header('Refresh: 2; Location: /index.html');
        }
    }
    
    //post data for creating a new member
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $id_num = $_POST["id_num"];
    $email = $_POST["email"];
    $sig = $_POST["sig"];
    $acctype = $_POST["acctype"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    
    //create new member
    if(isset($fname) && isset($lname) && isset($id_num) && isset($email) && isset($sig) && isset($acctype) && isset($password)){
        $member = new Member($fname,$lname,$id_num,$email,$sig,$acctype,$password);
        $member->store_to_db($conn);
        
        //send mail
        $msg = "Hello $fname, You have used this email to sign up for UWI CS Project Management System.";
        mail($email,"Welcome to UWI CS Projects",$msg);
        
        $_SESSION["uwi_id"] = $id_num;
        $_SESSION["firstname"] = $fname;
        $_SESSION["lastname"] = $lname;
        $_SESSION["email"] = $email;
        $_SESSION["acctype"] = $acctype;
        setcookie("acctype", $acctype, time()+3600, '/', null, null, false);
        $_SESSION["sig"] = $sig;
            
        
        if ($_SESSION["acctype"] == "leader") {
            header('Location: /leaderhomepage.php');
        } else if ($_SESSION["acctype"] == "member") {
            header('Location: /memberhomepage.php');
        }
    }

    
    //post data for creating a new project
    $pname = $_POST["proj_name"];
    $pdesc = $_POST["proj_desc"];
    $projm = $_POST["proj_mem"];
    $psig = $_POST["proj_sig"];
    
    //create new project
    if(isset($pname) && isset($pdesc) &&isset($psig)){
        $proj = new Project($pname,$pdesc,$projm,$psig);
        $proj->store_to_db($conn);
        
        header('Location: /viewprojects.html');
    }
    
    //post data for creating new task
    $tname = $_POST["t_name"];
    $tpname = $_POST["tp_name"];
    $tdesc = $_POST["t_desc"];
    $tmember = $_POST["t_mem"];
    
    //create new task
    if(isset($tname) && isset($tpname) && isset($tdesc) && isset($tmember)){
        $task = new Task($tname,$tpname,$tdesc,$tmember,0);
        $task->store_to_db($conn);
        
        //send mail
        $msg = "You have been assigned to a task: $tname where you will $tdesc.";
        mail($tmember,"You've been assigned to a task",$msg);
        
        header('Location: /viewtasks.html');
    }
    
    //post data for updating task
    $task_name = $_POST["task_name"];
    $newprog = $_POST["newprog"];
    
    if(isset($task_name) && isset($newprog)){
        
        $task = new Task($task_name,'','','','');
        $task->update_progress($conn, $newprog);
        
        
        if ($_SESSION["acctype"] == "leader") {
            header('Location: /leaderhomepage.php');
        } else if ($_SESSION["acctype"] == "member") {
            header('Location: /memberhomepage.php');
        }
    }
    
    //for forum posts
    $auth = $_POST["m_author"];
    $m_title = $_POST["m_title"];
    $m_message = $_POST["m_message"];
     
    if(isset($auth) && isset($m_title) && isset($m_message)){
        $mess = new Message($auth, $m_title, $m_message);
        $mess->store_to_db($conn);
         
        header('Location: /forum.html');
    }
}

if($_SERVER["REQUEST_METHOD"] === "GET"){
    //handle get requests
    
    //return all task data
    $task = $_GET["tasks"];
    
    if($task == 'true'){
        $stmt = $conn->query("SELECT * FROM tasks;");
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($res as $r){
            $i = $r["project_id"];
            $n = $conn->query("select projects.name from projects JOIN tasks ON projects.id = '$i';");
            $m = $n->fetchAll(PDO::FETCH_ASSOC);
            
            echo "<h2>" . $r["name"] . "</h2>";
            echo "<ul>";
            echo "<li>" . "Project: " . $m[0]["name"] . "</li>";
            echo "<li>" . "Description: " . $r["description"] . "</li>";
            echo "<li>" . "Member: " . $r["member"] . "</li>";
            echo "<li>" . "Progress: " . $r["progress"] . "%". "</li>";
            echo "</ul>";
        }
    }
    
    //return all project data
    $proj = $_GET["projects"];
    
    if ($proj == 'true'){
        $stmt = $conn->query("SELECT * FROM projects;");
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($res as $r){
            echo "<h2>" . $r["name"] . "</h2>";
            echo "<ul>";
            echo "<li>" . "Description: " . $r["description"] . "</li>";
            echo "<li> Member Email: ". $r["member"] . "</li>";
            echo "<li>" . "SIG: " . $r["sig"] . "</li>";
            echo "</ul>";
        }
    }
    
    //return all messages
    $messages = $_GET["messages"];
    
    if($messages == 'true'){
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
    }
    
    //all tasks for a specific member
    
    //all projects for specific member
}

?>