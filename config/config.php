<?php

// Database configurations

define("HOST", "iac353.encs.concordia.ca");//localhost
define("USER", "iac353_2");//root
define("DATABASE", "iac353_2");//same
define("PASSWORD","nM8E8j");//define("PASSWORD", "database");

// Base URL

define("BASEURL", "https://iac353.encs.concordia.ca/public");
//The name of the directory that we need to create.

define("UPLOADURL", "public/assets/uploads");

define("LOCALPATH", "/opt/lampp/htdocs/comp353CONsystem/");

$directoryName = LOCALPATH.UPLOADURL;
 
//Check if the directory already exists.
if(!is_dir($directoryName)){
    //Directory does not exist, so lets create it.
//    mkdir($directoryName, 0755);
}

?>
