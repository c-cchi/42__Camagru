<?php
class ActivateModel{
    protected $actId;

    public function __construct(){
        $this->actId = $_GET['activate_id'];
    }

    public function activateAccount(){
        $qry = "Update `users` SET `confirmed` = True WHERE `verify_id`=:verifyid";
        $arr = array('verifyid' => $this->actId);
        $rslt = Connection::getInstance()->updateQuery($qry, $arr);
    }
}