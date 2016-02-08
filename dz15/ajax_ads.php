<?php
require_once "prepare.php";
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' && isset($_REQUEST['id'])) {     // Кнопка "удалить" нажата?
    AdsStore::instance()->deleteAds($_REQUEST['id']); 
    echo 'Объявление успешно удалено';
}
?>