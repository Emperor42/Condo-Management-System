    <?php
    class groupModel extends databaseService
    {

        /**
         * @param $ownerId
         * @param $userId
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
         * @param $ownerId

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
            if ($this->Query("SELECT g.* FROM groups g INNER JOIN entity e ON g.userId = e.userId WHERE g.ownerId=?", [$ownerId] )) {
                return $this->fetchAll();
            }
        }

        /**
         * @return fetch : Fetches all groups. To be used by an Admin
         */
        function getAllGroups()
        {
            if ($this->Query("SELECT * FROM groups", [] )) {
                return $this->fetchAll();
            }
        }
    }

