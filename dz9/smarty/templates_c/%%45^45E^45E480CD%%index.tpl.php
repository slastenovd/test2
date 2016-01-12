<?php /* Smarty version 2.6.28, created on 2016-01-12 23:32:05
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index.tpl', 38, false),array('modifier', 'escape', 'index.tpl', 39, false),array('function', 'html_options', 'index.tpl', 134, false),)), $this); ?>
<!DOCTYPE html>
<html lang="RU">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>Лаба №9</title>


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php if (count ( $this->_tpl_vars['ads'] ) > 0): ?>
        <div class="container-fluid"> <div class="row"> <div class="col-xs-12 col-sm-10 col-md-8">
                <?php if ($this->_tpl_vars['ad_flag'] > 0): ?>
                    <h3><a href="<?php echo $this->_tpl_vars['href_self']; ?>
">Подать новое объявление</a></h3>
                <?php endif; ?>   

                <?php if (strlen ( $this->_tpl_vars['msg_ad_status'] ) > 0): ?>
                    <h3><?php echo $this->_tpl_vars['msg_ad_status']; ?>
</h3>
                <?php endif; ?>   
                
                

                <table class="table table-striped"><tr><td>#</td><td>Время и Дата</td><td>Название</td><td>Цена</td><td>Имя</td><td>Телефон</td><td>Действие</td></tr>                                
                    <?php $_from = $this->_tpl_vars['ads']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foreach_ads'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foreach_ads']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['foreach_ads']['iteration']++;
?>
                        <tr>
                            <td><?php echo ($this->_foreach['foreach_ads']['iteration']-1)+1; ?>
</td>
                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['date_change'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M:%S %d.%m.%Y") : smarty_modifier_date_format($_tmp, "%H:%M:%S %d.%m.%Y")); ?>
</td>
                            <td><a href="<?php echo $this->_tpl_vars['href_self']; ?>
?id=<?php echo $this->_tpl_vars['k']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></td>
                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['price'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 руб.</td>
                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['seller_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['phone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                            <td><a href="<?php echo $this->_tpl_vars['href_self']; ?>
?del_id=<?php echo $this->_tpl_vars['k']; ?>
">удалить</a></td>
                        </tr>
                    <?php endforeach; endif; unset($_from); ?>        
                </table>
            </div> </div> </div>
        <?php endif; ?>   
        
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-8">

                        <form  class="form-horizontal" method="post">
                            <div class="form-group">
                                <div class="col-sm-offset-2">
                                    <h2>
        <?php if ($this->_tpl_vars['ad_flag'] == 0): ?>
            Новое объявление
        <?php elseif ($this->_tpl_vars['ad_flag'] == 1): ?>
            Откорректируйте объявление<h4><?php echo $this->_tpl_vars['err_msg']; ?>
</h4>
        <?php elseif ($this->_tpl_vars['ad_flag'] == 2): ?>
            Просмотр объявления от <?php echo ((is_array($_tmp=$this->_tpl_vars['ad']['date_change'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M:%S %d.%m.%Y") : smarty_modifier_date_format($_tmp, "%H:%M:%S %d.%m.%Y")); ?>
<br>о продаже <?php echo ((is_array($_tmp=$this->_tpl_vars['ad']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 за <?php echo ((is_array($_tmp=$this->_tpl_vars['ad']['price'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
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
                                        <?php if ($this->_tpl_vars['ad']['private'] == 0): ?> 
                                            checked="" 
                                        <?php endif; ?>
                                                  value="0" name="private">Частное лицо</label> 
                                </div>            
                                <div class="radio-inline">
                                    <label><input type="radio" 
                                        <?php if ($this->_tpl_vars['ad']['private'] == 1): ?> 
                                            checked="" 
                                        <?php endif; ?>
                                                  value="1" name="private">Компания</label> 
                                </div>            
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_seller_name" id="your-name" class="col-sm-2 control-label">Ваше имя</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="40" class="form-control"  value="<?php echo ((is_array($_tmp=$this->_tpl_vars['ad']['seller_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" name="seller_name" id="fld_seller_name" placeholder = "Иван Петров">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_manager" class="col-sm-2 control-label"><b>Контактное лицо</b></label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="40" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['ad']['manager'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" name="manager" placeholder = "Петр Иванов" id="fld_manager">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_email" class="col-sm-2 control-label">Электронная почта</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['ad']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" name="email" id="fld_email"  placeholder="Ivan@Petrov.net">
                            </div>

                            <div class="checkbox col-sm-offset-2 col-sm-10">
                                <label for="allow_mails"  class=" control-label">
                                    <input type="checkbox" value="1" 
                                           <?php if ($this->_tpl_vars['ad']['allow_mails'] > 0): ?> 
                                             checked="" 
                                           <?php endif; ?>
                                           name="allow_mails" id="allow_mails">
                                    Я не хочу получать вопросы по объявлению по e-mail</label>
                            </div>
                        </div>     

                        <div class="form-group">
                            <label id="fld_phone_label"  class="col-sm-2 control-label" for="fld_phone">Номер телефона</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['ad']['phone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" name="phone" id="fld_phone" size="30"  placeholder = "+7 999 888 77-77">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="region" class="col-sm-2 control-label">Город</label>
                            <div class="col-sm-10">
                                <select title="Выберите Ваш город" name="location_id" id="region" class="form-control"> 
                                    <option value="">-- Выберите город --</option>
                                    <option disabled="disabled">-- Города --</option>
                                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['citys'],'selected' => $this->_tpl_vars['ad']['location_id']), $this);?>

                                    <option id="select-region" value="0">Выбрать другой...</option> </select> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_metro_id" class="col-sm-2 control-label">Метро</label>
                            <div class="col-sm-10">
                                <select title="Выберите станцию метро" name="metro_id" class="form-control" id="fld_metro_id"> <option value="">-- Выберите станцию метро --</option>
                                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['metro_stations'],'selected' => $this->_tpl_vars['ad']['metro_id']), $this);?>

                                </select> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_subcategory_id" class="col-sm-2 control-label">Категория</label> 
                            <div class="col-sm-10">
                                <select title="Выберите категорию объявления" class="form-control" name="subcategory_id" id="fld_subcategory_id"> <option value="">-- Выберите категорию --</option>
                                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['subcategory'],'selected' => $this->_tpl_vars['ad']['subcategory_id']), $this);?>

                                </select>
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_title" class="col-sm-2 control-label">Название объявления</label> 
                            <div class="col-sm-10">
                                <input type="text" maxlength="50" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['ad']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" name="title" id="fld_title" placeholder="Porsche Cayenne">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_description" id="js-description-label" class="col-sm-2 control-label">Описание объявления</label> 
                            <div class="col-sm-10">
                                <textarea maxle rows="5" ngth="3000" class="form-control" name="description" placeholder="Отличный автомобиль в полной комплектации" id="fld_description"><?php echo ((is_array($_tmp=$this->_tpl_vars['ad']['description'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label id="price_lbl" for="fld_price" class="col-sm-2 control-label">Цена</label> 
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-addon">руб.</div>
                                    <input type="text" maxlength="9" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['ad']['price'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
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
                                <input type="submit" class="btn btn-success" value="<?php if ($this->_tpl_vars['ad_flag'] == 2): ?>Сохранить<?php else: ?>Отправить<?php endif; ?>" id="form_submit" name="main_form_submit">
                            </div>            
                        </div>            

                    </form>
                </div>
            </div>
                    <h3><a href="install.php">Установка</a></h3>
        </div>
        
    </body>
</html>