$(document).ready(function () {



    $('a.delete').on('click', function () {
        var tr = $(this).closest('tr');
        var id = tr.children('td:first').html();
        console.log(id);

        var param = {"id":id}; //JSON
        
        $('#container').load('ajax_ads.php?action=delete&id=' + id,
                function () {
                    if($('#ad_id').val() === id) {
                        $('#ad_descr').html('Новое объявление');
                        $('#ad_form input').val('');
                        $('#ad_form select').val('');
                        $('#ad_form :checkbox').prop("checked", false);
                        $('#ad_form #radio_private').prop("checked", true);
//                    $('#ad_form')[0].reset();
                    }
                    tr.fadeOut('slow', function () {
                        $(this).remove();
                    });
                });
//        $.getJSON('ajax_ads.php?action=delete',
//        param,
//        function(response) {
//            tr.fadeOut('slow',function(){
//                if(response.status=='success'){
//                    
//                    if($('#ad_id').val() === id) {
//                        $('#ad_descr').html('Новое объявление');
//                        $('#ad_form input').val('');
//                        $('#ad_form select').val('');
//                        $('#ad_form :checkbox').prop("checked", false);
//                        $('#ad_form #radio_private').prop("checked", true);
//                    }
//
//                    $('#container').removeClass('alert-danger').addClass('alert-warning');
//                    $('#container_info').html(response.message);
//                    $('#container').fadeIn('slow');
//                    
//                    tr.fadeOut('slow', function () {
//                        $(this).remove();
//                    });
//                    
//                    
//                    
//                    
//                }else if(response.status=='error'){
//                    $('#container').removeClass('alert-warning').addClass('alert-danger');
//                    $('#container_info').html(response.message);
//                    $('#container').fadeIn('slow');
//                }
////                $(this).remove();
//            });
//        });


    });
}
);


