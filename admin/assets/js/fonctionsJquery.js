$(document).ready(function () {

    $('#inserer').click(function () {
        $('#ajout_nouveau').toggle();
    });

    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm("Voulez-vous supprimer ce type ?")) {
            let tr = $(this).closest('tr');
            tr.fadeOut('slow');
            $.ajax({
                type: 'get',
                dataType: 'json',
                data: 'id_type=' + id,
                url: 'src/php/ajax/ajaxDeleteType.php',
                success: function (data) {
                    console.log("Suppression OK : " + data);
                }
            });
        }
    });

})