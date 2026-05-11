CREATE OR REPLACE FUNCTION update_champ_article(p_champ text, p_valeur text, p_id int) RETURNS integer AS
'
BEGIN
    EXECUTE format('UPDATE article SET %I = %L WHERE id_article = %L', p_champ, p_valeur, p_id);
    RETURN 1;
END;
' LANGUAGE 'plpgsql';
