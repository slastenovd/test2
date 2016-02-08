$(document).ready(function () {



    $('a.delete').on('click', function () {
        var tr = $(this).closest('tr');
        var id = tr.children('td:first').html();
        console.log(id);

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

    });
}
);


