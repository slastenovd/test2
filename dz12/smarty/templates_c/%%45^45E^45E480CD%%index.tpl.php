<?php /* Smarty version 2.6.28, created on 2016-01-25 22:13:31
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index.tpl', 128, false),array('modifier', 'escape', 'index.tpl', 128, false),array('function', 'html_options', 'index.tpl', 199, false),)), $this); ?>
<!DOCTYPE html>
<html lang="RU">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Лаба №12</title>


        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Small modal -->
        <div class="container-fluid"> <div class="row"> <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="#">Лаба #12</a>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li ><a href="<?php echo $this->_tpl_vars['href_self']; ?>
#NewAd">Новое объявление <span class="sr-only">(current)</span></a></li>
                                    <li><a data-toggle="collapse" data-target="#collapseAds" aria-expanded="true" aria-controls="collapseAds">Перечень объявлений</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Еще <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Удалить все объявления</a></li>
                                            <li><a href="#">Удалить БД</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="install.php">Установка БД</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Найти объявление...">
                                    </div>
                                    <button  type='submit'>Поиск</button>
                                </form>

                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>  

 <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
     <div class="modal-dialog modal-sm">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title" id="gridSystemModalLabel">Ууупс....!</h4>
             </div>


             Еще не реализовал.<br> Сделаю завтра.
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
             </div>
         </div>
     </div>
 </div>                    

                    <?php if (count ( $this->_tpl_vars['ads'] ) > 0 && $this->_tpl_vars['ad_flag'] <> 1): ?> 

                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php echo $this->_tpl_vars['SliderIndicators']; ?>

                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <?php echo $this->_tpl_vars['SliderItems']; ?>

                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>                    

                    <a name="Ads"></a>


                        <button type="button" class="btn btn-default btn-lg btn-block" data-toggle="collapse" data-target="#collapseAds" aria-expanded="false" aria-controls="collapseAds">Перечень объявлений</button>
                        <div class="collapse" id="collapseAds" aria-expanded="true">
                            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'table.tpl.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        </div>  
                    <?php endif; ?>  
                                        <a name="NewAd"></a>
                    <form  class="form-horizontal" method="post">
                        <div class="form-group">
                            <div class="col-sm-offset-2">
                                <h2>
                                    <?php if ($this->_tpl_vars['ad_flag'] == 0): ?>
                                        Новое объявление
                                    <?php elseif ($this->_tpl_vars['ad_flag'] == 1): ?>
                                        Откорректируйте объявление<blockquote><?php echo $this->_tpl_vars['err_msg']; ?>
</blockquote>
                                    <?php elseif ($this->_tpl_vars['ad_flag'] == 2): ?>
                                        Просмотр объявления от <?php echo ((is_array($_tmp=$this->_tpl_vars['ad']->date_change)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M:%S %d.%m.%Y") : smarty_modifier_date_format($_tmp, "%H:%M:%S %d.%m.%Y")); ?>
<br>о продаже <?php echo ((is_array($_tmp=$this->_tpl_vars['ad']->title)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 за <?php echo ((is_array($_tmp=$this->_tpl_vars['ad']->price)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 руб.
                                    <?php else: ?>
                                        Обнаружена неконсистентность данных
                                    <?php endif; ?>
                                </h2>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="radio-inline">
                                    <label><input type="radio" 
                                                  <?php if ($this->_tpl_vars['ad']->private == 0): ?> 
                                                      checked="" 
                                                  <?php endif; ?>
                                                  value="0" name="private">Частное лицо</label> 
                                </div>            
                                <div class="radio-inline">
                                    <label><input type="radio" 
                                                  <?php if ($this->_tpl_vars['ad']->private == 1): ?> 
                                                      checked="" 
                                                  <?php endif; ?>
                                                  value="1" name="private">Компания</label> 
                                </div>            
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_seller_name" id="your-name" class="col-sm-2 control-label">Ваше имя</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="40" class="form-control"  value="<?php echo ((is_array($_tmp=$this->_tpl_vars['ad']->seller_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" name="seller_name" id="fld_seller_name" placeholder = "Иван Петров">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_manager" class="col-sm-2 control-label"><b>Контактное лицо</b></label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="40" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['ad']->manager)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" name="manager" placeholder = "Петр Иванов" id="fld_manager">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_email" class="col-sm-2 control-label">Электронная почта</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['ad']->email)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" name="email" id="fld_email"  placeholder="Ivan@Petrov.net">
                            </div>

                            <div class="checkbox col-sm-offset-2 col-sm-10">
                                <label for="allow_mails"  class=" control-label">
                                    <input type="checkbox" value="1" 
                                           <?php if ($this->_tpl_vars['ad']->allow_mails > 0): ?> 
                                               checked="" 
                                           <?php endif; ?>
                                           name="allow_mails" id="allow_mails">
                                    Я не хочу получать вопросы по объявлению по e-mail</label>
                            </div>
                        </div>     

                        <div class="form-group">
                            <label id="fld_phone_label"  class="col-sm-2 control-label" for="fld_phone">Номер телефона</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['ad']->phone)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" name="phone" id="fld_phone" size="30"  placeholder = "+7 999 888 77-77">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="region" class="col-sm-2 control-label">Город</label>
                            <div class="col-sm-10">
                                <select title="Выберите Ваш город" name="location_id" id="region" class="form-control"> 
                                    <option value="">-- Выберите город --</option>
                                    <option disabled="disabled">-- Города --</option>
                                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['cities'],'selected' => $this->_tpl_vars['ad']->location_id), $this);?>

                                    <option id="select-region" value="0">Выбрать другой...</option> </select> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_metro_id" class="col-sm-2 control-label">Метро</label>
                            <div class="col-sm-10">
                                <select title="Выберите станцию метро" name="metro_id" class="form-control" id="fld_metro_id"> <option value="">-- Выберите станцию метро --</option>
                                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['metro_stations'],'selected' => $this->_tpl_vars['ad']->metro_id), $this);?>

                                </select> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_category_id" class="col-sm-2 control-label">Категория</label> 
                            <div class="col-sm-10">
                                <select title="Выберите категорию объявления" class="form-control" name="category_id" id="fld_category_id"> <option value="">-- Выберите категорию --</option>
                                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['categories'],'selected' => $this->_tpl_vars['ad']->category_id), $this);?>

                                </select>
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_title" class="col-sm-2 control-label">Название объявления</label> 
                            <div class="col-sm-10">
                                <input type="text" maxlength="50" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['ad']->title)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" name="title" id="fld_title" placeholder="Porsche Cayenne">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_description" id="js-description-label" class="col-sm-2 control-label">Описание объявления</label> 
                            <div class="col-sm-10">
                                <textarea maxle rows="5" ngth="3000" class="form-control" name="description" placeholder="Отличный автомобиль в полной комплектации" id="fld_description"><?php echo ((is_array($_tmp=$this->_tpl_vars['ad']->description)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label id="price_lbl" for="fld_price" class="col-sm-2 control-label">Цена</label> 
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-addon">руб.</div>
                                    <input type="text" maxlength="9" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['ad']->price)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" name="price" id="fld_price" placeholder="00">
                                    <div class="input-group-addon">.00</div>
                                </div>            
                            </div>            
                        </div>            

                        <?php if (isset ( $_GET['id'] )): ?>
                            <input type="hidden" value="<?php echo $_GET['id']; ?>
" name="ad_id">
                        <?php endif; ?>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-success" value="<?php if ($this->_tpl_vars['ad_flag'] == 2): ?>Сохранить<?php else: ?>Отправить<?php endif; ?>" id="form_submit">
                            </div>            
                        </div>            

                    </form>

                    <div class="well well-lg">
                        <h3 class="text-center">Лаба #12 'Объекты'</h3>
                        <p class="text-center">Синглтон. Наследование. Бутстрап.</p>
                        <p class="text-center">
                            <a href='../dz11' class='btn btn-success'>Предыдущая лаба</a>
                        </p>

                    </div>

                </div>
            </div>

        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>    
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <!--<script src="js/bootstrap.min.js"></script>-->
    </body>
</html>