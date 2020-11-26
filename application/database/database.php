<?php
echo "<table style='border: solid 1px black;'>";

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
$dbname = "CONMANSYS";

try {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $getType = $_GET['q'];
        switch($getType){
            case "Example":
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $stmt = $conn->prepare("SELECT id, firstname, lastname FROM MyGuests WHERE lastname='Doe'"); 
                $stmt->execute();
                
                // set the resulting array to associative
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                    echo $v;
                }
            break;
            default:
                echo "NOTHING HERE";
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        $getType = $_POST['q'];
        switch($getType){
            case "Example":
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $stmt = $conn->prepare("SELECT id, firstname, lastname FROM MyGuests WHERE lastname='Doe'"); 
                $stmt->execute();
                
                // set the resulting array to associative
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                    echo $v;
                }
            break;
            default:
                echo "NOTHING HERE";
        }
    }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?> 
