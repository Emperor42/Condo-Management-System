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
     * Only values that can be updated are the text and the image, one image per post
     * @param $mid
     * @param $msgText
     * @param $msgAttach
     * @return bool
     */
    function updateMessage($mid, $msgText)
    {
        if ($this->Query("UPDATE messages SET
        ,msgText = ?
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
     * @return fetch : User with provded id to pull messages from this person
     */
    function messagesForUser($userId)
    {
        if ($this->Query("SELECT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach FROM messages 
        WHERE msgTo = ? 
        OR msgFrom = ? 
        OR msgTo IN (SELECT eid FROM relate WHERE tid = ?) 
        OR msgTo IN (SELECT tid FROM relate WHERE eid = ?)
        OR msgFrom IN (SELECT eid FROM relate WHERE tid = ?)
        OR msgFrom IN (SELECT tid FROM relate WHERE eid = ?)
        ", [$userId,$userId,$userId,$userId,$userId,$userId])) {
            return $this->fetch();
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
        if ($this->Query("SELECT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach FROM messages 
        WHERE msgSubject='PM' AND ((msgTo = ? AND msgFrom = ?)
        OR (msgTo = ? AND msgFrom = ?))
        ORDER BY mid ASC", [$userIdA, $userIdB, $userIdB, $userIdA])) {
            return $this->fetch();
        }
    }
}
