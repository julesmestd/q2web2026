CREATE OR REPLACE FUNCTION get_admin(p_nom_admin text, p_password text)
RETURNS TABLE (
    id_admin int,
    nom_admin varchar(50)
)
AS '
BEGIN
    RETURN QUERY 
    SELECT a.id_admin, a.nom_admin
    FROM admin a
    WHERE a.nom_admin = p_nom_admin AND a.password = p_password;
END;
' LANGUAGE 'plpgsql';