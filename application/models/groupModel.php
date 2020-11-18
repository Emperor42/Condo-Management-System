    <?php
    class groupModel extends databaseService
    {

        /**
         * @param $userId
         * @param $firstName
         * @param $lastName
         * @param $age
         * @param $email
         * @param $phone
         * @param $entityType
         * @param $userGroup
         * @param $password
         * @return bool
         */
        function insertGroupOwner($ownerId){
            if ($this->Query("INSERT INTO Gropus ($ownerId)
            VALUES(?)", [$ownerId])) {
                return true;
            } else {
                return false;
            }
        }
        function insertUserToGroup($ownerId, $userId){
            if ($this->Query("INSERT INTO Groups ($ownerId, $userId)
            VALUES(?,?)", [$ownerId, $userId])) {
                return true;
            } else {
                return false;
            }
        }
        function deleteUserFromGroup($ownerId, $userId)
        {
            if ($this->Query("DELETE FROM Groups ($ownerId, $userId)
            VALUES(?,?)", [$ownerId, $userId])) {
                return true;
            } else {
                return false;
            }
        }


        /**
         * @param $userId
         * @param $firstName
         * @param $lastName
         * @param $age
         * @param $email
         * @param $phone
         * @param $entityType
         * @param $userGroup
         * @param $password
         * @return bool
         */

        /**
         * @param $ownerId : User id for the user to be deleted
         */
        function deleteGroup($ownerId){
            return $this->Query("DELETE FROM Groups WHERE ownerId = ?", [$ownerId]);
        }

        /**
         * @return fetch : ALl users from entity
         */
        function getGroupList($ownerId)
        {
            if ($this->Query("SELECT e.* FROM Groups g INNER JOIN entity e ON g.userId = e.userId WHERE g.ownerId=?", [$ownerId] )) {
                return $this->fetchAll();
            }
        }

        /**
         * @param $userId
         * @return fetch : User with provded id
         */
        /*
         function getUser($userId)
         {
             if ($this->Query("SELECT * FROM entity WHERE userId = ?", [$userId])) {
                 return $this->fetch();
             }
         }
         */

    }

