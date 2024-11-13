<?php

namespace App\Enum;

enum ProductStatus: string
{
    case Available = "Available";
    case Out = "Out";
    case Preorder = "Preorder";

    public function toString(): string{
        return match($this){
            self::Available=>"Available",
            self::Out=>"Out of stock",
            self::Preorder=>"Preorder"
        };
    }
}
