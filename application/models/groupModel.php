<?php
//Khadija SUBTAIN-40040952
//Matthew GIANCOLA-40019131
class groupModel extends databaseService
{
    /**
     * @param $groupName
     * @param $groupDescription
     * @return bool
     * takes the group name and description and creates the group
     */
    function insertGroup($groupName, $groupDescription)
    {
        if ($this->Query("INSERT INTO entity (userId, user_group, pwrd) VALUES (?,?,?)", [$groupName, true, ""])) {
            if ($this->Query("SELECT eid FROM entity WHERE userId = ? AND user_group = ?", [$groupName,true])) {
                $made = $this->fetch();
                if ($this->Query("INSERT INTO groups VALUES(?,?,?)", [$made->eid, $groupName, $groupDescription])) {
                    if ($this->Query("INSERT INTO relate (relType, relSup, eid, tid) VALUES(?,?,?,?)", [0,0,0,$made->eid])) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    /**
     * insert a group owner to the group
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

    /**
     * @param $gid
     * @param $userId
     * @return bool
     * takes user id and group id and adds the user to that group
     */
    function insertUserToGroup($gid, $userId)
    {
        if ($this->Query("INSERT INTO relate (relType, relSup, eid, tid)
            VALUES(?,?,?,?)", [3,0,$userId,$gid])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $groupId
     * @return fetch
     * takes the group Id and checks if the users from an entity table
     * are part of that group or not
     */
    function checkNonMemberUser($groupId)
    {
        if ($this->Query("SELECT * FROM entity e WHERE e.eid NOT IN (SELECT eid FROM relate m WHERE m.tid=?)", [$groupId])) {
        }
        return $this->fetchAll();
    }

    /**
     * @param $gid
     * @param $userId
     * @return bool
     * takes the group id and user id and removes him/her from the group
     */
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
        /*if ($this->Query("SELECT DISTINCT gm.tid AS groupId, e.eid AS ownerId, e.userId, e.firstName, e.lastName, e.email FROM (CONMANSYSTEM.entity e
                                INNER JOIN CONMANSYSTEM.relate gm
                                ON e.eid = gm.eid)
                                WHERE gm.tid = ?", [$groupId])) {*/
        if($this->Query("SELECT DISTINCT r.tid AS groupId, r.relType, e.eid AS ownerId, e.userId, e.firstName, e.lastName, e.email 
        FROM entity e INNER JOIN relate r
        ON e.eid = r.eid WHERE r.tid = ? ", [$groupId])){
            return $this->fetchAll();
        }
    }

    /**
     * @return fetch : Fetches all groups. To be used by an Admin
     */
    function getAllGroups()
    {
        if ($this->Query("SELECT DISTINCT * FROM groups", [])) {
            return $this->fetchAll();
        }
    }
}

