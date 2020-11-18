    <?php

    /**
     * This controller will deal anything to do with group
     */
    class group extends BaseController
    {
        private $groupModel;

        public function __construct()
        {
            //Loads Base class constructor
            parent::__construct();
            $this->groupModel = $this->model('groupModel');
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
        public function editGroups()
        {
            //TODO hard coding Owner ID.. To be changed later
            $data = $this->groupModel->getGroupList(1);
            $this->view('EditGroups',$data);
        }
        /**
         * Returns editOrRemove view
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

            $this->redirect('user/EditGroups');
        }

    }

    ?>