<?php
    class ActivateController extends Controller{
        function process($params){
            $this->head = array(
                'title' => 'Camagrue');
            if (!isset($_GET['activate_id'])){
                echo "activate problem occured, please contact us.";
                exit;
            }else{
                $activeModel = new ActivateModel();
                if ($activeModel == true){
                    echo "your account is activate.";
                }else{
                    echo "fail to activate your account.";
                }
            }
        }
    }