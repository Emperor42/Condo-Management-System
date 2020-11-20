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
         * Returns editGroup view
         */
        public function manageGroups($ownerId)
        {
            //TODO hard coding Owner ID.. To be changed later
            $data = $this->getGroups($ownerId);
            $this->view('manageGroups',$data);
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