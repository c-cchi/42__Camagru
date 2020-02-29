<?php
class ActivateController extends Controller{
    function process($params){
        $this->view = 'activate';
        $this->renderView();
        if (!isset($_GET['activate_id'])){
            echo "<h5>activate problem occured, please contact us.</h5>";
        }else {
            $activeModel = new ActivateModel();
            $actAccount = $activeModel->activateAccount();
            echo "<p>Your account is activated</p>";
            echo "<a href='/index'><input type='button' value='Start Camagru'></a>";
            session_destroy();
        }
    }
}