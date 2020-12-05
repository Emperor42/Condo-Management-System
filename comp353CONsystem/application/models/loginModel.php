<?php
/*Khadija SUBTAIN-40040952*/
/*Matthew GIANCOLA-40019131
Daniel GAUVIN 40061905
We can use this to check privilege on all the other models to prevent access events and whatnot

*/

class loginModel extends databaseService
{
    /**
     * creates a new user in entity table
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
        if ($this->Query("INSERT INTO entity (userId, firstName, lastName, age,email,phone,entityType,user_group, pwrd)
        VALUES(?,?,?,?,?,?,?,?,?)", [$userId, $firstName, $lastName, $age, $email, $phone, $entityType, $userGroup, $password])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * updates rows in the entity table
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
     * remove a particular user using their userId
     * @param $userId : User id for the user to be deleted
     */
    function deleteUser($userId){
        return $this->Query("DELETE FROM entity WHERE userId = ?", [$userId]);
    }

    /**
     * get all users in the entity table
     * @return fetch : ALl users from entity
     */
    function getUsers()
    {
        if ($this->Query("SELECT * FROM entity", [])) {
            return $this->fetchAll();
        }
    }

    /**
     * get a user in the entity table using the userId
     * @param $userId
     * @return fetch : User with provded id
     */
    function getUser($userId)
    {
        if ($this->Query("SELECT * FROM entity WHERE userId = ?", [$userId])) {
            return $this->fetch();
        }
    }

    
}
