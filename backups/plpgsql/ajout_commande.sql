CREATE OR REPLACE FUNCTION ajout_commande(p_id_client int, p_prix_commande double precision)
RETURNS integer AS
'
DECLARE 
    retour integer;
BEGIN
    INSERT INTO commande (date_commande, date_livraison, prix_commande, id_client)
    VALUES (CURRENT_DATE, CURRENT_DATE + 7, p_prix_commande, p_id_client)
    RETURNING id_commande INTO retour;

    IF retour IS NOT NULL THEN
        INSERT INTO commande_article (id_article, id_commande, quantite, prix_unitaire)
        SELECT p.id_article, retour, p.quantite, a.prix
        FROM panier p
        JOIN article a ON p.id_article = a.id_article
        WHERE p.id_client = p_id_client AND p.statut = 'actif';

        DELETE FROM panier WHERE id_client = p_id_client AND statut = 'actif';

        RETURN retour;
    END IF;
    RETURN -1;
END;
' LANGUAGE 'plpgsql';