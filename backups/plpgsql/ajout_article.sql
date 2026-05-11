CREATE OR REPLACE FUNCTION ajout_article(p_nom text, p_stock int, p_prix numeric, p_descr text, p_type int, p_image text)
RETURNS integer AS
'
DECLARE retour integer;
BEGIN
INSERT INTO article (nom_article, prix, stock, description, id_type, image)
VALUES (p_nom, p_prix, p_stock, p_descr, p_type, p_image)
    ON CONFLICT (nom_article) DO NOTHING
    RETURNING id_article INTO retour;
IF retour IS NOT NULL THEN
        RETURN retour;
END IF;
RETURN -1;
END;
' LANGUAGE 'plpgsql';
