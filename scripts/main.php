<?php

include_once('/scripts/resourses.php');

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
    //handle post requests
}

if($_SERVER["REQUEST_METHOD"] === "GET"){
    //handle get requests
}

?>