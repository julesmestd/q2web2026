<?php
declare(strict_types=1);

class Panier
{
    public function __construct(
        public readonly int    $id_client,
        public readonly int    $id_article,
        public readonly int    $quantite,
        public readonly string $statut
    ) {}
}