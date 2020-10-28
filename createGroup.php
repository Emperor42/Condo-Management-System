//createGroup.php
<?php
$servername = "localhost";
$username = "root";
$password = "database";
$dbname = "CONMANSYSTEM";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $userId = "";
  $firstName = "";
  $lastName = "";
  $age = 2020;
  $email = "";
  $phone = "";
  $entityType = 2020;
  $group = True;
  $pwrd="";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST("userId"))){
            $userId = trim(stripslashes(htmlspecialchars($_POST("userId"))));
        } else {
            throw new Exception("userId is required to be set!", 1);
        }
        if (!empty($_POST("firstName"))){
            $firstName = trim(stripslashes(htmlspecialchars($_POST("firstName"))));
        }
        if (!empty($_POST("lastName"))){
            $lastName = trim(stripslashes(htmlspecialchars($_POST("lastName"))));
        }
        if (!empty($_POST("age"))){
            $age = (int)trim(stripslashes(htmlspecialchars($_POST("age"))));
        }
        if (!empty($_POST("email"))){
            $email = trim(stripslashes(htmlspecialchars($_POST("email"))));
        }
        if (!empty($_POST("phone"))){
            $phone = trim(stripslashes(htmlspecialchars($_POST("phone"))));
        }
        if (!empty($_POST("entityType"))){
            $entityType = (int)trim(stripslashes(htmlspecialchars($_POST("entityType"))));
        } else {
            throw new Exception("entityTYpe is required to be set!", 1);
        }
        if (!empty($_POST("pwrd"))){
            $pwrd = trim(stripslashes(htmlspecialchars($_POST("pwrd"))));
        }
  }
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO entity (userId, firstName, LastName, age,email,phone,entityType,group, pwrd)
  VALUES ($userId, $firstName, $lastName, $lastName, $age, $email,$phone, $entityType,$group, $pwrd)";
  // use exec() because no results are returned
  $conn->exec($sql);
  //possibly working may need to change late ron
  header("Location: index.html");//redirects to the home page 
  exit();
  //echo "New record created successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?> 