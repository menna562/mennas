<?php
// include congig file
require_once("../../config.php");

require_once(DOCUMENT_ROOT.'/friends/models/database.php');

class LoginModel{

    private $email;
    private $passWord;
    private $db;
    public function __construct($email, $passWord)
    {
        $this->email = $email;
        $this->passWord = $passWord;
        $this->db = new Database();
        $this->db->query("SELECT * FROM user WHERE email = :email");
    }
    public function login()
    {
        $this->db->bind(':email', $this->email);
        $result = $this->db->resultset();
        if (isset($result[0]['password'])){

            if(password_verify($this->passWord, $result[0]['password'])) {
                return $result[0];
            } 
        }
        return false;
    }
    
}