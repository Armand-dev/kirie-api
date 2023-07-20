<?php

namespace App\Enums;

enum SignatureType: string
{
    case Digital = 'digital';
    case Manual = 'manual';
}
