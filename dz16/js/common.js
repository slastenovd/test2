$(document).ready(function () {
    
    var delete_function = function () {
        var tr = $(this).closest('tr');
        var id = tr.children('td:first').html();
        var param = {"id":id}; //JSON
        $('#container_form_msg').fadeOut('slow');

        $.getJSON('ajax_ads.php?action=delete',
        param,
        function(response) {
                if(response.status=='success'){
                    
                    if($('#ad_id').val() === id) {
                        clear_form();
                    }
                    
                    tr.fadeOut('slow', function () {
                        tr.remove();
                        if(  $('tbody > tr').size() ===0 ){
                            $('#container1').fadeIn('slow');
                            $('#rable-ads').fadeOut();
                        }
                    });
                        $('#container').removeClass('alert-danger').addClass('alert-warning');
                        $('#container_info').html(response.message);
                        $('#container').fadeIn('slow');
                        
                    
                }else if(response.status=='error'){
                    $('#container').removeClass('alert-warning').addClass('alert-danger');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn('slow');
                }
        });
    };


    show_ad = function () { // Показать объявление
        var tr = $(this).closest('tr');
        var id = tr.children('td:first').html();
        var param = {"id":id}; 
        $('#container_form_msg').fadeOut('slow');

        $.getJSON('ajax_ads.php?action=get_ad',
        param,
        function(response) {

            $('#ad_form #radio_private').prop("checked", (response[0].private == 0) ? true : false );
            $('#ad_form #radio_company').prop("checked", (response[0].private == 1) ? true : false );
            $('#fld_seller_name').val(response[0].seller_name);
            $('#fld_manager').val(response[0].manager);
            $('#fld_email').val(response[0].email);
            $('#ad_form :checkbox').prop("checked", (response[0].allow_mails == 1) ? true : false );
            $('#fld_phone').val(response[0].phone);
            $('#region').val(response[0].location_id);
            $('#fld_metro_id').val(response[0].metro_id);
            $('#fld_category_id').val(response[0].category_id);
            $('#fld_title').val(response[0].title);
            $('#fld_description').val(response[0].description);
            $('#fld_price').val(response[0].price);
            $('#ad_id').val(response[0].ad_id);
            $('#ad_descr').html('Просмотр объявления от '+response[0].date_change+'<br>о продаже '+response[0].title+' за '+response[0].price+' руб.');
        });        
        return false; 
    };

    $('a.ad-href').on('click', show_ad);        // Показать объявление
    $('a.delete').on('click', delete_function); // Удалить объявление
    
    function clear_form(){ // Очистить форму
        $('#ad_descr').html('Новое объявление');
        $('#ad_form input, #ad_form select, #ad_form textarea').val('');
        $('#ad_form :checkbox').prop("checked", false);
        $('#ad_form #radio_private').prop("checked", true);
        $('#container, #container1, #container_form_msg').fadeOut('slow');
    }

    $('#href-new-ad').on('click', function () { // Новое объявление
        clear_form();
        return false; 
    });

    function refresh_table(){ // Заполнить таблицу
        $.getJSON('ajax_ads.php?action=get_ads',
        function(response) {
            $('tbody>tr').remove();
            $.each(response, function (i,val) {
                        $('tbody').append(  '<tr>'+
                                            '<td style="display: none;" class="ad_row">'+val.ad_id+'</td>'+
                                            '<td>'+val.date_change+'</td>'+
                                            '<td><a class="ad-href" href=index.php?id='+val.ad_id+'>'+val.title+'</a></td>'+
                                            '<td>'+val.price+'</td>'+
                                            '<td>'+val.seller_name+'</td>'+
                                            '<td>'+val.phone+'</td>'+
                                            '<td><a class="delete btn btn-warning"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>'+
                                            '</tr>');
            });
            $('a.delete').on('click', delete_function);
            $('a.ad-href').on('click', show_ad);
            $('#rable-ads').fadeIn();
        });        
        return false; 
    }
    
    $('#form_submit').on('click', function () { // Сохранить объявление
        $('#container, #container1, #container_form_msg').fadeOut('slow');
        
        $.post('ajax_ads.php?action=store_ad',
            $("#ad_form").serialize(),
            function(response) {
                if(response.status=='success'){
                    $('#container_form_msg').removeClass('alert-danger').addClass('alert-success');
                    refresh_table();
                    clear_form();
                }
                if(response.status=='error'){
                    $('#container_form_msg').removeClass('alert-success').addClass('alert-danger');
                }
                $('#container_info_form_msg').html(response.message);
                $('#container_form_msg').fadeIn('slow');              
            },'json');        
        return false;         
    });
}
);