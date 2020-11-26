<?php

function linkCSS($cssPath){


    $url = BASEURL . "/public/" .$cssPath;
    echo '<link rel="stylesheet" href="'. $url .'">';


}

function linkJS($jsPath){

    $url = BASEURL. "/public/". $jsPath;
    echo '<script src="'. $url .'"></script>';
}



?>