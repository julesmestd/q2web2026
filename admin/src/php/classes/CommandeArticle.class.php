<?php
declare(strict_types=1);

class CommandeArticle
{
    public function __construct(
        public readonly int   $id_article,
        public readonly int   $id_commande,
        public readonly int   $quantite,
        public readonly float $prix_unitaire
    ) {}
}