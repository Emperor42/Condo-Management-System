<?php
/*Khadija SUBTAIN-40040952*/

/**
 * This controller will deal anything to do with user
 */
class email extends BaseController
{
    private $emailModel;
    private $userModel;

    public function __construct()
    {
        //Loads Base class constructor
        parent::__construct();
        $this->emailModel = $this->model('emailModel');
        $this->userModel = $this->model('userModel');
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
        $data = $this->emailModel->fetchInbox($this->getSession("loggedUser"));
        $this->view('emailInbox', $data);
    }

    /**
     * will display the outbox view
     */
    public function outbox()
    {
        $data = $this->emailModel->fetchOutbox($this->getSession("loggedUser"));
        $this->view('emailOutbox', $data);
    }

    /**
     * will display the compose view
     */
    public function compose()
    {
        $this->view('emailCompose', array());
    }

    public function viewEmail($emailId, $page)
    {
        $data = $this->emailModel->getEmail($this->getSession("loggedUser"), $emailId, $page);
        if(!empty($data) && $page == "inbox"){
            $this->emailModel->markEmailAsRead($emailId);
        }
        $this->view('viewEmail', $data);
    }

    /**************************************************************/
    /*                    ACTION REQUESTS                         */
    /**************************************************************/
    /**
     * will send the email to an email id
     */
    public function sendEmailRequest()
    {
        // Value validation happens at client side, so no need to check for blanks here
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //Check if the targetEmail exists
            $data = $this->emailModel->getUserByEmail($this->input($_POST["email"]));
            if (empty($data)) {
                $this->setFlash('failure', "email [" . $this->input($_POST["email"]) . "] does not exist");

                 $emailContext = array(
                     'email' => $this->input($_POST["email"]),
                     'subject' => $this->input($_POST["subject"]),
                     'body' => $this->input($_POST["messageBody"])
                 );

                $this->view('emailCompose', $emailContext);
                //$this->redirect('email/compose');
            } else {
                if ($this->emailModel->insertEmail(
                    $this->getSession("loggedUser"),
                    $data->eid,
                    $this->input($_POST["subject"]),
                    $this->input($_POST["messageBody"]))) {
                    $this->setFlash('success', "Email sent successfully!");
                    $this->redirect('email/inbox');
                } else {
                    $this->setFlash('failure', "Problem sending email");
                    $this->redirect('email/compose');
                }
            }
        }
    }

    /**
     * this method deletes and email by making it as delete
     *
     * @param $emailId
     */
    public function deleteEmail($emailId, $page)
    {
        $this->emailModel->markEmailDelete($this->getSession("loggedUser"), $emailId);

        if($page == 'inbox') {
            $this->redirect('email/inbox');
        }else{
            $this->redirect('email/outbox');
        }
    }
}

?>