<?php

//echo phpinfo();

spl_autoload_register(function ($class) {
//    include 'classes/' . $class . '.class.php';
    echo $class;
    include $class . '.class.php';
});


$a = new my();

$a->abc = 'Hello world';

echo substr($a->abc,0,2);