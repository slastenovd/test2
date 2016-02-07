$(document).ready(function () {

    $('a.delete').on('click', function () {
        var tr = $(this).closest('tr');
        var id = tr.children('td:first').html();
        console.log(id);

        $('#container').load('index.php?action=delete&id=' + id,
                function () {
                    tr.fadeOut('slow', function () {
                        $(this).remove();
                    });
                });

    });
}
);
