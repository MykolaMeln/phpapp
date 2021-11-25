<?php
class Database {

    public $host;
    public $db_name;
    public $username;
    public $password;
    public $port;
    public $conn;

    public function __construct(){

    if(!empty($_ENV['MYSQL_HOST']))
    {
        $this->host = $_ENV['MYSQL_HOST'];
    }
    else {
        $this->host = "localhost";
    }

    if(!empty($_ENV['MYSQL_USER']))
    {
        $this->username = $_ENV['MYSQL_USER'];
    }
    else {
        $this->username = "root";
    }

    if(!empty($_ENV['MYSQL_PASS']))
    {
        $this->password = $_ENV['MYSQL_PASS'];
    }
    else {
        $this->password = 'root';
    }

    if(!empty($_ENV['MYSQL_DB']))
    {
        $this->db_name = $_ENV['MYSQL_DB'];
    }
    else {
        $this->db_name = "employers";
    }

    if(!empty($_ENV['MYSQL_PORT']))
    {
        $this->port = $_ENV['MYSQL_PORT'];
    }
    else {
        $this->port = '3306';
    }
    }

    public function getConnection(){

      $this->conn = null;

       try {
           $this->conn = new PDO("mysql:host=".$this->host.";port=".$this->port.";dbname=".$this->db_name, $this->username, $this->password);
           $this->conn->exec("set names utf8");
       } catch(PDOException $exception){
           echo "Connection error: ".$exception->getMessage();
       }

       return $this->conn;
   }
    }
?>
