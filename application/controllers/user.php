<?php
/*
 * Khadija SUBTAIN-40040952
 * Daniel Gauvin- 40061905
*/

/**
 * This controller will deal anything to do with user
 */
class user extends BaseController
{
    private $userModel;
    private $loginModel;

    /**
     * user default constructor
     */
    public function __construct()
    {
        //Loads Base class constructor
        parent::__construct();
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
     * returns the user's home page (userHome View)
     */
    public function home(){
        $data = $this->userModel->getLoggedUserData();
        $this->view('UserHome', $data);
    }

    /**
     * Returns register view
     */
    public function register()
    {
        $this->view('register');
    }
    /**
     * Returns editOrRemove view
     */
    public function editOrRemove()
    {
        $data = $this->userModel->getUsers();
        $this->view('EditOrRemove', $data);
    }


    /**************************************************************/
    /*                    ACTION REQUESTS                         */
    /**************************************************************/

    /**
     * @param $user_id
     *  takes user ID, edits the information of user and returns the user
     * edited information on EditUser
     */
    public function editUserRequest($user_id)
    {
        $dataRow = $this->userModel->getUser($user_id);
        $data = [

            'data' => $dataRow,
            'nameError' => '',
            'priceError' => '',
            'qualityError' => ''

        ];
        $this->view('EditUser', $data);
    }

    /**
     * @param $userId
     *  takes user ID, deletes the row with the information of user and returns the
     * page where the user has been deleted and redirects the user to editOrRemove
     */
    public function deleteUserRequest($userId)
    {
        $this->userModel->deleteUser($userId)
            ?
            $this->setFlash('success', 'User' . " $userId deleted successfully!")
            :
            $this->setFlash('failure', "Problem deleting $userId");

        $this->redirect('user/editOrRemove');
    }

    /**
     * updates the user information and flashes the message with
     * success and failure regarding the update of the information
     * redirects the user to editOrRemove
     */
    public function updateUserRequest()
    {
        $age = 2020;
        $userGroup = 0;

        // Value validation happens at client side, so no need to check for blanks here
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $this->userModel->updateUser(
                $this->input($_POST["userId"]),
                $this->input($_POST["firstName"]),
                $this->input($_POST["lastName"]),
                $age,
                $this->input($_POST["email"]),
                $this->input($_POST["phone"]),
                (int)$this->input($_POST["entityType"]),
                $userGroup,
                $password = $this->input($_POST["pwrd"]))
                ?
                $this->setFlash('success', 'User' . $this->input($_POST["userId"]) . " updated successfully!")
                :
                $this->setFlash('failure', "Problem updating " . $this->input($_POST["userId"]));

            $this->redirect('user/editOrRemove');
        }

    }

    /**
     * Register user's information and flashes a message with
     * successful or failed attempt
     * redirects the user to register page
     */
    public function registerUserRequest()
    {
        $age = 2020;
        $userGroup = 0;

        // Value validation happens at client side, so no need to check for blanks here
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $this->userModel->insertUser(
                $this->input($_POST["userId"]),
                $this->input($_POST["firstName"]),
                $this->input($_POST["lastName"]),
                $age,
                $this->input($_POST["email"]),
                $this->input($_POST["phone"]),
                (int)$this->input($_POST["entityType"]),
                $userGroup,
                $password = $this->input($_POST["pwrd"]))
                ?
                $this->setFlash('success', 'User ' . $this->input($_POST["userId"]) . " created successfully!")
                :
                $this->setFlash('failure', "Problem creating " . $this->input($_POST["userId"]));

            $this->redirect('user/register');
        }
    }
}

?>