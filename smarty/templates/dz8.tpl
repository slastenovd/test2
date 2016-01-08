<!DOCTYPE html>
<html lang="RU">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>Лаба №8</title>

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
        {if $AD_flag eq 1}
            {$err_msg}  
        {/if}   

        {if $AD_flag gt 0}
            <h3><a href="{$href_self}">Подать новое объявление</a></h3>
        {/if}   

        {if count($ads)>0}
        <div class="container-fluid"> <div class="row"> <div class="col-xs-12 col-sm-10 col-md-8">
                <table class="table table-striped"><tr><td>#</td><td>Время и Дата</td><td>Название</td><td>Цена</td><td>Имя</td><td>Телефон</td><td>Действие</td></tr>                                
                    {foreach from=$ads key=k item=v name=foreach_ads}
                        <tr>
                            <td>{$smarty.foreach.foreach_ads.index+1}</td>
                            <td>{$v.date_change|date_format:"%H:%M:%S %d.%m.%Y"}</td>
                            <td><a href="{$href_self}?id={$k}">{$v.title}</a></td>
                            <td>{$v.price} руб.</td>
                            <td>{$v.seller_name}</td>
                            <td>{$v.phone}</td>
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
        {if     $AD_flag eq 0}
            Новое объявление
        {elseif $AD_flag eq 1}
            Откорректируйте объявление
        {elseif $AD_flag eq 2}
            Просмотр объявления от {$date_change|date_format:"%H:%M:%S %d.%m.%Y"}<br>о продаже {$title} за {$price} руб.
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
                                        {if $private eq 0} 
                                            checked="" 
                                        {/if}
                                                  value="0" name="private">Частное лицо</label> 
                                </div>            
                                <div class="radio-inline">
                                    <label><input type="radio" 
                                        {if $private eq 1} 
                                            checked="" 
                                        {/if}
                                                  value="1" name="private">Компания</label> 
                                </div>            
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_seller_name" id="your-name" class="col-sm-2 control-label">Ваше имя</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="40" class="form-control"  value="{$seller_name}" name="seller_name" id="fld_seller_name" placeholder = "Иван Петров">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_manager" class="col-sm-2 control-label"><b>Контактное лицо</b></label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="40" class="form-control" value="{$manager}" name="manager" placeholder = "Петр Иванов" id="fld_manager">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_email" class="col-sm-2 control-label">Электронная почта</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" value="{$email}" name="email" id="fld_email"  placeholder="Ivan@Petrov.net">
                            </div>

                            <div class="checkbox col-sm-offset-2 col-sm-10">
                                <label for="allow_mails"  class=" control-label">
                                    <input type="checkbox" value="1" 
                                           {if $allow_mails gt 0} 
                                             checked="" 
                                           {/if}
                                           name="allow_mails" id="allow_mails">
                                    Я не хочу получать вопросы по объявлению по e-mail</label>
                            </div>
                        </div>     

                        <div class="form-group">
                            <label id="fld_phone_label"  class="col-sm-2 control-label" for="fld_phone">Номер телефона</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{$phone}" name="phone" id="fld_phone" size="30"  placeholder = "+7 999 888 77-77">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="region" class="col-sm-2 control-label">Город</label>
                            <div class="col-sm-10">
                                <select title="Выберите Ваш город" name="location_id" id="region" class="form-control"> 
                                    <option value="">-- Выберите город --</option>
                                    <option disabled="disabled">-- Города --</option>
                                    {html_options options=$citys selected=$location_id}
                                    <option id="select-region" value="0">Выбрать другой...</option> </select> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_metro_id" class="col-sm-2 control-label">Метро</label>
                            <div class="col-sm-10">
                                <select title="Выберите станцию метро" name="metro_id" class="form-control" id="fld_metro_id"> <option value="">-- Выберите станцию метро --</option>
                                    {html_options options=$subway_stations selected=$metro_id}
                                </select> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_category_id" class="col-sm-2 control-label">Категория</label> 
                            <div class="col-sm-10">
                                <select title="Выберите категорию объявления" class="form-control" name="category_id" id="fld_category_id"> <option value="">-- Выберите категорию --</option>
                                    {html_options options=$category selected=$category_id}
                                </select>
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_title" class="col-sm-2 control-label">Название объявления</label> 
                            <div class="col-sm-10">
                                <input type="text" maxlength="50" class="form-control" value="{$title}" name="title" id="fld_title" placeholder="Porsche Cayenne">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_description" id="js-description-label" class="col-sm-2 control-label">Описание объявления</label> 
                            <div class="col-sm-10">
                                <textarea maxle rows="5" ngth="3000" class="form-control" name="description" placeholder="Отличный автомобиль в полной комплектации" id="fld_description">{$description}</textarea> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label id="price_lbl" for="fld_price" class="col-sm-2 control-label">Цена</label> 
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-addon">руб.</div>
                                    <input type="text" maxlength="9" class="form-control" value="{$price}" name="price" id="fld_price" placeholder="00">
                                    <div class="input-group-addon">.00</div>
                                </div>            
                            </div>            
                        </div>            
                                    
                        {if isset($smarty.get.id)}
                            <input type="hidden" value="{$smarty.get.id}" name="AD_ID">
                        {/if}
                            <input type="hidden" value="{$date_change}" name="date_change">                                
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-success" value="{if $AD_flag eq 2}Сохранить{else}Отправить{/if}" id="form_submit" name="main_form_submit">
                            </div>            
                        </div>            

                    </form>
                </div>
            </div>
        </div>
        
    </body>
</html>
