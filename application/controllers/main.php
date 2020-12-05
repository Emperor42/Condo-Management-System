<?php
/*Khadija SUBTAIN-40040952*/

/**
 * This controller will deal with anything involving the main interface (combines together everything)
 */
class main extends BaseController
{
    public $userModel;
    private $postModel;
    private $condoModel;
    private $groupModel;
    private $payModel;

    public function __construct()
    {
        //Loads Base class constructor
        parent::__construct();
        $this->userModel = $this->model('userModel');
        $this->postModel = $this->model('postModel');
        $this->condoModel = $this->model('condoModel');
        $this->groupModel = $this->model('groupModel');
        $this->payModel = $this->model('payModel');
    }

    public function index()
    {
    }

    /**************************************************************/
    /*                    VIEW REQUESTS                           */
    /**************************************************************/

    /**
     * returns "wall" view if user is logged in
     * HIDDEN (NOTHING)
     */
    public function wall()
    {
        //switch to the login page if he loggedUser is not set
        if (!isset($_SESSION['loggedUser'])){
                $this->redirect('main/login');
        }
        $_SESSION['adminFunc']="Public Forum";
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        $data['core'] = $this->postModel->messagesForUser($_SESSION['loggedUser']);
        $data['top'] = $this->postModel->postToForUser($_SESSION['loggedUser']);
        $data['fop'] = $this->postModel->postFromForUser($_SESSION['loggedUser']);
        $this->view('wall', $data);
    }

        /**
     * returns "notoices" view if user is logged in, more or less a special sql query can only post notices if your an admin
     */
    public function notices()
    {
        //switch to the login page if he loggedUser is not set
        if (!isset($_SESSION['loggedUser'])){
                $this->redirect('main/login');
        }
        $_SESSION['adminFunc']="Condo Association Notices";
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        $data['core'] = $this->postModel->noticesForUser($_SESSION['loggedUser']);
        $data['top'] = $this->postModel->postToForUser($_SESSION['loggedUser']);
        $data['fop'] = $this->postModel->postFromForUser($_SESSION['loggedUser']);
        $this->view('wall', $data);
    }

        /**
     * returns "notoices" view if user is logged in, more or less a special sql query
     */
    public function concerns()
    {
        //switch to the login page if he loggedUser is not set
        if (!isset($_SESSION['loggedUser'])){
                $this->redirect('main/login');
        }
        $_SESSION['adminFunc']="Condo Owner Concerns";
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        $data['core'] = $this->postModel->concernsForUser($_SESSION['loggedUser']);
        $data['top'] = $this->postModel->postToForUser($_SESSION['loggedUser']);
        $data['fop'] = $this->postModel->postFromForUser($_SESSION['loggedUser']);
        $this->view('wall', $data);
    }

    public function classified()
    {
        //switch to the login page if he loggedUser is not set
        if (!isset($_SESSION['loggedUser'])){
                $this->redirect('main/login');
        }
        $_SESSION['adminFunc']="Classified Ads";
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        $data = $this->postModel->getAds();
        $this->view('ads', $data);
    }

    public function login(){
        //temp ffor testing
        //$this->useGroup(1998);
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
        $_SESSION['adminFunc']="PM with ".$other;
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
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
        $_SESSION['adminFunc']="Group Chat with ".$other;
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        $this->view('conversationGroup', $data);
    }


    public function events(){
        //switch to the login page if he loggedUser is not set
        if (!isset($_SESSION['loggedUser'])){
            $this->redirect('main/login');
        }
        $_SESSION['adminFunc']="Events";
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        $data['core'] = $this->postModel->eventsForUser($_SESSION['loggedUser']);
        $data['top'] = $this->postModel->postToForUser($_SESSION['loggedUser']);
        $data['fop'] = $this->postModel->postFromForUser($_SESSION['loggedUser']);
        $this->view('events', $data);
    }

    public function resolution(){
        //switch to the login page if he loggedUser is not set
        if (!isset($_SESSION['loggedUser'])){
            $this->redirect('main/login');
        }
        $_SESSION['adminFunc']="Resolutions";
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        $data['core'] = $this->postModel->pollsForUser($_SESSION['loggedUser']);
        $data['top'] = $this->postModel->postToForUser($_SESSION['loggedUser']);
        $data['fop'] = $this->postModel->postFromForUser($_SESSION['loggedUser']);
        $this->view('newpoll', $data);
    }

    public function contracts(){
        //switch to the login page if he loggedUser is not set
        if (!isset($_SESSION['loggedUser'])){
            $this->redirect('main/login');
        }
        $_SESSION['adminFunc']="Public Contracts";
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        $data['core'] = $this->postModel->contractsForUser($_SESSION['loggedUser']);
        $data['top'] = $this->postModel->postToForUser($_SESSION['loggedUser']);
        $data['fop'] = $this->postModel->postFromForUser($_SESSION['loggedUser']);
        $this->view('contracts', $data);
    }

    public function property(){
        //switch to the login page if he loggedUser is not set
        if (!isset($_SESSION['loggedUser'])){
            $this->redirect('main/login');
        }
        $_SESSION['adminFunc']="Property";
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        $myProperty = $this->condoModel->getOwnedProperties($_SESSION['loggedUser']);
        $groupProperty = $this->condoModel->getClaimedProperties();
        $data['mine'] = $myProperty;
        $data['ours'] = $groupProperty;
        $this->view('property', $data);
    }

    //the payment oveview
    public function finance($ca){
        $tmp = $this->groupModel->getAllGroupListed();
        foreach($tmp as $core){
            $ca = $core->groupId;
            $s = $this->payModel->getAccountsTotal($ca);
            $i = $this->payModel->getInAccounts($ca);
            $o = $this->payModel->getOutAccounts($ca);
            $data[$ca]['name']=$core->groupName;
            $data[$ca]['summary']=$s;
            $data[$ca]['in']=$i;
            $data[$ca]['out']=$o;
        }
        $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
        if (!empty($tmp)){
            $_SESSION['gp']=$tmp->m;
        }else {
            $_SESSION['gp']=1998;//default real high so that nothing happens
        }
        $_SESSION['adminFunc']="Condo";
        $this->view('finance', $data);
        
    
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

                $_SESSION["loggedUser"]= (int)$result->eid;
                $_SESSION["loggedName"]= strval($result->eid)." ".strval($result->firstName)." ".strval($result->lastName)." (".strval($result->userId).")";
                $_SESSION['screenName'] = 'PUBLIC';
                $_SESSION['entityType'] = -1;
                $this->setSession("screenName", strval($result->firstName));
                $this->setSession("entityType", strval($result->entityType));

                $this->setFlash('success', "WELCOME " . $_SESSION['screenName']." EID:".strval($_SESSION["loggedUser"]));
                $this->redirect('main/wall');
            } else {
                $this->setFlash('failure', "Failed to Log In ");
                $this->redirect('main/login');
            }
        }
    }

    public function logout(){
        if (isset($_SESSION['loggedUser'])){
            $_SESSION["loggedUser"]="";
            $_SESSION["loggedName"]= "";
            $_SESSION["screenName"]="";
            $_SESSION["entityType"]="";
            $this->setSession("screenName", "");
            $this->setSession("entityType", "");

                
        }
        $this->setFlash('success', "You are now logged out!");
        $this->redirect('main/login');
    }

    public function startEvent(){
        if (isset($_SESSION['loggedUser'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $t=(int)$this->input($_POST['eventGroup']);
                $f=(int)$this->input($_POST['eventStart']);
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

    public function startContract(){
        if (isset($_SESSION['loggedUser'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $t=(int)$this->input($_POST['eventGroup']);
                $f=(int)$this->input($_POST['eventStart']);
                $n=$this->input($_POST['eventNamed']);
                if ($this->postModel->createContract($t,$f,$n)){
                    $this->setFlash('success', "Your event has been created!");
                } else {
                    $this->setFlash('failure', "We could not create your event!");
                }
            }
        }
        $this->redirect('main/contracts');
    }

    //CODE IS RECYCLED SO SOME OF THE NAMES MAY NOT MAKE THE MOST CONTEXTUAL SENSE!
    public function addContractDetails(){
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
                    if( $this->postModel->createContractOffer($n,$t,$f, $date)){
                        $this->setFlash('success', "The details have been added to the event!");
                    } else {
                        $this->setFlash('failure', "We could not create your event location!");
                    }
                }
                if (!empty($_POST['eventTime'])){
                    if( $this->postModel->awardContractOffer($n,$f)){
                        $this->setFlash('success', "The details have been added to the event!");
                    } else {
                        $this->setFlash('failure', "We could not create your event location!");
                    }
                }
                if (!empty($_POST['eventArea'])) {
                    if($this->postModel->completeContractOffer($n,$f)){
                        $this->setFlash('success', "The details have been added to the event!");
                    } else {
                        $this->setFlash('failure', "We could not create your event location!");
                    }
                }
            }
        }
        $this->redirect('main/contracts');
    }

    public function startPoll(){
        if (isset($_SESSION['loggedUser'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $t=(int)$this->input($_POST['eventGroup']);
                $f=(int)$this->input($_POST['eventStart']);
                $n=$this->input($_POST['eventNamed']);
                if ($this->postModel->createPoll($t,$f,$n)){
                    $this->setFlash('success', "Your poll has been created!");
                } else {
                    $this->setFlash('failure', "We could not create your poll!");
                }
            }
        }
        $this->redirect('main/resolution');
    }



    //polling for  various resolutions

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

    public function nayVote($event){
        if (isset($_SESSION['loggedUser'])){
            if ($this->postModel->nayVote($_SESSION['loggedUser'], $event)){
                $this->setFlash('success', 'The vote has been added');
            } else{ 
                $this->setFlash('failure', 'There was a problem voting');
            }
        }
        $this->redirect('main/resolution');
    }

    public function yeaVote($event){
        if (isset($_SESSION['loggedUser'])){
            if ($this->postModel->yeaVote($_SESSION['loggedUser'], $event)){
                $this->setFlash('success', 'The vote has been added');
            } else{ 
                $this->setFlash('failure', 'There was a problem voting');
            }
        }
        $this->redirect('main/resolution');
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

    public function revokePollVote($event) {
        if (isset($_SESSION['loggedUser'])){
            if ($this->postModel->deleteVote($_SESSION['loggedUser'], $event)) {
                $this->setFlash('success', 'The vote has been removed'); 
            } else {
                $this->setFlash('failure', 'There was a problem voting');
            }
        }
        $this->redirect('main/resolution');
    }
    //group (Condo Association Setting)

    public function useGroup($group){
        if (isset($_SESSION['loggedUser'])){
            $data = $this->groupModel->getDetails($group);
            if (!empty($data)) {
                $_SESSION['useGroup'] = $data->eid;
                $_SESSION['useName'] = $data->groupName;
                $this->setFlash('success', 'The active group has ben changed!'); 
            } else {
                $_SESSION['useGroup'] = $group;
                $_SESSION['useName'] = '';
                $this->setFlash('failure', 'The group can\'t be found, there may be issues until one is set');
            }
        }
    }
//payment
//$to, $from, $pay, $total, $class, $memo
function addPayment(){
    if (isset($_SESSION['loggedUser'])){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $a=(int)$this->userModel->getUser($this->input($_POST['to']))->eid;
            $b=(int)$this->userModel->getUser($this->input($_POST['from']))->eid;
            $c=(int)$this->input($_POST['pay']);
            $d=(int)$this->input($_POST['total']);
            $e=$this->input($_POST['class']);
            $f=$this->input($_POST['memo']);
            if ($this->payModel->insertPayment($a, $b, $c, $d, $e, $f)) {
                $this->setFlash('success', 'The property has been created'); 
            } else {
                $this->setFlash('failure', 'The property could not be created');
            }
        }
    }
    $this->redirect('main/property');
}

    // property management
    //address, owner, share, manager
    function newProperty(){
        if (isset($_SESSION['loggedUser'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $n=$this->input($_POST['address']);
                if ($this->condoModel->insertProperty($n)) {
                    $na = (int)$this->condoModel->getPropertyByAddress($n)->pid;
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        //$n=$this->input($_POST['address']);
                        $o = (int)$this->userModel->getUser($this->input($_POST['owner']))->eid;
                        $s = (int)$this->input($_POST['share']);
                        if ($s>100) {
                            $s =100;
                            $this->setFlash('warning', 'Ownership has been set to 100'); 
                        }
                        if ($s<=0) {
                            $s =0;
                            $this->setFlash('failure', 'Ownership has to be set between 1 and 100!'); 
                        } else {
                            if ($this->condoModel->insertOwner($na, $o, $s)) {
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    //$n=$this->input($_POST['address']);
                                    $m=(int)$this->userModel->getUser($this->input($_POST['manager']))->eid;
                                    if ($this->condoModel->insertManager($na, $m)) {
                                        $this->setFlash('success', 'The property has been updated'); 
                                    } else {
                                        $this->setFlash('failure', 'The property could not be updated');
                                    }
                                } 
                            } else {
                                $this->setFlash('failure', 'The property could not be changed');
                            }
                        }
                    }
                } else {
                    $this->setFlash('failure', 'The property could not be created');
                }
            }
        }
        $this->redirect('main/property');
    }

    function addProperty(){
        if (isset($_SESSION['loggedUser'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $n=$this->input($_POST['address']);
                if ($this->condoModel->insertProperty($n)) {
                    $this->setFlash('success', 'The property has been created'); 
                } else {
                    $this->setFlash('failure', 'The property could not be created');
                }
            }
        }
        $this->redirect('main/property');
    }

    public function addOwner(){
        if (isset($_SESSION['loggedUser'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $n=$this->input($_POST['address']);
                $o = $this->input($_POST['owner']);
                $s = (int)$this->input($_POST['share']);
                if ($s>100) {
                    $s =100;
                    $this->setFlash('warning', 'Ownership has been set to 100'); 
                }
                if ($s<=0) {
                    $s =0;
                    $this->setFlash('failure', 'Ownership has to be set between 1 and 100!'); 
                } else {
                    if ($this->condoModel->insertOwner($n, $o, $s)) {
                        $this->setFlash('success', 'The property has a new owner been created'); 
                    } else {
                        $this->setFlash('failure', 'The property could not be changed');
                    }
                }
            }
        }
        $this->redirect('main/property');
    }

    function addManager(){
        if (isset($_SESSION['loggedUser'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $n=$this->input($_POST['address']);
                $m=$this->input($_POST['manager']);
                if ($this->condoModel->insertManager($n, $m)) {
                    $this->setFlash('success', 'The property has been updated'); 
                } else {
                    $this->setFlash('failure', 'The property could not be updated');
                }
            }
        }
        $this->redirect('main/property');
    }

    // property management
    function dropProperty(){
        if (isset($_SESSION['loggedUser'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $n=$this->input($_POST['address']);
                if ($this->condoModel->deleteProperty($n)) {
                    $this->setFlash('success', 'The property has been created'); 
                } else {
                    $this->setFlash('failure', 'The property could not be created');
                }
            }
        }
        $this->redirect('main/property');
    }

    public function changeOwner(){
        if (isset($_SESSION['loggedUser'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $n=$this->input($_POST['address']);
                $o = $this->input($_POST['owner']);
                $s = (int)$this->input($_POST['share']);
                if ($s>100) {
                    $s =100;
                    $this->setFlash('warning', 'Ownership has been set to 100'); 
                }
                if ($s<=0) {
                    $s =0;
                    $this->setFlash('failure', 'Ownership has to be set between 1 and 100!'); 
                } else {
                    if ($this->condoModel->updatePropertyOwner($n, $o, $s)) {
                        $this->setFlash('success', 'The property has a new owner been created'); 
                    } else {
                        $this->setFlash('failure', 'The property could not be changed');
                    }
                }
            }
        }
        $this->redirect('main/property');
    }

    function changeManager(){
        if (isset($_SESSION['loggedUser'])){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $n=$this->input($_POST['address']);
                $m=$this->input($_POST['manager']);
                if ($this->condoModel->updatePropertyManager($n, $m)) {
                    $this->setFlash('success', 'The property has been updated'); 
                } else {
                    $this->setFlash('failure', 'The property could not be updated');
                }
            }
        }
        $this->redirect('main/property');
    }


}
?>
