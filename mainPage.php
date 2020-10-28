<!DOCTYPE HTML>
<!--The following file loads all the messages which have spome relation to the logged user/group(they are a member or are from their members or are direct in some way)-->
<html>
<head>
<title>CONMAN -- Main Page</title>
</head>
<body>
<detail>
<summary>Show All Data</summary>
<?php
  $loggedUser = 0;
  echo "<table id='messagesDataTable' style='border: solid 1px black;'>";
  echo "<tr><th>MID</th><th>TO</th><th>FROM</th><th>Subject</th><th>Text</th><th>Attachments</th></tr>";

  class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
      parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
      return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
      echo "<tr>";
    }

    function endChildren() {
      echo "</tr>" . "\n";
    }
  }

  $servername = "localhost";
  $username = "root";
  $password = "database";
  $dbname = "CONMANSYSTEM";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT mid, msgTo, msgFrom, msgSubject, msgText, msgAttach FROM messages 
    WHERE msgTo = $loggedUser 
    OR msgFrom = $loggedUser 
    OR msgTo IN (SELECT eid FROM relate WHERE tid = $loggedUser) 
    OR msgTo IN (SELECT tid FROM relate WHERE eid = $loggedUser)
    OR msgFrom IN (SELECT eid FROM relate WHERE tid = $loggedUser)
    OR msgFrom IN (SELECT tid FROM relate WHERE eid = $loggedUser)
    ");
    /*above lists out the following cases
    msgTO = $loggedUser: The message is directly to the logged user
    msgFrom = $loggedUser: The message is directly from the logged user 
    msgTo IN (SELECT eid FROM relate WHERE tid = $loggedUser): The message is to a group/person to whom the logged user is related
    msgTo IN (SELECT tid FROM relate WHERE eid = $loggedUser): The message is to a person/group who has a relation to the logged user
    msgFrom IN (SELECT eid FROM relate WHERE tid = $loggedUser): The message is from an entity which is related to the logged user
    msgFrom IN (SELECT tid FROM relate WHERE eid = $loggedUser): The message is from an entity which is related to the logged user
    */
    //this is for System Admin user (eid=0)
    if ($loggedUser = 0){
      $stmt = $conn->prepare("SELECT replyTO, mid, msgTo, msgFrom, msgSubject, msgText, msgAttach FROM messages");
    }
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
      echo $v;
    }
  }
  catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  //$conn = null;
  echo "</table>";
?> 
</detail>
</body>
</html>