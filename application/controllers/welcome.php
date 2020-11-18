<?php

class welcome extends BaseController
{

    public function index()
    {
        if(!isset($_COOKIE['loggedUser'])){
            $this->view('login', $data);
        } else{
            echo "A USER HAS BEEN SET ALREADY!";
        }
    }
}

?>
