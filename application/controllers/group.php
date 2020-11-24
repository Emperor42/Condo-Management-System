    <?php

    /**
     * This controller will deal anything to do with group
     */
    class group extends BaseController
    {
        private $groupModel;
        private $userModel;

        public function __construct()
        {
            //Loads Base class constructor
            parent::__construct();
            $this->groupModel = $this->model('groupModel');
            $this->userModel = $this->model('userModel');
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
                $data = $this->getGroups((int)$_SESSION['loggedUser']);
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
            $this->view('createGroup');
        }
        

        public function addUser($gid){
            //$data = $this->userModel->getUsers($gid);
            //$this->view('userListForGroup', $data);
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $groupId = $_POST['gid'];
                $user_id = $_POST['uid'];
                $this->addMemberToGroup($groupId, $user_id);
            }
            $this->redirect('group/groupDetails/'.$gid);
        }

        /**
         * Returns groupDetails view
         */
        public function groupDetails($groupId)
        {
            $data = $this->groupModel->getGroupDetails($groupId);
            $gid = $groupId;
            $this->view('groupDetails', $data, $gid);//guarentees that group id is present even if the group has no memebers
        }


        /**
         * Returns editGroup view
         */
        public function editGroups()
        {
            //TODO hard coding Owner ID.. To be changed later
            if(isset($_SESSION['loggedUser'])){
                $ownerId = (int)$_SESSION['loggedUser'];
                $data = $this->groupModel->getGroupList($ownerId);
                $this->view('EditGroups',$data);
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


        public function deleteGroupRequest($groupId)
        {
            $this->groupModel->deleteGroup($groupId)
                ?
                $this->setFlash('success', 'Group [' . $groupId . "] deleted successfully!")
                :
                $this->setFlash('failure', "Problem deleting group [" . $groupId . "] ");

            $this->redirect('group/manageGroups');
        }

        public function addMemberToGroup($groupId, $user_id){
            if(isset($_SESSION['loggedUser'])){
                //$gid, $userId
                if($this->groupModel->checkNonMemberUser($groupId) != $user_id){
                    $this->groupModel->insertUserToGroup($groupId,$user_id);
                    $this->setFlash('success', "User is added." );
                    $this->redirect('group/manageGroups');
                } else {
                    $this->redirect('main/login');
                }
            }
            //$gid, $userId
        }

        public function createGroupRequest()
        {
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

        public function selfAddToGroup($groupId){
            if(isset($_SESSION['loggedUser'])){
                $ownerId = (int)$_SESSION['loggedUser'];
                $this->groupModel->insertUserToGroup($groupId,$ownerId);
                $this->setFlash('success', 'A request to add yourself has been made to the group!');
                $this->redirect('group/manageGroups');
            } else {
                $this->redirect('main/login');
            }
            //$gid, $userId
            
        }

        /** Get groups pertaining to an owner id
         * @param $ownerId
         * @return mixed
         */
        public function getGroups($ownerId)
        {
            /*Check if the owner is also an admin.
            If he/she is an admin, then return all groups, else
            return only groups which the owner owns*/

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
        }

        public function addOwnerOfGroup($ownerId)
        {
            $dataRow = $this->groupModel->insertGroupOwner($ownerId);
            $data = [
                'data'=>$dataRow,
                'nameError' => '',
                'priceError' => '',
                'qualityError' => ''
            ];
            $this->view('AddedOwner', $data);
        }

        public function addUserToGroup($gid, $userId)
        {
            if($this->groupModel->insertUserToGroup($gid, $userId)){
                $this->setFlash('success', 'User added successfully to group' );
            } else {
                $this->setFlash('failure', 'User has not been added to group' );
            }
            //$this->view('AddedUser', $data);
            $this->redirect('group/groupDetails/'.$gid);//custom redirect based on group
        }

        public function deleteUserFromGroup($ownerId,$userId)
        {
            if ($this->groupModel->deleteUserFromGroup($ownerId, $userId)){
                $this->setFlash('success', 'User deleted successfully from group' );
            } else {
                $this->setFlash('failure', 'Problem deleting user from group');
            }
                $this->redirect('group/groupDetails/'.$ownerId);//custom redirect based on group
        }
    }

    ?>