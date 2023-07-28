<?php

namespace App\Enums\Landlord;

enum TransactionStatus: string
{
    case Unpaid = 'unpaid';
    case Paid = 'paid';
}
