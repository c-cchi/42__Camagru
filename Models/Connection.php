<?php
require_once 'Models/Connection.php';

class Connection{
    protected static $_instance;
    protected $_conn;

    public static function getInstance() {
        if (!self::$_instance instanceof self) {
            self::$_instance = new Connection();
        }
        return self::$_instance;
    }
    
    public function __construct(){
        // require "Config/database.php";
        try {
            // $this->_conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $this->_conn = new PDO("mysql:host=localhost;dbname=camagru;charset=utf8", "root", "123456");
            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo 'Error!: ' . $e->getMessage();
            header("Location: /error?db");
            exit();
        }
    }

    public function insertQuery($qry, $arr){
        $stmt = $this->_conn->prepare($qry);
        $stmt->execute($arr);
    }

    public function runQuery($qry, $arr){
        $stmt = $this->_conn->prepare($qry);
        $stmt->execute($arr);
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ($r);
    }

    public function updateQuery($qry, $arr){
        $stmt = $this->_conn->prepare($qry);
        $stmt->execute($arr);
    }
}