<?php
declare(strict_types=1);

class Article
{
    public function __construct(
        public readonly int    $id_article,
        public readonly string $nom_article,
        public readonly int    $stock,
        public readonly float  $prix,
        public readonly string $description,
        public readonly string $image,
        public readonly int    $id_type,
    ) {}
}
