<?php

/* 
 * 
 * Функции используемые в Лабораторной 7 часть 2
 * 
 *  */


function send_ads_in_file() {
    global $ads;
    file_put_contents("ads.dat", serialize($ads));
}

function receive_ads_from_file() {
    global $ads;
    if( file_exists ("ads.dat") ){
        $ads = unserialize(file_get_contents("ads.dat"));
    }
}

?>