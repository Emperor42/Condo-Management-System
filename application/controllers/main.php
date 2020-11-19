<?php

/**
 * This controller will deal with anything involving the main interface (combines together everything)
 */
class main extends BaseController
{
    private $userModel;
    private $postModel;

    public function __construct()
    {
        //Loads Base class constructor
        parent::__construct();
        $this->userModel = $this->model('userModel');
        $this->postModel = $this->model('postModel');
    }

    public function index()
    {
    }

    /**************************************************************/
    /*                    VIEW REQUESTS                           */
    /**************************************************************/

    public function wall()
    {
        //switch to the login page if he loggedUser is not set
        if (!isset($_COOKIE['loggedUser'])){
                $this->redirect('main/login');
        }
        $data = $this->postModel->messagesForUser($_COOKIE['loggedUser']);
        $this->view('wall', $data, $this->userModel);
    }

    public function login(){
        //temp ffor testing
        $this->view('login');
        //$this->wall();
    }

    //need to split the two of these into get requests and such, will make a contacts page soon
    public function conversation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $other = (int)htmlspecialchars($_GET["user"]);
            $data = $this->postModel->conversationForUsers($_COOKIE['loggedUser'], $other);
            $this->view('conversation', $data);
        }
    }

    public function events(){
        $data = $this->postModel->eventsForUser($_COOKIE['loggedUser']);
        $this->view('events', $data, $this->userModel);
    }

    /**************************************************************/
    /*                    ACTION REQUESTS                         */
    /**************************************************************/
}
?>
