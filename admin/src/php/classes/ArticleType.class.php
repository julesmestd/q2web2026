<?php
class ArticleType extends Article
{
    public function __construct(
        int    $id_article,
        string $nom_article,
        int    $stock,
        float  $prix,
        string $description,
        string $image,
        int    $id_type,
        public readonly string $nom_type
    ) {
        parent::__construct($id_article, $nom_article, $stock, $prix, $description, $image, $id_type);
    }
}
