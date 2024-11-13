<?php

namespace App\Enum;

enum OrderStatus: string
{
    case Pending = "Pending";
    case Shipped = "Shipped";
    case Delivered = "Delivered";
    case Canceled = "Canceled";

    public function toString(): string{
        return match($this){
            self::Pending=>"Pending",
            self::Shipped=>"Shipped",
            self::Delivered=>"Delivered",
            self::Canceled=>"Canceled"
        };
    }
}
