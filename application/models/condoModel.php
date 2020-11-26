<?php

//combines property and ownership and management
class condoModel extends databaseService
{

    /**
     * adds a property to property table
     * @return bool
     */
    function insertProperty($place)
    {
        if ($this->Query("INSERT INTO property (property.address)
        VALUES(?)", [$place])) {
            return true;
        } else {
            return false;
        }
    }

     /**
      * adds an owner to the own table
     * @return bool
     */
    function insertOwner($place, $owner,$share)
    {
        if ($this->Query("INSERT INTO own (eid, pid, myShare)
        VALUES(?,?,?)", [$owner, $place, $share])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * adds manager to the manager table
     * @return bool
     */
    function insertManager($place, $owner)
    {
        if ($this->Query("INSERT INTO manager (eid, pid)
        VALUES(?,?)", [$owner, $place])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * updates the own table by updating the property owner
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
    function updatePropertyOwner($userId, $property, $share)
    {
        if ($this->Query("UPDATE own SET
        firstName = ?

        WHERE userId = ?", [$firstName, $lastName, $age, $email, $phone, $entityType, $userGroup, $password, $userId])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * removes a property from the database
     * @param $userId : User id for the user to be deleted
     */
    function deleteProperty($userId){
        return $this->Query("DELETE FROM property WHERE pid = ?", [$userId]);
    }

    /**
     * gets all owned properties
     * @return fetch : ALl users from entity
     */
    function getOwnedProperties($eid)
    {
        if ($this->Query("SELECT property.address own.share FROM property INNER JOIN own 
        WHERE property.pid=own.pid 
        AND ?=own.eid", [$eid])) {
            return $this->fetchAll();
        }
    }

    /**
     * gets all managed properties
     * @return fetch : ALl users from entity
     */
    function getManagedProperties($gid)
    {
        if ($this->Query("SELECT property.address FROM property INNER JOIN manage WHERE property.pid=manage.pid 
        AND ?=manage.eid", [$gid])) {
            return $this->fetchAll();
        }
    }

}
