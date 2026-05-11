CREATE OR REPLACE FUNCTION effacer_panier(p_id_client int, p_id_article int)
RETURNS integer AS
'
DECLARE retour integer;
BEGIN
    DELETE FROM panier WHERE id_client = p_id_client AND id_article = p_id_article
    RETURNING id_article INTO retour;
    IF retour IS NOT NULL THEN
        RETURN 1;
    END IF;
    RETURN 0;
END;
' LANGUAGE 'plpgsql';