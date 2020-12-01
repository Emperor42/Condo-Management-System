<?php

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
        if ($this->Query("INSERT INTO messages (replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach)
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
        if ($this->Query("INSERT INTO messages (replyTo, msgTo, msgFrom, msgSubject, msgText)
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
    function createEventDate($eventID,$msgTo, $msgFrom, $name)
    {
        //create the event itself
        if ($this->Query("INSERT INTO messages (replyTo, msgTo, msgFrom, msgSubject, msgText)
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
        if ($this->Query("INSERT INTO messages (replyTo,msgTo, msgFrom, msgSubject, msgText)
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
        if ($this->Query("INSERT INTO messages (replyTo,msgTo, msgFrom, msgSubject, msgText)
        VALUES(?,?,?,'EVENTSLOCATION',?)", [$eventID,$msgTo, $msgFrom, $name])) {
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
        //apply a new vote for something here, you can vote for multiple different things
        if ($this->Query("INSERT INTO messages (replyTo, msgFrom, msgSubject)
        VALUES(?,?,'VOTE')", [$name, $msgFrom])) {
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
        if($this->Query("DELETE FROM messages WHERE replyTo=? AND msgFrom=? AND msgSubject = 'VOTE' ", [$name, $msgFrom])){
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
        if ($this->Query("SELECT DISTINCT mid, replyTo FROM messages WHERE replyTo = ? AND msgSubject = 'VOTE'", [$event])) {
            $ret = $this->fetchAll();
            if ($this->Query("SELECT DISTINCT mid, replyTo FROM messages WHERE replyTo = ? AND msgSubject = 'VOTE' AND msgFrom = ?", [$event, $userId])){
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
        if ($this->Query("UPDATE messages SET
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
    function deleteMessage($mid){
        return $this->Query("DELETE FROM messages WHERE mid = ?", [$mid]);
    }

    /**
     * @return fetch : ALl users from entity, maybe modify later on
     */
    function getMessages()
    {
        if ($this->Query("SELECT * FROM messages", [])) {
            return $this->fetchAll();
        }
    }

    function getAds(){
        if ((int)$_SESSION['loggedUser']==-1) {
            if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach FROM messages WHERE msgSubject = 'PAD'
             ORDER BY mid DESC
            ", [])) {
                return $this->fetchAll();
            }
        } else {
            if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach 
            FROM messages 
            WHERE msgSubject = 'PAD' OR msgSubject = 'AD'
             ORDER BY mid DESC
            ", [])) {
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
        if ((int)$_SESSION['loggedUser']==0){
            if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach FROM messages 
             ORDER BY mid DESC
            ", [])) {
                return $this->fetchAll();
            }
        } else {
            if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach FROM messages 
            WHERE (msgTo = ? 
            OR msgFrom = ? 
            OR msgTo IN (SELECT eid FROM relate WHERE tid = ?) 
            OR msgTo IN (SELECT tid FROM relate WHERE eid = ?)
            OR msgFrom IN (SELECT eid FROM relate WHERE tid = ?)
            OR msgFrom IN (SELECT tid FROM relate WHERE eid = ?))
            OR msgTo = ? 
            OR msgFrom = ? ORDER BY mid DESC
            ", [$userId,$userId,$userId,$userId,$userId,$userId,-1, 0])) {
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
        if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach 
        FROM messages 
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
        if ($this->Query("SELECT DISTINCT * FROM relate 
        WHERE (tid=? AND eid=?) OR (tid=? AND eid=?)", [$group,$user,$user, $group])){
            if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach FROM messages 
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
        if ($this->Query("SELECT DISTINCT m.mid, m.replyTo, m.msgTo, m.msgFrom, m.msgSubject, m.msgText, m.msgAttach, IF( (m.mid=n.replyTO AND n.msgFrom = ? AND n.msgSubject='VOTE'),true, false) AS voted, (SELECT DISTINCT COUNT(k.mid) FROM messages k WHERE k.replyTO=m.mid AND k.msgSubject='VOTE') AS votes FROM messages m, messages n WHERE (m.msgSubject = 'VOTE' OR m.msgSubject = 'EVENTSLOCATION' OR m.msgSubject = 'EVENTS' OR m.msgSubject = 'EVENTSDATE' OR m.msgSubject = 'EVENTSTIME') AND (m.msgTo = ? OR m.msgFrom = ? OR m.msgTo IN (SELECT eid FROM relate WHERE tid = ?) OR m.msgTo IN (SELECT tid FROM relate WHERE eid = ?) OR m.msgFrom IN (SELECT eid FROM relate WHERE tid = ?) OR m.msgFrom IN (SELECT tid FROM relate WHERE eid = ?)) ORDER BY m.mid ASC, voted DESC
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
        if ($this->Query("SELECT DISTINCT m.mid, m.replyTo, m.msgTo, m.msgFrom, m.msgSubject, m.msgText, m.msgAttach FROM messages m WHERE m.msgSubject = 'CONTRACTS' OR m.msgSubject = 'CONTRACTSDATE' OR m.msgSubject = 'CONTRACTSTIME' OR m.msgSubject = 'CONTRACTSLOCATION'  ORDER BY m.mid ASC
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
        if ($this->Query("SELECT DISTINCT m.mid, m.replyTo, m.msgTo, m.msgFrom, m.msgSubject, m.msgText, m.msgAttach, IF( (m.mid=n.replyTO AND n.msgFrom = ? AND n.msgSubject='VOTE'),true, false) AS voted, (SELECT DISTINCT COUNT(k.mid) FROM messages k WHERE k.replyTO=m.mid AND k.msgSubject='VOTE') AS votes FROM messages m, messages n WHERE (m.msgSubject = 'VOTE' OR m.msgSubject = 'POLLSLOCATION' OR m.msgSubject = 'POLLS' OR m.msgSubject = 'POLLSDATE' OR m.msgSubject = 'POLLSTIME') AND (m.msgTo = ? OR m.msgFrom = ? OR m.msgTo IN (SELECT eid FROM relate WHERE tid = ?) OR m.msgTo IN (SELECT tid FROM relate WHERE eid = ?) OR m.msgFrom IN (SELECT eid FROM relate WHERE tid = ?) OR m.msgFrom IN (SELECT tid FROM relate WHERE eid = ?)) ORDER BY m.mid ASC, voted DESC
        ", [$userId,$userId,$userId,$userId,$userId,$userId,$userId])) {
            return $this->fetchAll();
        }
    }
}
