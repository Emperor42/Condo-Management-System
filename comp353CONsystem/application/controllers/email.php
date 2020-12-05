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
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        $data = $this->emailModel->fetchInbox($this->getSession("loggedUser"));
        $this->view('emailInbox', $data);
    }

    /**
     * will display the outbox view
     */
    public function outbox()
    {
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        $data = $this->emailModel->fetchOutbox($this->getSession("loggedUser"));
        $this->view('emailOutbox', $data);
    }

    /**
     * will display the compose view
     */
    public function compose()
    {
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        $this->view('emailCompose', array());
    }

    /**
     * This method is used to view an email.
     * If this request is coming from inbox, then
     * email is also marked as 'Read'
     *
     * @param $emailId
     * @param $page
     */
    public function viewEmail($emailId, $page)
    {
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        $data = $this->emailModel->getEmail($this->getSession("loggedUser"), $emailId, $page);
        if(!empty($data) && $page == "inbox"){
            $this->emailModel->markEmailAsRead($emailId);
        }
        $this->view('viewEmail', $data);
    }

    /**
     * This method is used to reply to an email
     */
    public function replyEmail(){
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

           $length =  strlen($this->input($_POST["subject"]) );
           $line = "";
           for($i = 0; $i < $length; $i++){
               $line .= "=";
            }

            $emailContext = array(
                'email' => $this->input($_POST["emailAddress"]),
                'subject' => "RE: " . $this->input($_POST["emailSubject"]),
                'body' => "\r\n" . $line . "\r\n" .
                    $this->input($_POST["subject"]) . "\r\n" . $line . "\r\n" .
                    $this->input($_POST["messageBody"])
            );
            $this->view('emailCompose', $emailContext);
        }
    }

    /**
     * This method is used to forward an email
     */
    public function forwardEmail(){
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $emailContext = array(
                'email' => '',
                'subject' => "FW: " . $this->input($_POST["emailSubject"]),
                'body' =>  "\r\n" . $this->input($_POST["messageBody"])
            );
            $this->view('emailCompose', $emailContext);
        }
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