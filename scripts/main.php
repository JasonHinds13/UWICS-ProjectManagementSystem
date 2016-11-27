<?php

include_once('resourses.php');

$host = getenv('IP');
$username = getenv('C9_USER');
$password = '';
$dbname = 'ProjectDB';

try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
}
catch(PDOException $e){
    echo $e;
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    //post data for creating a new member
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $id_num = $_POST["id_num"];
    $email = $_POST["email"];
    $sig = $_POST["sig"];
    $acctype = $_POST["acctype"];
    $password = $_POST["password"];
    
    if(isset($fname) && isset($lname) && isset($id_num) && isset($email) && isset($sig) && isset($acctype) && isset($password)){
        $member = new Member($fname,$lname,$id_num,$email,$sig,$acctype,$password);
        $member->store_to_db();
    }
}

if($_SERVER["REQUEST_METHOD"] === "GET"){
    //handle get requests
}

?>