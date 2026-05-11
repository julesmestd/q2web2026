CREATE OR REPLACE FUNCTION get_client(p_email text, p_password text)
RETURNS TABLE (
    id_client integer,
    nom_client text,
    prenom_client text,
    email text,
    mot_de_passe text,
    telephone text,
    id_adresse integer
) AS
'
BEGIN
RETURN QUERY
SELECT c.id_client, c.nom_client, c.prenom_client,
       c.email, c.mot_de_passe, c.telephone, c.id_adresse
FROM client c
WHERE c.email = p_email AND c.mot_de_passe = p_password;
END;
' LANGUAGE 'plpgsql';