<?php


/**
 * Class welcome contorls what the user sees when
 * accessing the website
 */
class welcome extends BaseController
{
    /**
     * redirects the user depending on if they are
     * logged in or not
     */
    public function index()
    {
        if(!isset($_SESSION['loggedUser'])){
            $this->redirect('main/login');
        } else{
            
            $this->redirect('main/wall');
        }
    }
}

?>
