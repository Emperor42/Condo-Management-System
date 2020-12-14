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
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        if ($this->Query("INSERT INTO iac353_2.entity (userId, user_group, pwrd) VALUES (?,?,?)", [$groupName, true, ""])) {
            if ($this->Query("SELECT eid FROM iac353_2.entity WHERE userId = ? AND user_group = ?", [$groupName,true])) {
                $made = $this->fetch();
                if ($this->Query("INSERT INTO iac353_2.groups (groupId, groupName, groupDescription) VALUES(?,?,?)", [$made->eid, $groupName, $groupDescription])) {
                    if ($this->Query("INSERT INTO iac353_2.relate (relType, relSup, eid, tid) VALUES(?,?,?,?)", [0,0,0,$made->eid])) {
                        if ($_SESSION['loggedUser']!=0) {
                            if (!$this->Query("INSERT INTO iac353_2.relate (relType, relSup, eid, tid)
                            VALUES(?,?,?,?)", [0,0,$_SESSION['loggedUser'], $made->eid])) {return false;}
                        } 
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
    function insertGroupOwner($groupId, $ownerId)
    {
        if(!$this->hasSpecificAccess($_SESSION['loggedUser'],$groupId, 4)){return false;}
        if ($this->Query("INSERT INTO iac353_2.relate (relType, relSup, eid, tid)
            VALUES(?,?,?,?)", [0,0,$ownerId, $groupId])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $groupId
     * @param $userId
     * @return bool
     * takes user id and group id and adds the user to that group
     */
    function insertUserToGroup($groupId, $userId)
    {
        if(!$this->hasSpecificAccess($_SESSION['loggedUser'],$groupId, 3)){return false;}
        if ($this->Query("INSERT INTO iac353_2.relate (relType, relSup, eid, tid)
            VALUES(?,?,?,?)", [3,0,$userId,$groupId])) {
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
    function checkNonMemberUser($groupId, $eid)
    {
        if(!$this->hasSpecificAccess($_SESSION['loggedUser'],$groupId, 4)){return false;}
        if ($this->Query("SELECT eid FROM iac353_2.relate m WHERE m.tid=? AND m.eid=?", [$groupId, $eid])) {
            return empty($this->fetchAll());
        }
        return false;
        
    }

    /**
     * @param $groupId
     * @param $userId
     * @return bool
     * takes the group id and user id and removes him/her from the group
     */
    function deleteUserFromGroup($groupId, $userId)
    {
        if(!$this->hasSpecificAccess($_SESSION['loggedUser'],$groupId, 3)){return false;}
        if ($this->Query("DELETE FROM iac353_2.relate 
            WHERE eid=? AND tid = ?", [$userId,$groupId])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $ownerId : User id for the user to be deleted
     */
    function deleteGroup($groupId)
    {
        if(!$this->hasSpecificAccess($_SESSION['loggedUser'],$groupId, 4)){return false;}
        return $this->Query("DELETE FROM iac353_2.entity WHERE eid = ? AND user_group=?", [$groupId, true]);
    }

    /**
     * @return fetch : ALl users from entity
     */
    function getGroupDetails($groupId)
    {
        if(!$this->hasSpecificAccess($_SESSION['loggedUser'],$groupId, 5)){return false;}
        /*if ($this->Query("SELECT DISTINCT gm.tid AS groupId, e.eid AS ownerId, e.userId, e.firstName, e.lastName, e.email FROM (iac353_2.entity e
                                INNER JOIN iac353_2.relate gm
                                ON e.eid = gm.eid)
                                WHERE gm.tid = ?", [$groupId])) {*/
        if($this->Query("SELECT DISTINCT r.tid AS groupId, r.relType AS relType,r.relSup, e.eid AS ownerId, e.userId, e.firstName, e.lastName, e.email 
        FROM iac353_2.entity e INNER JOIN iac353_2.relate r
        ON e.eid = r.eid WHERE r.tid = ? OR r.eid=?", [$groupId, $groupId])){
            return $this->fetchAll();
        }
    }

    function getUserGroups($groupId){
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        if($this->Query("SELECT DISTINCT g.groupId AS groupId,g.groupName AS groupName, g.groupDescription AS groupDescription
        FROM (iac353_2.entity e INNER JOIN iac353_2.groups g ON e.eid = g.groupId), iac353_2.relate r WHERE (r.eid=? AND r.tid=g.groupId)", [$groupId])){
            return $this->fetchAll();
        }
    }

    function getAllUserGroups($groupId){
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        if($this->Query("SELECT DISTINCT g.groupId AS groupId,g.groupName AS groupName, g.groupDescription AS groupDescription
        FROM (iac353_2.entity e INNER JOIN iac353_2.groups g ON e.eid = g.groupId), iac353_2.relate r ", [$groupId])){
            return $this->fetchAll();
        }
    }

    function getDetails($groupId){
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        if($this->Query("SELECT DISTINCT *
        FROM iac353_2.entity e INNER JOIN iac353_2.groups r
        ON e.eid = r.groupId WHERE e.eid=?", [$groupId])){
            return $this->fetchAll();
        }
    }

    /**
     * @return fetch : Fetches all groups. To be used by an Admin
     */
    function getAllGroups()
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ($this->Query("SELECT DISTINCT * FROM iac353_2.groups", [])) {
            return $this->fetchAll();
        }
    }

    /**
     * @return fetch : Fetches all groups. To be used by an Admin
     */
    function getAllGroupListed()
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ($this->Query("SELECT DISTINCT groupId, groupName FROM iac353_2.groups, iac353_2.payment WHERE payment.payTo = groupId OR payment.payFrom = groupId", [])) {
            return $this->fetchAll();
        }
    }
}

