<?php
class User {
    private $db;
    public function __constract ()
    {
        $this->db = new Database;
    }


    //Add New User [Register User ]
    public function register($data)
    {
        $this->db->query("INSERT INT users(name, email, password) VALUES(:name ,:email ,:password)");
        //Bind Value 
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //find User By Email 
    public function findUserByEmail($email)
    {
        $this->db->query("SELECT * FROM users WHERE email=:email");
        $this->db->bind(":email",$email);
        $result =  $this->db->single();
        //check Row
        if($this->db->rowCount() > 0) {
            return True;
        }else{
            return False;
        }
    }
    // Get User By Id 
    public function getUserById($id)
    {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id',$id);
        $row = $this->db->single();
        //check Row
        if($this->db->rowCount()>0){
            return $row;
        }else{
            return null;
        }
    }
    public function login($email,$password)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(":email", $email);
        $row = $this->db->single();
        if(password_verify($password, $row->password)){
            return $row;
        }else{
            return false;
        }

    }

    
}