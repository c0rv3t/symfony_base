<?php

namespace App\Enum;

enum OrderStatus: string
{
    case Preparation = "En préparation";
    case Expediee = "Expediée";
    case Livree = "Livrée";
    case Annulee = "Annulée";
}
