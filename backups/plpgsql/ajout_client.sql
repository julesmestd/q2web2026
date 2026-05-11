CREATE OR REPLACE FUNCTION ajout_client(
    p_nom text, p_prenom text, p_email text, p_password text,
    p_telephone text, p_cp integer, p_ville text, p_nom_rue text, p_num_rue text
)
RETURNS integer
AS '
DECLARE
v_id_adresse integer;
    v_id_client integer;
BEGIN
INSERT INTO adresse (cp, ville, nom_rue, num_rue)
VALUES (p_cp, p_ville, p_nom_rue, p_num_rue)
    RETURNING id_adresse INTO v_id_adresse;

INSERT INTO client (nom_client, prenom_client, email, mot_de_passe, telephone, id_adresse)
VALUES (p_nom, p_prenom, p_email, p_password, p_telephone, v_id_adresse)
    RETURNING id_client INTO v_id_client;

RETURN v_id_client;
EXCEPTION WHEN OTHERS THEN
    RETURN -1;
END;
' LANGUAGE 'plpgsql';