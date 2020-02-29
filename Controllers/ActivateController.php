<?php
class ActivateController extends Controller{
    function process($params){
        $this->view = 'activate';
        $this->renderView();
        echo "<div class='activ'>";
        if (!isset($_GET['activate_id'])){
            echo "<h5>activate problem occured, please contact us.</h5>";
        }else {
            $activeModel = new ActivateModel();
            $actAccount = $activeModel->activateAccount();
            echo "<p>Your account is activated</p>";
            echo "<a href='/index'><input class='start' type='button' value='Start Camagru'></a>";
            echo "</div>";
            session_destroy();
        }
    }
}