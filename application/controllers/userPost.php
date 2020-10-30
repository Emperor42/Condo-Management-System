<?php
$servername = "localhost";
$username = "root";
$password = "database";
$dbname = "CONMANSYSTEM";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $replyTo = -1;
  $msgTo = -1;
  $msgFrom = -1;
  $msgSubject = "";
  $msgText = "";
  $msgAttach="";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST("replyTo"))){
            $replyTo = (int)trim(stripslashes(htmlspecialchars($_POST("replyTo"))));
        } else {
            throw new Exception("userId is required to be set!", 1);
        }
        if (!empty($_POST("msgTo"))){
            $msgTo = (int)trim(stripslashes(htmlspecialchars($_POST("msgTo"))));
        }
        if (!empty($_POST("msgFrom"))){
            $msgFrom = (int)trim(stripslashes(htmlspecialchars($_POST("msgFrom"))));
        }
        if (!empty($_POST("msgSubject"))){
            $msgSubject = trim(stripslashes(htmlspecialchars($_POST("msgSubject"))));
        }
        if (!empty($_POST("msgText"))){
            $msgText = trim(stripslashes(htmlspecialchars($_POST("msgText"))));
        }
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
  }
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO messages (replyTo, msgTo, msgFrom, msgSubject,msgText,msgAttach)
  VALUES ($replyTo, $msgTo, $msgFrom, $msgSubject, $msgText, $msgAttach)";
  // use exec() because no results are returned
  $conn->exec($sql);
  //possibly working may need to change late ron
  header("Location: mainPage.php");//redirects to the home page 
  exit();
  //echo "New record created successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?> 