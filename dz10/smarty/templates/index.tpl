<!DOCTYPE html>
<html lang="RU">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>Лаба №10</title>


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        {if count($ads)>0}
        <div class="container-fluid"> <div class="row"> <div class="col-xs-12 col-sm-10 col-md-8">
                {if $ad_flag gt 0}
                    <h3><a href="{$href_self}">Подать новое объявление</a></h3>
                {/if}   

                {if strlen($msg_ad_status) gt 0}
                    <h3>{$msg_ad_status}</h3>
                {/if}   

                <table class="table table-striped"><tr><td>#</td><td>Время и Дата</td><td>Название</td><td>Цена</td><td>Имя</td><td>Телефон</td><td>Действие</td></tr>                                
                    {foreach from=$ads key=k item=v name=foreach_ads}
                        <tr>
                            <td>{$smarty.foreach.foreach_ads.index+1}</td>
                            <td>{$v.date_change|date_format:"%H:%M:%S %d.%m.%Y"}</td>
                            <td><a href="{$href_self}?id={$k}">{$v.title|escape}</a></td>
                            <td>{$v.price|escape} руб.</td>
                            <td>{$v.seller_name|escape}</td>
                            <td>{$v.phone|escape}</td>
                            <td><a href="{$href_self}?del_id={$k}">удалить</a></td>
                        </tr>
                    {/foreach}        
                </table>
            </div> </div> </div>
        {/if}   
        
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-8">

                        <form  class="form-horizontal" method="post">
                            <div class="form-group">
                                <div class="col-sm-offset-2">
                                    <h2>
        {if     $ad_flag eq 0}
            Новое объявление
        {elseif $ad_flag eq 1}
            Откорректируйте объявление<h4>{$err_msg}</h4>
        {elseif $ad_flag eq 2}
            Просмотр объявления от {$ad.date_change|date_format:"%H:%M:%S %d.%m.%Y"}<br>о продаже {$ad.title|escape} за {$ad.price|escape} руб.
        {else}
            Обнаружена неконсистентность данных
        {/if}
                                    </h2>
                                </div>
                            </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="radio-inline">
                                    <label><input type="radio" 
                                        {if $ad.private eq 0} 
                                            checked="" 
                                        {/if}
                                                  value="0" name="private">Частное лицо</label> 
                                </div>            
                                <div class="radio-inline">
                                    <label><input type="radio" 
                                        {if $ad.private eq 1} 
                                            checked="" 
                                        {/if}
                                                  value="1" name="private">Компания</label> 
                                </div>            
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_seller_name" id="your-name" class="col-sm-2 control-label">Ваше имя</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="40" class="form-control"  value="{$ad.seller_name|escape}" name="seller_name" id="fld_seller_name" placeholder = "Иван Петров">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_manager" class="col-sm-2 control-label"><b>Контактное лицо</b></label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="40" class="form-control" value="{$ad.manager|escape}" name="manager" placeholder = "Петр Иванов" id="fld_manager">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_email" class="col-sm-2 control-label">Электронная почта</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" value="{$ad.email|escape}" name="email" id="fld_email"  placeholder="Ivan@Petrov.net">
                            </div>

                            <div class="checkbox col-sm-offset-2 col-sm-10">
                                <label for="allow_mails"  class=" control-label">
                                    <input type="checkbox" value="1" 
                                           {if $ad.allow_mails gt 0} 
                                             checked="" 
                                           {/if}
                                           name="allow_mails" id="allow_mails">
                                    Я не хочу получать вопросы по объявлению по e-mail</label>
                            </div>
                        </div>     

                        <div class="form-group">
                            <label id="fld_phone_label"  class="col-sm-2 control-label" for="fld_phone">Номер телефона</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{$ad.phone|escape}" name="phone" id="fld_phone" size="30"  placeholder = "+7 999 888 77-77">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="region" class="col-sm-2 control-label">Город</label>
                            <div class="col-sm-10">
                                <select title="Выберите Ваш город" name="location_id" id="region" class="form-control"> 
                                    <option value="">-- Выберите город --</option>
                                    <option disabled="disabled">-- Города --</option>
                                    {html_options options=$cities selected=$ad.location_id}
                                    <option id="select-region" value="0">Выбрать другой...</option> </select> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_metro_id" class="col-sm-2 control-label">Метро</label>
                            <div class="col-sm-10">
                                <select title="Выберите станцию метро" name="metro_id" class="form-control" id="fld_metro_id"> <option value="">-- Выберите станцию метро --</option>
                                    {html_options options=$metro_stations selected=$ad.metro_id}
                                </select> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_category_id" class="col-sm-2 control-label">Категория</label> 
                            <div class="col-sm-10">
                                <select title="Выберите категорию объявления" class="form-control" name="category_id" id="fld_category_id"> <option value="">-- Выберите категорию --</option>
                                    {html_options options=$categories selected=$ad.category_id}
                                </select>
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_title" class="col-sm-2 control-label">Название объявления</label> 
                            <div class="col-sm-10">
                                <input type="text" maxlength="50" class="form-control" value="{$ad.title|escape}" name="title" id="fld_title" placeholder="Porsche Cayenne">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_description" id="js-description-label" class="col-sm-2 control-label">Описание объявления</label> 
                            <div class="col-sm-10">
                                <textarea maxle rows="5" ngth="3000" class="form-control" name="description" placeholder="Отличный автомобиль в полной комплектации" id="fld_description">{$ad.description|escape}</textarea> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label id="price_lbl" for="fld_price" class="col-sm-2 control-label">Цена</label> 
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-addon">руб.</div>
                                    <input type="text" maxlength="9" class="form-control" value="{$ad.price|escape}" name="price" id="fld_price" placeholder="00">
                                    <div class="input-group-addon">.00</div>
                                </div>            
                            </div>            
                        </div>            
                                    
                        {if isset($smarty.get.id)}
                            <input type="hidden" value="{$smarty.get.id}" name="ad_id">
                        {/if}
{*                            <input type="hidden" value="{$ad.date_change}" name="date_change">                                *}
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-success" value="{if $ad_flag eq 2}Сохранить{else}Отправить{/if}" id="form_submit">
                            </div>            
                        </div>            

                    </form>
                </div>
            </div>
                    <h3><a href="install.php">Установка</a></h3>
        </div>
        
    </body>
</html>
