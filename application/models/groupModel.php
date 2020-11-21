<?php

class groupModel extends databaseService
{

    function insertGroup($groupName, $groupDescription)
    {
        if ($this->Query("INSERT INTO groups
            VALUES(?,?, ?)", [NULL, $groupName, $groupDescription])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $ownerId
     * @param $userId
     * @return bool
     */
    function insertGroupOwner($ownerId)
    {
        if ($this->Query("INSERT INTO Gropus ($ownerId)
            VALUES(?)", [$ownerId])) {
            return true;
        } else {
            return false;
        }
    }

    function insertUserToGroup($ownerId, $userId)
    {
        if ($this->Query("INSERT INTO Groups ($ownerId, $userId)
            VALUES(?,?)", [$ownerId, $userId])) {
            return true;
        } else {
            return false;
        }
    }

    function deleteUserFromGroup($ownerId, $userId)
    {
        if ($this->Query("DELETE FROM Groups ($ownerId, $userId)
            VALUES(?,?)", [$ownerId, $userId])) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * @param $ownerId
     * @return bool
     */

    /**
     * @param $ownerId : User id for the user to be deleted
     */
    function deleteGroup($groupId)
    {
        return $this->Query("DELETE FROM groups WHERE groupId = ?", [$groupId]);
    }

    /**
     * @return fetch : ALl users from entity
     */
    function getGroupDetails($groupId)
    {
        if ($this->Query("SELECT gm.ownerId, e.userId, e.firstName, e.lastName, e.email FROM CONMANSYSTEM.entity e
                                INNER JOIN CONMANSYSTEM.groupMembership gm
                                ON e.userId = gm.userId
                                WHERE gm.groupId = ?", [$groupId])) {
            return $this->fetchAll();
        }
    }

    /**
     * @return fetch : Fetches all groups. To be used by an Admin
     */
    function getAllGroups()
    {
        if ($this->Query("SELECT * FROM groups", [])) {
            return $this->fetchAll();
        }
    }
}

