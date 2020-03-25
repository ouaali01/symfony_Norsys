<?php


namespace App\Service;


class CalculPrixTTC
{
    public function getPrixTTC($prix)
    {
        $prixTTC=$prix + ($prix * 0.2);

        return $prixTTC;
    }
}