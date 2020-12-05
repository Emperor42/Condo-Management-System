<?php
//Khadija SUBTAIN-40040952
function linkCSS($cssPath){


    $url = BASEURL . "/" .$cssPath;
    echo '<link rel="stylesheet" href="'. $url .'">';


}

function linkJS($jsPath){

    $url = BASEURL. "/". $jsPath;
    echo '<script src="'. $url .'"></script>';
}



?>