<?php

require_once "prepare.php";
$adStore =  AdsStore::instance();

$ad = new AdsPrivatePerson($db->selectRow('SELECT * FROM ads WHERE ad_id = 6'));    
//echo $ad->getTitle();
//$db->query('UPDATE ads SET  private = 1 WHERE ad_id = 6');
//$ad->refresh(6);
//print_r($ad);

//$ad->__constructor($db->selectRow('SELECT * FROM ads WHERE ad_id = 7'));    

//print_r($ad);


$smarty->assign('ad',$ad);
//$result['ad_row']=$smarty->fetch('table_row.tpl.html');
//print_r($db->Select('select * from ads') );

$vars = Array( 'title'=>'Cocod22222rile' );
    print_r($vars);
echo '<br>';
    
echo $db->query('INSERT INTO ads(?#) VALUES(?a)',  array_keys($vars),  array_values($vars));
//echo $db->query('INSERT INTO ads("title") VALUES("fdffdfdf")');
//print_r($result);

//echo $ad->getTitle();
//echo '<br>';
//echo $ad->getDate_change();
//echo '<br>';
//echo $ad->getPrivate();

?>