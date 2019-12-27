<?php
class ActivateModel{
    protected $activate_id;

    public function __construct(){
        if ($_GET['activate_id']){
            $sql = "Update `users` SET `confirmed` = True WHERE `verify_id`=:verifyid";
            $arr = array('verifyid' => $_GET['activate_id']);
            $rslt = Connection::getInstance()->runQuery($sql, $arr);
            if (!$rslt){
                return (FALSE);
            }
            return (TRUE);
        }
    }
    
    
}