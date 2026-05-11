CREATE OR REPLACE FUNCTION effacer_type(p_id int) RETURNS integer
AS
'
    DECLARE retour integer;
BEGIN
    DELETE FROM type WHERE id_type = p_id
    RETURNING id_type INTO retour;
    IF retour IS NOT NULL
    THEN
        RETURN 1;
    END IF;
    RETURN 0;
END;
'
LANGUAGE 'plpgsql';