CREATE OR REPLACE FUNCTION update_quantite_panier(p_id_client int, p_id_article int, p_quantite int)
RETURNS integer AS
'
BEGIN
    EXECUTE format('UPDATE panier SET quantite = %L WHERE id_client = %L AND id_article = %L', 
                   p_quantite, p_id_client, p_id_article);
    RETURN 1;
END;
' LANGUAGE 'plpgsql';