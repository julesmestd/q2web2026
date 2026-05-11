CREATE OR REPLACE FUNCTION ajout_panier(p_id_client int, p_id_article int)
RETURNS integer AS
'
BEGIN
    IF EXISTS (SELECT 1 FROM panier WHERE id_client = p_id_client AND id_article = p_id_article) THEN
        UPDATE panier SET quantite = quantite + 1
        WHERE id_client = p_id_client AND id_article = p_id_article;
        RETURN 1;
    ELSE
        INSERT INTO panier (id_client, id_article, quantite, statut)
        VALUES (p_id_client, p_id_article, 1, 'actif');
        RETURN 1;
    END IF;
END;
' LANGUAGE 'plpgsql';