<?php
/*Khadija SUBTAIN-40040952*/

/**
 * This controller will deal with anything involving the main interface (combines together everything)
 */
class main extends BaseController
{
    public $userModel;
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

    /**
     * returns "wall" view if user is logged in
     */
    public function wall()
    {
        //switch to the login page if he loggedUser is not set
        if (!isset($_SESSION['loggedUser'])){
                $this->redirect('main/login');
        }
        $data = $this->postModel->messagesForUser($_SESSION['loggedUser']);
        $this->view('wall', $data, $this->userModel);
    }

    public function login(){
        //temp ffor testing
        $this->view('login');
        //$this->wall();
    }

    //need to split the two of these into get requests and such, will make a contacts page soon
    public function conversation($other)
    {
        //switch to the login page if he loggedUser is not set
        if (!isset($_SESSION['loggedUser'])){
            $this->redirect('main/login');
        }
        $data = $this->postModel->conversationForUsers($_SESSION['loggedUser'], $other);
        $_SESSION['talkTo']=$other;
        $this->view('conversation', $data);
    }

    //need to split the two of these into get requests and such, will make a contacts page soon
    public function conversationGroup($other)
    {
        //switch to the login page if he loggedUser is not set
        if (!isset($_SESSION['loggedUser'])){
            $this->redirect('main/login');
        }
        $data = $this->postModel->conversationForGroup($_SESSION['loggedUser'], $other);
        $_SESSION['talkTo']=$other;
        $this->view('conversation', $data);
    }


    public function events(){
        //switch to the login page if he loggedUser is not set
        if (!isset($_SESSION['loggedUser'])){
            $this->redirect('main/login');
        }
        $data = $this->postModel->eventsForUser($_SESSION['loggedUser']);
        $this->view('events', $data, $this->userModel);
    }

    /**************************************************************/
    /*                    ACTION REQUESTS                         */
    /**************************************************************/
    public function loginForm()
    {
        // Value validation happens at client side, so no need to check for blanks here
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //check if the user password is correct
            $u= $this->input($_POST["uname"]);
            $p = $this->input($_POST["psw"]);
            if($this->userModel->checkUser($u,$p)){
                $result = $this->userModel->getEID($u,$p);

                $_SESSION["loggedUser"]= strval($result->eid);
                $_SESSION["loggedName"]= strval($result->eid)." ".strval($result->firstName)." ".strval($result->lastName)." (".strval($result->userId).")";
                $this->setSession("screenName", strval($result->firstName));
                $this->setSession("entityType", strval($result->entityType));

                $this->setFLash('success', 'you are logged in ');
                $this->redirect('main/wall');
            } else {
                $this->setFlash('failure', "Failed to Log In ");
                $this->redirect('main/login');
            }
        }
        $this->setFlash('success', "WELCOME " . $_SESSION['loggedName']);
    }

    public function logout(){
        if (isset($_SESSION['loggedUser'])){
            $_SESSION["loggedUser"]="";
            $_SESSION["loggedName"]= "";
                
        }
        $this->setFlash('success', "You are now logged out!");
        $this->redirect('main/login');
    }

    public function startEvent(){
        if (isset($_SESSION['loggedUser'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $t=$this->input($_POST['eventGroup']);
                $f=$this->input($_POST['eventStart']);
                $n=$this->input($_POST['eventNamed']);
                if ($this->postModel->createEvent($t,$f,$n)){
                    $this->setFlash('success', "Your event has been created!");
                } else {
                    $this->setFlash('failure', "We could not create your event!");
                }
            }
        }
        $this->redirect('main/events');
    }

    public function addEventDetails(){
        if (isset($_SESSION['loggedUser'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $n=$this->input($_POST['eventReply']);
                $t=$this->input($_POST['eventGroup']);
                $f=$this->input($_POST['eventStart']);
                $date=strval($this->input($_POST['eventDate']));
                $time=strval($this->input($_POST['eventTime']));
                $area=strval($this->input($_POST['eventArea']));
                if (empty($_POST['eventDate'])&& empty($_POST['eventTime']) && empty($_POST['eventArea'])){
                    $this->setFlash('failure', "No details supplied!");//no details supplied
                    $this->redirect('main/events');
                }
                if (!empty($_POST['eventDate'])) { 
                    if( $this->postModel->createEventDate($n,$t,$f, $date)){
                        $this->setFlash('success', "The details have been added to the event!");
                    } else {
                        $this->setFlash('failure', "We could not create your event location!");
                    }
                }
                if (!empty($_POST['eventTime'])){
                    if( $this->postModel->createEventTime($n,$t,$f, $time)){
                        $this->setFlash('success', "The details have been added to the event!");
                    } else {
                        $this->setFlash('failure', "We could not create your event location!");
                    }
                }
                if (!empty($_POST['eventArea'])) {
                    if($this->postModel->createEventLocation($n,$t,$f, $area)){
                        $this->setFlash('success', "The details have been added to the event!");
                    } else {
                        $this->setFlash('failure', "We could not create your event location!");
                    }
                }
            }
        }
        $this->redirect('main/events');
    }


    public function toggleVote($event){
        if (isset($_SESSION['loggedUser'])){
            if ($this->postModel->createVote($_SESSION['loggedUser'], $event)){
                $this->setFlash('success', 'The vote has been added');
            } else{ 
                $this->setFlash('failure', 'There was a problem voting');
            }
        }
        $this->redirect('main/events');
    }

    public function revokeVote($event) {
        if (isset($_SESSION['loggedUser'])){
            if ($this->postModel->deleteVote($_SESSION['loggedUser'], $event)) {
                $this->setFlash('success', 'The vote has been removed'); 
            } else {
                $this->setFlash('failure', 'There was a problem voting');
            }
        }
        $this->redirect('main/events');
    }

}
?>
