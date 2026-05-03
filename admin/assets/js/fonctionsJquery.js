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

    $(document).on('click', '.delete-panier', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm("Supprimer cet article du panier ?")) {
            let tr = $(this).closest('tr');
            let prix = parseFloat(tr.find('.prix-article').text().replace('€', '').replace(',', '.'));
            tr.fadeOut('slow', function() {
                $(this).remove();
                let total = 0;
                $('tr .prix-article').each(function() {
                    total += parseFloat($(this).text().replace('€', '').replace(',', '.'));
                });
                $('#total').text(total.toFixed(2) + '€');
            });
            $.ajax({
                type: 'get',
                dataType: 'json',
                data: 'id_article=' + id,
                url: 'admin/src/php/ajax/ajaxDeletePanier.php',
                success: function (data) {
                    console.log("Suppression OK : " + data);
                }
            });
        }
    });

    $(document).on('click', '.btn-plus', function () {
        let tr = $(this).closest('tr');
        let id = tr.data('id');
        let prix = parseFloat(tr.data('prix'));
        let span = tr.find('.quantite');
        let quantite = parseInt(span.text()) + 1;
        span.text(quantite);
        tr.find('.prix-article').text((prix * quantite).toFixed(2) + '€');
        let total = 0;
        $('tr .prix-article').each(function () {
            total += parseFloat($(this).text().replace('€', '').replace(',', '.'));
        });
        $('#total').text(total.toFixed(2) + '€');
        $.ajax({
            type: 'get', dataType: 'json',
            data: 'id_article=' + id + '&quantite=' + quantite,
            url: 'admin/src/php/ajax/ajaxUpdateQuantite.php',
            success: function (data) { console.log("Quantité : " + data); }
        });
    });

    $(document).on('click', '.btn-moins', function () {
        let tr = $(this).closest('tr');
        let id = tr.data('id');
        let prix = parseFloat(tr.data('prix'));
        let span = tr.find('.quantite');
        let quantite = parseInt(span.text()) - 1;
        if (quantite < 1) {
            return;
        } else {
            span.text(quantite);
            tr.find('.prix-article').text((prix * quantite).toFixed(2) + '€');
            let total = 0;
            $('tr .prix-article').each(function () {
                total += parseFloat($(this).text().replace('€', '').replace(',', '.'));
            });
            $('#total').text(total.toFixed(2) + '€');
            $.ajax({
                type: 'get', dataType: 'json',
                data: 'id_article=' + id + '&quantite=' + quantite,
                url: 'admin/src/php/ajax/ajaxUpdateQuantite.php',
                success: function (data) { console.log("Quantité : " + data); }
            });
        }
    });


})