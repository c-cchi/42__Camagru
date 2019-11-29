<?php
    class IndexController extends Controller{
        function process($params){
            $this->head = array(
                'title' => 'Camagrue');
            $login = new LoginController;
            $login->process();
        }
    }