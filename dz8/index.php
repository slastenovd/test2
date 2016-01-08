<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

$project_root=$_SERVER['DOCUMENT_ROOT'];
$smarty_dir=$project_root.'/dz8/smarty/';

// put full path to Smarty.class.php
require($smarty_dir.'/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = false;

$smarty->template_dir = $smarty_dir.'templates';
$smarty->compile_dir = $smarty_dir.'templates_c';
$smarty->cache_dir = $smarty_dir.'cache';
$smarty->config_dir = $smarty_dir.'configs';


$smarty->assign('title','Лаба 8');
$smarty->assign('name','DS');
if (isset($_GET['mobile'])){
    $smarty->assign('header_template','header_mobile');
}else{
    $smarty->assign('header_template','header');
}

$contacts = array( 
                 'Alex'=> array (  'name'=>'Alexander',
                                   'fax'=>'+7888 888 888',
                                   'phone'=>array('mobile'=>'890988833','home'=>'782782334'),
                                   'email'=>'alex@mail.ru'
                                 ),
                 'Kate'=> array (  'name'=>'Katerina',
                                   'fax'=>'+7888 555 888',
                                   'phone'=>array('mobile'=>'890455988833','home'=>'2222222'),
                                   'email'=>'kate@mail.ru'
                                 ),
                 'Dima'=> array (  'name'=>'Dmitry',
                                   'fax'=>'+90903434',
                                   'phone'=>array('mobile'=>'890988833','home'=>'782782334'),
                                   'email'=>'dima@mail.ru'
                                 )
            );
$items_list = array( 23=>array('no'=>2456, 'label'=>'salad'),
                     96=>array('no'=>9678, 'label'=>'cream')
    
    );
$smarty->assign('items',$items_list);
$smarty->assign('contacts',$contacts);

//echo $_SERVER['PHP_SELF'];
$smarty->assign('href_self',$_SERVER['PHP_SELF']);

//        print_r($contacts);
$smarty->display('index.tpl');
//$file = $smarty->fetch('index.tpl');
//echo $file;
    
//$vars = $smarty->get_template_vars();
//print_r($vars);




