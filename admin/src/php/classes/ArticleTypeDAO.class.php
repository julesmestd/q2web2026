<?php
class ArticleTypeDAO
{
    private PDO $_cnx;

    public function __construct(PDO $_cnx)
    {
        $this->_cnx = $_cnx;
    }

    public function getVueArticles()
    {
        $query = "SELECT * FROM vue_articles_types ORDER BY id_article";
        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array_map(function ($d) {
                return new ArticleType(
                    id_article:  (int)$d['id_article'],
                    nom_article: (string)$d['nom_article'],
                    stock:       (int)$d['stock'],
                    prix:        (float)$d['prix'],
                    description: (string)$d['description'],
                    image:       (string)$d['image'],
                    id_type:     (int)$d['id_type'],
                    nom_type:    (string)$d['nom_type']
                );
            }, $data);
        } catch (PDOException $e) {
            print $e->getMessage();
            return null;
        }
    }
}
