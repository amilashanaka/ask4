<?php

class Database
{


    private static $dsn, $db, $un, $pw;

    protected $link;
    private $stmt;

    public function __construct()
    {
        self::$dsn = "localhost";
        self::$db = "networks";
        self::$un = "root";
        self::$pw = "";
        $this->connect();
    }
    private function connect()
    {
        $conn = 'mysql:host=' . self::$dsn . ';dbname=' . self::$db;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        $this->link = new PDO($conn, self::$un, self::$pw, $options);

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

        return $this->link;
    }

    // Prepare statement with query
    public function query($sql)
    {
        $this->stmt = $this->link->prepare($sql);
        $this->stmt->execute();
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