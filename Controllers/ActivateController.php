<?php
class ActivateController extends Controller{
    function process($params){
        $this->head = array(
            'title' => 'Camagrue');
        if (!isset($_GET['activate_id'])){
            echo "<h5>activate problem occured, please contact us.</h5>";
        }else {
        $activeModel = new ActivateModel();
        $actAccount = $activeModel->activateAccount();
        // echo "<h5>activated.</h5>";
        // if ($actAccount == 0){
        //     echo "<h5>error</h5>";
        // }else{
        
        // }
        }
    }
}