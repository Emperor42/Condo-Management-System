<?php

class welcome extends BaseController
{

    public function index()
    {
        if(!isset($_COOKIE['loggedUser'])){
            $this->redirect('main/login');
        } else{
            $this->redirect('main/wall');
        }
    }
}

?>
