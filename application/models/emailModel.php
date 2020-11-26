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
    /**
     * will insert the email in the table
     */
    public function insertEmail(){

    }

    /**
     * takes the email id and deletes it from the table
     * @param $email_id
     */
    public function deleteEmail($email_id){

    }

    /**
     * takes user id and retrieves the email from the table
     * @param $user_Id
     * @return fetch
     */
    public function fetchInbox($user_Id){
        if ($this->Query("SELECT * FROM email em INNER JOIN entity en
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

    }
}
