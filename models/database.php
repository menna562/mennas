<?php
// include config
if (!DOCUMENT_ROOT){
    define("DOCUMENT_ROOT", "/xampp/htdocs/"); // define document root
}

require_once  (DOCUMENT_ROOT."/friends/config.php");
class Database{

    private $dbh;
    public $error;
    private $stmt;

    public function __construct()
    {
        //set DSN
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
        // set options
        $options = [
            PDO::ATTR_PERSISTENT        => true,
            PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION
        ];

        //create new PDO
         try {
            $this->dbh = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
             $this->error = $e->getMessage();
        }
    }

    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                    default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindparam($param, $value, $type);
    }

    public function execute(){
        return $this->stmt->execute();
    }

    public function resultset(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lastinsertid(){
        return $this->dbh->lastInsertId();
    }
}
?>
