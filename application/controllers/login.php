<?php
/**
 * khadija Subtain-40040952
 */
/**
 * This controller will deal anything to do with login
 */
class login extends BaseController
{
    private $loginModel;

    /**
     * login default constructor
     */
    public function __construct()
    {
        //Loads Base class constructor
        parent::__construct();
        $this->loginModel = $this->model('loginModel');
    }

    public function index()
    {
    }

    /**************************************************************/
    /*                    VIEW REQUESTS                           */
    /**************************************************************/

    /**
     * Returns register view
     */
    public function login()
    {
        $this->view('login');
    }

    /**
     * Returns editOrRemove view with
     * a specified userId
     * @param $user_id
     */
    public function validateUser($user_id)
    {
        if($user_id == $this->loginModel->getUsers())
        $data = $this->loginModel->getUsers();
        // check if it exist of
        $this->view('login', $data);
    }

    /**************************************************************/
    /*                    ACTION REQUESTS                         */
    /**************************************************************/

    /**
     * returns EditUser View using a user id
     * @param $user_id
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
     * deletes userRequests and redirects to editOrRemove View
     * @param $userId
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
     * updates the user information to the newly edited
     * version of the user
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
     * creates a user and inserts the user information into
     * in the user model table
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