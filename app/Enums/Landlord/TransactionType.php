<?php

namespace App\Enums\Landlord;

enum TransactionType: string
{
    case Rent = 'rent';
    case Tax = 'tax';
    case Repair = 'repair';
    case Investment = 'investment';
}
