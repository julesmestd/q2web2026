$(document).ready(function () {

    $('#inserer').click(function () {
        $('#ajout_nouveau').toggle();
    });

    $(document).on('click', '.delete-type', function (e) {
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
                    console.log("Type supprimé : ", data);
                }
            });
        }
    });



    $(document).on('blur', 'td[contenteditable="true"]', function () {
        let nouveau = $.trim($(this).text());
        let id = $(this).attr('id');
        let champ = $(this).data('champ');
        $.ajax({
            type: 'get',
            dataType: 'json',
            data: 'champ=' + champ + '&nouveau=' + nouveau + '&id_article=' + id,
            url: 'src/php/ajax/ajaxUpdateArticle.php',
            success: function (data) {
                console.log("Mise à jour OK : " + data);
            }
        });
    });


    $(document).on('change', '.selectType', function () {
        let nouveau = $(this).val();
        let td = $(this).closest('td');
        let id = td.attr('id');
        $.ajax({
            type: 'get',
            dataType: 'json',
            data: 'champ=id_type&nouveau=' + nouveau + '&id_article=' + id,
            url: 'src/php/ajax/ajaxUpdateArticle.php',
            success: function (data) {
                console.log("Type mis à jour : " + data);
            }
        });
    });


    $(document).on('click', '.delete-article', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        if (confirm("Voulez-vous supprimer cet article ?")) {
            let tr = $(this).closest('tr');
            tr.fadeOut('slow');

            $.ajax({
                type: 'get',
                dataType: 'json',
                data: 'id_article=' + id,
                url: 'src/php/ajax/ajaxDeleteArticle.php',
                success: function (data) {
                    console.log("Article supprimé : ", data);
                }
            });
        }
    });

})