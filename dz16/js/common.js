$(document).ready(function () {

    $('a.delete').on('click', function () {
        var tr = $(this).closest('tr');
        var id = tr.children('td:first').html();
        console.log(id);

        var param = {"id":id}; //JSON

        $.getJSON('ajax_ads.php?action=delete',
        param,
        function(response) {
                if(response.status=='success'){
                    
                    if($('#ad_id').val() === id) {
                        $('#ad_descr').html('Новое объявление');
                        $('#ad_form input').val('');
                        $('#ad_form select').val('');
                        $('#ad_form :checkbox').prop("checked", false);
                        $('#ad_form #radio_private').prop("checked", true);
                    }

                    
                    tr.fadeOut('slow', function () {
                        tr.remove();
                    });
                        $('#container').removeClass('alert-danger').addClass('alert-warning');
                        $('#container_info').html(response.message);
                        $('#container').fadeIn('slow');
                        
                        if(  $('.ad_row').size() ===0 ){
                            $('#container1').fadeIn('slow');
                        }
                    
                }else if(response.status=='error'){
                    $('#container').removeClass('alert-warning').addClass('alert-danger');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn('slow');
                }
        });
    });
}
);
