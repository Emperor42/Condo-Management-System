<?php
//Matthew Giancola (40019131)
class postModel extends databaseService
{

    /**
     * Creates a new message ot insert into the messages table
     * @param $replyTo
     * @param $msgTo
     * @param $msgFrom
     * @param $msgSubject
     * @param $msgText
     * @param $msgAttach
     * @return bool
     */
    function insertMessage($replyTo, $msgTo, $msgFrom, $msgSubject, $msgText, $msgAttach)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ($this->Query("INSERT INTO iac353_2.messages (replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach)
        VALUES(?,?,?,?,?,?)", [$replyTo, $msgTo, $msgFrom, $msgSubject, $msgText, $msgAttach])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * The is a helper function which creates a series of messages which allow for the creation of an event
     * @param $msgTo is the group that the event involves
     * @param $msgFrom is the user who created the event
     * @param $name is the name of the event
     * @return bool
     */
    function createEvent($msgTo, $msgFrom, $name)
    {
        //create the event itself
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        if ($this->Query("INSERT INTO iac353_2.messages (replyTo, msgTo, msgFrom, msgSubject, msgText)
        VALUES(?,?,?,'EVENTS',?)", [-1, $msgTo, $msgFrom, $name])) {
            return true;
        } else {
            return false;
        }
    }

        /**
     * The is a helper function which creates a series of messages which allow for the creation of an event
     * @param $msgTo is the group that the event involves
     * @param $msgFrom is the user who created the event
     * @param $name is the name of the event
     * @return bool
     */
    function createPoll($msgTo, $msgFrom, $name)
    {
        //create the event itself
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        if ($this->Query("INSERT INTO iac353_2.messages (replyTo, msgTo, msgFrom, msgSubject, msgText)
        VALUES(?,?,?,'POLLS',?)", [-1, $msgTo, $msgFrom, $name])) {
            return true;
        } else {
            return false;
        }
    }

        /**
     * The is a helper function which creates a series of messages which allow for the creation of an event
     * @param $msgTo is the group that the event involves
     * @param $msgFrom is the user who created the event
     * @param $name is the name of the event
     * @return bool
     */
    function createEventDate($eventID,$msgTo, $msgFrom, $name)
    {
        //create the event itself
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        if ($this->Query("INSERT INTO iac353_2.messages (replyTo, msgTo, msgFrom, msgSubject, msgText)
        VALUES(?,?,?,'EVENTSDATE',?)", [$eventID, $msgTo, $msgFrom, $name])) {
            return true;
        } else {
            return false;
        }
    }

        /**
     * The is a helper function which creates a series of messages which allow for the creation of an event
     * @param $msgTo is the group that the event involves
     * @param $msgFrom is the user who created the event
     * @param $msgText is the name of the event
     * @return bool
     */
    function createEventTime($eventID,$msgTo, $msgFrom, $name)
    {
        //create the event itself
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        if ($this->Query("INSERT INTO iac353_2.messages (replyTo,msgTo, msgFrom, msgSubject, msgText)
        VALUES(?,?,?,'EVENTSTIME',?)", [$eventID,$msgTo, $msgFrom, $name])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * The is a helper function which creates a series of messages which allow for the creation of an event
     * @param $msgTo is the group that the event involves
     * @param $msgFrom is the user who created the event
     * @param $msgText is the name of the event
     * @return bool
     */
    function createEventLocation($eventID,$msgTo, $msgFrom, $name)
    {
        //create the event itself
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        if ($this->Query("INSERT INTO iac353_2.messages (replyTo,msgTo, msgFrom, msgSubject, msgText)
        VALUES(?,?,?,'EVENTSLOCATION',?)", [$eventID,$msgTo, $msgFrom, $name])) {
            return true;
        } else {
            return false;
        }
    }

        /**
     * The is a helper function which creates a series of messages which allow for the creation of an event
     * @param $msgTo is the group that the event involves
     * @param $msgFrom is the user who created the event
     * @param $name is the name of the event
     * @return bool
     */
    function createContract($msgTo, $msgFrom, $name)
    {
        //create the event itself
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        if ($this->Query("INSERT INTO iac353_2.messages (replyTo, msgTo, msgFrom, msgSubject, msgText)
        VALUES(?,?,?,'CONTRACTS',?)", [-1, $msgTo, $msgFrom, $name])) {
            return true;
        } else {
            return false;
        }
    }
       /**
     * The is a helper function which creates a series of messages which allow for the creation of an event
     * @param $msgTo is the group that the event involves
     * @param $msgFrom is the user who created the event
     * @param $name is the name of the event
     * @return bool
     */
    function createContractOffer($eventID,$msgTo, $msgFrom, $name)
    {
        //create the event itself
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ($this->Query("INSERT INTO iac353_2.messages (replyTo, msgTo, msgFrom, msgSubject, msgText)
        VALUES(?,?,?,'CONTRACTSOFFER',?)", [$eventID, $msgTo, $msgFrom, $name])) {
            return true;
        } else {
            return false;
        }
    }
    
           /**
     * The is a helper function which creates a series of messages which allow for the creation of an event
     * @param $msgTo is the group that the event involves
     * @param $msgFrom is the user who created the event
     * @param $name is the name of the event
     * @return bool
     */
    function awardContractOffer($eventID,$msgFrom)
    {
        //create the event itself
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 4)){return false;}
        if ($this->Query("UPDATE iac353_2.messages SET msgSubject = 'CONTRACTSAWARD' WHERE mid = ? AND msgSubject = 'CONTRACTSOFFER' AND msgFrom=? ", [$eventID, $msgFrom])) {
            return true;
        } else {
            return false;
        }
    }

               /**
     * The is a helper function which creates a series of messages which allow for the creation of an event
     * @param $msgTo is the group that the event involves
     * @param $msgFrom is the user who created the event
     * @param $name is the name of the event
     * @return bool
     */
    function completeContractOffer($eventID,$msgFrom)
    {
        //create the event itself
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 4)){return false;}
        if ($this->Query("UPDATE iac353_2.messages SET msgSubject = 'CONTRACTSCOMPLETE' WHERE mid = ? AND msgSubject = 'CONTRACTSAWARD' AND msgFrom = ? ", [$eventID, $msgFrom])) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * @param $msgFrom is the voter
     * @param $name is the item for which you are voting
     * @return bool
     */
    function createVote($msgFrom, $name)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 5)){return false;}
        //apply a new vote for something here, you can vote for multiple different things
        if ($this->Query("INSERT INTO iac353_2.messages (replyTo, msgFrom, msgSubject)
        VALUES(?,?,'VOTES')", [$name, $msgFrom])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $msgFrom is the voter
     * @param $name is the item for which you are voting
     * @return bool
     */
    function yeaVote($msgFrom, $name)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 5)){return false;}
        //apply a new vote for something here, you can vote for multiple different things
        if ($this->Query("INSERT INTO iac353_2.messages (replyTo, msgFrom, msgSubject)
        VALUES(?,?,'VOTEYEA')", [$name, $msgFrom])) {
            return true;
        } else {
            return false;
        }
    }

        /**
     * @param $msgFrom is the voter
     * @param $name is the item for which you are voting
     * @return bool
     */
    function nayVote($msgFrom, $name)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 5)){return false;}
        //apply a new vote for something here, you can vote for multiple different things
        if ($this->Query("INSERT INTO iac353_2.messages (replyTo, msgFrom, msgSubject)
        VALUES(?,?,'VOTENAY')", [$name, $msgFrom])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * removes vote a specifed vote using specified parameters
     * @param $msgFrom
     * @param $name
     * @return bool specified vote is found
     */
    function deleteVote($msgFrom, $name){
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 5)){return false;}
        if($this->Query("DELETE FROM iac353_2.messages WHERE replyTo=? AND msgFrom=? AND msgSubject LIKE 'VOTE%' ", [$name, $msgFrom])){
            return true;
        }else {
            return false;
        }
    }

    /**
     * counts all the votes on a given event
     * @param $event
     * @param $userId
     * @return array
     */
    function countVotes($event, $userId){
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ($this->Query("SELECT DISTINCT mid, replyTo FROM iac353_2.messages WHERE replyTo = ? AND msgSubject = 'VOTE'", [$event])) {
            $ret = $this->fetchAll();
            if ($this->Query("SELECT DISTINCT mid, replyTo FROM iac353_2.messages WHERE replyTo = ? AND msgSubject = 'VOTE' AND msgFrom = ?", [$event, $userId])){
                $tmp = $this->fetchAll();
                return [$ret, count($ret), count($tmp)>0];
            }
        }
    }

    /**
     * Only values that can be updated are the text and the image, one image per post
     * @param $mid
     * @param $msgText
     * @param $msgAttach
     * @return bool
     */
    function updateMessage($mid, $msgText)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ($this->Query("UPDATE iac353_2.messages SET
        msgText = ?
        WHERE mid = ?", [ $msgText, $mid])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $mid : Message ID for the message to be deleted, also makes a recursive call to remove any and all direct references
     * NOTE: Some messages are only deleted after they have been found in a get query (replies to replies for example)
     */
    function deleteMessage($mid, $sender){
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if( $this->Query("DELETE FROM iac353_2.messages WHERE (mid = ? && msgFrom=?)", [$mid, $sender])){

        }
    }

    /**
     * @return fetch : ALl users from entity, maybe modify later on
     */
    function getMessages()
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ($this->Query("SELECT * FROM iac353_2.messages", [])) {
            return $this->fetchAll();
        }
    }

    function getAds(){
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ((int)$_SESSION['loggedUser']==-1) {
            if ($this->Query("SELECT DISTINCT m.mid, m.replyTo, m.msgTo, m.msgFrom, m.msgSubject, m.msgText, m.msgAttach, e.firstName AS name, e.lastName AS coname
            FROM iac353_2.messages m, iac353_2.entity e
            WHERE m.msgFrom = e.eid AND (m.msgSubject = 'PAD')
             ORDER BY mid DESC
            ", [])) {
                return $this->fetchAll();
            }
        } else {
            if ($this->Query("SELECT DISTINCT m.mid, m.replyTo, m.msgTo, m.msgFrom, m.msgSubject, m.msgText, m.msgAttach, e.firstName AS name, e.lastName AS coname
            FROM iac353_2.messages m, iac353_2.entity e
            WHERE m.msgFrom = e.eid AND (m.msgSubject = 'PAD' OR (m.msgSubject = 'AD' AND m.msgFrom IN (select r1.eid FROM  iac353_2.relate r1,  iac353_2.relate r2 WHERE 
            r2.eid = ? AND r1.tid=r2.tid
            )))
             ORDER BY mid DESC
            ", [(int)$_SESSION['loggedUser']])) {
                return $this->fetchAll();
            }
        }
    }

    /**
     * fetches all messages destined to the specified user if they are logged in
     * @param $userId
     * @return fetch : User with provded id to pull messages from this person (sjows posts to public and from admin)
     */
    function messagesForUser($userId)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ((int)$_SESSION['loggedUser']==0){
            if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach,
            e1.userId AS toName, e2.userId AS fromName
           FROM iac353_2.messages, iac353_2.entity e1, iac353_2.entity e2 WHERE e1.eid = msgTo AND e2.eid = msgFrom 
             ORDER BY mid DESC
            ", [])) {
                return $this->fetchAll();
            }
        } elseif ((int)$_SESSION['loggedUser']==-1){
            if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach,
            e1.userId AS toName, e2.userId AS fromName
           FROM iac353_2.messages, iac353_2.entity e1, iac353_2.entity e2 WHERE e1.eid = msgTo AND e2.eid = msgFrom 
           AND (msgTo=? OR msgFrom = ?)
             ORDER BY mid DESC
            ", [(int)$_SESSION['loggedUser'],(int)$_SESSION['loggedUser']])) {
                return $this->fetchAll();
            }
        } else {
            if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach,
            e1.userId AS toName, e2.userId As fromName
           FROM iac353_2.messages, iac353_2.entity e1, iac353_2.entity e2 
           WHERE e1.eid = msgTo 
           AND e2.eid = msgFrom
           AND msgSubject='POST'
           AND (msgFrom=? OR (msgTo = ? OR msgFrom=?) OR msgFrom = ? OR msgTo = ? OR 
            msgTo IN (SELECT DISTINCT tid FROM iac353_2.relate WHERE  eid = ? )
            OR 
            msgFrom IN (SELECT DISTINCT tid FROM iac353_2.relate WHERE  eid = ? ))
           UNION
           SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach,
            e1.userId AS toName, e2.userId As fromName
           FROM iac353_2.messages, iac353_2.entity e1, iac353_2.entity e2 
           WHERE e1.eid = msgTo 
           AND e2.eid = msgFrom
           AND msgSubject='COMMENT'
           
           
           ORDER BY mid ASC
            
            ", [0,-1,-1,$userId,$userId,$userId,$userId])) {
                return $this->fetchAll();
            }
        }
    }

        /**
     * fetches all messages destined to the specified user if they are logged in AND r2.relType<3
     * @param $userId
     * @return fetch : User with provded id to pull messages from this person (sjows posts to public and from admin)
     */
    function concernsForUser($userId)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        if ((int)$_SESSION['loggedUser']==0){
            if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach,
            e1.userId AS toName, e2.userId AS fromName
           FROM iac353_2.messages, iac353_2.entity e1, iac353_2.entity e2 WHERE e1.eid = msgTo AND e2.eid = msgFrom 
             ORDER BY mid DESC
            ", [])) {
                return $this->fetchAll();
            }
        } else {
            if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach,
            e1.userId AS toName, e2.userId As fromName
           FROM iac353_2.messages, iac353_2.entity e1, iac353_2.entity e2 
           WHERE e1.eid = msgTo 
           AND e2.eid = msgFrom
           AND msgSubject='POST'
           AND msgTo != ?
           AND msgFrom != ?
           AND msgTo IN (SELECT DISTINCT tid FROM  iac353_2.relate WHERE eid = ?)
           UNION
           SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach,
            e1.userId AS toName, e2.userId As fromName
           FROM iac353_2.messages, iac353_2.entity e1, iac353_2.entity e2 
           WHERE e1.eid = msgTo 
           AND e2.eid = msgFrom
           AND msgSubject='COMMENT'
           
           
           ORDER BY mid ASC
            
            
            ", [-1,-1,$userId])) {
                return $this->fetchAll();
            }
        }
    }

        /**
     * fetches all messages destined to the specified user if they are logged in
     * @param $userId
     * @return fetch : User with provded id to pull messages from this person (sjows posts to public and from admin)
     */
    function noticesForUser($userId)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        if ((int)$_SESSION['loggedUser']==0){
            if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach,
            e1.userId AS toName, e2.userId AS fromName
           FROM iac353_2.messages, iac353_2.entity e1, iac353_2.entity e2 WHERE e1.eid = msgTo AND e2.eid = msgFrom 
             ORDER BY mid DESC
            ", [])) {
                return $this->fetchAll();
            }
        } else {
            if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach,
            e1.userId AS toName, e2.userId As fromName
           FROM iac353_2.messages, iac353_2.entity e1, iac353_2.entity e2 
           WHERE e1.eid = msgTo 
           AND e2.eid = msgFrom
           AND msgSubject='POST'
           AND msgTo != ?
           AND msgFrom != ?
           AND msgFrom IN (SELECT DISTINCT tid FROM iac353_2.relate WHERE eid = ?)
           UNION
           SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach,
            e1.userId AS toName, e2.userId As fromName
           FROM iac353_2.messages, iac353_2.entity e1, iac353_2.entity e2 
           WHERE e1.eid = msgTo 
           AND e2.eid = msgFrom
           AND msgSubject='COMMENT'
           
           
           ORDER BY mid ASC
            
            
            ", [-1,-1,$userId])) {
                return $this->fetchAll();
            }
        }
    }

     /**
     * Allows all messages with subject PM
     * @param $userIdA
     * @param $userIdB
     * @return fetch : User with provded id to pull messages from this conversation
     */
    function conversationForUsers($userIdA, $userIdB)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach 
        FROM iac353_2.messages 
        WHERE msgSubject='PM' AND ((msgTo = ? AND msgFrom = ?)
        OR (msgTo = ? AND msgFrom = ?))
        ORDER BY mid ASC", [$userIdA, $userIdB, $userIdB, $userIdA])) {
            return $this->fetchAll();
        }
    }

    /**
     * Allows all messages with subject PM if the user has a relation to the group
     * @param $userIdA
     * @param $userIdB
     * @return fetch : User with provded id to pull messages from this conversation
     */
    function conversationForGroup($user, $group)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 6)){return false;}
        if ($this->Query("SELECT DISTINCT * FROM iac353_2.relate 
        WHERE (tid=? AND eid=?) OR (tid=? AND eid=?)", [$group,$user,$user, $group])){
            if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach FROM iac353_2.messages 
            WHERE msgSubject='PM' AND ((msgTo = ?)
            OR (msgFrom = ?))
            ORDER BY mid ASC", [$group, $group])) {
                return $this->fetchAll();
            }
        }
    }

     /**
     * @param $userId
     * @return fetch : User with provded id to pull messages from this person
     */
    function eventsForUser($userId)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ($this->Query("SELECT DISTINCT m.mid, m.replyTo, m.msgTo, m.msgFrom, m.msgSubject, m.msgText, m.msgAttach, e.userId AS poster
        IF( (m.mid=n.replyTO AND n.msgFrom = ? AND n.msgSubject LIKE 'VOTE%'),true, false) AS voted, 
        (SELECT DISTINCT COUNT(k.mid) FROM iac353_2.messages k WHERE k.replyTO=m.mid AND k.msgSubject LIKE 'VOTE%')
         AS votes FROM iac353_2.messages m, iac353_2.messages n,  iac353_2.entity e WHERE (m.msgSubject LIKE 'EVENTS%') AND (m.msgTo = ? OR m.msgFrom = ?
 OR m.msgTo = -1 OR m.msgFrom = -1 
                                                                                  
OR m.msgTo IN (SELECT eid FROM  iac353_2.relate WHERE tid = ?)
OR m.msgTo IN (SELECT tid FROM  iac353_2.relate WHERE eid = ?) 
OR m.msgFrom IN (SELECT eid FROM  iac353_2.relate WHERE tid = ?) 
OR m.msgFrom IN (SELECT tid FROM  iac353_2.relate WHERE eid = ?)) AND m.msgFrom = e.eid
ORDER BY m.mid ASC, voted DESC
        ", [$userId,$userId,$userId,$userId,$userId,$userId,$userId])) {
            return $this->fetchAll();
        }
    }

         /**
     * @param $userId
     * @return fetch : User with provded id to pull messages from this person
     */
    function contractsForUser($userId)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ($this->Query("SELECT DISTINCT m.mid, m.replyTo, m.msgTo, m.msgFrom, m.msgSubject, m.msgText, m.msgAttach, CONCAT(a.firstName,' ',a.lastName) AS 'poster' FROM  iac353_2.messages m,  iac353_2.entity a WHERE m.msgSubject LIKE 'CONTRACTS%' AND a.eid = m.msgFrom ORDER BY m.mid ASC
        ", [])) {
            return $this->fetchAll();
        }
    }

         /**
     * @param $userId
     * @return fetch : User with provded id to pull messages from this person
     */
    function pollsForUser($userId)
    {
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ($this->Query("SELECT DISTINCT m.mid, m.replyTo, m.msgTo, m.msgFrom, m.msgSubject, m.msgText, m.msgAttach, 
        (m.mid=n.replyTO AND n.msgFrom = ? AND n.msgSubject LIKE 'VOTE%') AS voted, 
        ((SELECT DISTINCT COUNT(k.mid) FROM  iac353_2.messages k WHERE k.replyTO=m.mid AND k.msgSubject='VOTEYEA')-(SELECT DISTINCT COUNT(k.mid) FROM  iac353_2.messages k WHERE k.replyTO=m.mid AND k.msgSubject='VOTENAY'))
         AS votes FROM  iac353_2.messages m,  iac353_2.messages n WHERE  (m.mid != n.mid) AND ((m.msgSubject LIKE 'POLLS%') AND (m.msgTo = ? OR m.msgFrom = ?
 OR m.msgTo = -1 OR m.msgFrom = -1 
                                                                                  
OR m.msgTo IN (SELECT eid FROM  iac353_2.relate WHERE tid = ?)
OR m.msgTo IN (SELECT tid FROM  iac353_2.relate WHERE eid = ?) 
OR m.msgFrom IN (SELECT eid FROM  iac353_2.relate WHERE tid = ?) 
OR m.msgFrom IN (SELECT tid FROM  iac353_2.relate WHERE eid = ?))) 
ORDER BY m.mid ASC, voted DESC", [$userId,$userId,$userId,$userId,$userId,$userId,$userId])) {
            return $this->fetchAll();
        }
    }

    function postToForUser($userId){
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ($this->Query("SELECT DISTINCT tid AS eid, userId from  iac353_2.relate,  iac353_2.entity WHERE  iac353_2.relate.eid=? AND  iac353_2.relate.tid= iac353_2.entity.eid 
        UNION SELECT DISTINCT eid, userId FROM  iac353_2.entity WHERE eid =? 
        UNION SELECT DISTINCT eid, userId FROM  iac353_2.entity WHERE eid =? 
        UNION SELECT DISTINCT eid, userId FROM  iac353_2.entity WHERE eid =?", [$userId,$userId,0,-1])) {
            return $this->fetchAll();
        }
    }

    function postFromForUser($userId){
        if(!$this->hasGeneralAccess($_SESSION['loggedUser'], 1998)){return false;}
        if ($this->Query("SELECT DISTINCT tid AS eid, userId from  iac353_2.relate,  iac353_2.entity WHERE  iac353_2.relate.relType<? AND  iac353_2.relate.eid=? AND  iac353_2.relate.tid= iac353_2.entity.eid 
        UNION SELECT DISTINCT eid, userId FROM  iac353_2.entity WHERE eid =? ", [3,$userId,$userId])) {
            return $this->fetchAll();
        }
    }
}
