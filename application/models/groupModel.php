<?php

class groupModel extends databaseService
{

    function insertGroup($groupName, $groupDescription)
    {
        if ($this->Query("INSERT INTO entity (userId, user_group, pwrd) VALUES (?,?,?)", [$groupName, true, ""])) {
            if ($this->Query("SELECT eid FROM entity WHERE userId = ? AND user_group = ?", [$groupName,true])) {
                $made = $this->fetch();
                if ($this->Query("INSERT INTO groups VALUES(?,?,?)", [$made->eid, $groupName, $groupDescription])) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    /**
     * @param $ownerId
     * @param $userId
     * @return bool
     */
    function insertGroupOwner($gid, $ownerId)
    {
        if ($this->Query("INSERT INTO relate (relType, relSup, eid, tid)
            VALUES(?,?,?,?)", [0,0,$ownerId, $gid])) {
            return true;
        } else {
            return false;
        }
    }

    function insertUserToGroup($gid, $userId)
    {
        if ($this->Query("INSERT INTO entity (relType, relSup, eid, tid)
            VALUES(?,?,?,?)", [3,0,$userId,$gid])) {
            return true;
        } else {
            return false;
        }
    }

    function deleteUserFromGroup($gid, $userId)
    {
        if ($this->Query("DELETE FROM relate 
            WHERE eid=? AND tid = ?", [$userId,$gid])) {
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
        return $this->Query("DELETE FROM entity WHERE eid = ? AND user_group=?", [$groupId, true]);
    }

    /**
     * @return fetch : ALl users from entity
     */
    function getGroupDetails($groupId)
    {
        if ($this->Query("SELECT gm.tid, e.eid, e.userId, e.firstName, e.lastName, e.email FROM CONMANSYSTEM.entity e
                                INNER JOIN CONMANSYSTEM.relate gm
                                ON e.eid = gm.eid
                                WHERE gm.tid = ?", [$groupId])) {
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

