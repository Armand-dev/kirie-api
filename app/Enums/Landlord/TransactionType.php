<?php

namespace App\Enums\Landlord;

enum TransactionType: string
{
    case Rent = 'rent';
    case Repair = 'repair';
    case Investment = 'investment';
}
