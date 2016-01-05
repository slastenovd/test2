<!DOCTYPE html>
<html lang="RU">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>Лаба №7</title>

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
        <?php

        if (isset($_GET['id'])) { // Показать объявление
            $get_id = (int) $_GET['id'];
            if (isset($ads[$get_id])) {
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
        if (isset($ads) and count($ads)) {
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
