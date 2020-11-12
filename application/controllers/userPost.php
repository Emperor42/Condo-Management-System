<?php

/**
 * This controller will deal anything to do with user's post (messages and whatnot)
 */
class userPost extends BaseController
{
    private $postModel;

    public function __construct()
    {
        //Loads Base class constructor
        parent::__construct();
        $this->postModel = $this->model('postModel');
    }

    public function index()
    {
    }

    /**************************************************************/
    /*                    VIEW REQUESTS                           */
    /**************************************************************/

    public function wall()
    {
        $this->view('main/wall');
    }

    /**************************************************************/
    /*                    ACTION REQUESTS                         */
    /**************************************************************/

    public function editPostRequest($user_id)
    {
        $dataRow = $this->postModel->getUser($user_id);
        $data = [

            'data' => $dataRow,
            'nameError' => '',
            'priceError' => '',
            'qualityError' => ''

        ];
        $this->view('EditUser', $data);
    }

    public function deletePostRequest($userId)
    {
        $this->postModel->deletePost($userId)
            ?
            $this->setFlash('success', 'User' . " $userId deleted successfully!")
            :
            $this->setFlash('failure', "Problem deleting $userId");

        $this->redirect('main/wall');
    }

    public function changePostRequest()
    {
        // Value validation happens at client side, so no need to check for blanks here
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $this->postModel->updatePost(
                $this->input($_POST["mid"]),
                $this->input($_POST["msgText"])
                ?
                $this->setFlash('success', 'User' . $this->input($_POST["userId"]) . " updated successfully!")
                :
                $this->setFlash('failure', "Problem updating " . $this->input($_POST["userId"])));

            $this->redirect('main/wall');
        }

    }

    public function registerPostRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $msgAttach = "";
            if (!empty($_POST("msgAttach"))){
                $target_dir = "uploads/". $_COOKIE['loggedUser'];
                $target_file = $target_dir . basename($_FILES["msgAttach"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["msgAttach"]["tmp_name"]);
                if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
                }

                // Check if file already exists multiple times
                $counter = 1;
                while (file_exists($target_file)) {
                //echo "Sorry, file already exists.";
                //set the target file to the same name with series of ones until it is cleared out
                $target_file = $target_dir . str($counter) . basename($_FILES["msgAttach"]["name"]);
                $counter=$counter+1;
                //$uploadOk = 0;
                }

                // Check file size
                if ($_FILES["msgAttach"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
                }

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["msgAttach"]["tmp_name"], $target_file)) {
                        //echo "The file ". htmlspecialchars( basename( $_FILES["msgAttach"]["name"])). " has been uploaded.";
                        //setup the database to load the data in correctly when reading out from the main
                        $msgAttach = $target_file;
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            } 


            // Value validation happens at client side, so no need to check for blanks here
       

            $this->postModel->insertPost(
                (int)$this->input($_POST["replyTo"]),
                (int)$this->input($_POST["msgTO"]),
                (int)$this->input($_POST["msgFrom"]),
                $this->input($_POST["msgSubject"]),
                $this->input($_POST["msgText"]),
                $this->input($msgAttach),
                )
                ?
                $this->setFlash("Post Sent!"):
                $this->setFlash('Post Not Sent!');

            $this->redirect('main/wall');
        }
    }
}

?>