<?php
require_once "prepare.php";
$adStore =  AdsStore::instance();

switch ($_REQUEST['action']) {
    case "get_ad":
        echo $adStore->getAdJSON($_REQUEST['id']);
        break;
    
    case "get_ads":
        echo $adStore->getAdsJSON();
        break;
    
    case "store_ad":
        if( $_POST['private'] ){
            $ad = new AdsCompany($_POST);    
        }else{
            $ad = new AdsPrivatePerson($_POST);    
        }
        
        $CheckResult = AdChecker::check($ad);
        if ( $CheckResult ){    // Проверка на заполнение полей
            $result['status']='error';
            $result['message'] = $CheckResult;
        } else {
            $ad->save()->refresh();              // Иначе - сохранение и обновление из БД

            $smarty->assign('ad',$ad);
            $result['ad_row']=$smarty->fetch('table_row.tpl.html');
            $result['status']='success';
            $result['message'] = "Объявление ".$ad->getTitle()." успешно сохранено.";
        }
        echo json_encode($result);
        break;
    
    case "delete":
        if($adStore->deleteAds($_REQUEST['id'])){
            $result['status']='success';
            $result['message'] = "Объявление о продаже ".$_REQUEST['id']." удалено успешно";
        }else{
            $result['status']='error';
            $result['message'] = "Ошибка выполнения запроса на удаление";
        }
        echo json_encode($result);

        break;

    default:
        break;
}

?>