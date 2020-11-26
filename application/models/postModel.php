<?php

class postModel extends databaseService
{

    /**
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
        if ($this->Query("INSERT INTO messages (msgTo, msgFrom, msgSubject, msgText)
        VALUES(?,?,'EVENTS',?)", [$msgTo, $msgFrom, $msgText])) {
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
        VALUES(?,?,?,'EVENTSDATE',?)", [$eventID, $msgTo, $msgFrom, $msgText])) {
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
        VALUES(?,?,?,'EVENTSTIME',?)", [$eventID,$msgTo, $msgFrom, $msgText])) {
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
    function createEventLocation($eventID,$msgTo, $msgFrom, $msgText)
    {
        //create the event itself
        if ($this->Query("INSERT INTO messages (replyTo,msgTo, msgFrom, msgSubject, msgText)
        VALUES(?,?,?,'EVENTSLOCATION',?)", [$eventID,$msgTo, $msgFrom, $msgText])) {
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
        VALUES(?,?,'VOTE') WHERE NOT EXISTS (SELECT replyTo, msgFrom FROM messages WHERE replyTo = ? AND msgFrom = ? AND msgSubject = 'VOTE')", [$name, $msgFrom, $name, $msgFrom])) {
            return true;
        } else {
            return false;
        }
    }
    //count all the votes for some message
    function countVotes($event){
        if ($this->Query("SELECT COUNT(DISTINCT mid) FROM messages WHERE msgSubject='VOTE' AND replyTo = ?", [$event])) {
            return $this->fetchAll();
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

    /**
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
        if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach FROM messages 
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
        if ($this->Query("SELECT DISTINCT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach FROM messages 
        WHERE msgSubject = 'EVENTS' AND (msgTo = ? 
        OR msgFrom = ? 
        OR msgTo IN (SELECT eid FROM relate WHERE tid = ?) 
        OR msgTo IN (SELECT tid FROM relate WHERE eid = ?)
        OR msgFrom IN (SELECT eid FROM relate WHERE tid = ?)
        OR msgFrom IN (SELECT tid FROM relate WHERE eid = ?)) ORDER BY mid
        ", [$userId,$userId,$userId,$userId,$userId,$userId])) {
            return $this->fetch();
        }
    }
}
