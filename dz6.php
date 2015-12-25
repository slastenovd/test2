<?php
session_start();

$AD_flag = 0; // 0-новое, 1-исправление, 2-вывод
// ----
$citys = array(
    '641780'=>'Новосибирск',
    '641490'=>'Барабинск',
    '641510'=>'Бердск',
    '641600'=>'Искитим',
    '641630'=>'Колывань',
    '641680'=>'Краснообск',
    '641710'=>'Куйбышев',
    '641760'=>'Мошково',
    '641790'=>'Обь',
    '641800'=>'Ордынское',
    '641970'=>'Бердск',
    '641510'=>'Черепаново'
    );

$subway_stations = array(
    '2028'=>'Берёзовая роща',
    '2018'=>'Гагаринская',
    '2017'=>'Заельцовская',
    '2029'=>'Золотая Нива',
    '2019'=>'Красный проспект',
    '2027'=>'Маршала Покрышкина',
    '2021'=>'Октябрьская',
    '2025'=>'Площадь Гарина-Михайловского',
    '2020'=>'Площадь Ленина',
    '2024'=>'Площадь Маркса',
    '2022'=>'Речной вокзал',
    '2026'=>'Сибирская',
    '2023'=>'Студенческая'
    );

$ini_string='
[Транспорт]
9 = Автомобили с пробегом;
109 = Новые автомобили;
14 = Мотоциклы и мототехника;
81 = Грузовики и спецтехника;
11 = Водный транспорт;
10 = Запчасти и аксессуары;
[Недвижимость]
24 = Квартиры;
23 = Комнаты;
25 = Дома, дачи, коттеджи;
26 = Земельные участки;
85 = Гаражи и машиноместа;
42 = Коммерческая недвижимость;
86 = Недвижимость за рубежом;
[Работа]
111 = Вакансии;
112 = Резюме;
[Услуги]
114 = Предложения услуг;
115 = Запросы на услуги;
[Личные вещи]
27 = Одежда, обувь, аксессуары;
29 = Детская одежда и обувь;
30 = Товары для детей и игрушки;
28 = Часы и украшения;
88 = Красота и здоровье;
[Для дома и дачи]
21 = Бытовая техника;
20 = Мебель и интерьер;
87 = Посуда и товары для кухни;
82 = Продукты питания;
19 = Ремонт и строительство;
106 = Растения;
[Бытовая электроника]
32 = Аудио и видео;
97 = Игры, приставки и программы;
31 = Настольные компьютеры;
98 = Ноутбуки;
99 = Оргтехника и расходники;
96 = Планшеты и электронные книги;
84 = Телефоны;
101 = Товары для компьютера;
105 = Фототехника;
[Хобби и отдых]
33 = Билеты и путешествия;
34 = Велосипеды;
83 = Книги и журналы;
36 = Коллекционирование;
38 = Музыкальные инструменты;
102 = Охота и рыбалка;
39 = Спорт и отдых;
103 = Знакомства;
[Животные]
89 = Собаки;
90 = Кошки;
91 = Птицы;
92 = Аквариум;
93 = Другие животные;
94 = Товары для животных;
[Для бизнеса]
116 = Готовый бизнес;
40 = Оборудование для бизнеса;';

$category = parse_ini_string($ini_string, true);
                                    
function AD_show() { // Выводит перечень всех объявлений
    if (isset( $_SESSION['AD'] )) {
        echo '<table border = 2><tr><td>Дата</td><td>Название</td><td>Цена</td><td>Имя</td><td>Действие</td></tr>';
        foreach ($_SESSION['AD'] as $key => $value) {
            echo '<tr><td>'.date('D, d M Y H:i:s',  $key). '</td><td><a href="dz6.php?id='.$key.'">' . $value['title'] . '</a></td><td>' . $value['price'] . '</td><td>' . $value['seller_name'] . '</td><td><a href="dz6.php?del_id='.$key.'">удалить</a></td></tr>';
        }
        echo '</table>';
    }
}



function AD_check_n_view_errors() { // Проверяем заполнены ли все необходимые поля
    $error_flag = false;
    if (isset($_POST['title']) and ! strlen($_POST['title'])) { // Если значение приянто, однако оно пустое
        echo '<label class="myclass"> Не заполнено поле <bold>Название объявления</bold></label><br>';
        $error_flag = true;
    }

    if (isset($_POST['seller_name']) and ! strlen($_POST['seller_name'])) { // Если значение приянто, однако оно пустое
        echo '<label class="myclass"> Не заполнено поле <bold>Ваше имя</bold></label><br>';
        $error_flag = true;
    }

    if (isset($_POST['price']) and $_POST['price'] == 0) { // Если значение приянто, однако оно пустое
        echo '<label class="myclass"> Не заполнено поле <bold>Цена</bold></label><br>';
        $error_flag = true;
    }
    if ($error_flag) {
        echo '<h4>Пожалуйста, заполните необходимые поля</h4><br>';
    }
    return $error_flag;
}

function get_value($value) { // Получаем значение поля (в зависимости от режима из POST или SESSION
    global $AD_flag;
    if ($AD_flag == 1 and isset($_POST[$value])) {
        return $_POST[$value]; // Режим дозаполнения полей
    }
//    if ($AD_flag == 2 and isset($_SESSION['AD'][$value])) {
    if ($AD_flag == 2 and isset($_GET['id']) and isset($_SESSION['AD'][$_GET['id']][$value])) {
        return $_SESSION['AD'][$_GET['id']][$value]; // Режим просмотра
    }
    return ''; // Режим ввода нового
}

// Точка входа
if (isset($_POST['seller_name'])) { // Кнопка 'Отправить' нажата?
    if (AD_check_n_view_errors()) { // Проверяем заполнены ли все необходимые поля
        $AD_flag = 1;
    } else {
        $_SESSION['AD'][time()] = $_POST; // Добавляем новое объявление в сессию
    }
}

if (isset($_GET['id'])) { // Показать объявление
    if (isset($_SESSION['AD'][$_GET['id']])) {
        echo '<h1>Просмотр объявления ' . date('D, d M Y H:i:s',  $_GET['id']) . '</h1>';
        $AD_flag = 2;
    } else {
        echo '<h1>Не удалось отобразить бъявление ' . $_GET['id'] . '.</h1>';
    }
}

if (isset($_GET['del_id'])) { // Удалить объявление
    if (isset($_SESSION['AD'][$_GET['del_id']])) {
        unset($_SESSION['AD'][$_GET['del_id']]);
        echo '<h1>Удалено '.$_GET['del_id'].'</h1>';
    }
    else{
        echo '<h1>Не удалось удалить. Объявление '.$_GET['del_id'].' не найдено.</h1>';
    }
        
}

?>


<!DOCTYPE HTML">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Лаба 6 на уроке XAVER vk.com/xaverru</title>
        <link rel="stylesheet" type="text/css" href="dz6.css">        

    </head>
    <body>


        <form  method="post">


            <div class="form-row-indented"> <label class="form-label-radio">
                    <input type="radio" checked="" value="1" name="private">
                    Частное лицо</label> <label class="form-label-radio"><input type="radio" value="0" name="private">Компания</label> </div>
            <div class="form-row"> 
                <label for="fld_seller_name" class="form-label"><b id="your-name">Ваше имя</b></label>
                
                <input type="text" maxlength="40" class="form-input-text" value="<?php echo get_value('seller_name')?>" name="seller_name" id="fld_seller_name">
            </div>
            
                <label for="fld_manager" class="form-label"><b>Контактное лицо</b></label> 
                <input type="text" class="form-input-text" maxlength="40" value="<?php echo get_value('manager')?>" name="manager" id="fld_manager">
                <em class="f_r_g">&nbsp;&nbsp;необязательно</em>

            <div class="form-row"> <label for="fld_email" class="form-label">Электронная почта</label>
                
                <input type="text" class="form-input-text" value="<?php echo get_value('email') ?>" name="email" id="fld_email">
                
            </div>
            <div class="form-row-indented"> <label class="form-label-checkbox" for="allow_mails"> <input type="checkbox" value="1" name="allow_mails" id="allow_mails" class="form-input-checkbox"><span class="form-text-checkbox">Я не хочу получать вопросы по объявлению по e-mail</span> </label> </div>
            <div class="form-row"> <label id="fld_phone_label" for="fld_phone" class="form-label">Номер телефона</label> 
                
                <input type="text" class="form-input-text" value="<?php echo get_value('phone') ?>" name="phone" id="fld_phone">
            </div>
            <div id="f_location_id" class="form-row form-row-required"> <label for="region" class="form-label">Город</label> 
                
                <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select"> 
                    <option value="">-- Выберите город --</option>
                    <option class="opt-group" disabled="disabled">-- Города --</option>
                    
                    <?php // Выводим города в селектор
                    foreach ($citys as $number => $city) {
                       $selected = ($number==get_value('location_id')) ? 'selected="" ' : '';
                       echo '<option '.$selected.'data-coords=",," value="'.$number.'">'.$city.'</option>';  //но теперь как то сюда нужно подставить что город нужный выбран -> selected=""
                    }
                    ?>                    
                    <option id="select-region" value="0">Выбрать другой...</option> </select> 
                    
                    <div id="f_metro_id"> <select title="Выберите станцию метро" name="metro_id" id="fld_metro_id" class="form-input-select"> <option value="">-- Выберите станцию метро --</option>
                    
                    <?php // Выводим станции метро в селектор
                    foreach ($subway_stations as $number => $subway_station) {
                       $selected = ($number==get_value('metro_id')) ? 'selected="" ' : '';
                       echo '<option '.$selected.'data-coords=",," value="'.$number.'">'.$subway_station.'</option>';  //но теперь как то сюда нужно подставить что город нужный выбран -> selected=""
                    }
                    ?>                    

                        
                        </select> </div> <div id="f_district_id"> <select title="Выберите район города" name="district_id" id="fld_district_id" class="form-input-select" style="display: none;"> <option value="">-- Выберите район города --</option></select> </div> <div id="f_road_id"> <select title="Выберите направление" name="road_id" id="fld_road_id" class="form-input-select" style="display: none;"> <option value="">-- Выберите направление --</option><option value="56">Бердское шоссе</option><option value="57">Гусинобродское шоссе</option><option value="53">Дачное шоссе</option><option value="55">Краснояровское шоссе</option><option value="54">Мочищенское шоссе</option><option value="52">Ордынское  шоссе</option><option value="58">Советское шоссе</option></select> </div> </div>
            <div class="form-row"> <label for="fld_category_id" class="form-label">Категория</label> <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select"> <option value="">-- Выберите категорию --</option>
                    
                    

                    <?php // Выводим категории в селектор
                    foreach ($category as $cat=>$subcats) {
                        echo '<optgroup label="'.$cat.'">';
                            foreach ($subcats as $subcat=>$cat_subscr) {
                               $selected = ($subcat==get_value('category_id')) ? 'selected="" ' : '';
                               echo '<option '.$selected.'value="'.$subcat.'">'.$cat_subscr.'</option>';  //но теперь как то сюда нужно подставить что город нужный выбран -> selected=""
                            }
                    }
                    ?>                    
               
                </select> </div>

            <div style="display: none;" id="params" class="form-row form-row-required"> <label class="form-label ">
                    Выберите параметры
                </label> <div class="form-params params" id="filters">
                </div> </div>
            <div id="f_map" class="form-row form-row-required hidden"> <label class="form-label c-2">Укажите местоположение объекта на&nbsp;карте</label> <div class="b-address-map j-address-map disabled"> <div class="wrapper"> <div class="map" id="address-map"></div> <div class="overlay"> <div class="modal">Сначала <span class="fill-in pseudo-link">укажите адрес</span></div> </div> </div> <div class="result c-2 hidden"> <div class="map-success">
                            Маркер указывает на: <span class="address-line"></span>.
                            <span class="confirm pseudo-link hidden">Это верный адрес</span> </div> <div class="map-error">Мы не смогли автоматически определить адрес.</div> </div> 
                            <input type="hidden" disabled="disabled" value="" class="j-address-latitude" name="coords[lat]"> <input type="hidden" disabled="disabled" value="" class="j-address-longitude" name="coords[lng]"> <input type="hidden" disabled="disabled" value="" class="j-address-zoom" name="coords[zoom]"> </div> </div>
            <div id="f_title" class="form-row f_title"> <label for="fld_title" class="form-label">Название объявления</label> 
                
                <input type="text" maxlength="50" class="form-input-text-long" value="<?=get_value('title'); ?>" name="title" id="fld_title">
            </div>
            <div class="form-row"> <label for="fld_description" class="form-label" id="js-description-label">Описание объявления</label> 
                
                <textarea maxlength="3000" name="description" id="fld_description" class="form-input-textarea"><?php echo get_value('description'); ?></textarea> 
            
            </div>
            <div id="price_rw" class="form-row rl"> <label id="price_lbl" for="fld_price" class="form-label">Цена</label> 
                
                <input type="text" maxlength="9" class="form-input-text-short" value="<?php echo get_value('price')?>" name="price" id="fld_price">

                &nbsp;<span id="fld_price_title">руб.</span> <a class="link_plain grey right_price c-2 icon-link" id="js-price-link" href="/info/pravilnye_ceny?plain"><span>Правильно указывайте цену</span></a> </div>



            <div style="display: none;" id="progress"> <table><tbody><tr><td> <div><div></div></div> </td></tr></tbody></table> </div> 
        <div class="form-row-indented form-row-submit b-vas-submit" id="js_additem_form_submit">
            <div class="vas-submit-button pull-left"> <span class="vas-submit-border"></span> <span class="vas-submit-triangle"></span> <input type="submit" value="Отправить" id="form_submit" name="main_form_submit" class="vas-submit-input"> </div>
        </div>
    </form>


        <label class="myclass">Перечень поданных объявлений</label><br>

<?php  AD_show();?>


</body>
</html>