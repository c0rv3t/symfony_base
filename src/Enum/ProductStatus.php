<?php

namespace App\Enum;

enum ProductStatus : string
{
    case Disponible = "Disponible";
    case Rupture = "Rupture de stock";
    case Précommande = "En précommande";
}

?>