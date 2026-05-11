CREATE OR REPLACE FUNCTION effacer_article(p_id int) RETURNS integer AS
'
DECLARE retour integer;
BEGIN
    DELETE FROM article WHERE id_article = p_id
    RETURNING id_article INTO retour;
    IF retour IS NOT NULL THEN
        RETURN 1;
    END IF;
    RETURN 0;
END;
' LANGUAGE 'plpgsql';
