<!DOCTYPE html>
<html lang="RU">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Лаба №17</title>


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
        <div class="container-fluid"> <div class="row"> <div class="col-xs-12 col-sm-12 col-md-10 col-lg-7">
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
                                <a class="navbar-brand" href="#">Лаба #16</a>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li ><a id="href-new-ad" href="{$href_self}#NewAd">Новое объявление <span class="sr-only">(current)</span></a></li>
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


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                </div>
                            </div>
                        </div>
                    </div>                    
                            
      <div id="container" class="alert alert-warning alert-dismissible" style="display: none" role="alert">
          <button type="button" style="float: right;" onclick="$('#container').fadeOut('slow');return false;" class="btn btn-warning btn-sm">
              <span aria-hidden="true">&times;</span></button>
          <div id="container_info"></div>
      </div>

                    {if count($ads)>0 and $ad_flag <> 1} 
  
                        <a name="Ads"></a>
                                {include file='table.tpl.html'}
                    {/if}  

      <div id="container1" class="alert alert-warning alert-dismissible" style="display: none" role="alert">
          <button type="button" style="float: right;" onclick="$('#container1').fadeOut('slow');return false;" class="btn btn-danger btn-sm">
              <span aria-hidden="true">&times;</span></button>
          <div id="container1_info">В базе данных нет ни одного объявления. <br> Все объявления удалены.</div>
      </div>


                    <a name="NewAd"></a>
                    <form  class="form-horizontal" method="post" id="ad_form">
                        <div class="form-group">
                            <div class="col-sm-offset-2">
                                <h2>
                                    <div  id="ad_descr">
                                    {if     $ad_flag eq 0}
                                        Новое объявление
                                    {elseif $ad_flag eq 1}
                                        Откорректируйте объявление<blockquote>{$err_msg}</blockquote>
                                    {elseif $ad_flag eq 2}
                                        Просмотр объявления от {$ad->getDate_change()|date_format:"%H:%M:%S %d.%m.%Y"}<br>о продаже {$ad->getTitle()|escape} за {$ad->getPrice()|escape} руб.
                                    {else}
                                        Обнаружена неконсистентность данных
                                    {/if}
                                    </div>
                                </h2>
                            </div>
                        </div>

                          <div id="container_form_msg" class="alert alert alert-success alert-dismissible" style="display: none" role="alert">
                              <button type="button" style="float: right;" onclick="$('#container_form_msg').fadeOut('slow');return false;" class="btn btn-warning btn-sm">
                                  <span aria-hidden="true">&times;</span></button>
                              <div id="container_info_form_msg"></div>
                          </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="radio-inline">
                                    <label><input id="radio_private" type="radio" 
                                                  {if $ad->getPrivate() eq 0} 
                                                      checked="" 
                                                  {/if}
                                                  value="0" name="private">Частное лицо</label> 
                                </div>            
                                <div class="radio-inline">
                                    <label><input id="radio_company" type="radio" 
                                                  {if $ad->getPrivate()  eq 1} 
                                                      checked="" 
                                                  {/if}
                                                  value="1" name="private">Компания</label> 
                                </div>            
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_seller_name" id="your-name" class="col-sm-2 control-label">Ваше имя</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="40" defaultValue="" class="form-control"  value="{$ad->getSeller_name()|escape}" name="seller_name" id="fld_seller_name" placeholder = "Иван Петров">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_manager" class="col-sm-2 control-label"><b>Контактное лицо</b></label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="40" class="form-control" value="{$ad->getManager()|escape}" name="manager" placeholder = "Петр Иванов" id="fld_manager">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_email" class="col-sm-2 control-label">Электронная почта</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" value="{$ad->getEmail()|escape}" name="email" id="fld_email"  placeholder="Ivan@Petrov.net">
                            </div>

                            <div class="checkbox col-sm-offset-2 col-sm-10">
                                <label for="allow_mails"  class=" control-label">
                                    <input type="checkbox" value="1" 
                                           {if $ad->getAllow_mails() gt 0} 
                                               checked="" 
                                           {/if}
                                           name="allow_mails" id="allow_mails">
                                    Я не хочу получать вопросы по объявлению по e-mail</label>
                            </div>
                        </div>     

                        <div class="form-group">
                            <label id="fld_phone_label"  class="col-sm-2 control-label" for="fld_phone">Номер телефона</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{$ad->getPhone()|escape}" name="phone" id="fld_phone" size="30"  placeholder = "+7 999 888 77-77">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="region" class="col-sm-2 control-label">Город</label>
                            <div class="col-sm-10">
                                <select title="Выберите Ваш город" name="location_id" id="region" class="form-control"> 
                                    <option value="">-- Выберите город --</option>
                                    <option disabled="disabled">-- Города --</option>
                                    {html_options options=$cities selected=$ad->getLocation_id()}
                                    <option id="select-region" value="0">Выбрать другой...</option> </select> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_metro_id" class="col-sm-2 control-label">Метро</label>
                            <div class="col-sm-10">
                                <select title="Выберите станцию метро" name="metro_id" class="form-control" id="fld_metro_id"> <option value="">-- Выберите станцию метро --</option>
                                    {html_options options=$metro_stations selected=$ad->getMetro_id()}
                                </select> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_category_id" class="col-sm-2 control-label">Категория</label> 
                            <div class="col-sm-10">
                                <select title="Выберите категорию объявления" class="form-control" name="category_id" id="fld_category_id"> <option value="">-- Выберите категорию --</option>
                                    {html_options options=$categories selected=$ad->getCategory_id()}
                                </select>
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_title" class="col-sm-2 control-label">Название объявления</label> 
                            <div class="col-sm-10">
                                <input type="text" maxlength="50" class="form-control" value="{$ad->getTitle()|escape}" name="title" id="fld_title" placeholder="Porsche Cayenne">
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label for="fld_description" id="js-description-label" class="col-sm-2 control-label">Описание объявления</label> 
                            <div class="col-sm-10">
                                <textarea maxle rows="5" ngth="3000" class="form-control" name="description" placeholder="Отличный автомобиль в полной комплектации" id="fld_description">{$ad->getDescription()|escape}</textarea> 
                            </div>            
                        </div>            

                        <div class="form-group">
                            <label id="price_lbl" for="fld_price" class="col-sm-2 control-label">Цена</label> 
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-addon">руб.</div>
                                    <input type="text" maxlength="9" class="form-control" value="{$ad->getPrice()|escape}" name="price" id="fld_price" placeholder="00">
                                    <div class="input-group-addon">.00</div>
                                </div>            
                            </div>            
                        </div>            

                            <input type="hidden" value="{$smarty.get.id}" name="ad_id" id="ad_id">

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-success" id="form_submit">{if $ad_flag eq 2}Сохранить{else}Отправить{/if}</button>
                            </div>            
                        </div>            

                    </form>

                    <div class="well well-lg">
                        <h3 class="text-center">Лаба #16</h3>
                        <p class="text-center">AJAX</p>
                    </div>

                </div>
            </div>

        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>    
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <!--<script src="js/bootstrap.min.js"></script>-->
        <script src="js/common.js"></script>
        <script src="js/jquery.form.min.js"></script>
    </body>
</html>
