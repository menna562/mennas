<?php
// include congig file
require_once("../../config.php");

require_once(DOCUMENT_ROOT.'/friends/models/database.php');

class RegisterModel{

    private $userName;
    private $passWord;
    private $email;
    private $gender;
    private $image_link;
    private $db;
    public function __construct($userName, $passWord, $email, $gender, $image_link)
    {
        $this->userName = $userName;
        $this->passWord = $passWord;
        $this->email = $email;
        $this->gender = $gender;
        $this->image_link = $image_link;
        $this->db = new Database();
    }
    
    public function emailAreadyExists()
    {
        $this->db->query("SELECT * FROM user WHERE email = :email");
        $this->db->bind(':email', $this->email);
        return $this->db->resultset();

    }
    
    public function register()
    {
        $this->db->query("INSERT INTO user (username, `password`, email, gender, image_link) VALUES (:username, :password, :email, :gender, :image_link)");

        $this->db->bind(':username', $this->userName);
        $this->db->bind(':password', $this->passWord);
        $this->db->bind(':email', $this->email);
        $this->db->bind(':gender', $this->gender);
        $this->db->bind(':image_link', $this->image_link);

        $this->db->execute();
        return $this->db->lastinsertid();
    }
    
}