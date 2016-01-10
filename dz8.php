<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

$AD_flag = 0;        // 0-новое, 1-исправление, 2-просмотр
$ads     = array();  // Массив объявлений
$err_msg = false;

require( 'dz8_model.php' );     // данные для загрузки в селекторы
require( 'dz8_functions.php' ); 

$category = parse_ini_string($ini_string, true);

receive_ads_from_file(); // Загрузка данных из файла

$msg_ad_status = ''; // Информационная строка, которая будет выводиться перед формой, и будет уведомлять пользователя о том сохранено ли его объявление
if (isset($_POST['seller_name'])) { // Кнопка 'Отправить' нажата?
    $err_msg = AD_check_n_view_errors();
    if ($err_msg) { // Проверяем заполнены ли все необходимые поля
        $AD_flag = 1; // Установка флага в значение 1: не заполнены нужные поля, пользователь должен внести все необходимые данные
    } else {
        $post = $_POST;
        $post['date_change'] = time(); // Добавление временной метки последнего внесения изменений в объявление
        $msg_ad_status = 'Объявление ' . trim(htmlspecialchars($post['title'])) . ' за ' . (int) $post['price'] . ' руб.';

        if (isset($post['AD_ID']) and $post['AD_ID'] >= 0) { // Внесение изменений в существующее объявление
            $ads[$post['AD_ID']] = $post;
            $msg_ad_status .= ' сохранено';
        } else {
            $ads[] = $post; // Добавляем новое объявление
            $msg_ad_status .= ' добавлено';
        }
        send_ads_in_file();
    }
}

if (isset($_GET['del_id'])) { // Удалить объявление
    $del_id = (int) $_GET['del_id'];
    if (isset($ads[$del_id])) {
        unset($ads[$del_id]);
        send_ads_in_file();
        header('Location: '. $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo '<h2>Не удалось удалить. Объявление ' . $del_id . ' не найдено.</h2>';
        echo '<h2><a href="' . $_SERVER['PHP_SELF'] . '">Назад<a></h2>';
        exit;
    }
}

/////////////
        if (isset($_GET['id'])) { // Показать объявление
            $get_id = (int) $_GET['id'];
            if (isset($ads[$get_id])) {
                $AD_flag = 2;
            } else {
                echo '<h2>Не удалось отобразить объявление ' . $get_id . '.</h2>';
            }
        }

        if (strlen(trim($msg_ad_status)) > 0) {
            echo "<h2>$msg_ad_status</h2>";
        }

        
///////////////////
//require( 'dz8_html.php' );
$project_root=$_SERVER['DOCUMENT_ROOT'];
$smarty_dir=$project_root.'/smarty/';

require($smarty_dir.'/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
//$smarty->debugging = false;
//$smarty->debugging = true;

$smarty->template_dir = $smarty_dir.'templates';
$smarty->compile_dir = $smarty_dir.'templates_c';
$smarty->cache_dir = $smarty_dir.'cache';
$smarty->config_dir = $smarty_dir.'configs';

$smarty->assign('ads',$ads);
$smarty->assign('err_msg',$err_msg);
$smarty->assign('AD_flag',$AD_flag);

$smarty->assign('citys',$citys);
$smarty->assign('subway_stations',$subway_stations);
$smarty->assign('category',$category);



$smarty->assign('href_self',$_SERVER['PHP_SELF']);

//$smarty->assign('private',get_value('private'));
//$smarty->assign('seller_name',get_value('seller_name'));
//$smarty->assign('manager',get_value('manager'));
//$smarty->assign('email',get_value('email'));
//$smarty->assign('allow_mails',get_value('allow_mails'));
//$smarty->assign('phone',get_value('phone'));
//$smarty->assign('location_id',get_value('location_id'));
//$smarty->assign('metro_id',get_value('metro_id'));
//$smarty->assign('category_id',get_value('category_id'));
//$smarty->assign('title',get_value('title'));
//$smarty->assign('description',get_value('description'));
//$smarty->assign('price',get_value('price'));
//$smarty->assign('date_change',get_value('date_change'));

$smarty->assign('ad',array(
                    'private'       =>get_value('private') ,
                    'seller_name'   =>get_value('seller_name') ,
                    'manager'       =>get_value('manager') ,
                    'email'         =>get_value('email') ,
                    'allow_mails'   =>get_value('allow_mails') ,
                    'phone'         =>get_value('phone') ,
                    'location_id'   =>get_value('location_id') ,
                    'metro_id'      =>get_value('metro_id') ,
                    'category_id'   =>get_value('category_id') ,
                    'title'         =>get_value('title') ,
                    'description'   =>get_value('description') ,
                    'price'         =>get_value('price') ,
                    'date_change'   =>get_value('date_change'))
                );

$smarty->display('dz8.tpl');
?>
