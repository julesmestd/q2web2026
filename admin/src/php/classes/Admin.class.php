<?php declare (strict_types=1);

class Admin
{
    public function __construct(public int $id_admin, public string $nom_admin,public int $statut)
    {

    }
}
