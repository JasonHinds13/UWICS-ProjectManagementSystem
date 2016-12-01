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
    
    public function __construct($fname,$lname,$id_num,$email,$sig,$acctype,$password){
        $this->fname = $fname;
        $this->lname = $lname;
        $this->id_num = $id_num;
        $this->email = $email;
        $this->sig = $sig;
        $this->acctype = $acctype;
        $this->password = $password;
    }
    
    public function store_to_db($conn){
        $sql = "INSERT INTO members(uwi_id,firstname,lastname,email,acctype,sig,password) VALUES('$this->id_num','$this->fname','$this->lname','$this->email','$this->acctype','$this->sig','$this->password');";
        $conn->exec($sql);
    }
}

class Project{
    
    private $name = "";
    private $desc = "";
    private $sig = "";
    
    private $tasks = array();
    
    public function __construct($name,$desc,$sig){
        $this->name = $name;
        $this->desc = $desc;
        $this->sig = $sig;
    }
    
    public function view_details(){
        echo "Project: " . $this->name . "Description: " .$this->desc . "SIG: " .$this->sig;
    }
    
    public function store_to_db($conn){
        $sql = "INSERT INTO projects(name,description,sig) VALUES('$this->name','$this->desc','$this->sig');";
        $conn->exec($sql);
    }
}

class Task{
    
    private $name = "";
    private $pname = "";
    private $desc = "";
    private $member = "";
    private $progress = "";
    
    public function __construct($name,$pname,$desc,$member,$progress){
        $this->name = $name;
        $this->pname = $pname;
        $this->desc = $desc;
        $this->member = $member;
        $this->progress = $progress;
    }
    
    public function update_progress($conn, $newprog){
        $sql = "UPDATE tasks SET progress = '$newprog' WHERE name = '$this->name';";
        $conn->exec($sql);
    }
    
    public function view_details(){
        echo "Project:" . $this->pname . 'Name' . $this->name . 'Description' . $this->desc . 'Assignee' . $this->member . 'Progress' . $this->progress;
    }
    
    public function store_to_db($conn){
        $ql = "SELECT * FROM projects WHERE name = '$this->pname';";
        $q = $conn->query($ql);
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        
        $id = $result[0]["id"];
        
        $sql = "INSERT INTO tasks(name,project_id,description,member,progress) VALUES('$this->name','$id','$this->desc','$this->member','$this->progress');";
        $conn->exec($sql);
    }
}

class InterestGroup{
    
    private $name = "";
    private $leader = "";
    
    public function __construct($name, $leader){
        $this->name = $name;
        $this->leader = $leader;
    }
    
    public function store_to_db($conn){
        $sql = "SELECT * FROM members WHERE name = '$this->leader';";
        $q = $conn->query($sql);
        
        $result = $q->fetch();
        
        $lid = $result["uwi_id"];
        
        $query = "INSERT INTO interestgroup(leader_id, name) VALUES('$lid', '$this->name');";
    }
}

?>