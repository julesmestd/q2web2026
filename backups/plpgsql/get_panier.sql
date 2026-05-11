CREATE OR REPLACE FUNCTION get_panier(p_id_client int)
RETURNS TABLE (
    id_article integer,
    nom_article text,
    prix double precision,
    image text,
    quantite integer,
    statut text
) AS
'
BEGIN
    RETURN QUERY
    SELECT a.id_article, a.nom_article, a.prix, a.image, p.quantite, p.statut
    FROM panier p
    JOIN article a ON p.id_article = a.id_article
    WHERE p.id_client = p_id_client AND p.statut = 'actif';
END;
' LANGUAGE 'plpgsql';