CREATE OR REPLACE FUNCTION get_toutes_commandes()
RETURNS TABLE (
    id_commande integer,
    date_commande date,
    date_livraison date,
    prix_commande double precision,
    nom_client text,
    prenom_client text
) AS
'
BEGIN
    RETURN QUERY
    SELECT c.id_commande, c.date_commande, c.date_livraison, c.prix_commande,
           cl.nom_client, cl.prenom_client
    FROM commande c
    JOIN client cl ON c.id_client = cl.id_client
    ORDER BY c.date_commande DESC;
END;
' LANGUAGE 'plpgsql';