<?php
/*Khadija SUBTAIN-40040952*/

/**
 * This class models a user in the system.
 * This model interfaces with the database.
 *
 * Class userModel
 */
class userModel extends databaseService
{
    /**
     * Inserts a new user in the system. This creates another row in the entity table
     * @param $userId
     * @param $firstName
     * @param $lastName
     * @param $age
     * @param $email
     * @param $phone
     * @param $entityType
     * @param $userGroup
     * @param $password
     * @return bool
     */
    function insertUser($userId, $firstName, $lastName, $age, $email, $phone, $entityType, $userGroup, $password)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 2)){return false;}
        if ($this->Query("INSERT INTO entity (userId, firstName, lastName, age,email,phone,entityType,user_group, pwrd)
        VALUES(?,?,?,?,?,?,?,?,?)", [$userId, $firstName, $lastName, $age, $email, $phone, $entityType, $userGroup, $password])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * updates information on a specified user in the entity table using their userId
     * @param $userId
     * @param $firstName
     * @param $lastName
     * @param $age
     * @param $email
     * @param $phone
     * @param $entityType
     * @param $userGroup
     * @param $password
     * @return bool
     */
    function updateUser($userId, $firstName, $lastName, $age, $email, $phone, $entityType, $userGroup, $password)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        if ($this->Query("UPDATE entity SET
        firstName = ?
        ,lastName = ?
        ,age = ?
        ,email = ?
        ,phone = ?
        ,entityType = ?
        ,user_group = ?
        ,pwrd = ?
        WHERE userId = ?", [$firstName, $lastName, $age, $email, $phone, $entityType, $userGroup, $password, $userId])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * deletes a user with the specified userId from the entity table
     * @param $userId
     * @return bool
     */
    function deleteUser($userId){
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        return $this->Query("DELETE FROM entity WHERE userId = ?", [$userId]);
    }

    /**
     * gets all users from the entity table
     * @return fetch : ALl users from entity
     */
    function getUsers()
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ($this->Query("SELECT * FROM entity WHERE user_group = ? AND userId != ?", [false, 0])) {
            return $this->fetchAll();
        }
    }

    /**
     * gets all information of a user given a userId
     * @param $userId
     * @return fetch : User with provided id
     */
    function getUser($userId)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ($this->Query("SELECT * FROM entity WHERE userId = ?", [$userId])) {
            return $this->fetch();
        }
    }

    /**
     * gets a user by its email address.
     *
     * @param $email
     * @return fetch
     */
     public function getUserByEmail($email)
     {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        $this->Query("SELECT * FROM entity WHERE email = ?", [$email]);
        return $this->fetch();
     }


     //
     //_______DO NOT ADD PERMISSION BELOW THIS IS USED ON LOGIN!________
     //
    /**
     * gets the entityId (EID) of a given user usign their userId
     * @param $userId
     * @param $pwd
     * @return fetch
     */
    function getEID($userId, $pwd){
        
        if ($this->Query("SELECT eid, userId, firstName, lastName, entityType FROM entity WHERE user_group != ? AND userId = ? AND pwrd = ?", [true, $userId, $pwd])) {
            return $this->fetch();
        }
    }

    /**
     * This method checks for the existence of a user in the system
     * @param $userId
     * @param $pwd
     * @return bool
     */
    function checkUser($userId, $pwd)
    {
        $userIdentification = trim(strip_tags($userId));
        $password = trim(strip_tags($pwd));
         if($this->Query("SELECT * FROM entity WHERE userId = ? AND pwrd = ?", [$userIdentification, $password])) {
             return empty($this->fetch()) ? false : true;
         }
    }

    function generalPermission($userId){
        if($this->Query("SELECT DISTINCT MIN(relType) AS m FROM relate WHERE eid=?", [$userId])){
            return $this->fetch();
        }
    }

    function specificPermission($userId, $groupId){
        if($this->Query("SELECT DISTINCT MIN(relType) AS m FROM relate WHERE eid=? AND tid=?", [$userId, $groupId])){
            return $this->fetch();
        }
    }
}
