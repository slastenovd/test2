<?php

/* 
 * 
 * Функции используемые в Лабораторной 7 часть 1
 * 
 *  */


function set_ads_in_cookie() { // Сохранение объявлений в cookie
    global $ads;
    setcookie('AD', serialize($ads), time() + 3600 * 24 * 7);
}

?>