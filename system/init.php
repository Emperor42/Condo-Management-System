<?php
//Khadija SUBTAIN-40040952
spl_autoload_register(function($className){
    include "classes/$className.php";
});

$rout = new rout;

?>