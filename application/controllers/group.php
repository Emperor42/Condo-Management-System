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
            //TODO: Get owner id from using session info and UserModel.
            // Hard Coding ownerId for now as admin
            $ownerId = 789;
            //TODO hard coding Owner ID.. To be changed later
            $data = $this->getGroups($ownerId);
            $this->view('manageGroups',$data);
        }

        /**
         * Returns createGroup view
         */
        public function createGroup()
        {
            $this->view('createGroup');
        }

        /**
         * Returns groupDetails view
         */
        public function groupDetails($groupId)
        {
            $id = 4;
            $data = $this->groupModel->getGroupDetails($groupId);
            $this->view('groupDetails',$data );
        }


        /**
         * Returns editGroup view
         */
        public function editGroups()
        {
            //TODO hard coding Owner ID.. To be changed later
            $data = $this->groupModel->getGroupList(1);
            $this->view('EditGroups',$data);
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
            //echo $user["entityType"];

            //TODO: Hard coding 123 as an admin. To be decided later on
            if($user["entityType"] == 123){
               // print_r($this->groupModel->getAllGroups());
                return $this->groupModel->getAllGroups();
            }else{
                return $this->groupModel->getGroupList($ownerId);
                //print_r($this->groupModel->getGroupList($ownerId));
            }

          //  echo gettype($user);
            //print_r($user);

          //  $user = (Array)$user;
          //  echo gettype($user);
           // return $user[1];
           // print_r(array_values($user));



           /* $dataRow = $this->groupModel->insertGroupOwner($ownerId);
            $data = [
                'data'=>$dataRow,
                'nameError' => '',
                'priceError' => '',
                'qualityError' => ''
            ];
            $this->view('AddedOwner', $data);*/
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

        public function addUserToGroup($ownerId, $userId)
        {
            $dataRow = $this->groupModel->insertUserToGroup($ownerId, $userId);
            $data = [

                'data' => $dataRow,
                'nameError' => '',
                'priceError' => '',
                'qualityError' => ''

            ];
            $this->view('AddedUser', $data);
        }

        public function deleteUserFromGroup($ownerId,$userId)
        {
            $this->groupModel->deleteUserFromGroup($ownerId, $userId)
                ?
                $this->setFlash('success', 'User' . " $userId deleted successfully from group" )
                :
                $this->setFlash('failure', "Problem deleting $userId");

            $this->redirect('group/EditGroups');
        }

    }

    ?>