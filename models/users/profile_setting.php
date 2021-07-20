<?php
session_start();

require_once ('/xampp/htdocs/friends/models/database.php');
// $s=resultset();
// $id=$s['id'];
class updatedata{
    private $username;
    private $password;
    private $db;
    public function __construct($username,$password )
    {
        $this->username = $username;
        $this->password = $password;
        $this->db=new Database();

    }

    public function updatedata()
    {
        $this->db->query("update user set username=:username,password=:password where id==:id");

         $this->db->bind(':username', $this->username);
         $this->db->bind(':password', $this->password);
         $this->db->bind(':id',$_SESSION['id']);


        $this->db->execute();
    }
    public function getuser(){
            $this->db->query("select * from user where id=:id");
            $this->db->bind(':id',$_SESSION['id']);
           $user=$this->db->resultset();
        
    }
}
?>