<?php
require_once 'Models/Connection.php';

class Connection{
    protected static $_instance;
    protected $_conn = null;

    public static function getInstance() {
        if (!self::$_instance instanceof self) {
            self::$_instance = new Connection();
        }
        return self::$_instance;
    }
    
    public function __construct(){
        $dsn = 'mysql:host=localhost;dbname=camagrue;charset=utf8';
        $user = 'root';
        $password = '123456';
        try {
            $this->_conn = new PDO($dsn, $user, $password);
            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error!: ' . $e->getMessage();
            die();
        }
    }

    public function runQuery($qry, $arr){
        $stmt = $this->_conn->prepare($qry);
        $stmt->execute($arr);
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ($r);
    }
}