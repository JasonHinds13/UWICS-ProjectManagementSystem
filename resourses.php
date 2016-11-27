<?php

//classes that will be used in the system

class Member{
    
    private $fname = "";
    private $lname = "";
    private $id_num = "";
    private $email = "";
    private $sig = "";
    private $acctype = "";
    private $password = "";
    
    function __construct($fname,$lname,$id_num,$email,$sig,$acctype,$password){
        $this->$fname = $fname;
        $this->$lname = $lname;
        $this->$id_num = $id_num;
        $this->$email = $email;
        $this->$sig = $sig;
        $this->$acctype = $acctype;
        $this->$password = $password;
    }
    
    public function store_to_db($conn){
        if($this->$acctype == "leader"){
            $sql = "INSERT INTO leaders(uwi_id,firstname,lastname,email,sig,password) VALUES('$this->$id_num','$this->$fname','$this->$lname','$this->$email','$this->$sig','$this->$password';);";
            $conn->exec($sql);
        }
        else{
            $sql = "INSERT INTO users(uwi_id,firstname,lastname,email,sig,password) VALUES('$this->$id_num','$this->$fname','$this->$lname','$this->$email','$this->$sig','$this->$password';);";
            $conn->exec($sql);
        }
    }
}

class Project{
    
    private $name = "";
    private $desc = "";
    private $sig = "";
    
    private $tasks = array();
    
    function __construct($name,$desc,$sig){
        $this->$name = $name;
        $this->$desc = $desc;
        $this->$sig = $sig;
    }
    
    public function store_to_db($conn){
        $sql = "INSERT INTO projects(name,description,sig) VALUES('$this->$name','$this->desc','$this->$sig');";
        $conn->exec($sql);
    }
}

class Task{
    
    private $name = "";
    private $desc = "";
    private $member = "";
    private $progress = "";
    
    function __construct($name,$desc,$member,$progress){
        $this->$name = $name;
        $this->$desc = $desc;
        $this->$member = $member;
        $this->$progress = $progress;
    }
    
    public function store_to_db($conn){
        $sql = "INSERT INTO tasks(name,description,member,progress) VALUES('$this->$name','$this->$desc','$this->member','$this->$progress');";
        $conn->exec($sql);
    }
}

?>