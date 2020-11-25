<?php
/*Khadija SUBTAIN-40040952*/
class emailModel extends databaseService
{
    /**
     * will insert the email in the table
     */
    public function insertEmail(){

    }

    /**
     * @param $email_id
     * takes the email id and deletes it from the table
     */
    public function deleteEmail($email_id){

    }

    /**
     * @param $user_Id
     * * takes user id and retrieves the email from the table
     */
    public function fetchInbox($user_Id){
        if ($this->Query("SELECT * FROM email em INNER JOIN entity en
            ON em.toEid = en.userId
            WHERE em.toEid = ?", [$user_Id])) {
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
