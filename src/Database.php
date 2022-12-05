<?php

namespace Ask4;

use PDO;

class Database
{

    protected static $host, $user, $pass, $db;
    public $pdo;
    protected $stmt;


    public function __construct()
    {
        self::$host = "localhost";
        self::$user = "root";
        self::$pass = "";
        self::$db = "networks";
        $this->connect();
    }


    public function __destruct()
    {
        if ($this->stmt !== null) {

            $this->stmt = null;

        }

        if ($this->pdo !== null) {

            $this->pdo = null;

        }
    }

    private function connect()
    {
        $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$db;

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );


        try {

            $this->pdo = new PDO($dsn, self::$user, self::$pass, $options);

        } catch (\PDOException $e) {

            die("Error connecting database: " . $e->getMessage());
        }
        return $this->pdo;

    }


    public function __sleep()
    {
        return array('dsn', 'username', 'password');
    }

    public function __wakeup()
    {
        $this->connect();
    }

    public function conn()
    {

        return $this->pdo;
    }

    // Prepare statement with query
    public function query($sql)
    {
        $this->stmt = $this->pdo->prepare($sql);
       
    }

        
    public function run_query($sql){
    
       $this->query($sql);
       return  $this->execute();

    }

    // Bind values
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
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

        $this->stmt->bindValue($param, $value, $type);
    }


    // Execute the prepared statement
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultSet()
    {

        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function get_result($sql){
    
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);

    }

    public function get_all_results($sql){
    
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);

    }

    // Get single record as object
    public function single()
    {
        // $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

}