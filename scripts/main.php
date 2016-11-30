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
        
        if(count($result) == 1){
            echo "Login Successful";
            header('Location: homepage.php');
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
    }
    
    //post data for creating a new project
    $pname = $_POST["proj_name"];
    $pdesc = $_POST["proj_desc"];
    $psig = $_POST["proj_sig"];
    
    //create new project
    if(isset($pname) && isset($pdesc) &&isset($psig)){
        $proj = new Project($pname,$pdesc,$psig);
        $proj->store_to_db($conn);
    }
    
    //post data for creating new task
    $tname = $_POST["t_name"];
    $tdesc = $_POST["t_desc"];
    $tmember = $_POST["t_mem"];
    
    //create new task
    if(isset($tname) && isset($tdesc) && isset($tmember)){
        $task = new Task($tname,$tdesc,$tmember,0);
        $task->store_to_db($conn);
    }
}

if($_SERVER["REQUEST_METHOD"] === "GET"){
    //handle get requests
}

?>