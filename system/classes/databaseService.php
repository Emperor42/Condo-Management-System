<?php
//Khadija SUBTAIN-40040952
class databaseService
{

    public $host = HOST;
    public $user = USER;
    public $database = DATABASE;
    public $password = PASSWORD;
    public $con;
    public $preparedStmt;

    /**
     * databaseService constructor.
     */
    public function __construct()
    {

        date_default_timezone_set('America/Toronto');

        try {
            $this->con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->user, $this->password);
            $this->con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            echo "Database connection Error: " . $e->getMessage();

        }
    }

    /**
     * @param $qry
     * @param array $params
     * @return bool
     */
    public function Query($qry, $params = [])
    {
        try {


            if (empty($params)) {

                $this->preparedStmt = $this->con->prepare($qry);
                return $this->preparedStmt->execute();

            } else {
                $this->preparedStmt = $this->con->prepare($qry);
                return $this->preparedStmt->execute($params);
            }
        } catch(PDOException $e) {
            echo $qry . "<br>" . $e->getMessage();
        }
    }

    /**
     * @return row count for last executed query
     */
    public function rowCount()
    {
        return $this->preparedStmt->rowCount();
    }

    public function last(){
        return $this->conn->lastInsertId();
    }

    /**
     * @return fetch all rows from last executed query
     */
    public function fetchAll()
    {
        return $this->preparedStmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @return fetch results from last executed query
     */
    public function fetch()
    {
        return $this->preparedStmt->fetch(PDO::FETCH_OBJ);
    }
}