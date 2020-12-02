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
                $data = $this->groupModel->getUserGroups((int)$_SESSION['loggedUser']);
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
            $this->view('groupDetails', $data, $gid);//guarentees that group id is present even if the group has no memebers
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

        /**
         * specified group will be deleted given the groupId
         * @param $groupId
         */
        public function deleteGroupRequest($groupId)
        {
            $this->groupModel->deleteGroup($groupId)
                ?
                $this->setFlash('success', 'Group [' . $groupId . "] deleted successfully!")
                :
                $this->setFlash('failure', "Problem deleting group [" . $groupId . "] ");

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
                if($this->groupModel->checkNonMemberUser($groupId, $user_id)){
                    $this->groupModel->insertUserToGroup($groupId,$user_id);
                    $this->setFlash('success', "User is added." );
                    $this->redirect('group/manageGroups');
                } else {
                    $this->setFlash('failure', "User is a member." );
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

        /**
         * @param $ownerId
         * takes the id of the user and add him/her as the owner of the group
         */
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
        }

        /**
         * deletes a user from a group user their respective id's
         * redirect to the group details view
         * @param $ownerId
         * @param $userId
         */
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