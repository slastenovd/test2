<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);

require_once "settings.php";
require_once "functions.php";
require_once "FirePHPCore/FirePHP.class.php";
require_once MY_DBSIMPLE_DIR."DbSimple/Generic.php";
require_once MY_DBSIMPLE_DIR."config.php";
require_once MY_SMARTY_DIR.'/libs/Smarty.class.php';

$firePHP = FirePHP::getInstance(true);
$firePHP->setEnabled(true);

$smarty = new Smarty();
$smarty->compile_check = true;
$smarty->template_dir = MY_SMARTY_DIR.'templates';
$smarty->compile_dir  = MY_SMARTY_DIR.'templates_c';
$smarty->cache_dir    = MY_SMARTY_DIR.'cache';
$smarty->config_dir   = MY_SMARTY_DIR.'configs';

if (! $iniArray = getParamsFromIniFile(INI_FILE_NAME) ){
    echo 'Отсутствует '.INI_FILE_NAME.' файл. Перейдите к <a href="install.php">установке</a>';
    exit;
}

$db = DbSimple_Generic::connect('mysqli://'.$iniArray['UserName'].':'.$iniArray['Password'].'@'.$iniArray['ServerName'].'/'.$iniArray['Database']);
$db->setErrorHandler('databaseErrorHandler');    
$db->setLogger('myLogger');

?>