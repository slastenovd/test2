<?php
session_start();

$AD_flag = 0; // 0-новое, 1-исправление, 2-просмотр

$citys = array(
    '641780' => 'Новосибирск',
    '641490' => 'Барабинск',
    '641510' => 'Бердск',
    '641600' => 'Искитим',
    '641630' => 'Колывань',
    '641680' => 'Краснообск',
    '641710' => 'Куйбышев',
    '641760' => 'Мошково',
    '641790' => 'Обь',
    '641800' => 'Ордынское',
    '641970' => 'Бердск',
    '641510' => 'Черепаново'
);

$subway_stations = array(
    '2028' => 'Берёзовая роща',
    '2018' => 'Гагаринская',
    '2017' => 'Заельцовская',
    '2029' => 'Золотая Нива',
    '2019' => 'Красный проспект',
    '2027' => 'Маршала Покрышкина',
    '2021' => 'Октябрьская',
    '2025' => 'Площадь Гарина-Михайловского',
    '2020' => 'Площадь Ленина',
    '2024' => 'Площадь Маркса',
    '2022' => 'Речной вокзал',
    '2026' => 'Сибирская',
    '2023' => 'Студенческая'
);

$ini_string = '
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
    $AD_show_result = '';
    if (isset($_SESSION['AD'])) {
        $row_counter = 1;
        $AD_show_result .= '<table class="table table-striped"><tr><td>#</td><td>Дата</td><td>Название</td><td>Цена</td><td>Имя</td><td>Телефон</td><td>Действие</td></tr>';
        foreach ($_SESSION['AD'] as $key => $value) {
            $AD_show_result .= '<tr><td>' . $row_counter++ . '</td><td>' . trim(date('D, d M Y H:i:s', (int) $value['date_change'])) . '</td><td><a href="' . $_SERVER[PHP_SELF] . '?id=' . (int) $key . '">' . $value['title'] . '</a></td><td>' . (int) $value['price'] . ' руб.</td><td>' . $value['seller_name'] . '</td><td>' . $value['phone'] . '</td><td><a href="' . $_SERVER[PHP_SELF] . '?del_id=' . (int) $key . '">удалить</a></td></tr>';
        }
        $AD_show_result .= '</table>';
    }
    return $AD_show_result;
}

function AD_check_n_view_errors() { // Проверяем заполнены ли все необходимые поля
    $error_flag = false;
    if (isset($_POST['title']) and ! strlen($_POST['title'])) { // Если значение приянто, однако оно пустое
        echo '<label> Не заполнено поле Название объявления</label><br>';
        $error_flag = true;
    }

    if (isset($_POST['seller_name']) and ! strlen($_POST['seller_name'])) { // Если значение приянто, однако оно пустое
        echo '<label> Не заполнено поле Ваше имя</label><br>';
        $error_flag = true;
    }

    if (isset($_POST['price']) and $_POST['price'] == 0) { // Если значение приянто, однако оно пустое
        echo '<label> Не заполнено поле Цена</label><br>';
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
        return htmlspecialchars($_POST[$value]); // Режим дозаполнения полей
    }
    if ($AD_flag == 2 and isset($_GET['id']) and isset($_SESSION['AD'][$_GET['id']][$value])) {
        return htmlspecialchars($_SESSION['AD'][(int) $_GET['id']][(string) $value]); // Режим просмотра
    }
    return ''; // Режим ввода нового
}

function set_ads_in_cookie() {
    setcookie('AD', serialize($_SESSION['AD']), time() + 3600 * 24 * 7);
//        setcookie('AD', serialize($_SESSION['AD']), time()+5    );
}

// Точка входа

if (isset($_GET['del_id'])) { // Удалить объявление
    $del_id = (int) $_GET['del_id'];
    if (isset($_SESSION['AD'][$del_id])) {
        unset($_SESSION['AD'][$del_id]);
        set_ads_in_cookie();
        header('Location: dz7_1.php');
        exit();
    } else {
        echo '<h2>Не удалось удалить. Объявление ' . $del_id . ' не найдено.</h2>';
        echo '<h2><a href="' . $_SERVER['PHP_SELF'] . '">Назад<a></h2>';
        exit;
    }
}

$msg_ad_status = ''; // Информационная строка, которая будет выводиться перед формой, и будет уведомлять пользователя о том сохранено ли его объявление
if (isset($_POST['seller_name'])) { // Кнопка 'Отправить' нажата?
    if (AD_check_n_view_errors()) { // Проверяем заполнены ли все необходимые поля
        $AD_flag = 1; // Установка флага в значение 1: не заполнены нужные поля, пользователь должен внести все необходимые данные
    } else {
        $post = $_POST;
        $post['date_change'] = time(); // Добавление временной метки последнего внесения изменений в объявление
        $msg_ad_status = 'Объявление ' . trim(htmlspecialchars($post['title'])) . ' за ' . (int) $post['price'] . ' руб.';

        if (isset($post['AD_ID']) and $post['AD_ID'] >= 0) { // Внесение изменений в существующее объявление
            $_SESSION['AD'][$post['AD_ID']] = $post;
            $msg_ad_status .= ' сохранено';
        } else {
            $_SESSION['AD'][] = $post; // Добавляем новое объявление
            $msg_ad_status .= ' добавлено';
        }
        set_ads_in_cookie();
    }
} else { // Загрузка данных из cookie в $_SESSION
    if (isset($_COOKIE['AD'])) {
        if (isset($_SESSION['AD'])) {
            unset($_SESSION['AD']);
        }

        if (isset($_COOKIE['AD'])) {
            $_SESSION['AD'] = unserialize($_COOKIE['AD']);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="RU">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>Лаба №7_1 COOKIE</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="css/common.css"  rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>


        <!--        <div class="row">
                    <div class="col-md-12">.<h2>Лаба №7_1 COOKIE</h2>  </div>
                </div>        -->
        <!--
                <div class="row">
                    <div class="col-md-12">.<button type="button" class="btn btn-info">Подать новое объявление</button></div>
                </div>        -->
        <?php
// header('Content-type: text/html; charset=utf-8');


        if (isset($_GET['id'])) { // Показать объявление
            $get_id = (int) $_GET['id'];
            if (isset($_SESSION['AD'][$get_id])) {
                //echo '<h2>Просмотр объявления ' . date('D, d M Y H:i:s', $get_id) . '</h2>';
                $AD_flag = 2;
            } else {
                echo '<h2>Не удалось отобразить объявление ' . $get_id . '.</h2>';
            }
        }

        if (strlen(trim($msg_ad_status)) > 0) {
            echo "<h2>$msg_ad_status</h2>";
        }
        ?>

        <?php
        if ($AD_flag) {
            echo '<h3><a href="' . $_SERVER[PHP_SELF] . '">Подать новое объявление</a></h3>';
        }
        ?>

        <?php
        if (isset($_SESSION['AD']) and count($_SESSION['AD'])) {
            ?>
            <!--        <h3>Перечень поданных объявлений</h3>-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-8">

                        <?php echo AD_show(); ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-md-8">

                    <form  class="form-horizontal" method="post">
                        <div class="form-group">
                            <div class="col-sm-offset-2">
                                <h2><?php
        switch ($AD_flag) {
            case 0:
                echo 'Новое объявление';
                break;
            case 1:
                echo 'Откорректируйте объявление';
                break;
            case 2:
                echo 'Просмотр объявления ' . date('D, d M Y H:i:s', (int) get_value('date_change'));
                break;
            default:
                break;
        }
        ?> </h2>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="radio-inline">
                                    <label><input type="radio" <?= (get_value('private') == 0) ? 'checked="" ' : '' ?> value="0" name="private">Частное лицо</label> 
                                </div>            
                                <div class="radio-inline">
                                    <label><input type="radio" <?= (get_value('private') == 1) ? 'checked="" ' : '' ?> value="1" name="private">Компания</label> 
                                </div>            
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_seller_name" id="your-name" class="col-sm-2 control-label">Ваше имя</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="40" class="form-control"  value="<?php echo get_value('seller_name') ?>" name="seller_name" id="fld_seller_name" placeholder = "Иван Петров">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_manager" class="col-sm-2 control-label"><b>Контактное лицо</b></label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="40" class="form-control" value="<?php echo get_value('manager') ?>" name="manager" placeholder = "Петр Иванов" id="fld_manager">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_email" class="col-sm-2 control-label">Электронная почта</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" value="<?php echo get_value('email') ?>" name="email" id="fld_email"  placeholder="Ivan@Petrov.net">
                            </div>

                            <div class="checkbox col-sm-offset-2 col-sm-10">
                                <label for="allow_mails"  class=" control-label">
                                    <input type="checkbox" value="1" <?= (get_value('allow_mails')) ? 'checked="" ' : '' ?> name="allow_mails" id="allow_mails">
                                    Я не хочу получать вопросы по объявлению по e-mail</label>
                            </div>
                        </div>     

                        <div class="form-group">
                            <label id="fld_phone_label"  class="col-sm-2 control-label" for="fld_phone">Номер телефона</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo get_value('phone') ?>" name="phone" id="fld_phone" size="30"  placeholder = "+7 999 888 77-77">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="region" class="col-sm-2 control-label">Город</label>
                            <div class="col-sm-10">
                                <select title="Выберите Ваш город" name="location_id" id="region" class="form-control"> 
                                    <option value="">-- Выберите город --</option>
                                    <option disabled="disabled">-- Города --</option>

                                    <?php
// Выводим города в селектор
                                    foreach ($citys as $number => $city) {
                                        $selected = ($number == get_value('location_id')) ? 'selected="" ' : '';
                                        echo '<option ' . $selected . 'data-coords=",," value="' . $number . '">' . $city . '</option>';
                                    }
                                    ?>                    
                                    <option id="select-region" value="0">Выбрать другой...</option> </select> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_metro_id" class="col-sm-2 control-label">Метро</label>
                            <div class="col-sm-10">
                                <select title="Выберите станцию метро" name="metro_id" class="form-control" id="fld_metro_id"> <option value="">-- Выберите станцию метро --</option>

                                    <?php
// Выводим станции метро в селектор
                                    foreach ($subway_stations as $number => $subway_station) {
                                        $selected = ($number == get_value('metro_id')) ? 'selected="" ' : '';
                                        echo '<option ' . $selected . 'data-coords=",," value="' . $number . '">' . $subway_station . '</option>';  //но теперь как то сюда нужно подставить что город нужный выбран -> selected=""
                                    }
                                    ?>                    
                                </select> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_category_id" class="col-sm-2 control-label">Категория</label> 
                            <div class="col-sm-10">
                                <select title="Выберите категорию объявления" class="form-control" name="category_id" id="fld_category_id"> <option value="">-- Выберите категорию --</option>
                                    <?php
// Выводим категории в селектор
                                    foreach ($category as $cat => $subcats) {
                                        echo '<optgroup label="' . $cat . '">';
                                        foreach ($subcats as $subcat => $cat_subscr) {
                                            $selected = ($subcat == get_value('category_id')) ? 'selected="" ' : '';
                                            echo '<option ' . $selected . 'value="' . $subcat . '">' . $cat_subscr . '</option>';  //но теперь как то сюда нужно подставить что город нужный выбран -> selected=""
                                        }
                                    }
                                    ?>                    
                                </select>
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_title" class="col-sm-2 control-label">Название объявления</label> 
                            <div class="col-sm-10">
                                <input type="text" maxlength="50" class="form-control" value="<?= get_value('title'); ?>" name="title" id="fld_title" placeholder="Porsche Cayenne">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_description" id="js-description-label" class="col-sm-2 control-label">Описание объявления</label> 
                            <div class="col-sm-10">
                                <textarea maxle rows="5" ngth="3000" class="form-control" name="description" placeholder="Отличный автомобиль в полной комплектации" id="fld_description"><?php echo get_value('description'); ?></textarea> 
                            </div>            
                        </div>            


                        <div class="form-group">
                            <label id="price_lbl" for="fld_price" class="col-sm-2 control-label">Цена</label> 
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-addon">руб.</div>
                                    <input type="text" maxlength="9" class="form-control" value="<?php echo get_value('price') ?>" name="price" id="fld_price" placeholder="00">
                                    <div class="input-group-addon">.00</div>
                                </div>            
                            </div>            
                        </div>            



                        <?php
                        if (isset($_GET['id'])) { // Если режим исправления то внедряем в форму hidden по которому сможем распознать 
                            echo '<input type="hidden" value="' . (int) $_GET['id'] . '" name="AD_ID">';
                        } else {
//    echo '<input type="hidden" value="' . get_value('AD_ID') . '" name="AD_ID">';
                            echo '<input type="hidden" value="' . get_value('date_change') . '" name="date_change">';
                        }
                        ?>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-success" value="<?= ($AD_flag == 2) ? 'Сохранить' : 'Отправить' ?>" id="form_submit" name="main_form_submit">
                            </div>            
                        </div>            

                    </form>
                </div>
            </div>
        </div>

    </body>
</html>
