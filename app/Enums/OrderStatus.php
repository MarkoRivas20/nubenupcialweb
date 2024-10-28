<?php

namespace App\Enums;

enum OrderStatus: int
{
    case PendingPayment = 1;
    case Pending = 2;
    case Processing = 3;
    case Completed = 4;
    case Cancelled = 5;
    case Refunded = 6;
}

?>