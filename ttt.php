<?php
//
//$post['AD_id'] = 25;
//$post['price'] = 566;
//$post['name'] = 'Dmitry';
//$s['AD'][1] = $post;
//
//$post['AD_id'] = 254;
//$post['price'] = 100    ;
//$post['name'] = 'Kate';
//$s['AD'][2] = $post;
//
//$post['AD_id'] = 2;
//$post['price'] = 66;
//$post['name'] = 'Sonia';
//$s['AD'][3] = $post;
//
//echo '<br>'.  max($s['AD'][]);
if (!file_put_contents("ads.xvr", "123456") ){
    echo 'Не удалось охранить файл';
}

echo file_get_contents("ads.xvr");
//print_r($_SERVER);