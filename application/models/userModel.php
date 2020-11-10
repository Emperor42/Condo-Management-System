<?php

class userModel extends databaseService
{

    function insertUser($userId, $firstName, $lastName, $age, $email, $phone, $entityType, $user_group, $pwrd)
    {
        if($this->Query("INSERT INTO entity (userId, firstName, LastName, age,email,phone,entityType,user_group, pwrd)
        VALUES(?,?,?,?,?,?,?,?,?)", [$userId, $firstName, $lastName, $age, $email,$phone, $entityType,$user_group, $pwrd]))
        {
            return true;
        }else
        {
            return false;
        }
    }
}
