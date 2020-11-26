<?php
/*Khadija SUBTAIN-40040952*/

/**
 * This controller will deal anything to do with user
 */
class email extends BaseController
{
    private $emailModel;

    public function __construct()
    {
        //Loads Base class constructor
        parent::__construct();
        $this-> emailModel = $this->model('emailModel');
    }

    public function index()
    {
    }

    /**************************************************************/
    /*                    VIEW REQUESTS                           */
    /**************************************************************/

    /**
     * will display the inbox view
     */
    public function inbox()
    {
        echo $this->getSession("loggedUser");
        $data = $this->emailModel->fetchInbox($this->getSession("loggedUser"));
        //print_r($data);
        $this->view('emailInbox',$data);
    }
    /**
     * will display the outbox view
     */
    public function outbox()
    {
        $this->view('emailOutbox');
    }
    /**
     * will display the compose view
     */
    public function compose()
    {
        $this->view('emailCompose');
    }

    /**************************************************************/
    /*                    ACTION REQUESTS                         */
    /**************************************************************/
    /**
     * will send the email to an email id
     */
    public function send()
    {
        //TODO

    }
}

?>