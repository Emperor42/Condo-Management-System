<?php
    /*Khadija SUBTAIN-40040952*/
    /*Matthew GIANCOLA-40019131*/
    /**
     * This controller will deal anything to do with group
     */
    class group extends BaseController
    {
        private $groupModel;
        private $userModel;
        private $loginModel;

        public function __construct()
        {
            //Loads Base class constructor
            parent::__construct();
            $this->groupModel = $this->model('groupModel');
            $this->userModel = $this->model('userModel');
            $this->loginModel = $this->model('loginModel');
        }

        public function index()
        {
        }

        /**************************************************************/
        /*                    VIEW REQUESTS                           */
        /**************************************************************/

        /**
         * Returns manageGroups view
         */
        public function manageGroups()
        {
            //switch to the login page if he loggedUser is not set
            if (isset($_SESSION['loggedUser'])){
                $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
                if (!empty($tmp)){
                    $_SESSION['gp']=$tmp->m;
                }else {
                    $_SESSION['gp']=1998;//default real high so that nothing happens
                }
                $data['view'] = $this->groupModel->getUserGroups((int)$_SESSION['loggedUser']);
                $data['join'] = $this->groupModel->getAllUserGroups((int)$_SESSION['loggedUser']);
                
                //checking permission
                if($this->loginModel->checkAccess((int)$_SESSION['loggedUser'],-1, 300)){
                    $this->redirect('user/home');
                }
                
                $this->view('manageGroups',$data);
            } else {
                $this->redirect('main/login');
            }
        }

        /**
         * Returns createGroup view
         */
        public function createGroup()
        {
            $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
            if (!empty($tmp)){
                $_SESSION['gp']=$tmp->m;
            }else {
                $_SESSION['gp']=1998;//default real high so that nothing happens
            }

            //checking permission
            if($this->loginModel->checkAccess($_SESSION['loggedUser'],-1, 300)){
                $this->redirect('user/home');
            }

            $this->view('createGroup');
        }

        /**
         * adds a user to a group with specified group id
         * @param $gid
         */
        public function addUser($gid){
            //$data = $this->userModel->getUsers($gid);
            //$this->view('userListForGroup', $data);
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $groupId = $_POST['gid'];
                $user_id = (int)($this->userModel->getUser($_POST['uid'])->eid);

                //checking permission
                if($this->loginModel->checkAccess($_SESSION['loggedUser'],$gid, 3)){
                    $this->redirect('user/home');
                }
                
                $this->addMemberToGroup($groupId, $user_id);
            }
            
            $this->redirect('group/groupDetails/'.$gid);
        }

        /**
         * Returns groupDetails with group details for specified groupid
         * @param $groupId
         */
        public function groupDetails($groupId)
        {
            $data = $this->groupModel->getGroupDetails($groupId);
            $gid = $groupId;
            $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
            if (!empty($tmp)){
                $_SESSION['gp']=$tmp->m;
            }else {
                $_SESSION['gp']=1998;//default real high so that nothing happens
            }
            $tmp = $this->userModel->specificPermission($_SESSION['loggedUser'], $groupId);
            if (!empty($tmp)){
                $_SESSION['sp']=$tmp->m;
            }else {
                $_SESSION['sp']=1998;//default real high so that nothing happens
            }
            if ($_SESSION['sp']<4){
                //checking permission
                if($this->loginModel->checkAccess($_SESSION['loggedUser'],$groupId, 3)){
                    $this->redirect('user/home');
                }
                $this->view('groupDetails', $data, $gid);//guarentees that group id is present even if the group has no memebers
            }else {
                $this->setFlash('failure','You dont have permission to access this!');
                $this->redirect('/user/home');
            }
        }


        /**
         * Returns editGroup view if user is logged in
         * otherwise, login view
         */
        public function editGroups()
        {
            //TODO hard coding Owner ID.. To be changed later
            if(isset($_SESSION['loggedUser'])){
                $ownerId = (int)$_SESSION['loggedUser'];
                $data = $this->groupModel->getGroupList($ownerId);
                $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
            if (!empty($tmp)){
                $_SESSION['gp']=$tmp->m;
            }else {
                $_SESSION['gp']=1998;//default real high so that nothing happens
            }
                $tmp = $this->userModel->specificPermission($_SESSION['loggedUser'], $groupId);
            if (!empty($tmp)){
                $_SESSION['sp']=$tmp->m;
            }else {
                $_SESSION['sp']=1998;//default real high so that nothing happens
            }
            if ($_SESSION['sp']<2){
                $this->view('EditGroups',$data);
            }else {
                $this->setFlash('failure','You dont have permission to access this!');
                $this->redirect('/user/home');
            }
            } else {
                $this->redirect('main/login');
            }
           // return $data;
        }

        /**
         * Returns editOrRemove view
         * @param $ownerId
         * @return
         */
        /*
        public function editOrRemove()
        {
            $data = $this->userModel->getUsers();
            $this->view('EditOrRemove', $data);
        }
        */

        /**************************************************************/
        /*                    ACTION REQUESTS                         */
        /**************************************************************/

        /**
         * specified group will be deleted given the groupId
         * @param $groupId
         */
        public function deleteGroupRequest($groupId)
        {
            $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
            if (!empty($tmp)){
                $_SESSION['gp']=$tmp->m;
            }else {
                $_SESSION['gp']=1998;//default real high so that nothing happens
            }
            $tmp = $this->userModel->specificPermission($_SESSION['loggedUser'], $groupId);
            if (!empty($tmp)){
                $_SESSION['sp']=$tmp->m;
            }else {
                $_SESSION['sp']=1998;//default real high so that nothing happens
            }
            if ($_SESSION['sp']<2){
            $this->groupModel->deleteGroup($groupId)
                ?
                $this->setFlash('success', 'Group [' . $groupId . "] deleted successfully!")
                :
                $this->setFlash('failure', "Problem deleting group [" . $groupId . "] ");
            }else {
                $this->setFlash('failure','You dont have permission to access this!');
                $this->redirect('/user/home');
            }
            $this->redirect('group/manageGroups');
        }

        /**
         * adds a user to a group using userid and groupid
         * returns manage group view if logged in, else  login view
         * @param $groupId
         * @param $user_id
         */
        public function addMemberToGroup($groupId, $user_id){
            if(isset($_SESSION['loggedUser'])){
                //$gid, $userId
                $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
            if (!empty($tmp)){
                $_SESSION['gp']=$tmp->m;
            }else {
                $_SESSION['gp']=1998;//default real high so that nothing happens
            }
                $tmp = $this->userModel->specificPermission($_SESSION['loggedUser'], $groupId);
            if (!empty($tmp)){
                $_SESSION['sp']=$tmp->m;
            }else {
                $_SESSION['sp']=1998;//default real high so that nothing happens
            }
            if ($_SESSION['sp']<2){
                if($this->groupModel->checkNonMemberUser($groupId, $user_id)){
                    $this->groupModel->insertUserToGroup($groupId,$user_id);
                    $this->setFlash('success', "User is added." );
                    $this->redirect('group/manageGroups');
                } else {
                    $this->setFlash('failure', "User is a member." );
                }
            }else {
                $this->setFlash('failure','You dont have permission to access this!');
                $this->redirect('/user/home');
            }
            }
            else {
                $this->redirect('main/login');
            }
            //$gid, $userId
        }

        /**
         * for an admin to create to the group and flashes the
         * message of success and failure based on creation of group
         */
        public function createGroupRequest()
        {
            $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
            /*if (!empty($tmp)){
                $_SESSION['gp']=$tmp->m;
            }else {
                $_SESSION['gp']=1998;//default real high so that nothing happens
            }*/
            // Value validation happens at client side, so no need to check for blanks here
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $this->groupModel->insertGroup(
                    $this->input($_POST["groupName"]),
                    $this->input($_POST["groupDescription"]))
                    ?
                    $this->setFlash('success', 'Group' . $this->input($_POST["groupName"]) . " created successfully!")
                    :
                    $this->setFlash('failure', "Problem creating group " . $this->input($_POST["groupName"]));

                $this->redirect('group/manageGroups');
            }
        

        }

        /**
         * @param $groupId
         */
        public function selfAddToGroup($groupId){
            if(isset($_SESSION['loggedUser'])){
                $ownerId = $_SESSION['loggedUser'];
                if ($this->groupModel->checkNonMemberUser($groupId, $ownerId)){
                    $this->groupModel->insertUserToGroup($groupId,$ownerId);
                    $this->setFlash('success', 'A request to add yourself has been made to the group!');
                    $this->redirect('group/manageGroups');
                }else {
                    $this->setFlash('failure', 'YOu are already a member of thr group!');
                    $this->redirect('group/manageGroups');
                }
            } else {
                $this->redirect('main/login');
            }
            //$gid, $userId
            
        }

        /**
         * Get groups pertaining to an owner id
         * @param $ownerId
         * @return mixed
         */
        public function getGroups($ownerId)
        {
            /*Check if the owner is also an admin.
            If he/she is an admin, then return all groups, else
            return only groups which the owner owns*/
            $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
            if (!empty($tmp)){
                $_SESSION['gp']=$tmp->m;
            }else {
                $_SESSION['gp']=1998;//default real high so that nothing happens
            }
                $tmp = $this->userModel->specificPermission($_SESSION['loggedUser'], $groupId);
            if (!empty($tmp)){
                $_SESSION['sp']=$tmp->m;
            }else {
                $_SESSION['sp']=1998;//default real high so that nothing happens
            }
            if ($_SESSION['sp']<5){
            $user = $this->userModel->getUser($ownerId);
            $user = (Array)$user;
            //echo $user["entityType"]; //uc

            //TODO: Hard coding 123 as an admin. To be decided later on
            if((int)$_SESSION['loggedUser']==0){
               // print_r($this->groupModel->getAllGroups());
                return $this->groupModel->getAllGroups();
            }else{
                //return $this->groupModel->getGroupList($ownerId);
                return $this->groupModel->getGroupDetails($ownerId);
                //return $this->groupModel->getAllGroups();
                
                //print_r($this->groupModel->getGroupList($ownerId));
            }
        }else {
            $this->setFlash('failure','You dont have permission to access this!');
            $this->redirect('/user/home');
        }
            
        }

        /**
         * @param $ownerId
         * takes the id of the user and add him/her as the owner of the group
         */
        public function addOwnerOfGroup($ownerId)
        {
            $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
            if (!empty($tmp)){
                $_SESSION['gp']=$tmp->m;
            }else {
                $_SESSION['gp']=1998;//default real high so that nothing happens
            }
                $tmp = $this->userModel->specificPermission($_SESSION['loggedUser'], $groupId);
            if (!empty($tmp)){
                $_SESSION['sp']=$tmp->m;
            }else {
                $_SESSION['sp']=1998;//default real high so that nothing happens
            }
            if ($_SESSION['sp']<2){
            $dataRow = $this->groupModel->insertGroupOwner($ownerId);
            $data = [
                'data'=>$dataRow,
                'nameError' => '',
                'priceError' => '',
                'qualityError' => ''
            ];
            $this->view('AddedOwner', $data);
        }else {
            $this->setFlash('failure','You dont have permission to access this!');
            $this->redirect('/user/home');
        }
        }

        /**
         * adds user to group given user id, group id
         * flashes a success or failure message
         * redirects to custom group page
         * @param $gid
         * @param $userId
         *
         */
        public function addUserToGroup($gid, $userId)
        {
            $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
            if (!empty($tmp)){
                $_SESSION['gp']=$tmp->m;
            }else {
                $_SESSION['gp']=1998;//default real high so that nothing happens
            }
                $tmp = $this->userModel->specificPermission($_SESSION['loggedUser'], $groupId);
            if (!empty($tmp)){
                $_SESSION['sp']=$tmp->m;
            }else {
                $_SESSION['sp']=1998;//default real high so that nothing happens
            }
            if ($_SESSION['sp']<2){
            if ($this->groupModel->checkNonMemberUser($groupId, $ownerId)){
                if($this->groupModel->insertUserToGroup($gid, $userId)){
                    $this->setFlash('success', 'User added successfully to group' );
                } else {
                    $this->setFlash('failure', 'User has not been added to group' );
                }
            }else {
                $this->setFlash('failure', 'User is already a member of thr group!' );
            }
            //$this->view('AddedUser', $data);
            $this->redirect('group/groupDetails/'.$gid);
        }else {
            $this->setFlash('failure','You dont have permission to access this!');
            $this->redirect('/user/home');
        }
        }

        /**
         * deletes a user from a group user their respective id's
         * redirect to the group details view
         * @param $ownerId
         * @param $userId
         */
        public function deleteUserFromGroup($ownerId,$userId)
        {
            $tmp = $this->userModel->generalPermission($_SESSION['loggedUser']);
            if (!empty($tmp)){
                $_SESSION['gp']=$tmp->m;
            }else {
                $_SESSION['gp']=1998;//default real high so that nothing happens
            }
                $tmp = $this->userModel->specificPermission($_SESSION['loggedUser'], $groupId);
            if (!empty($tmp)){
                $_SESSION['sp']=$tmp->m;
            }else {
                $_SESSION['sp']=1998;//default real high so that nothing happens
            }
            if ($_SESSION['sp']<3){
            if ($this->groupModel->deleteUserFromGroup($ownerId, $userId)){
                $this->setFlash('success', 'User deleted successfully from group' );
            } else {
                $this->setFlash('failure', 'Problem deleting user from group');
            }
                $this->redirect('group/groupDetails/'.$ownerId);//custom redirect based on group
            }else {
                $this->setFlash('failure','You dont have permission to access this!');
                $this->redirect('/user/home');
            }
        }
    }

    ?>
