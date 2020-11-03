<?php

/**
 * This controller will deal anything to do with user
 */
class user extends BaseController
{
    private $userModel;

    public function __construct()
    {
        //Loads Base class constructor
        parent::__construct();
        $this->userModel = $this->model('userModel');
    }

    public function index()
    {
    }

    /**************************************************************/
    /*                    VIEW REQUESTS                           */
    /**************************************************************/

    public function register()
    {
        $this->view('register');
    }

    public function editOrRemove()
    {
        $data = $this->userModel->getUsers();
        $this->view('EditOrRemove', $data);
    }

    /**************************************************************/
    /*                    ACTION REQUESTS                         */
    /**************************************************************/

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

    public function deleteUserRequest($userId)
    {
        $this->userModel->deleteUser($userId)
            ?
            $this->setFlash('success', 'User' . " $userId deleted successfully!")
            :
            $this->setFlash('failure', "Problem deleting $userId");

        $this->redirect('user/editOrRemove');
    }

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