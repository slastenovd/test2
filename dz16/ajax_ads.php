<?php
require_once "prepare.php";


switch ($_REQUEST['action']) {
    case "delete":
        if(AdsStore::instance()->deleteAds($_REQUEST['id'])){
            $result['status']='success';
            $result['message'] = "Tovar ".$_REQUEST['id']." udalen uspeshno";
        }else{
            $result['status']='error';
            $result['message'] = "Ошибка выполнения запроса на удаление";
        }
//        $result['server'] = $_SERVER;    
        echo json_encode($result);

        break;

    default:
        break;
}
//
//
//if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete' && isset($_REQUEST['id'])) {     // Кнопка "удалить" нажата?
//    AdsStore::instance()->deleteAds($_REQUEST['id']); 
//    echo 'Объявление успешно удалено';
//}
?>