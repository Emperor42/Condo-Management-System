
<?php

// Database configurations

define("HOST", "localhost");
define("USER", "root");
define("DATABASE", "CONMANSYSTEM");
define("PASSWORD","");//define("PASSWORD", "database");

// Base URL

define("BASEURL", "http://localhost:8080/comp353CONsystem");
//The name of the directory that we need to create.

define("UPLOADURL", "public/assets/uploads");

define("LOCALPATH", "/opt/lampp/htdocs/comp353CONsystem/");

$directoryName = LOCALPATH.UPLOADURL;
 
//Check if the directory already exists.
if(!is_dir($directoryName)){
    //Directory does not exist, so lets create it.
    mkdir($directoryName, 0755);
}

?>
