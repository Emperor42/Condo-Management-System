<?php

class createUser extends BaseController
{
    public function index()
    {
        $this->view('register');
    }

    public function registerUser()
    {
        $userId = "";
        $firstName = "";
        $lastName = "";
        $age = 2020;
        $email = "";
        $phone = "";
        $entityType = 2020;
        $user_group = 0;
        $pwrd = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST["userId"])) {
                $userId = $this->input($_POST["userId"]);
            } else {
                throw new Exception("userId is required to be set!", 1);
            }
            if (!empty($_POST["firstName"])) {
                $firstName = $this->input($_POST["firstName"]);
            }
            if (!empty($_POST["lastName"])) {
                $lastName = $this->input($_POST["lastName"]);
            }
            if (!empty($_POST["age"])) {
                $age = (int)$this->input($_POST["age"]);
            }
            if (!empty($_POST["email"])) {
                $email = $this->input($_POST["email"]);
            }
            if (!empty($_POST["phone"])) {
                $phone = $this->input($_POST["phone"]);
            }
            if (!empty($_POST["entityType"])) {
                $entityType = (int)$this->input($_POST["entityType"]);
            } else {
                throw new Exception("entityTYpe is required to be set!", 1);
            }
            if (!empty($_POST["pwrd"])) {
                $pwrd = $this->input($_POST["pwrd"]);
            }
        }

        $myModel = $this->model('userModel');
        if ($myModel->insertUser($userId, $firstName, $lastName, $age, $email, $phone, $entityType, $user_group, $pwrd)) {
            echo "user has been created";
        } else {
            echo "issue in creating user";
        }
        $this->redirect("index.php");
    }
}

?>