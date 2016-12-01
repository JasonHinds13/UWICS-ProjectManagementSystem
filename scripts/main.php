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
        $sql = "SELECT * FROM members WHERE email='$logmail' AND password='$logpass';";
        $q = $conn->query($sql);
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        
        if(count($result) > 0){
            echo "Login Successful";
            
            $_SESSION["uwi_id"] = $result[0]["uwi_id"];
            $_SESSION["firstname"] = $result[0]["firstname"];
            $_SESSION["lastname"] = $result[0]["lastname"];
            $_SESSION["email"] = $result[0]["email"];
            $_SESSION["acctype"] = $result[0]["acctype"];
            $_SESSION["sig"] = $result[0]["sig"];
            
            header('Location: /homepage.php');
        }
        else{
            echo "Password Incorrect";
        }
    }
    
    //post data for creating a new member
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $id_num = $_POST["id_num"];
    $email = $_POST["email"];
    $sig = $_POST["sig"];
    $acctype = $_POST["acctype"];
    $password = $_POST["password"];
    
    //create new member
    if(isset($fname) && isset($lname) && isset($id_num) && isset($email) && isset($sig) && isset($acctype) && isset($password)){
        $member = new Member($fname,$lname,$id_num,$email,$sig,$acctype,$password);
        $member->store_to_db($conn);
        
        //send mail
        $msg = "Hello $fname, You have used this email to sign up for UWI CS Project Management System.";
        mail($email,"Welcome to UWI CS Projects",$msg);
        
        header('Location: /index.php');
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
        
        header('Location: /viewprojects.php');
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
        
        header('Location: /viewtasks.php');
    }
    
    //post data for updating task
    $task_name = $_POST["task_name"];
    $newprog = $_POST["newprog"];
    
    if(isset($task_name) && isset($newprog)){
        
        $task = new Task($task_name,'','','','');
        $task->update_progress($conn, $newprog);
        
        header('Location: /homepage.php');
    }
}

if($_SERVER["REQUEST_METHOD"] === "GET"){
    //handle get requests
}

?>