CREATE OR REPLACE FUNCTION get_commandes_client(p_id_client int)
RETURNS TABLE (
    id_commande integer,
    date_commande date,
    date_livraison date,
    prix_commande double precision
) AS
'
BEGIN
    RETURN QUERY
    SELECT c.id_commande, c.date_commande, c.date_livraison, c.prix_commande
    FROM commande c
    WHERE c.id_client = p_id_client
    ORDER BY c.date_commande DESC;
END;
' LANGUAGE 'plpgsql';