<?php
$eid = 0;
$counter = 0;
if(isset($_COOKIE[$loggedUser])) {
  //we can work with the given values
  $eid = (int)$_COOKIE[$loggedUser];
  //for generation of my tables
  echo "<table style='border: solid 1px black;'>";
  echo "<tr><th>User Id</th><th>Name</th><th>Coname</th><th>Age</th><th>Phone</th><th>Email</th><th>CUT?</th></tr>";
  
  class TableRows extends RecursiveIteratorIterator {
      
    function __construct($it) {
      parent::__construct($it, self::LEAVES_ONLY);
    }
  
    function current() {
      return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }
  
    function beginChildren() {
      echo "<tr id=\"r$counter\">";
    }
  
    function endChildren() {
      echo "<td><button onCLick=\"document.getElementById(\"r$counter\").style.display = \"none\";\"></button></td></tr>" . "\n";
      $counter=$counter+1;
    }
  }
  
  $servername = "localhost";
  $username = "root";
  $password = "database";
  $dbname = "CONMANSYSTEM";
  
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT userId, firstName, lastName, age, phone, email FROM entity WHERE entity.group = FALSE
    UNION
    SELECT eid FROM relate WHERE relate.eid = $eid
    UNION
    SELECT tid FROM relate WHERE relate.tid = $eid
    ORDER BY eid
    ");
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
  $conn = null;
  echo "</table>";
} 
?>
