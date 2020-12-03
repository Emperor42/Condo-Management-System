<?php

/**
 * This controller will deal anything to do with user's post (messages and whatnot)
 */
class userPost extends BaseController
{
    private $postModel;
    private $fileModel;

    public function __construct()
    {
        //Loads Base class constructor
        parent::__construct();
        $this->postModel = $this->model('postModel');
        $this->fileModel = $this->model('fileModel');
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

        $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function changePostRequest()
    {
        // Value validation happens at client side, so no need to check for blanks here
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $this->postModel->updateMessage(
                $this->input($_POST["mid"]),
                $this->input($_POST["msgText"]),
                )
                ?
                $this->setFlash('success', 'User' . $this->input($_POST["userId"]) . " updated successfully!")
                :
                $this->setFlash('failure', "Problem updating " . $this->input($_POST["userId"]));

            $this->redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function registerPostRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $msgAttach = "";
            //if(!empty($_POST["msgAttach"])){
                if (!empty($_FILES["msgAttach"]) && basename($_FILES["msgAttach"]["name"])!="" && basename($_FILES["msgAttach"]["name"])!=NULL){
                    $target_dir = "../".UPLOADURL."/";
                    
                    $target_file = $target_dir .$_SESSION['loggedUser']. basename($_FILES["msgAttach"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    // Check if image file is a actual image or fake image
                    if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["msgAttach"]["tmp_name"]);
                    if($check !== false) {
                        $this->setFlash("failure", "File is an image - " . $check["mime"] . ".");
                        $uploadOk = 1;
                    } else {
                        $this->setFlash("failure", "File is not an image.");
                        $uploadOk = 0;
                    }
                    }

                    // Check if file already exists multiple times
                    $counter = 1;
                    while (file_exists($target_file)) {
                        $this->setFlash("failure", "Sorry, file already exists.".basename($_FILES["msgAttach"]["name"]));
                    //set the target file to the same name with series of ones until it is cleared out
                    $target_file = $target_dir . $counter . basename($_FILES["msgAttach"]["name"]);
                    $counter=$counter+1;
                    //$uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES["msgAttach"]["size"] > 50000000) {
                        $this->setFlash("failure", "Sorry, your file is too large.");
                    $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                        $this->setFlash("failure", "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                    $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        //$this->setFlash("failure", "Sorry, your file was not uploaded.");
                    //$msgAttach = $target_file;
                    $this->redirect('main/wall');
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["msgAttach"]["tmp_name"], $target_file)) {
                            $this->setFlash("failure", "The file ". htmlspecialchars( basename( $_FILES["msgAttach"]["name"])). " has been uploaded.");
                            //setup the database to load the data in correctly when reading out from the main
                            $msgAttach = $target_file;
                        } else {
                            $this->setFlash("failure", "Sorry, there was an error uploading your file.".$target_file);
                            $msgAttach = $target_file;
                            $this->redirect('main/wall');
                        }
                    }
                                      
                } 
            //}


            // Value validation happens at client side, so no need to check for blanks here
            $this->postModel->insertMessage(
                (int)$this->input($_POST["replyTo"]),
                (int)$this->input($_POST["msgTo"]),
                (int)$this->input($_POST["msgFrom"]),
                $this->input($_POST["msgSubject"]),
                $this->input($_POST["msgText"]),
                $this->input($msgAttach),
            )
                ?
                $this->setFlash("success","Post Sent!"):
                $this->setFlash("failure",'Post Not Sent!');
                if($_SESSION['adminFunc']=="Condo Owner Concerns"){
                    $this->redirect($_SERVER['main/concerns']);
                }
                if($_SESSION['adminFunc']=="Condo Association Notices"){
                    $this->redirect($_SERVER['main/notices']);
                }
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function registerPMRequest($conversation)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $msgAttach = "";
            //if(!empty($_POST["msgAttach"])){
                if (!empty($_FILES["msgAttach"]) && basename($_FILES["msgAttach"]["name"])!="" && basename($_FILES["msgAttach"]["name"])!=NULL){
                    $target_dir = "../".UPLOADURL."/";
                    
                    $target_file = $target_dir .$_SESSION['loggedUser']. basename($_FILES["msgAttach"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    // Check if image file is a actual image or fake image
                    if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["msgAttach"]["tmp_name"]);
                    if($check !== false) {
                        $this->setFlash("failure", "File is an image - " . $check["mime"] . ".");
                        $uploadOk = 1;
                    } else {
                        $this->setFlash("failure", "File is not an image.");
                        $uploadOk = 0;
                    }
                    }

                    // Check if file already exists multiple times
                    $counter = 1;
                    while (file_exists($target_file)) {
                        $this->setFlash("failure", "Sorry, file already exists.".basename($_FILES["msgAttach"]["name"]));
                    //set the target file to the same name with series of ones until it is cleared out
                    $target_file = $target_dir . $counter . basename($_FILES["msgAttach"]["name"]);
                    $counter=$counter+1;
                    //$uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES["msgAttach"]["size"] > 50000000) {
                        $this->setFlash("failure", "Sorry, your file is too large.");
                    $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                        $this->setFlash("failure", "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                    $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        //$this->setFlash("failure", "Sorry, your file was not uploaded.");
                    $msgAttach = $target_file;
                    $this->redirect('main/wall');
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["msgAttach"]["tmp_name"], $target_file)) {
                            $this->setFlash("failure", "The file ". htmlspecialchars( basename( $_FILES["msgAttach"]["name"])). " has been uploaded.");
                            //setup the database to load the data in correctly when reading out from the main
                            $msgAttach = $target_file;
                        } else {
                            $this->setFlash("failure", "Sorry, there was an error uploading your file.".$target_file);
                            $msgAttach = $target_file;
                            $this->redirect('main/wall');
                        }
                    }
                } 
            //}


            // Value validation happens at client side, so no need to check for blanks here
       

            $this->postModel->insertMessage(
                (int)$this->input($_POST["replyTo"]),
                (int)$this->input($_POST["msgTo"]),
                (int)$this->input($_POST["msgFrom"]),
                $this->input($_POST["msgSubject"]),
                $this->input($_POST["msgText"]),
                $this->input($msgAttach),
            )
                ?
                $this->setFlash("success","Post Sent!"):
                $this->setFlash("failure",'Post Not Sent!');

            //$this->redirect($_SERVER['HTTP);
            $this->redirect('main/conversation/'.strval($_POST["msgTo"]));
        }
    }

    public function registerAdRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $msgAttach = "";
            //if(!empty($_POST["msgAttach"])){
                if (!empty($_FILES["msgAttach"]) && basename($_FILES["msgAttach"]["name"])!="" && basename($_FILES["msgAttach"]["name"])!=NULL){
                    $target_dir = "../".UPLOADURL."/";
                    
                    $target_file = $target_dir .$_SESSION['loggedUser']. basename($_FILES["msgAttach"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    // Check if image file is a actual image or fake image
                    if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["msgAttach"]["tmp_name"]);
                    if($check !== false) {
                        $this->setFlash("failure", "File is an image - " . $check["mime"] . ".");
                        $uploadOk = 1;
                    } else {
                        $this->setFlash("failure", "File is not an image.");
                        $uploadOk = 0;
                    }
                    }

                    // Check if file already exists multiple times
                    $counter = 1;
                    while (file_exists($target_file)) {
                        $this->setFlash("failure", "Sorry, file already exists.".basename($_FILES["msgAttach"]["name"]));
                    //set the target file to the same name with series of ones until it is cleared out
                    $target_file = $target_dir . $counter . basename($_FILES["msgAttach"]["name"]);
                    $counter=$counter+1;
                    //$uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES["msgAttach"]["size"] > 50000000) {
                        $this->setFlash("failure", "Sorry, your file is too large.");
                    $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                        $this->setFlash("failure", "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                    $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        //$this->setFlash("failure", "Sorry, your file was not uploaded.");
                    $msgAttach = $target_file;
                    $this->redirect('main/wall');
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["msgAttach"]["tmp_name"], $target_file)) {
                            $this->setFlash("failure", "The file ". htmlspecialchars( basename( $_FILES["msgAttach"]["name"])). " has been uploaded.");
                            //setup the database to load the data in correctly when reading out from the main
                            $msgAttach = $target_file;
                        } else {
                            $this->setFlash("failure", "Sorry, there was an error uploading your file.".$target_file);
                            $msgAttach = $target_file;
                            $this->redirect('main/wall');
                        }
                    }
                } 
            //}


            // Value validation happens at client side, so no need to check for blanks here
       

            $this->postModel->insertMessage(
                (int)$this->input($_POST["replyTo"]),
                (int)$this->input($_POST["msgTo"]),
                (int)$this->input($_POST["msgFrom"]),
                $this->input($_POST["msgSubject"]),
                $this->input($_POST["msgText"]),
                $this->input($msgAttach),
            )
                ?
                $this->setFlash("success","Post Sent!"):
                $this->setFlash("failure",'Post Not Sent!');

            $this->redirect('main/classified');
        }
    }

    public function registerGCRequest($conversation)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $msgAttach = "";
            //if(!empty($_POST["msgAttach"])){
                if (!empty($_FILES["msgAttach"]) && basename($_FILES["msgAttach"]["name"])!="" && basename($_FILES["msgAttach"]["name"])!=NULL){
                    $target_dir = "../".UPLOADURL."/";
                    
                    $target_file = $target_dir .$_SESSION['loggedUser']. basename($_FILES["msgAttach"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    // Check if image file is a actual image or fake image
                    if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["msgAttach"]["tmp_name"]);
                    if($check !== false) {
                        $this->setFlash("failure", "File is an image - " . $check["mime"] . ".");
                        $uploadOk = 1;
                    } else {
                        $this->setFlash("failure", "File is not an image.");
                        $uploadOk = 0;
                    }
                    }

                    // Check if file already exists multiple times
                    $counter = 1;
                    while (file_exists($target_file)) {
                        $this->setFlash("failure", "Sorry, file already exists.".basename($_FILES["msgAttach"]["name"]));
                    //set the target file to the same name with series of ones until it is cleared out
                    $target_file = $target_dir . $counter . basename($_FILES["msgAttach"]["name"]);
                    $counter=$counter+1;
                    //$uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES["msgAttach"]["size"] > 50000000) {
                        $this->setFlash("failure", "Sorry, your file is too large.");
                    $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                        $this->setFlash("failure", "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                    $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        //$this->setFlash("failure", "Sorry, your file was not uploaded.");
                    $msgAttach = $target_file;
                    $this->redirect('main/wall');
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["msgAttach"]["tmp_name"], $target_file)) {
                            $this->setFlash("failure", "The file ". htmlspecialchars( basename( $_FILES["msgAttach"]["name"])). " has been uploaded.");
                            //setup the database to load the data in correctly when reading out from the main
                            $msgAttach = $target_file;
                        } else {
                            $this->setFlash("failure", "Sorry, there was an error uploading your file.".$target_file);
                            $msgAttach = $target_file;
                            $this->redirect('main/wall');
                        }
                    }
                } 
            //}


            // Value validation happens at client side, so no need to check for blanks here
       

            $this->postModel->insertMessage(
                (int)$this->input($_POST["replyTo"]),
                (int)$this->input($_POST["msgTo"]),
                (int)$this->input($_POST["msgFrom"]),
                $this->input($_POST["msgSubject"]),
                $this->input($_POST["msgText"]),
                $this->input($msgAttach),
            )
                ?
                $this->setFlash("success","Post Sent!"):
                $this->setFlash("failure",'Post Not Sent!');

            //$this->redirect($_SERVER['HTTP);
            $this->redirect('main/conversationGroup/'.strval($_POST["msgTo"]));
        }
    }
}

?>