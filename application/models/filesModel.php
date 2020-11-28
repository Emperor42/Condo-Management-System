<?php

//Allows for various files to be stored directly on the databae
class fileModel extends databaseService
{

        /**
     * adds a file to the database, assumes that the file has ben opened (deal with when loading)
     * @return bool
     */
    function insertFile($fileData, $mime)
    {
        if ($this->Query("INSERT INTO files (files.data, files.mime)
        VALUES(?, ?)", [$fileData, $mime])) {
            return true;
        } else {
            return false;
        }
    }

            /**
     * updates a file to the database, assumes that the file has ben opened (deal with when loading)
     * @return bool
     */
    function updateFile($id, $fileData, $mime)
    {
        if ($this->Query("UPDATE files SET mime = ?, data = ? WHERE id = ?", [$mime, $fileData, $id])) {
            return true;
        } else {
            return false;
        }
    }

    //Fetches only one file from the database to be rendered
    function renderFile($id){
        if ($this->Query("SELECT files.data, files.mime FROM files WHERE id = ? ", [$id])) {
            return $this->fetch();
        }
    }


}
