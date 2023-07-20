<?php

namespace App\Enums;

enum LeaseStatus: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case PendingSignature = 'pending_signature';
    case PendingCommencement = 'pending_commencement';
    case Canceled = 'canceled';
}
