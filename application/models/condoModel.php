<?php

//combines property and ownership and management AND PAYMENTS (TODO ADD PAYMENTS!)
//Matthew Giancola (40019131)
class condoModel extends databaseService
{

    /**
     * adds a property to property table
     * @return bool
     */
    function insertProperty($place)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 2)){return false;}
        if ($this->Query("INSERT INTO iac353_2.property (property.address) VALUES(?)", [$place])) {
            return true;
        } else {
            return false;
        }
    }

    function getPropertyByAddress($place){
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 2)){return false;}
        if ($this->Query("SELECT pid FROM iac353_2.property WHERE property.address=?", [$place])) {
            return $this->fetch();
        } 
    }

     /**
      * adds an owner to the own table
     * @return bool
     */
    function insertOwner($place, $owner,$share)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 3)){return false;}
        if ($this->Query("INSERT INTO iac353_2.own (eid, pid, myShare)
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
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 2)){return false;}
        if ($this->Query("INSERT INTO iac353_2.manager (eid, pid)
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
    function updatePropertyOwner($place, $owner, $share)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 3)){return false;}
        if ($this->Query("UPDATE iac353_2.own SET
        eid = ?, share = ?
        WHERE pid = ?", [$owner, $share, $place])) {
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
    function updatePropertyManager($place, $owner)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 2)){return false;}
        if ($this->Query("UPDATE iac353_2.own SET
        eid = ?
        WHERE pid = ?", [$owner, $share, $place])) {
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
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 2)){return false;}
        return $this->Query("DELETE FROM iac353_2.property WHERE pid = ?", [$userId]);
    }

    /**
     * gets all owned properties
     * @return fetch : ALl users from entity
     */
    function getOwnedProperties($eid)
    {
        if(!$this->hasSpecificAccess($_SESSION['loggedUser'],$eid, 5)){return false;}
        if ($this->Query("SELECT DISTINCT
        p.pid AS pid, 
        p.address AS address,
        g.groupName AS manage,
        e.userId AS owner,
        o.myShare AS shares
        FROM 
        iac353_2.property p,
        iac353_2.own o,
        iac353_2.manager m, 
        iac353_2.entity e,
        iac353_2.groups g
        WHERE
        o.pid = p.pid 
        AND 
        p.pid = m.pid
        AND
        m.eid = g.groupId
        AND
        o.eid = e.eid
        AND
        o.eid = ?", [$eid])) {
            return $this->fetchAll();
        }
    }

    /**
     * gets all managed properties
     * @return fetch : ALl users from entity
     */
    function getManagedProperties($gid)
    {
        if(!$this->hasSpecificAccess($_SESSION['loggedUser'],$gid, 5)){return false;}
        if ($this->Query("SELECT DISTINCT
        p.pid AS pid, 
        p.address AS address,
        g.groupName AS manage,
        e.userId AS owner,
        o.myShare AS shares
        FROM 
        iac353_2.property p,
        iac353_2.own o,
        iac353_2.manager m, 
        iac353_2.entity e,
        iac353_2.groups g
        WHERE
        o.pid = p.pid 
        AND 
        p.pid = m.pid
        AND
        m.eid = g.groupId
        AND
        o.eid = e.eid
        AND
        m.eid = ?", [$gid])) {
            return $this->fetchAll();
        }
    }

    function getClaimedProperties(){
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ($this->Query("SELECT DISTINCT
        p.pid AS pid, 
        p.address AS address,
        g.groupName AS manage,
        e.userId AS owner,
        o.myShare AS shares
        FROM 
        iac353_2.property p,
        iac353_2.own o,
        iac353_2.manager m, 
        iac353_2.entity e,
        iac353_2.groups g
        WHERE
        o.pid = p.pid 
        AND 
        p.pid = m.pid
        AND
        m.eid = g.groupId
        AND
        o.eid = e.eid", [])) {
            return $this->fetchAll();
        }
    }

}
