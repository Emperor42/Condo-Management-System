<?php
/*Khadija SUBTAIN-40040952*/

/**
 * This class models email functionality
 * This class interfaces with the database
 *
 * Class emailModel
 */
class emailModel extends databaseService
{
    public function getUserByEmail($email)
    {
        $this->Query("SELECT * FROM entity WHERE email = ?", [$email]);
        return $this->fetch();
    }

    /**
     * Insert an email into the mail table
     *
     * @param $senderUserId
     * @param $receiverUserId
     * @param $subject
     * @param $bodyText
     * @return bool
     */
    public function insertEmail($senderUserId, $receiverUserId, $subject, $bodyText){
        if ($this->Query("INSERT INTO email (emailId, fromEid, toEid, subject, body, emailStatus, createDate, outboxDelete ,inboxDelete)
        VALUES(?,?,?,?,?,?,?,?,?)", [null, $senderUserId, $receiverUserId, $subject, $bodyText, 'New', date('Y-m-d H:i:s') ,0 ,0])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * takes the email id and marks the email as delete.
     * we do not delete emails until email has been marked delete
     * from both outbox and inbox. Then trigger will clean it up
     *
     * @param $userId
     * @param $emailId
     */
    public function markEmailDelete($userId, $emailId){

        //1 - Get info if this request is for an outbox email or an inbox email

        // 1.1 Outbox check. user ID will be the fromEid
        $this->Query("SELECT * FROM email WHERE fromEid = ? AND emailId = ?",[$userId, $emailId]);
        if($this->fetch()){
            $column = "outboxDelete";
        }else{
            $column = "inboxDelete";
        }
        $query = "UPDATE email SET $column = 1 WHERE emailId = $emailId";
        return $this->Query($query, [$emailId]);
    }

    /**
     * takes user id and retrieves the email from the table
     * @param $user_Id
     * @return fetch
     */
    public function fetchInbox($user_Id){
        if ($this->Query("SELECT *, 'inbox' AS page FROM email em INNER JOIN entity en
            ON em.toEid = en.eid
            WHERE em.inboxDelete = 0 AND em.toEid = ?
            order by createDate, emailStatus", [$user_Id])) {
            return $this->fetchAll();
        }
    }

    /**
     * @param $user_Id
     * takes user id and retrieves the email from the table
     */
    public function fetchOutbox($user_Id){
        if ($this->Query("SELECT *, 'outbox' AS page FROM email em INNER JOIN entity en
            ON em.toEid = en.eid
            WHERE em.outboxDelete = 0 AND em.fromEid = ?
            order by createDate, emailStatus", [$user_Id])) {
            return $this->fetchAll();
        }
    }

    /** returns an email based on email id which is unique
     * @param $emailId
     * @return fetch
     */
    public function getEmail($userId, $emailId, $page){

        // 1.1 Outbox check. user ID will be the fromEid
        $this->Query("SELECT * FROM email WHERE fromEid = ? AND emailId = ?",[$userId, $emailId]);
        if($this->fetch()){
            $column = "toEid";
        }else{
            $column = "fromEid";
        }

        if ($this->Query("SELECT *, '$page' AS page FROM email em INNER JOIN entity en
            ON em.$column = en.eid
            WHERE em.emailId = ?", [$emailId])) {
            return $this->fetch();
        }
    }

    /**
     * It marks an email as Read
     *
     * @param $emailId
     * @return bool
     */
    public function markEmailAsRead($emailId){
        $query = "UPDATE email SET emailStatus = 'Read' WHERE emailId = $emailId";
        return $this->Query($query, [$emailId]);
    }
}
